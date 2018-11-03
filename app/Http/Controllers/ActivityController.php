<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller{
    //活动列表
    public function index(){
        $activities = Activity::all();
        return view('activities.list',compact('activities'));
    }

    //未开始活动
    public function prepare(){
        $activities = Activity::where('start_time','>',date('Y-m-d H:i:s',time()))->get();
        return view('activities.list',compact('activities'));
    }
    //进行中活动
    public function conduct(){
        $activities = Activity::where('end_time','>',date('Y-m-d H:i:s',time()))->where('start_time','<',date('Y-m-d H:i:s',time()))->get();
        return view('activities.list',compact('activities'));
    }
    //已结束活动
    public function end(){
        $activities = Activity::where('end_time','<',date('Y-m-d H:i:s',time()))->get();
        return view('activities.list',compact('activities'));
    }

    //活动详情
    public function show(Activity $activity){
        return view('activities.details',compact('activity'));
    }
    //显示添加活动的表单
    public function create(){
        return view('activities.create');
    }
    //保存活动添加
    public function store(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'text'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ]);
        Activity::create([
            'title' => $request->title,
            'text' => $request->text,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        return redirect()->route('activities.index')->with('success','添加活动成功');
    }
    //修改活动信息-回显
    public function edit(Activity $activity){
        return view('activities.edit',compact('activity'));
}
//保存活动修改
    public function update(Request $request,Activity $activity){
        $activity->update([
            'title' => $request->title,
            'text' => $request->text,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        return redirect()->route('activities.index')->with('success','修改活动信息成功');
    }
    //删除活动
    public function destroy(Activity $activity){
        $activity->delete();
        return redirect()->route('activities.index')->with('success', '删除活动成功');
    }
}
