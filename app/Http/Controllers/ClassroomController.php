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

    public function create(Request $request){
          Classroom::create([
            'name'=>$request->name,
         ]);

         return response()->json([
            'message'=>'Classroom created successfully',
         ],200);
    }

    public function update(Request $request,$id){
        $classroom = Classroom::find($id);

       if(!$classroom){
           return response()->json([
              'message' => 'Classroom not found'
           ],404);
       }

       $classroom->name = $request->name;
       $classroom->save();

       return response()->json(['successfully updated'],200);
    }

    public function destroy($id){
        $classroom = Classroom::find($id);
        $classroom->delete();
        return response()->json([
            "message"=>"Classroom deleted successfully",
        ],200);
    }
}
