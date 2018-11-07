<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller{
    //会员列表
    public function index(){
        $members = Member::paginate(5);
        return view('members.list',compact('members'));
    }
    //禁用
    public function edit(Member $member){
        $member->update([
            'status'=>-1,
        ]);
        return redirect()->route('members.index')->with('success','该会员账号已禁用');
    }
}
