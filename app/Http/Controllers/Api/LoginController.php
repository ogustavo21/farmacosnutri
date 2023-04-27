<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\farmaco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'token'=>$request->user()->createToken($request->name)->plainTextToken,
                'message'=>'Succes'
            ]);
        }
        return response()->json([
            'message'=>'Unauthenticated'
        ],401);
    }

    public function validateLogin(Request $request)
    {
        return $request->validate([
            'email'=>'required|email',
            'password'=>'required',
            'name'=>'required'
        ]);
    }

    
/**
     * Retorna los farmacos que coincidan con la busqueda
     *
     */

    public function query(Request $request)
         {
         $bfarmaco='%'.$request->consultaf.'%';
         $farmacos = farmaco::select('farmacos.*')
         ->where('farmaco', 'like', $bfarmaco)
         ->get();
         return $farmacos;
 
        }
 
}
