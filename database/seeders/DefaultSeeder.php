<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Classroom;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = ['user_create','user_read','user_update','user_delete','class_create','class_read','class_update','class_delete','role_create','role_read','role_update','role_delete'];
        $classes = ['Kindergarten','Grade-1','Grade-2','Grade-3','Grade-4','Grade-5','Grade-6','Grade-7','Grade-8','Grade-9','Grade-10','Grade-11','Grade-12'];

        foreach($permissions as $permission){
            Permission::create([
                'name'=>$permission,
            ]);
        }

        $adminPermissions = Permission::all()->pluck('id');
         Role::create([
            'name'=>"admin",
        ])->permissions()->sync($adminPermissions);

        $teacherPermissions = Permission::where('name', 'not like', '%_delete%')->pluck('id');
        Role::create([
            'name'=>"teacher",
        ])->permissions()->sync($teacherPermissions);

        $studentPermissions = Permission::where('name', 'not like', '%_create%')->where('name','not like','%_update%')->where('name','not like','%_delete%')->pluck('id');
        Role::create([
            'name'=>"student",
        ])->permissions()->sync($studentPermissions);



        foreach($classes as $class){
            Classroom::create([
                'name' => $class,
            ]);
        }

        $users = [
                [
                    'name'=>"admin",
                    'email'=>"admin@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 1,
                ],
                [
                    'name'=>"teacher",
                    'email'=>"teacher@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 2,
                ],
                [
                    'name'=>"teacher1",
                    'email'=>"teacher1@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 2,
                ],
                [
                    'name'=>"teacher2",
                    'email'=>"teacher2@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 2,
                ],
                [
                    'name'=>"teacher3",
                    'email'=>"teacher3@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 2,
                ],
                [
                    'name'=>"teacher4",
                    'email'=>"teacher4@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 2,
                ],
                [
                    'name'=>"teacher5",
                    'email'=>"teacher5@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 2,
                ],
                [
                    'name'=>"student",
                    'email'=>"student@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 3,
                ],
                [
                    'name'=>"student1",
                    'email'=>"student1@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 3,
                ],
                [
                    'name'=>"student2",
                    'email'=>"student2@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 3,
                ],
                [
                    'name'=>"student3",
                    'email'=>"student3@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 3,
                ],
                [
                    'name'=>"student4",
                    'email'=>"student4@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 3,
                ],
                [
                    'name'=>"student5",
                    'email'=>"student5@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 3,
                ],
                [
                    'name'=>"student6",
                    'email'=>"student6@gmail.com",
                    'password'=> bcrypt('password'),
                    'classroom_id' => 1,
                    'role' => 3,
                ],

            ];

        foreach($users as $user){
            User::factory()->create([
                "name"=>$user['name'],
                "email"=>$user['email'],
                "password"=>$user['password'],
                "classroom_id"=>$user['classroom_id'],
            ])->roles()->attach($user['role']);
        }

    }
}
