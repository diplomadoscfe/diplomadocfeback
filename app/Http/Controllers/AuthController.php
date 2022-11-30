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

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string',
            'permisosu' => 'required|boolean'
        ]);

        $permiso='permisos';
        /*if($permiso==true){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'permisosu' => $request->permisosu
            ]);
        }*/
        $usuario = DB::table('users')
            ->select('email')
            ->where('email','=',$request->email)
            ->get();

            /*if($usuario=$request->email){
                return response()->json([
                    'message'=>'el usuario ya fue registrado'
                ]);
            }*/
            if($request->permisosu=true){
                $permiso='asignar';
            }else 
            if ($request->permisosu=false){
                $permiso='noasignar';
            }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'permisosu' => $permiso
        ]);
    

        return response()->json([
            'message' => 'usuario creado'
        ], 201);
    }
    
    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);        
        $credentials = request(['email', 'password']);
        
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'datos incorrectos'
            ], 401);
        
        
        $user = $request->user();
        $permisos = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $permiso = $permisos->permisosu;
        //return response()->json($tokenResult);
        if($permiso == 'asignar' || $permiso == 'noasignar'){
            return response()->json([
                'message' => 'los permisos no han sido asignados'
            ]);
        };

        return response()->json([
            'access_token' => $tokenResult->plainTextToken,
            'token_type' => 'Bearer',
            'permiso' => $permisos->permisosu,
            //'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
            'message' => 'inicio de sesion con exito'
        ]);
    }

    /**
     * Cierre de sesión (anular el token)
     */

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'sesion cerrada'
        ]);
    }

    /**
     * Obtener el objeto User como json
     */

    public function user(Request $request)
    {

        return response()->json($request->user());
    }
    /*public function getpowerreport(Request $request){
            if (!($request->user()->permisosu)) {
                return response()->json(['mensaje' => 'No cuenta con los permisos necesarios'], 401);
            }
            $reportes = DB::table('planreportes')
                ->select('*')
                ->get();
    
            return response()->json($reportes, 200);
    }
    */
   
}