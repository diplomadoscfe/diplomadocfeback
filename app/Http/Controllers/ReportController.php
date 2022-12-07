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

class ReportController extends Controller
{
    /**
     * Obtener el objeto User como json
     */
    public function user(Request $request)
    {

        return response()->json($request->user());
    }

    // CONSULTA DE REPORTES DE POWER BI
    public function powerrepo(Request $request){
        $request->validate([
            'division'=>'required|string',
        ]);
        $div = DB::table('division')
            ->where('nombre','=',$request->division);
        
        if($div=$request->division){
            $reporteplan = DB::table('planreportes')
            ->select('reporte')
            ->where('tipoP', '=',$request->division)
            ->get();

            if(count($reporteplan)<=0){
                return response()->json(['mensaje'=>'categoria no encontrada'], 200);
}
            return response()->json($reporteplan, 200);          
}
    
}
public function powermenu(Request $request){
    
    
        $reporteplan = DB::table('planreportes')
        ->select('tipoP','reporte')
        ->get();

        return response()->json($reporteplan, 200);          
}

public function powerrepor(Request $request){
    $request->validate([
        'division'=>'required|string',
    ]);
    $div = DB::table('division')
        ->where('nombre','=',$request->division);
    
    if($div=$request->division){
        $reporteplan = DB::table('planreportes')
        ->select('reporte')
        ->where('tipoP', '=',$request->division)
        ->get();

        if(count($reporteplan)<=0){
    return response()->json(['mensaje'=>'categoria no encontrada'], 200);
}
        return response()->json($reporteplan, 200);          
}

}
    
public function reporte1(Request $request){
    
        $reporteplan = DB::table('planreportes')
        ->select('reporte')
        ->where('nombre', '=','reporte1')
        ->get();
        return response()->json($reporteplan, 200);          
}
public function reporte2(Request $request){
    
    $reporteplan = DB::table('planreportes')
    ->select('reporte')
    ->where('nombre', '=','reporte2')
    ->get();
    return response()->json($reporteplan, 200);          
}
public function reporte3(Request $request){
    
    $reporteplan = DB::table('planreportes')
    ->select('reporte')
    ->where('nombre', '=','reporte4')
    ->get();
    return response()->json($reporteplan, 200);          
}
public function reporte4(Request $request){
    
    $reporteplan = DB::table('planreportes')
    ->select('reporte')
    ->where('nombre', '=','reporte5')
    ->get();
    return response()->json($reporteplan, 200);          
}
public function reporte5(Request $request){
    
    $reporteplan = DB::table('planreportes')
    ->select('reporte')
    ->where('nombre', '=','reporte6')
    ->get();
    return response()->json($reporteplan, 200);          
}
public function reporte6(Request $request){
    
    $reporteplan = DB::table('planreportes')
    ->select('reporte')
    ->where('nombre', '=','reporte7')
    ->get();
    return response()->json($reporteplan, 200);          
}
public function reporte7(Request $request){
    
    $reporteplan = DB::table('planreportes')
    ->select('reporte')
    ->where('nombre', '=','reporte8')
    ->get();
    return response()->json($reporteplan, 200);          
}
public function reporte8(Request $request){
    
    $reporteplan = DB::table('planreportes')
    ->select('reporte')
    ->where('nombre', '=','reporte9')
    ->get();
    return response()->json($reporteplan, 200);          
}

}
