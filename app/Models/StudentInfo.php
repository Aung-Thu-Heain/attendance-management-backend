<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    use HasFactory;

    protected $fillable =[
        'father_name',
        'mother_name',
        'date_of_birth',
        'nrc_number',
        'contact_number',
        'roll_number',
        'user_id',
    ];
}
