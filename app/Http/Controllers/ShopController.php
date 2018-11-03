<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //商家信息列表-已审核
    public function index(){
        $shops = Shop::where('status',1)->paginate(5);
        return view('shops.list',compact('shops'));
    }
    //商家信息列表-未审核
    public function home(){
        $shops = Shop::where('status',0)->paginate(5);
        return view('shops.home',compact('shops'));
    }
    //通过审核
    public function show(Shop $shop){
        $shop->update([
            'status' => 1,
        ]);
        return redirect()->route('shops.home')->with('success','审核通过');
    }

    //添加商家信息-显示表单
    public function create(){
        $shopgories = ShopCategory::all();
        $shops = Shop::all();
        return view('shops.create',compact('shopgories','shops'));
    }

    //保存新增商家信息
    public function store(Request $request){
        $this->validate($request,[
            //商家信息
            'shop_category_id'=>'required',
            'shop_name'=>'required',
//            'shop_img'=>'required|file',
            'shop_rating'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
            //账号信息
            'name'=>'required',
            'email'=>'email',
            'password'=>'required',
        ]);
        //$path = $request->file('shop_img')->store('public/shops');
        //开启事务
        DB::beginTransaction();
        $sql=Shop::create([
            'shop_category_id' => $request->shop_category_id,
            'shop_name' => $request->shop_name,
            'shop_img' => $request->img,
            'shop_rating' => $request->shop_rating,
            'brand' => $request->brand,
            'on_time' => $request->on_time,
            'fengniao' => $request->fengniao,
            'bao' => $request->bao,
            'piao' => $request->piao,
            'zhun' => $request->zhun,
            'start_send' => $request->start_send,
            'send_cost' => $request->send_cost,
            'notice' => $request->notice,
            'discount' => $request->discount,
            'status' => $request->status,
        ]);
        //获取最后一条新增数据id
        $shop_id=$id = DB::getPdo()->lastInsertId();
        $sql2=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => $request->status,
            'shop_id' => $shop_id,
        ]);
        if($sql && $sql2){
            //执行成功提交事务
            DB::commit();
            return redirect()->route('shops.index')->with('success','添加商家成功');
        }else{
            DB::rollback();
            return redirect()->route('shops.create')->with('success','添加商家失败');
        }
    }

    //修改商家信息-回显
    public function edit(Shop $shop){
        $shopgories = ShopCategory::all();
        return view('shops.edit',compact('shop','shopgories'));
    }

    //保存商家信息修改
    public function update(Request $request,Shop $shop){
        $this->validate($request,[
            'shop_category_id'=>'required',
            'shop_name'=>'required',
//            'shop_img'=>'required|file',
            'shop_rating'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
        ]);
//        $request->shop_img ? $path = $request->file('shop_img')->store('public/shops'):$path = $shop->shop_img;
        $shop->update([
            'shop_category_id' => $request->shop_category_id,
            'shop_name' => $request->shop_name,
            'shop_img' => $request->img,
            'shop_rating' => $request->shop_rating,
            'brand' => $request->brand,
            'on_time' => $request->on_time,
            'fengniao' => $request->fengniao,
            'bao' => $request->bao,
            'piao' => $request->piao,
            'zhun' => $request->zhun,
            'start_send' => $request->start_send,
            'send_cost' => $request->send_cost,
            'notice' => $request->notice,
            'discount' => $request->discount,
            'status' => $request->status,
        ]);
        return redirect()->route('shops.index')->with('success','修改商家信息成功');
    }

    //删除商家信息
    public function destroy(Shop $shop){
        $shop->delete();
        return redirect()->route('shops.index')->with('success','删除商家成功');
    }

    //接受webuploader文件上传
    public function upload(Request $request){
        $path = $request->file('file')->store('elm/img');
        return ['path'=>Storage::url($path)];
    }
}
