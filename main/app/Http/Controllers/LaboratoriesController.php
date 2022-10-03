<?php

namespace App\Http\Controllers;

use App\Exports\LaboratoryExport;
use Illuminate\Http\Request;
use App\Models\Laboratories;
use App\Models\CupLaboratory;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;


class LaboratoriesController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function paginate()
    {
        return $this->success(Laboratories::with('patient')
            ->with('cup')
            ->when(request()->get('fecha'), function ($q, $fill) {
                $fechas = explode('a', request()->get('fecha'));
                $f1 = new Carbon($fechas[0]);
                $f2 = new Carbon($fechas[1]);
                $q->whereBetween('date', [$f1, $f2]);
            })
            ->when(request()->get('paciente'), function ($q, $fill) {
                $q->whereHas('patient', function ($query) {
                    $query->where(DB::raw("CONCAT(firstname,' ', middlename, ' ', surname, ' ', secondsurname)"), 'like', '%' . request()->get('paciente') . '%')
                        ->orWhere('identifier', 'like', '%' . request()->get('paciente') . '%');
                });
            })
            ->when(request()->get('ciudad'), function ($q, $fill) {
                $q->whereHas('patient', function ($query) {
                    $query->whereHas('municipality', function ($query2) {
                        $query2->where('name', 'like', '%' . request()->get('ciudad') . '%');
                    });
                });
            })
            ->when(request()->get('eps'), function ($q, $fill) {
                $q->whereHas('patient', function ($query) {
                    $query->whereHas('eps', function ($query2) {
                        $query2->where('name', 'like', '%' . request()->get('eps') . '%');
                    });
                });
            })
            ->when(request()->get('estado'), function ($q, $fill) {
                $q->where('status', 'like', '%' . $fill . '%');
            })
            ->when(request()->get('codigo'), function ($q, $fill) {
                $q->where('id', '=', $fill);
            })
            ->when(request()->get('laboratory_id'), function ($q, $fill) {
                $q->where('laboratory_id', '=', $fill);
            })
            ->orderByDesc('created_at')
            ->paginate(request()->get('pageSize', 10), ['*'], 'page', request()->get('page', 1)));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Laboratories::create([
            'patient' => $request->get('patient')['id'],
            'date' => $request->get('date'),
            'contract_id' => $request->get('contract_id'),
            'professional_id' => $request->get('professional_id'),
            'cie10_id' => $request->get('cie10_id')['value'],
            'laboratory_id' => $request->get('laboratory_id'),
            'ips_id' => $request->get('ips_id'),
        ])->id;
        foreach ($request->get('cups') as $cup) {
            CupLaboratory::create([
                'id_laboratory' => $id,
                'id_cup' => $cup["id"],

            ]);
        }
        return $this->success('Creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->success(Laboratories::where('id', $id)
            ->with('patient', 'cup', 'place', 'contract', 'professional', 'cie10', 'motivo')
            /* ->join('causal_anulacion', 'Causal_Anulacion.Id_Causal_Anulacion', '=', 'laboratories.motivo_id') */
            ->first());
    }

    public function cupsLaboratory($id)
    {
        return $this->success(
            DB::table('cup_laboratories')
                ->where('id_laboratory',  '=', $id)
                ->join('cups', 'cups.id', '=', 'cup_laboratories.id_cup')
                ->select('cup_laboratories.*', 'cups.description as name_cup', 'cups.code')
                ->get()
        );
    }

    public function tomarOrAnular(Request $request)
    {
        Laboratories::updateOrCreate(['id' => $request->get('id')], $request->all());
    }

    public function deleteDocument($id)
    {
        CupLaboratory::find($id)->update([
            'state' => 'Pendiente',
            'file' => null
        ]);
    }

    public function cargarDocumento(Request $request)
    {
        try {
            $base64 = saveBase64File($request->file, 'laboratory/', false, '.pdf');
            $file = URL::to('/') . '/api/file?path=' . $base64;
            foreach ($request->get('ids') as $cup) {
                //return $this->success($cup);
                CupLaboratory::updateOrCreate(
                    [
                        'id' => $cup,
                    ],
                    [
                        'file' => $file,
                        'state' => $request->get('status'),
                    ]
                );
            }

            return $this->success('Creado Con éxito');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 500);
        }
    }

    public function getCausalAnulation()
    {
        return $this->success(DB::table('Causal_Anulacion')->select('Id_Causal_Anulacion as value', 'Nombre as text')->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function report()
    {
        $laboratoriesday = Laboratories::whereDate('created_at', Carbon::today())
            ->with('patient', 'cup', 'place', 'contract', 'professional', 'cie10', 'motivo')
            ->get();

        return Excel::download(new LaboratoryExport(), 'reporte-dia.xlsx');
        return 'asd';
        /* $pdf = PDF::loadHTML($contenido);
        return $pdf->download('reporte.pdf'); */
    }

    public function downloadFiles($id)
    {
        /* $pdfmerge = PDFMerger::init(); */
        $laboratory = Laboratories::where('id', $id)->with('cup')->first();
        $files = [];
        foreach ($laboratory->cup as $cup) {
            if ($cup->file != null) {
                array_push($files, $cup->file);
            }
        }
        return $this->success(array_unique($files));
    }

    public function pdf($id)
    {
        $patient = DB::table('laboratories as l')->where('l.id', $id)
            ->join('patients as p', 'l.patient', '=', 'p.id')
            ->join('type_documents as t', 'p.type_document_id', '=', 't.id')
            ->select(
                DB::raw("CONCAT(p.firstname, ' ', p.middlename, ' ', p.surname, ' ', p.secondsurname) AS name_patient"),
                'p.type_document_id',
                'p.identifier',
                'p.gener',
                'p.date_of_birth',
                't.code',
                'l.*'
            )
            ->first();
        $cups = DB::table('laboratories as l')->where('l.id', $id)
            ->join('cup_laboratories as cl', 'cl.id_laboratory', '=', 'l.id')
            ->join('cups as c', 'cl.id_cup', '=', 'c.id')
            ->select('c.code')
            ->get();
        $ips = DB::table('laboratories as l')->where('l.id', $id)
            ->join('companies as c', 'c.id', '=', 'l.ips_id')
            ->select('c.name', 'c.tin', 'c.dv')
            ->first();
        $cupsHTML = '';
        foreach ($cups as $cup) {
            $cupsHTML = $cupsHTML . $cup->code . ' - ';
        }
        $edad = Carbon::parse($patient->date_of_birth)->age;
        $hora = date("g:i a", strtotime($patient->hour));
        $fecha = date("d/m/Y", strtotime($patient->hour));
        $codebar = new DNS1D();
        $codebarLaboratory = $codebar->getBarcodeHTML(str_pad($patient->id, 12, "0", STR_PAD_LEFT), 'EAN13', 1.8, 20);
        $contenido =
            '<!DOCTYPE html>
        <html lang="en" style="margin: 2pt;">
        
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
            .vertical {
                position: absolute;
                font-size: 3px;
                float: right;
                top: 0;
                width: 60pt;
                min-height: 20pt;
                -moz-transform: rotate(270deg);
                /* FF3.5+ */
                -o-transform: rotate(270deg);
                /* Opera 10.5 */
                -webkit-transform: rotate(-90deg);
                /* Saf3.1+, Chrome */
                -moz-transform-origin: 100% 100%;
                -o-transform-origin: 100% 100%;
                -webkit-transform-origin: 100% 100%;
              }
            </style>
        </head>
        
        <body style="margin: 0;">                       
            <div>
                <span style="font-size: 7.5px;">' . $patient->name_patient . '<br>'
            . $patient->code . '. ' . number_format($patient->identifier, 0, "", ".") . '<br>Edad: '
            . $edad . ' años - (' . date("d/m/Y", strtotime($patient->date_of_birth)) . ')<br>Sexo: ' . $patient->gener . '<br>Fecha y hora: ' . $fecha . ' a las ' . $hora . '<br></span>
                ' . $codebarLaboratory . '
                <p style="font-size: 7.5px;margin-top: 0; padding-top: 0;margin-bottom: 0; padding-bottom: 0;">' . $cupsHTML . '</p>
                 
            </div>   
            <div class="vertical"><b style="font-size: 3.2px !important">' . number_format($ips->tin, 0, "", ".") . '-' . $ips->dv . '</b> ' .  $ips->name . '</div>          
        </body>
        
        </html>';

        $pdf = PDF::loadHTML($contenido)->setPaper([0.0, 0.0, 71, 144], 'landscape');
        return $this->success('data:application/pdf;base64,', base64_encode($pdf->stream()));
        //return $pdf->stream('etiqueta.pdf');
    }
}