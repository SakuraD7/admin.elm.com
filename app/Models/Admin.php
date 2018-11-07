<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends User{
    use Notifiable;
    use HasRoles;
    protected $guard_name = 'web';
    //声明可被接收的变量
    protected $fillable = ['name','email','password','newpwd','newspwd','remember_token'];
}
