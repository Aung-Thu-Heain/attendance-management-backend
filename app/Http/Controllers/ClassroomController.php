<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Resources\ClassroomResource;

class ClassroomController extends Controller
{
    public function index(){

        try{
            $classrooms = ClassroomResource::collection(Classroom::all());
            return response()->json([
                    'classrooms' =>  $classrooms,
            ],200);
        }catch(Exception $e){
             return response()->json([
                'message' => $e->getMessage()
            ],500);
        }
    }
}
