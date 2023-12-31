<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\Product;
use App\Models\VariableProduct;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $data = DB::table('producto')
    ->select([
                                DB::raw('CONCAT(Principio_Activo, " ",Presentacion, " ",Concentracion, " (",Nombre_Comercial,") ",Cantidad," ",Unidad_Medida," EMB: ", Embalaje ) as Nombre'),
                                'Id_Producto','Codigo_Cum',
                                'Codigo_Cum as Cum',
                                'Principio_Activo',
                                'Descripcion_ATC',
                                'Codigo_Barras',
                                'Id_Producto',
                                'Id_Categoria',
                                'Id_Subcategoria',
                                'Laboratorio_Generico as Generico',
                                'Laboratorio_Comercial as Comercial',
                                'Invima as Invima',
                                'Imagen as Foto',
                                'Nombre_Comercial as Nombre_Comercial',
                                'Id_Producto',
                                'Embalaje',
                                'Tipo as Tipo',
                                'Producto_Dotacion_Tipo',
                                'Producto_Dotation_Type_Id',
                                'Tipo_Catalogo',
                                'pdt.name as nombreDotacionTipo',
                                'Estado'
                            ])


            ->leftJoin('product_dotation_types as pdt', 'pdt.id', '=', 'producto.Producto_Dotation_Type_Id');

        return $this->success(
            $data->when(request()->get("tipo"), function ($q) {
                $q->where("Tipo_Catalogo", request()->get("tipo"));
            })

        ->paginate(request()->get('pageSize', 10), ['*'], 'page', request()->get('page', 1))
        );



    }

    public function getProductActa()
    {
        $page = Request()->get('page');
        $page = $page ? $page : 1;
        $pageSize = Request()->get('pageSize');
        $pageSize = $pageSize ? $pageSize : 10;

        $d = DB::table('producto as p')
            ->Leftjoin('inventario_nuevo AS inu', 'inu.Id_Producto', '=', 'p.Id_Producto')
            ->select(
                DB::raw(' IFNULL(inu.Cantidad, 0) as CantidadInventario'),
                'p.Id_Producto',
                'inu.Lote',
                'p.Codigo_Cum',

                'p.Principio_Activo',

                'p.Codigo_Barras',

                'p.Id_Categoria',
                'p.Id_Subcategoria',
                'p.Laboratorio_Generico as Generico',
                'p.Laboratorio_Comercial as Comercial',
                'p.Invima as Invima',
                'p.Imagen as Foto',
                'p.Nombre_Comercial as Nombre_Comercial',

                'p.Embalaje',
                'p.Tipo as Tipo',
                'p.Tipo_Catalogo',
                'p.Id_Tipo_Activo_Fijo',
                'p.Estado',
                'p.Referencia'
            )
            ->where('inu.Cantidad', '>', 0)
            ->where('p.Tipo_Catalogo', 'Medicamento')
            ->selectRaw('(SELECT IFNULL(SUM(Cantidad-(Cantidad_Apartada+Cantidad_Seleccionada)),0)
                          FROM Inventario_Nuevo WHERE Id_Producto = p.Id_Producto ) as cantidadA')

            ->when(Request()->get('type'),  function ($q, $fill) {
                $q->where('ID.type', $fill);
            })
            ->when(Request()->get('name'),  function ($q, $fill) {
                $q->where('ID.name', 'like', '%' . $fill . '%');
            })

            ->paginate($pageSize, '*', 'page', $page);

        return $this->success($d);
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
        try {

            $data = $request->except(["dynamic"]);
            $dynamic = request()->get("dynamic");
            $product = Product::create($data);
            // echo json_encode($product);
            foreach($dynamic as $d){
				$d["product_id"] = $product->id;
				VariableProduct::create($d);
			}

            return $this->success("guardado con éxito");


        } catch (\Throwable $th) {
            return $this->error(['message' => $th->getMessage(), $th->getLine(), $th->getFile()], 400);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        try {
            $data = $request->except(["dynamic", "Status", "Codigo", "Producto_Dotacion_Tipo"]);
            $dynamic = request()->get("dynamic");
           // var_dump($dynamic);
            $product = Product::where('Id_Producto', $id)->update($data);

            foreach($dynamic as $d){
                $d['product_id'] = $id;
			    VariableProduct::updateOrCreate(['id' => $d["id"]], $d);
			}

            return $this->success("guardado con éxito");

        } catch (\Throwable $th) {
            return $this->error(['message' => $th->getMessage(), $th->getLine(), $th->getFile()], 400);
        }
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
}
