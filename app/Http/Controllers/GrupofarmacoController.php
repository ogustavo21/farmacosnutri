<?php

namespace App\Http\Controllers;

use App\Models\grupofarmaco;
use Illuminate\Http\Request;

class GrupofarmacoController extends Controller
{
    public function index(){
        $grupofarmaco = grupofarmaco::all();
        return view('grupofarmacos.index', ['grupofarmacos' => $grupofarmaco]);
    }
    public function create(){
        return view("grupofarmacos.create");
    }
    public function create2(grupofarmaco $grupofarmaco){
        $idgrupo=$grupofarmaco->id;
        $grupofarmacos = grupofarmaco::select('grupofarmacos.*')
                                   ->where('grupofarmacos.id', $grupofarmaco->id)
                                   ->get();
                                          // return $bibliografias;
        return view('grupofarmacos.create', ['grupofarmacos' => $grupofarmacos,'idgf'=>$idgrupo]);
    }
    public function store(Request $request){
        if($request->id_grupofarmaco==""){
        $grupofarmaco= new grupofarmaco();
        }else{
            $grupofarmaco = grupofarmaco::find($request->id_grupofarmaco);
        }

//return $grupofarmacos;
        $grupofarmaco-> grupo=$request->grupo;
        $grupofarmaco-> subgrupo='xxxx';
        $grupofarmaco-> estatus=1;
        $grupofarmaco->save();
        $grupofarmacos = grupofarmaco::all();
        return view('grupofarmacos.index', ['grupofarmacos' => $grupofarmacos]);
    }
    public function show(grupofarmaco $grupofarmaco){
        return view('grupofarmacos.show', compact('grupofarmacos'));
    }
    public function destroy(grupofarmaco $grupofarmaco)
    {
        $grupofarmaco->delete();
        //return $grupofarmaco;
        $grupofarmacos =grupofarmaco::all();
         
        return view('grupofarmacos.index', ['grupofarmacos' => $grupofarmacos]);
    }
}
