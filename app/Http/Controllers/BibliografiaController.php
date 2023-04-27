<?php

namespace App\Http\Controllers;
use App\Models\bibliografia;
use Illuminate\Http\Request;

class BibliografiaController extends Controller
{
    public function index(){
        $bibliografias = bibliografia::all();
        return view('bibliografias.index', ['bibliografias' => $bibliografias]);
    }
    public function create(){
        return view("bibliografias.create");
    }
    public function create2(bibliografia $bibliografia){
        $idbiblio=$bibliografia->id;
        $bibliografias = bibliografia::select('bibliografias.*')
                                   ->where('bibliografias.id', $bibliografia->id)
                                   ->get();
                                          // return $bibliografias;
        return view('bibliografias.create', ['bibliografias' => $bibliografias,'idb'=>$idbiblio]);
    }
    public function store(Request $request){
        if($request->id_bibliografia==""){
        $bibliografia= new bibliografia();
        }else{
            $bibliografia = bibliografia::find($request->id_bibliografia);
        }

//return $bibliografias;
        $bibliografia-> titulo=$request->titulo;
        $bibliografia-> descripcion=$request->descripcion;
        $bibliografia-> autor=$request->autor;
        $bibliografia-> anio=$request->anio;
        $bibliografia-> editorial=$request->editorial;
        $bibliografia-> estatus=1;
        $bibliografia->save();
        $bibliografias = bibliografia::all();
        return view('bibliografias.index', ['bibliografias' => $bibliografias]);
    }
    public function show(bibliografia $bibliografia){
        return view('farmacos.show', compact('farmaco'));
    }
    public function destroy(bibliografia $bibliografia)
    {
        $bibliografia->delete();
        //return $bibliografia;
        $bibliografias =bibliografia::all();
         
        return view('bibliografias.index', ['bibliografias' => $bibliografias]);
    }

}

