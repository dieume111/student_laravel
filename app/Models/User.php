<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
     protected $fillable = [
        'user_name',
        'password',
        'remember_token',
    ];
     protected $hidden = [
        'password',
        'remember_token'];
     protected $primaryKey = 'user_id';
     
}
