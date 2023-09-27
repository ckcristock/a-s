<?php

namespace App\Http\Controllers;

use App\Models\Cup;
use Illuminate\Http\Request;


use App\Imports\CupsImport;
use App\Http\Controllers\Controller;
use App\Models\Agendamiento;
use App\Models\Color;
use App\Models\Cup_type;
use App\Models\Space;
use App\Services\CupService;
use App\Models\Speciality;
use App\Models\TypeService;
use App\Traits\ApiResponser;
use Dotenv\Result\Success;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class CupController extends Controller
{

    public function __construct(CupService $cupService)
    {
        $this->cupService = $cupService;
    }

    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $cups = Cup::query();

        $cups->when(request()->get('year'), function ($q) {
            $q->where('year', request()->get('year'))->get();
        });

        $cups->when((request()->get('speciality')), function ($q) {
            $cupIds = DB::table('cup_speciality')->select('cup_id')->where('speciality_id', request()->get('speciality'));
            $q->where(function ($q) {
                $q->where('description', 'Like', '%' . request()->get('search') . '%')
                    ->orWhere('code', 'Like', '%' . request()->get('search') . '%');
            })
                ->where(function ($q) use ($cupIds) {
                    $q->orWhereIn('id', $cupIds->pluck('cup_id'));
                });
        });

        $cups->when(request()->get('space'), function ($q, $spaceId) {
            $space = Space::with('agendamiento.cups:id')->find($spaceId);
            $cupIds = DB::table('cup_speciality')->select('cup_id')->where('speciality_id', $space->agendamiento->speciality_id);
            $q->where(function ($q) {
                $q->where('description', 'Like', '%' . request()->get('search') . '%')
                    ->orWhere('code', 'Like', '%' . request()->get('search') . '%');
            })
                ->where(function ($q) use ($space, $cupIds) {
                    $q->whereIn('id', $space->agendamiento->cups->pluck('id'))
                        ->orWhereIn('id', $cupIds->pluck('cup_id'));
                });
        });

        $cups->when(request()->get('search'), function ($q) {
            $q->where(function ($q) {
                $q->where('description', 'Like', '%' . request()->get('search') . '%')
                    ->orWhere('code', 'Like', '%' . request()->get('search') . '%');
            });
        });

        $cups->when(request()->get('type'), function ($q) {
            $q->whereHas('type_service', function ($q) {
                $q->where('type_service_id', request()->get('type'));
            });
        }); //?relacionar con la nueva tabla

        return $this->success($cups->get(['id as value',  DB::raw("CONCAT( code, ' - ' ,description) as text")])->take(30));
    }

    public function paginate()
    {
        try {
            return $this->success(
                Cup::orderBy('description')->with('colors','type_service')
                    ->when(request()->get('description'), function (Builder $q) {
                        $q->where('description', 'like', '%' . request()->get('description') . '%');
                    })
                    ->when(request()->get('type_service_id'), function (Builder $q) {
                        $q->where('type_service_id', '=', request()->get('type_service_id'));
                    })
                    ->when(request()->get('code'), function (Builder $q) {
                        $q->where('code', 'like', '%' . request()->get('code') . '%');
                    })->paginate(request()->get('pageSize', 10), ['*'], 'page', request()->get('page', 1))
            );
        } catch (\Throwable $th) {
            return  $this->errorResponse([$th->getMessage(), $th->getFile(), $th->getLine()]);
        }
    }

    public function getTypes() {
        return $this->success(TypeService::select('id as value', 'name as text')->get());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        try {
            $Cup = Cup::updateOrCreate(['id' => request()->get('id')], request()->all());
            $Cup->specialities()->sync(request()->get('specialities'));
            $Cup->type_service()->sync(request()->get('type_service_id'));
            return ($Cup->wasRecentlyCreated === true) ? response()->success('Creado con éxito') : response()->success('Actualizado con éxito');
        } catch (\Throwable $th) {
            return  $this->errorResponse([$th->getMessage(), $th->getFile(), $th->getLine()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cup  $cup
     * @return \Illuminate\Http\Response
     */
    public function show($cup)
    {
        return response()->success(
            Cup::with('specialities:id', 'type_service:id')
                ->find($cup)
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cup  $cup
     * @return \Illuminate\Http\Response
     */
    public function edit(Cup $cup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cup  $cup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cup $cup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cup  $cup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cup $cup)
    {
        //
    }


    public function import()
    {
        Excel::import(new CupsImport, request()->file('file'));
        return redirect('/')->with('success', 'All good!');
    }

    public function storeFromMedical()
    {
        try {
            // $specialities = Speciality::get(['code', 'name']);
            // foreach ($specialities as  $speciality) {
            $this->cups = json_decode($this->cupService->get(), true);
            // if (count($this->cups) > 0) {
            $this->handlerInsertTable($this->cups);
            // }
            // }
            return $this->success('Datos insertados Correctamente');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 400);
        }
    }

    public function handlerInsertTable($data)
    {
        foreach ($data as  $item) {
            if (gettype($item) != 'array') {
                // dd('Necesitas un array');
            } else {
                $dataFormated = [];
                foreach ($item as $index =>  $value) {
                    if (gettype($value) == 'array') {
                        $this->handlerInsertTableRespaldo($value, $index);
                    } else {
                        if ($index == 'Name') {
                            $dataFormated['description'] = $value;
                        }
                        $dataFormated[customSnakeCase($index)] = $value;
                        // $dataFormated['speciality'] = $speciality;
                    }
                }
            }

            $cup = Cup::firstWhere('code', $dataFormated['code']);
            if (!$cup) {
                Cup::create($dataFormated);
            }
        }
    }


    public function handlerInsertTableRespaldo($data, $table)
    {
        // if (count($data) > 0) {
        //     if ($table != 'EPSs' && $table != 'Interface' && $table != 'Parent' && $table != 'Regional') {
        //         $dataFormated = [];
        //         foreach ($data as $index =>  $value) {
        //             if (gettype($value) == 'array') {
        //                 dd('Otro array');
        //             } else {
        //                 if ($index == 'NAME') {
        //                     $dataFormated['description'] = $value;
        //                 }
        //                 $dataFormated[customSnakeCase($index)] = $value;
        //             }
        //         }
        //     }
        // }
    }
}
