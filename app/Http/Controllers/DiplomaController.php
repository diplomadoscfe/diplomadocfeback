<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\DB;



class DiplomaController extends Controller
{
    //
    public function user(Request $request)
    
    {

        return response()->json($request->user());
    }

    public function inicioDiplomado(Request $request){

            $diploma = DB::table('division')
            ->select('nombre','imagen')
            ->where('nombre','=','pruebas')
            ->get();

                    return response()->json(['mensaje'=>'',$diploma], 200);
                }

    public function insertar(Request $request){
        $producto = request()->all();
        return response()->json($producto);

        Productos::insert($producto);
        return response()->json($producto);
    }

    public function insertarfoto(Request $request){

        $producto=request();
        if($request->hasFile('foto')){
            $producto['foto']=$request->file('foto')->store('fotosProductos','public');
        };

        $nombre='pruebas';
        DB::table('division')
        ->insert(['nombre'=>$nombre,'imagen' => $producto]);
        return response()->json(['mensaje'=>'proceso terminado']);
    }
    
            
}
