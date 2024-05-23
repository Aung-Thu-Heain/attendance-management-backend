<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin','teacher','student'];
        $permissions = ['create','read','update','delete'];
        $classes = ['Kindergarten','Grade-1','Grade-2','Grade-3','Grade-4','Grade-5','Grade-6','Grade-7','Grade-8','Grade-9','Grade-10','Grade-11','Grade-12'];
        User::create([
            'name'=>"admin",
            'email'=>"admin@gmail.com",
            'password'=> bcrypt('password'),
        ]);

        foreach ($roles as $role) {
            Role::create([
                'name'=>$role,
            ]);
        }

        foreach ($permissions as $permission) {
            Role::find(1)->permissions()->create([
                'name'=>$permission,
            ]);
        }

        foreach($classes as $class){
            Classroom::create([
                'name' => $class,
            ]);
        }

        User::find(1)->roles()->attach(Role::all());
    }
}
