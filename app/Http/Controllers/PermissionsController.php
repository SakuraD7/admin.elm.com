<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

//权限管理
class PermissionsController extends Controller{
    //创建edit articles权限（建议：权限名称和路由名称一致）
    //$permission = Permission::create(['name' => 'edit articles']);

    //权限列表
    public function index(){
        $permissions = Permission::paginate(10);
        return view('permissions.list',compact('permissions'));
    }
    //添加权限
    public function create(){
        return view('permissions.create');
    }
    //保存添加
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'describe'=>'required',
        ]);
        Permission::create([
            'name' => $request->name,
            'describe'=> $request->describe,
        ]);
        return redirect()->route('permissions.index')->with('success','添加权限成功');
    }
    //修改权限-回显
    public function edit(Permission $permission){
        return view('permissions.edit',compact('permission'));
    }
    //保存修改
    public function update(Request $request,Permission $permission){
        $this->validate($request,[
            'name'=>'required',
            'describe'=>'required',
        ]);
        $permission->update([
            'name' => $request->name,
            'describe' => $request->describe,
        ]);
        return redirect()->route('permissions.index')->with('success','权限修改成功');
    }
    //删除权限
    public function destroy(Permission $permission){
        $permission->delete();
        return redirect()->route('permissions.index')->with('success','删除权限成功');
    }
}
