<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Exception;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
        try{
            $permissions = PermissionResource::collection(Permission::all());
            return response()->json([
                    'permissions' =>  $permissions,
            ],200);
        }catch(Exception $e){
             return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }
}
