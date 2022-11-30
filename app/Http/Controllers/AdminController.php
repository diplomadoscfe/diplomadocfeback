<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\user;

class AdminController extends Controller
{
    /**
     * Obtener el objeto User como json
     */
    public function user(Request $request)
    
    {

        return response()->json($request->user());
    }

    // CONSULTA DE REPORTES DE POWER BI
    public function permisosAceptados(Request $request){
        $permisou = DB::table('users')
            ->select('name','email')
            ->whereIn('permisosu',['1','0'])
            ->get();

        return response()->json($permisou, 200);
    }
    public function permisosad(Request $request){
        $permisou = DB::table('registro_permiso')
            ->select('name','email')
            ->where('permisosu','=','1')
            ->get();

        return response()->json($permisou, 200);
    }

    public function permisospre(Request $request){
        $permisou = DB::table('users')
            ->select('permisosu')
            ->get();

        return response()->json($permisou, 200);
    }
   /* public function adguardar(Request $request){
        $request->validate([
            'email'=>'required|string',
            'permisos'=>'string'
        ]);
        $permiso = request(['permisos']);

        if($permiso === 'Alumno'){
            $permisosg = DB::table('users')
            ->where('email','=',$request->email)
            ->update(['permisosu'=>$permiso
    ]);
            $permisosa = DB::table('users')
            ->select('name','email','password')
            ->where('email','=',$request->email)
            ->get();

            DB::table('alumnos')
            ->insert(['name' => $permisosa->name,
            'email' => $permisosa->email,
            'password' => $permisosa->password,
            'permisosu' => $permisosa->permisosu]);

            return response()->json(['mensaje'=>'permisos',$permiso], 200);
        }
        switch($permiso){
                case('Alumno'):
                    $permisosg = DB::table('users')
                        ->where('email','=',$request->email)
                        ->update(['permisosu'=>$permiso
                ]);
                break;
        }
        
    return response()->json(['mensaje'=>'permisos asignados con exito',$permiso], 200);
          
    }*/

    /*public function adguardar(Request $request){
        $request->validate([
            'nombre' => 'required|string',
            'email'=>'required|string',
            'permisos'=>'required|string'
        ]);
        $perm = DB::table('users')
            ->select('permisosu')
            ->where('email','=',$request->email)
            ->get();


            if($perm == false || $perm == true){
                $acceso = $perm;
                if($acceso = '0' || $acceso = '1'){
                        return response()->json([
                            'message' => 'permisos fallidos'
                        ],200);
                    }else{
                        
                        if($request->permisos=='Alumno'){
                    $permisosg = DB::table('users')
                    ->where('email','=',$request->email)
                    ->update(['permisosu'=>$request->permisos]);

                    $revision = DB::table('alumnos')
                    ->select('usuario')
                    ->where('usuario','=',$request->email)
                    ->get();

                        if(count($revision)<=0){

                            DB::table('alumnos')
                            ->insert(['nombre' => $request->nombre,
                            'usuario' => $request->email]);
                        }else{
                            return response()->json(['mensaje'=>'correo registrado anteriormente',$request->nombre], 200);
                        };
                        return response()->json(['mensaje'=>'permisos exitosos',$request->nombre], 200);
                    };

                            
                };
                if($request->permisos=='Instructor'){
                    $permisosg = DB::table('users')
                    ->where('email','=',$request->email)
                    ->update(['permisosu'=>$request->permisos]);
        
                    $revision = DB::table('instructor')
                    ->select('usuario')
                    ->where('usuario','=',$request->email)
                    ->get();
                    
                    if(count($revision)<=0){

                        DB::table('instructor')
                        ->insert(['nombre' => $request->nombre,
                        'usuario' => $request->email]);
                    }else{
                        return response()->json(['mensaje'=>'correo registrado anteriormente',$request->nombre], 200);
                    }

                        return response()->json(['mensaje'=>'permisos exitosos',$request->nombre], 200);
                };
                if($request->permisos=='Admin'){
                    $permisosg = DB::table('users')
                    ->where('email','=',$request->email)
                    ->update(['permisosu'=>$request->permisos]);

                    $revision = DB::table('admin_personal')
                        ->select('usuario')
                        ->where('usuario','=',$request->email)
                        ->get();
                    
                    if(count($revision)<=0){

                        DB::table('admin_personal')
                        ->insert(['nombre' => $request->nombre,
                        'usuario' => $request->email]);
                    }else{
                        return response()->json(['mensaje'=>'correo registrado anteriormente',$request->nombre], 200);
                    }

                        return response()->json(['mensaje'=>'permisos exitosos',$request->nombre], 200);
                };
                if($request->permisos=='Personal'){

                    $permisosg = DB::table('users')
                    ->where('email','=',$request->email)
                    ->update(['permisosu'=>$request->permisos]);

                    $revision = DB::table('personal')
                        ->select('usuario')
                        ->where('usuario','=',$request->email)
                        ->get();
                    
                    if(count($revision)<=0){

                        DB::table('personal')
                        ->insert(['nombre' => $request->nombre,
                        'usuario' => $request->email]);
                    }else{
                        return response()->json(['mensaje'=>'correo registrado anteriormente',$request->nombre], 200);
                    };

                        return response()->json(['mensaje'=>'permisos exitosos',$request->nombre], 200);
                };
                            /*$permisosa = DB::table('users')
                            ->select('name','email','password')
                            ->where('email','=',$request->email)
                            ->get();
                */
                            /*DB::table('alumnos')
                            ->insert([
                                'nombre' => 'nombre1',
                            'email' => $permisosa->email,
                            'contraseña' => $permisosa->password]);
                return response()->json(['mensaje'=>'permisos'], 200);
            }else{
                return response()->json(['mensaje'=>'el usuario ya fue ingresado anteriormente'], 200);
            };
    }*/
    public function adminguardar(Request $request){
        $request->validate([
            'nombre' => 'required|string',
            'email'=>'required|string',
            'permisos'=>'required|string'
        ]);
        $perm = DB::table('users')
            ->select('permisosu')
            ->where('email','=',$request->email)
            ->get();

            $revision = DB::table('users')
            ->select('permisosu')
            ->where('email','=',$request->email)
            ->get();

            $revisiona = DB::table('alumnos')
                    ->select('usuario')
                    ->where('usuario','=',$request->email)
                    ->get();
            $revisioni = DB::table('instructor')
                    ->select('usuario')
                    ->where('usuario','=',$request->email)
                    ->get();
            $revisionad = DB::table('admin_personal')
                    ->select('usuario')
                    ->where('usuario','=',$request->email)
                    ->get();
            $revisionp = DB::table('personal')
                    ->select('usuario')
                    ->where('usuario','=',$request->email)
                    ->get();

                    $comprobaciona = count($revisiona);
                    $comprobacioni = count($revisioni);
                    $comprobacionad = count($revisionad);
                    $comprobacionp = count($revisionp);

                    if($revision = 'asignar' || $revision = 'noasignar'){
                    //if($revision = '"permisosu":"0"' && $revision = '"permisosu":"1"'){
                    //if($comprobaciona <= 0 || $comprobacioni <= 0 || $comprobacionad <= 0 || $comprobacionp <= 0){
                        switch($request->permisos) {
                            case('Alumno'):
                 
                                
                                $revision = DB::table('alumnos')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();

                                if(count($revision) <= 0 ){
                                    $permisosg = DB::table('users')
                                        ->where('email','=',$request->email)
                                        ->update(['permisosu'=>$request->permisos]);
                                    
                                DB::table('alumnos')
                                ->insert(['nombre' => $request->nombre,
                                'usuario' => $request->email]);

                                    return response()->json(['mensaje'=>'permisos asignados',$request->nombre], 200);
                                };
                                break;
                 
                            case('Instructor'):
                                 
                                $revision = DB::table('instructor')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();

                                if(count($revision) <= 0 ){
                                $permisosg = DB::table('users')
                                ->where('email','=',$request->email)
                                ->update(['permisosu'=>$request->permisos]);
                    
                                
                                            
                                    DB::table('instructor')
                                    ->insert(['nombre' => $request->nombre,
                                    'usuario' => $request->email]);

                                    return response()->json(['mensaje'=>'permisos asignados',$request->nombre], 200);
                                };
                                break;

                            case('Admin'):
                                $revision = DB::table('admin_personal')
                                    ->select('usuario')
                                    ->where('usuario','=',$request->email)
                                    ->get();

                                if(count($revision) <= 0 ){
                                $permisosg = DB::table('users')
                                    ->where('email','=',$request->email)
                                    ->update(['permisosu'=>$request->permisos]);

                                DB::table('admin_personal')
                                ->insert(['nombre' => $request->nombre,
                                'usuario' => $request->email]);
                    

                                    return response()->json(['mensaje'=>'permisos asignados',$request->nombre], 200);
                                };
                                break;

                            case('Personal'):
                                 $revision = DB::table('personal')
                                    ->select('usuario')
                                    ->where('usuario','=',$request->email)
                                    ->get();
                                
                                if(count($revision) <= 0 ){
                                $permisosg = DB::table('users')
                                    ->where('email','=',$request->email)
                                    ->update(['permisosu'=>$request->permisos]);
            
                                    DB::table('personal')
                                    ->insert(['nombre' => $request->nombre,
                                    'usuario' => $request->email]);
            
                                    return response()->json(['mensaje'=>'permisos asignados',$request->nombre], 200);
                                    };
                                    break;
                 
                            default:
                               return response()->json(['mensaje'=>'nombre de permisos no encontrados'], 200);

                        };


                    };
                        return response()->json (['mensaje'=>'los permisos ya fueron colocados anteriormente'], 200);
                    /*$request->email,$revisiona,$revisioni,$revisionad,$revisionp*/
    }
    public function alumnoGuardar(Request $request){

            $permisosg = DB::table('users')
                ->where('email','=',$request->email)
                ->update(['permisosu'=>$request->permisos]);
                
            $revision = DB::table('alumnos')
            ->select('usuario')
            ->where('usuario','=',$request->email)
            ->get();

            if(count($revision) <= 0 ){

            DB::table('alumnos')
            ->insert(['nombre' => $request->nombre,
            'usuario' => $request->email]);

                return response()->json(['mensaje'=>'permisos exitosos',$request->nombre], 200);
            };
    }
    
    
/*    import axios from 'axios'
//const url_base_Pb = 'http://192.168.0.145:8000/api/auth';
const url_base_Pb = process.env.REACT_APP_PB_URL;

//axios
export async function requestAxios (){
    try{
    const response = await axios({
        method:'get',
        url:`${url_base_Pb}/reporte1`
    })
        return response
    }catch (error){
        console.log(error);
}
}
const baseurl = 'http://192.168.0.145:8000/api/auth';
const ("nombre de variable") = async ("datos") => {
    await axios.post(baseUrl + '("funcion")', { 'id': ("datos").id }, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'content-type': 'application/json', 'Authorization': 'Bearer ' + cookies.get('accessToken', { path: '/iatsaFleet' }) } }).
        then(response => {
            console.log(response.data);
            getUnidades();
        }).catch(error => {
            console.log(error);
        })
}*/
}