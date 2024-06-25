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
            $roles = RoleResource::collection(Role::with('permissions')->get());
            return response()->json([
                    'roles' =>  $roles,
            ],200);
        }catch(Exception $e){
             return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }

    public function create(Request $request){
        $role = Role::create([
            'name' => $request->name,
        ]);
        $role->permissions()->attach($request->permissions);

        return response()->json([
           'message' => 'Role created successfully',
        ],201);
    }

    public function update(Request $request, string $id){
        $role = Role::findOrFail($id);
        $role->permissions()->sync($request->permissions);
    }

    public function destroy($id){
        $role = Role::findOrFail($id);
        $role->permissions()->detach();
        $role->delete();
        return response()->json([
            'message' => 'Role deleted successfully',
        ],200);
    }
}
