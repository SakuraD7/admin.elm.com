<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller{
    //管理员列表
    public function index(){
        $admins = Admin::paginate(5);
        return view('admins.list',compact('admins'));
    }
    //添加管理员表单
    public function create(){
        $roles = Role::all();
        return view('admins.create',compact('roles'));
    }
    //保存新增管理员
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'email',
            'password'=>'required',
        ]);
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $admin = Admin::where('name',$request->name)->first();
        $admin->syncRoles($request->roles);
        return redirect()->route('admins.index')->with('success','添加管理员成功');
    }
    //管理员修改-回显
    public function edit(Admin $admin){
        $roles = Role::all();
        return view('admins.edit',compact('admin','roles'));
    }
    //保存管理员修改
    public function update(Request $request,Admin $admin){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'email',
        ]);
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $admin = Admin::where('name',$request->name)->first();
        $admin->syncRoles($request->roles);
        return redirect()->route('admins.index')->with('success','管理员修改成功');
    }
    //删除管理员
    public function destroy(Admin $admin){
        $admin->delete();
        return redirect()->route('admins.index')->with('success','删除管理员成功');
    }
    //显示管理员密码修改表单
    public function show(Admin $admin){
        return view('admins.pwd',compact('admin'));
    }
    //保存管理员密码修改
    public function savepwd(Request $request){
        //dd($request->password,Hash::make(auth()->user()->password));
        $this->validate($request,[
            'password'=>'required',
            'newpwd'=>'required|confirmed',
            'newpwd_confirmation'=>'required|same:newpwd',
        ],[
            'password.required'=>'请输入旧密码',
            'newpwd.required'=>'新密码不能为空',
            'newpwd_confirmation.required'=>'请确认密码',
            'newpwd.confirmed'=>'两次密码输入不一致',
            'newpwd_confirmation.same'=>'请确认密码一致',
        ]);
        if(Hash::check($request->password,auth()->user()->password)){
            auth()->user()->update([
                'password' => bcrypt($request->newpwd),
            ]);
            return redirect()->route('admins.index')->with('success','管理员密码修改成功');
        }else{
            return redirect()->route('admins.show')->with('success','旧密码错误');
        }
    }
}
