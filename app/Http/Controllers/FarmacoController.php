<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\farmaco;
use App\Models\bibliografia;
use App\Models\grupofarmaco;
use App\Models\interacciones;
use Illuminate\Support\Facades\Log;




class FarmacoController extends Controller
{
    public function apifarmacos()
    {
        return farmaco::all();
    }
    public function index(){
         $farmacos = farmaco::with('bibliografia','grupofarmaco')->get();
        return view('farmacos.index', ['farmacos' => $farmacos]);
        
    }
    public function create(){
        $bibliografias = bibliografia::all();
        $grupofarmaco= grupofarmaco::all();
        $biblioselect = farmaco::select('bibliografias.*')
        ->join('farmacobiblios', 'farmacos.id', '=', 'farmacobiblios.farmaco_id')   
        ->join('bibliografias', 'farmacobiblios.bibliografia_id', '=', 'bibliografias.id')
        ->where('farmacos.id', 0)
        ->get();
        return view("farmacos.create", ['bibliografias' => $bibliografias, 'gfar' => $grupofarmaco, 'biblioselect' => $biblioselect]);
    }

    public function create2(farmaco $farmaco){
        $idfarmaco=$farmaco->id;
        $bibliografias = bibliografia::all();
        $grupofarmaco= grupofarmaco::all();
        $interacciones = interacciones::select('farmacos.*', 'interacciones.*')
                                   ->join('farmacos', 'interacciones.idfarmaco', '=', 'farmacos.id')
                                   ->where('interacciones.idfarmaco', $idfarmaco )
                                   ->get();
                                  //return $interacciones;
                                  $biblioselect = farmaco::select('bibliografias.*')
                                  ->join('farmacobiblios', 'farmacos.id', '=', 'farmacobiblios.farmaco_id')   
                                  ->join('bibliografias', 'farmacobiblios.bibliografia_id', '=', 'bibliografias.id')
                                  ->where('farmacos.id', $idfarmaco)
                                  ->get();
       return view("farmacos.create", ['bibliografias' => $bibliografias, 'gfar' => $grupofarmaco, 'inter' => $interacciones, 'idfarmaco' => $idfarmaco, 'biblioselect' => $biblioselect]);
    }

    public function store(Request $request){
        $farmaco= new farmaco();
        $farmaco-> farmaco=$request->farmaco;
        $farmaco-> mecanismo=$request->mecanismo;
        $farmaco-> url=$request->urlimagen;
        $farmaco-> efecto=$request->efecto;
        $farmaco-> recomendaciones=$request->recomendaciones;
        $farmaco-> id_bibliografia=$request->id_bibliografia;
        $farmaco-> id_grupo=$request->id_grupofarmaco;
        $farmaco-> estatus=1;
        $farmaco->save();
        $farmacos =farmaco::all();
        return view('farmacos.index', ['farmacos' => $farmacos]);
        //return redirect()->route('farmacos.index', ['farmacos' => $farmacos]);
    }

    public function store2(Request $request){
        Log::info('Se ha accedido a una ruta dentro del grupo /mi-grupo');

        if ($request->id_farmaco==''){
        $farmaco= new farmaco();
        $farmaco-> farmaco=$request->farmaco;
        $farmaco-> mecanismo=$request->mecanismo;
            //guardar imagen
            $name=$request->input('farmaco');
            $ruta_carpeta = 'imgfarmacos';
            $imagen = $request->file('urlimagen');
            $ruta_imagen = $imagen->storeAs($ruta_carpeta,$name.".".$imagen->extension(),'public');
        $farmaco-> url=$ruta_imagen;
        
        $farmaco-> efecto=$request->efecto;
        $farmaco-> recomendaciones=$request->recomendaciones;
        $farmaco-> id_grupo=$request->id_grupofarmaco;
        $farmaco-> estatus=1;
        //return $farmaco;
        $farmaco->save();
        $ultimofarmaco = farmaco::latest()->first();
        $ultimo=$ultimofarmaco->id;
            // guarda bibliografias
            $biblios=$request->id_bibliografia;
            $farmaco->bibliografia()->attach($biblios);
            /// fin bibliografias
        }else{

        $ultimo=$request->id_farmaco;
  
        }
        
        $interaccion= new interacciones();
        $interaccion-> tipo="xxxx";
        $interaccion-> interaccion=$request->interaccion;
        $interaccion-> idfarmaco=$ultimo;
        $interaccion-> estatus=1;
        //return $interaccion;
        $interaccion->save();
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


    public function show(farmaco $farmaco){
        return view('farmacos.show', compact('farmaco'));
    }

    public function edit(farmaco $farmaco)
    {
        $bibliografias = bibliografia::all();
        $grupofarmacos = grupofarmaco::all();
        return view('farmacos.edit', compact('farmaco'),['bibliografias' => $bibliografias, 'grupos' => $grupofarmacos]);
    }

    public function update(Request $request, farmaco $farmaco)
    {
        $farmaco-> farmaco=$request->farmaco;
        $farmaco-> mecanismo=$request->mecanismo;
            //guardar imagen
        if($request->urlimagen!=""){

            $name=$request->input('farmaco');
            $ruta_carpeta = 'imgfarmacos';
            $imagen = $request->file('urlimagen');
            $ruta_imagen = $imagen->storeAs($ruta_carpeta,$name.".".$imagen->extension(),'public');
        $farmaco-> url=$ruta_imagen;
        }
        $farmaco-> efecto=$request->efecto;
        $farmaco-> recomendaciones=$request->recomendaciones;
        $farmaco-> id_grupo=$request->id_grupofarmaco;
        $farmaco-> estatus=1;
        //return $farmaco;
        $farmaco->save();
        // guarda bibliografias
        $biblios=$request->id_bibliografia;
        $farmaco->bibliografia()->sync($biblios);
        /// fin bibliografias

        $ultimo=$request->id_farmaco;
        $bibliografias = bibliografia::all();
        $grupofarmaco= grupofarmaco::all();
        $interacciones = interacciones::select('farmacos.*', 'interacciones.*')
                                   ->join('farmacos', 'interacciones.idfarmaco', '=', 'farmacos.id')
                                   ->where('interacciones.idfarmaco', $ultimo )
                                   ->get();
/////// consulta de bibliografias seleccionadas
        $biblioselect = farmaco::select('bibliografias.*')
                                   ->join('farmacobiblios', 'farmacos.id', '=', 'farmacobiblios.farmaco_id')   
                                   ->join('bibliografias', 'farmacobiblios.bibliografia_id', '=', 'bibliografias.id')
                                   ->where('farmacos.id', $ultimo )
                                   ->get();
       return view("farmacos.create", ['bibliografias' => $bibliografias, 'gfar' => $grupofarmaco, 'inter' => $interacciones, 'idfarmaco' => $ultimo, 'biblioselect' => $biblioselect]);
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
       return view("farmacos.create", ['bibliografias' => $bibliografias, 'gfar' => $grupofarmaco, 'inter' => $interacciones, 'idfarmaco' => $ultimo]);
    }

    public function destroy(farmaco $farmaco)
    {
        $farmaco->delete();
        $farmacos =farmaco::all();
        return view('farmacos.index', ['farmacos' => $farmacos]);
    }

    public function active(Request $request, farmaco $farmaco)
    {
        $estatus = $request->estatus=='checked' ? 0 : 1;
        $estatus = $request->estatus=='' ? 1 : 0; 
 

        $farmaco-> estatus=$estatus;
        $farmaco->save();
        $farmacos = farmaco::with('bibliografia','grupofarmaco')->get();
        return view('farmacos.index', ['farmacos' => $farmacos]);
    }
    
     

 }
