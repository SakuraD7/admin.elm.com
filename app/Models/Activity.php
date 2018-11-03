<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //声明可被接收的变量
    protected $fillable = ['title','text','start_time','end_time'];
}
