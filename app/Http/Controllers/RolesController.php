<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

//角色管理
class RolesController extends Controller{
    //角色列表
    public function index(){
        $roles = Role::paginate(5);
        return view('roles.list',compact('roles'));
    }
    //添加角色
    public function create(){
        $permissions = Permission::all();
        return view('roles.create',compact('permissions'));
    }
    //保存添加
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'describe'=>'required',
            'permissions'=>'required',
        ]);
        $role = Role::create([
            'name' => $request->name,
            'describe' => $request->describe,
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success','添加角色成功');
    }
    //修改角色-回显
    public function edit(Role $role){
        $permissions = Permission::all();
        return view('roles.edit',compact('role','permissions'));
    }
    //保存修改
    public function update(Request $request,Role $role){
        $this->validate($request,[
            'name'=>'required',
            'describe'=>'required',
            'permissions'=>'required',
        ]);
        $role->update([
            'name' => $request->name,
            'describe' => $request->describe,
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success','角色修改成功');
    }
    //删除角色
    public function destroy(Role $role){
        $role->delete();
        return redirect()->route('roles.index')->with('success','删除权限成功');
    }
}
