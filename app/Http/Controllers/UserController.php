<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Info;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

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

    public function create(Request $request){


        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:8',
            'dob' =>'required',
            'classroom' =>'required',
            'fatherName' =>'required',
            'contactNumber' =>'required',
        ]);

        if($validator->fails()){
            return response()->json([
               'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

       try{
        DB::transaction(function () use($request){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'classroom_id' => $request->classroom,
            ]);

            $user->roles()->attach($request->roles);
            $start_date = !empty($request->startDate) ? Carbon::createFromFormat('d-M-Y', $request->startDate)->format('Y-m-d') : null;
            Info::create([
                'user_id' => $user->id,
                'date_of_birth' => Carbon::createFromFormat('d-M-Y', $request->dob)->format('Y-m-d'),
                'father_name' => $request->fatherName,
                'contact_number' => $request->contactNumber,
                'nrc_number'=> $request->nrc_number,
                'education'=> $request->education,
                'start_date'=> $start_date,
                'roll_number'=> $request->roll_number,
            ]);
        });

        return response()->json([
            'message' => 'User created successfully',
         ],201);

       }catch(Exception $e){
         return response()->json([
              'message' => $e->getMessage()
           ]);
       }

    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();

        return response()->json([
           'message' => 'User deleted successfully',
        ],200);
    }
}
