<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

//导航菜单管理
class NavController extends Controller{
    public function index(){
        $navs = Nav::paginate(10);
        return view('navs.list',compact('navs'));
    }
    //添加导航菜单
    public function create(){
        $permissions = Permission::all();
        $navs = Nav::where('pid',0)->get();
        return view('navs.create',compact('navs','permissions'));
    }
    //保存添加
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'pid'=>'required',
            'url'=>'required',
        ]);
        //查询URL地址/路由在权限表中的对应id
        $request->url!='无'?$id=Permission::where('name',$request->url)->first()->id : $id=0;
        Nav::create([
            'name'=>$request->name,
            'url'=>$request->url,
            'permission_id'=>$id,
            'pid'=>$request->pid
        ]);
        return redirect()->route('navs.index')->with('success','添加成功');
    }
    //修改导航菜单-回显
    public function edit(Nav $nav){
        //查询所有权限和一级菜单
        $permissions = Permission::all();
        $navs = Nav::where('pid',0)->get();
        return view('navs.edit',compact('nav','navs','permissions'));
    }
    //保存修改
    public function update(Nav $nav,Request $request){
        $this->validate($request,[
            'name'=>'required',
        ]);
        //查询URL地址/路由在权限表中的对应id
        $request->url!='无'?$id=Permission::where('name',$request->url)->first()->id : $id=0;
        $nav->update([
            'name'=>$request->name,
            'url'=>$request->url,
            'permission_id'=>$id,
            'pid'=>$request->pid
        ]);
        return redirect()->route('navs.index')->with('success','修改导航菜单成功');
    }
    //删除导航菜单
    public function destroy(Nav $nav){
        $nav->delete();
        return redirect()->route('navs.index')->with('success','删除导航成功');
    }
}

