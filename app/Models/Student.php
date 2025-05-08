<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable =[
        'First_name',
        'Last_name',
        'gender',
        'contact_no',
        'email',
        'address',
        'date_of_birth',
        
    ];
    protected $primaryKey = 'student_id';
    public $timestamps = true;
}
