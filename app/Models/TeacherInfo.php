<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherInfo extends Model
{
    use HasFactory;

    protected $fillable =[
        'father_name',
        'mother_name',
        'date_of_birth',
        'education',
        'nrc_number',
        'phone_number',
        'start_date',
        'user_id',

    ];
}
