<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){

        try{
            $classrooms = RoleResource::collection(Role::all());
            return response()->json([
                    'roles' =>  $classrooms,
            ],200);
        }catch(Exception $e){
             return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }
}
