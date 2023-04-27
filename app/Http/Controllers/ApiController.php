<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
   public function users(Request $request)
   {
    $users = User::all();
    return response()->json($users);
   }
}
