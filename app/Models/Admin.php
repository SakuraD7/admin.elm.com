<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User{
    use Notifiable;
    //声明可被接收的变量
    protected $fillable = ['name','email','password','newpwd','newspwd','remember_token'];
}
