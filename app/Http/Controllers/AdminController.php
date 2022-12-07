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
            ->select('name','apellidosp','apellidosm','email')
            ->where('permisosu','=','asignar')
            ->get();

        return response()->json($permisou, 200);
    }
    public function permisosad(Request $request){
        $permisou = DB::table('users')
            ->select('name','email')
            ->where('permisosu','=','asignar')
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
    public function adregistros(Request $request){
        $request->validate([
            'nombre' => 'string',
            'apellidop'=>'string',
            'apellidom'=>'string',
            'email'=>'required|string|email',
            'usuario'=>'string',
            'password'=>'string',
            'curp'=>'string',
            'rpe'=>'string',
            'diplomado'=>'string',
            'division'=>'string',
            'materia'=>'string'

        ]);

        
            $revision = DB::table('users')
            ->select('permisosu')
            ->where('email','=',$request->email)
            ->get();
            $revisional = DB::table('alumnos')
            ->select('nombre')
            ->where('usuario','=',$request->email)
            ->get();
            $revisionin = DB::table('instructor')
            ->select('nombre')
            ->where('usuario','=',$request->email)
            ->get();
            $revisionad = DB::table('admin_personal')
            ->select('nombre')
            ->where('usuario','=',$request->email)
            ->get();
            $revisionpe = DB::table('personal')
            ->select('nombre')
            ->where('usuario','=',$request->email)
            ->get();


            $formularioal = DB::table('alumnos')
            ->select('nombre','apellidop','apellidom','RPE','curp','diplomado','division','usuario')
            ->where('usuario','=',$request->email)
            ->get();
            $formularioin = DB::table('instructor')
            ->select('nombre','apellidop','apellidom','RPE','diplomado','division','materia','usuario')
            ->where('usuario','=',$request->email)
            ->get();
            $formularioad = DB::table('admin_personal')
            ->select('nombre','apellidop','apellidom','usuario')
            ->where('usuario','=',$request->email)
            ->get();
            $formularioper = DB::table('personal')
            ->select('nombre','apellidop','apellidom','usuario')
            ->where('usuario','=',$request->email)
            ->get();
            /*$formularionom = DB::table('personal')
            ->select('nombre')
            ->where('usuario','=',$request->email && 'nombre',' like ',%$request->nombre%)
            ->get();*/
            if(!count($revisional)<=0){
                $usuario='Alumno';
            }elseif(!count($revisionin)<=0){
                $usuario='Instructor';
            }elseif(!count($revisionad)<=0){
                $usuario='Admin';
            }elseif(!count($revisionpe)<=0){
                $usuario='Personal';
            }

                    if($revision != 'asignar' || $revision != 'noasignar'){
                        switch($usuario) {
                            case('Alumno'):

                                        /*if(!$request->nombre==''){
                                                    $permisosg = DB::table('alumnos')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['nombre'=>$request->nombre]);
                                                };
                                                if(!$request->apellidop==''){
                                                    $permisosg = DB::table('alumnos')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['apellidop'=>$request->apellidop]);
                                                };
                                                if(!$request->apellidom==''){
                                                    $permisosg = DB::table('alumnos')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['apellidom'=>$request->apellidom]);
                                                };
                                                if(!$request->password==''){
                                                    $permisosg = DB::table('alumnos')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['contraseña'=>$request->password]);
                                                };*/
                                                if(!$request->curp==''){
                                                    $curpal = DB::table('alumnos')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['curp'=>$request->curp]);
                                                };
                                                if(!$request->rpe==''){
                                                    $rpeal = DB::table('alumnos')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['rpe'=>$request->rpe]);
                                                };
                                                if(!$request->diplomado==''){
                                                    $diplomadoal = DB::table('alumnos')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['diplomado'=>$request->diplomado]);
                                                };
                                                if(!$request->division==''){
                                                    $divisional = DB::table('alumnos')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['division'=>$request->division]);
                                                };
                                                
                                                $formulario = ([$revisional,$curpal,$rpeal,$diplomadoal,$divisional]);

                                    return response()->json(['mensaje'=>'informacion asignada',$formularioal], 200);
                                break;
                 
                            case('Instructor'):
                                                /*if(!$request->nombre==''){
                                                    $permisosg = DB::table('instructor')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['nombre'=>$request->nombre]);
                                                };
                                                if(!$request->apellidop==''){
                                                    $permisosg = DB::table('instructor')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['apellidop'=>$request->apellidop]);
                                                };
                                                if(!$request->apellidom==''){
                                                    $permisosg = DB::table('instructor')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['apellidom'=>$request->apellidom]);
                                                };
                                                if(!$request->password==''){
                                                    $permisosg = DB::table('instructor')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['contraseña'=>$request->password]);
                                                };*/
                                                if(!$request->materia==''){
                                                    $materiain = DB::table('instructor')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['materia'=>$request->materia]);
                                                };
                                                if(!$request->rpe==''){
                                                    $rpein = DB::table('instructor')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['rpe'=>$request->rpe]);
                                                };
                                                if(!$request->diplomado==''){
                                                    $diplomadoin = DB::table('instructor')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['diplomado'=>$request->diplomado]);
                                                };
                                                if(!$request->division==''){
                                                    $divisionin = DB::table('instructor')
                                                    ->where('usuario','=',$request->email)
                                                    ->update(['division'=>$request->division]);
                                                };
                                                $formulario = ([$revisionin,$materiain,$rpein,$diplomadoin,$divisionin]);

                                    return response()->json(['mensaje'=>'informacion asignada',$formulario], 200);
                                break;

                            case('Admin'):
                            if(!$request->nombre==''){
                                $permisosg = DB::table('admin_personal')
                                ->where('usuario','=',$request->email)
                                ->update(['nombre'=>$request->nombre]);
                            };
                            if(!$request->password==''){
                                $permisosg = DB::table('admin_personal')
                                ->where('usuario','=',$request->email)
                                ->update(['contraseña'=>$request->password]);
                            };
                                    return response()->json(['mensaje'=>'informacion asignada',$revisionad], 200);
                                break;

                            case('Personal'):
                                if(!$request->nombre==''){
                                    $permisosg = DB::table('personal')
                                    ->where('usuario','=',$request->email)
                                    ->update(['nombre'=>$request->nombre]);
                                };
                                if(!$request->password==''){
                                    $permisosg = DB::table('personal')
                                    ->where('usuario','=',$request->email)
                                    ->update(['contraseña'=>$request->password]);
                                };
                                    return response()->json(['mensaje'=>'informacion asignada',$revisionpe], 200);
                                    
                                    break;
                 
                            default:
                               return response()->json(['mensaje'=>'nombre de permisos no encontrados'], 200);

                        };


                    };
                        return response()->json (['mensaje'=>'los permisos ya fueron colocados anteriormente'], 200);
                    /*$request->email,$revisiona,$revisioni,$revisionad,$revisionp*/
    }

    public function adminguardar(Request $request){
        $request->validate([
            'nombre' => 'required|string',
            'apellidop'=>'string',
            'apellidom'=>'string',
            'email'=>'required|string|email',
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

                    if($revision = 'asignar' || $revision = 'noasignar'){
                    //if($revision = '"permisosu":"0"' && $revision = '"permisosu":"1"'){
                    //if($comprobaciona <= 0 || $comprobacioni <= 0 || $comprobacionad <= 0 || $comprobacionp <= 0){
                        switch($request->permisos) {
                            case('Alumno'):
                 
                                
                                $revisional = DB::table('alumnos')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();
                                $revisionin = DB::table('instructor')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();
                                $revisionad = DB::table('admin_personal')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();
                                $revisionpe = DB::table('personal')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();

                                if(count($revisional) <= 0 && count($revisionin) <= 0 && count($revisionad) <= 0 && count($revisionpe) <= 0 ){
                                    $permisosg = DB::table('users')
                                        ->where('email','=',$request->email)
                                        ->update(['permisosu'=>$request->permisos]);

                                        $sql = "SELECT * FROM users WHERE name=? AND email<?";
                                        $nombreal = DB::select($sql,array($request->nombre,$request->email));
                                        
                                        $apellidopat = User::where('email','=',$request->email,'&','apellidop','=',$request->apellidop)
                                        ->select('name')
                                        ->get();
                                        $apellidomat = User::where('email','=',$request->email,'&','apellidom','=',$request->apellidom )
                                        ->select('name')
                                        ->get();
                                        $diploma='asignar';
                                        if(count($nombreal) <= 0 && count($apellidopat) <= 0 && count($apellidomat) <= 0 ){
                                            return response()->json(['mensaje'=>'nombre incorrecto'],200);
                                        }
                                        DB::table('alumnos')
                                        ->insert(['nombre' => $request->nombre,'apellidop'=>$request->apellidop,'apellidom'=>$request->apellidom,
                                        'usuario' => $request->email,'diplomado' => $diploma]);

                                    return response()->json(['mensaje'=>'permisos asignados'], 200);
                                };
                                break;
                 
                            case('Instructor'):
                                 
                                $revisional = DB::table('alumnos')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();
                                $revisionin = DB::table('instructor')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();
                                $revisionad = DB::table('admin_personal')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();
                                $revisionpe = DB::table('personal')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();

                                if(count($revisional) <= 0 && count($revisionin) <= 0 && count($revisionad) <= 0 && count($revisionpe) <= 0 ){
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
                                $revisional = DB::table('alumnos')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();
                                $revisionin = DB::table('instructor')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();
                                $revisionad = DB::table('admin_personal')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();
                                $revisionpe = DB::table('personal')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();

                                if(count($revisional) <= 0 && count($revisionin) <= 0 && count($revisionad) <= 0 && count($revisionpe) <= 0 ){
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
                                $revisional = DB::table('alumnos')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();
                                $revisionin = DB::table('instructor')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();
                                $revisionad = DB::table('admin_personal')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();
                                $revisionpe = DB::table('personal')
                                ->select('usuario')
                                ->where('usuario','=',$request->email)
                                ->get();

                                if(count($revisional) <= 0 && count($revisionin) <= 0 && count($revisionad) <= 0 && count($revisionpe) <= 0 ){
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
    public function usuarioGuardar(Request $request){
        $request->validate([
            'nombre' => 'required|string',
            'email'=>'required|string|email',
            'diplomado'=>'string'
        ]);
            $consulta = DB::table('alumnos')
            ->select('diplomado')
            ->where('usuario','=',$request->email)
            ->get();

            $alumno = DB::table('alumnos')
            ->select('usuario')
            ->where('usuario','=',$request->email)
            ->get();

            $instructor = DB::table('instructor')
            ->select('usuario')
            ->where('usuario','=',$request->email)
            ->get();

            //if(!count($alumno)<=0){
                $salida = empty($consulta);
                if($salida==false){
                    return response()->json(['mensaje'=>'alumno',$alumno], 200);
                }elseif(count($consulta)>=0){
                    return response()->json(['mensaje'=>'instruccion vacia',$consulta], 200);
                }else{
                    return response()->json(['mensaje'=>'ya tiene el diplomado',$consulta], 200);
                }
                
            }
            
    
            public function adminguardarprueba(Request $request){
                $request->validate([
                    'nombre' => 'required|string',
                    'email'=>'required|string|email',
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
        
                            if($revision = 'asignar' || $revision = 'noasignar'){
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

                                            $diploma='asignar';
                                        DB::table('alumnos')
                                        ->insert(['nombre' => $request->nombre,
                                        'usuario' => $request->email,'diplomado' => $diploma]);
        
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

            public function inicioDiplomado(Request $request){
                $request->validate([
                    'nombre' => 'required|string',
                    'imagen'=>'required|image',
                ]);
                    $diploma = DB::table('division')
                    ->select('nombre')
                    ->where('nombre','=',$request->nombre)
                    ->get();
        
                        if(count($diploma)<=0){
                            return response()->json(['mensaje'=>'division no encontrada'], 200);
                        }else{
                            
                            $diplomaimagen = DB::table('division')
                            ->where('nombre','=',$request->nombre)
                            ->update(['imagen' => $request->imagen]);

                            return response()->json(['mensaje'=>'accion terminada'], 200);
                        }
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