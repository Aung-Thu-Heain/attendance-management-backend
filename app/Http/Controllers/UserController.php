<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index(){


     try{
        $users = UserResource::collection(User::with(['classroom', 'roles'])->get());
        return response()->json([
            'users' =>  $users,
        ]);
        return UserResource::collection($users);
     }catch(Exception $e){
         return response()->json([
            'message' => $e->getMessage()
        ]);
     }
    }
}
