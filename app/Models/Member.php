<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //声明可被接收的变量
    protected $fillable = ['username','password','tel','remember_token','status'];
}
