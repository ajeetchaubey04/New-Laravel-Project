<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    protected $table = 'temp_user';
    protected $fillable = ['name','email','password'];
}
