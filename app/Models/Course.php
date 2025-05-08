<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_name',
        'description',
        'duration',
    ];
    protected $primaryKey = 'course_id';
    public $timestamps = true;
}   
