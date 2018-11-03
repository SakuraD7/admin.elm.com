<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //商家账号列表
    public function index(){
        $users = User::paginate(5);
        return view('users.list',compact('users'));
    }
    //添加商家账号-显示表单
    public function create(){
        $shops = Shop::all();
        return view('users.create',compact('shops'));
    }
    //保存新增商家账号
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'email',
            'password'=>'required',
            'shop_id'=>'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'shop_id' => $request->shop_id,
            'status' => $request->status,
        ]);
        return redirect()->route('users.index')->with('success','添加账号成功');
    }
    //修改商家账号-回显
    public function edit(User $user){
        $shops = Shop::all();
        return view('users.edit',compact('user','shops'));
    }
    //保存商家账号修改
    public function update(Request $request,User $user){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'email',
            'status'=>'required',
            'shop_id'=>'required',
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'shop_id' => $request->shop_id,
            'status' => $request->status,
        ]);
        return redirect()->route('users.index')->with('success','修改账号成功');
    }
    //删除商家账号
    public function destroy(User $user){
        $user->delete();
        return redirect()->route('users.index')->with('success','删除账号成功');
    }
    //重置密码
    public function show(User $user){
        $user->update([
            'password'=>bcrypt('0000'),
        ]);
        return redirect()->route('users.index')->with('success','重置密码成功');
    }
}
