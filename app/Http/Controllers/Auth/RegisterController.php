<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(Request $request){

        $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            //'c_password' => 'required|same:password',

        ]);

        $user = new User([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'classroom_id' => 1,
        ]);

        if($user->save()){
            $user->roles()->attach(3);
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            return response()->json([
            'message' => 'Successfully created user!',
            'token'=> $token,
            ],201);
        }
        else{
            return response()->json(['error'=>'Provide proper details']);
        }
    }
}
