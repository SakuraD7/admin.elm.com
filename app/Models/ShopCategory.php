<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCategory extends Model
{
    //声明可被接收的变量
    protected $fillable = ['name','img','status'];
}
