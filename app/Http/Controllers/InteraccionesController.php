<?php

namespace App\Http\Controllers;

use App\Models\bibliografia;
use App\Models\farmaco;
use App\Models\grupofarmaco;
use App\Models\interacciones;
use Illuminate\Http\Request;

class InteraccionesController extends Controller
{
    
    
    public function destroy(Request $request, interacciones $interacciones)
    {
     
        $interacciones->delete();
        $bibliografias = bibliografia::all();
        $grupofarmaco= grupofarmaco::all();
        $ninter = interacciones::select('interacciones.*')
        ->where('interacciones.idfarmaco', $request->id_farmaco )->count();
                                       // return $ninter;
        if($ninter==0){

        $interacciones = farmaco::select('farmacos.*')
                                        ->where('farmacos.id', $request->id_farmaco )
                                        ->get();
        }else{
        $interacciones = interacciones::select('farmacos.*', 'interacciones.*')
                                        ->join('farmacos', 'interacciones.idfarmaco', '=', 'farmacos.id')
                                        ->where('interacciones.idfarmaco', $request->id_farmaco )
                                        ->get();

        }  
                                   //return $interacciones;
                                   $biblioselect = farmaco::select('bibliografias.*')
                                   ->join('farmacobiblios', 'farmacos.id', '=', 'farmacobiblios.farmaco_id')   
                                   ->join('bibliografias', 'farmacobiblios.bibliografia_id', '=', 'bibliografias.id')
                                   ->where('farmacos.id', $request->id_farmaco )
                                   ->get();
      return view("farmacos.create", ['bibliografias' => $bibliografias, 'gfar' => $grupofarmaco, 'inter' => $interacciones, 'idfarmaco' => $request->id_farmaco, 'count'=>$ninter, 'biblioselect' => $biblioselect]);    
    }
    public function store3(Request $request, farmaco $farmaco)
    {    //$farmaco-> farmaco=$request->farmaco;
       //return $request->interaccion;

        $interaccionUpdate= interacciones::findOrFail( $request->id_interaccion);
        $interaccionUpdate -> interaccion=$request->interaccion;
        $interaccionUpdate;
        $interaccionUpdate->save();

        $ultimo=$request->id_farmaco;

        $bibliografias = bibliografia::all();
        $grupofarmaco= grupofarmaco::all();
        $interacciones = interacciones::select('farmacos.*', 'interacciones.*')
                                   ->join('farmacos', 'interacciones.idfarmaco', '=', 'farmacos.id')
                                   ->where('interacciones.idfarmaco', $ultimo )
                                   ->get();
                                  //return $interacciones;
                                  $biblioselect = farmaco::select('bibliografias.*')
                                  ->join('farmacobiblios', 'farmacos.id', '=', 'farmacobiblios.farmaco_id')   
                                  ->join('bibliografias', 'farmacobiblios.bibliografia_id', '=', 'bibliografias.id')
                                  ->where('farmacos.id', $ultimo)
                                  ->get();
       return view("farmacos.create", ['bibliografias' => $bibliografias, 'gfar' => $grupofarmaco, 'inter' => $interacciones, 'idfarmaco' => $ultimo, 'biblioselect' => $biblioselect]);
    }

    
}
