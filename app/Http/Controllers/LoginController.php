<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //显示登录界面
    public function create(){
        return view('logins.login');
    }
    //验证登录信息
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
        ]);
        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('remember'))){
            return redirect()->intended(route('admins.index'))->with('登录成功');
        }else{
            return back()->with('danger','用户名或密码错误，请重新登录')->withInput();
        }
    }
    //退出登录
    public function destroy(){
        Auth::logout();
        return redirect()->route('login')->with('success','成功退出');
    }
}
