<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopCategoryController extends Controller
{
    //商家分类列表
    public function index(){
        $shopgories = ShopCategory::all();
        return view('shopcategories.list',compact('shopgories'));
    }
    //添加商家分类-显示表单
    public function create(){
        return view('shopcategories.create');
    }
    //保存新增商家分类
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'status'=>'required',
        ]);
        ShopCategory::create([
            'name' => $request->name,
            'img' => $request->img,
            'status' => $request->status,
        ]);
        return redirect()->route('shopcategories.index')->with('success','添加商家分类成功');
    }

    //修改商家分类-回显
    public function edit(ShopCategory $shopcategory){
        return view('shopcategories.edit',compact('shopcategory'));
    }
    //保存商家分类修改
    public function update(Request $request,ShopCategory $shopcategory){
        $this->validate($request,[
            'name'=>'required',
            'status'=>'required',
        ]);
        $shopcategory->update([
            'name' => $request->name,
            'img' => $request->img,
            'status' => $request->status,
        ]);
        return redirect()->route('shopcategories.index')->with('success','修改商家分类成功');
    }
    //删除商家分类
    public function destroy(ShopCategory $shopcategory){
        $shopcategory->delete();
        return redirect()->route('shopcategories.index')->with('success','删除商家分类成功');
    }

    //接受webuploader文件上传
    public function upload(Request $request){
        $path = $request->file('file')->store('elm/img');
        return ['path'=>Storage::url($path)];
    }
}
