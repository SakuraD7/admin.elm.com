@extends('layout.default')

@section('contents')
    <form method="post" action="{{ route('admins.update',[$admin]) }}" enctype="multipart/form-data">
        <h3><label>管理员修改</label></h3>
        <div class="form-group">
            <label>账号名称</label>
            <input type="text" name="name" class="form-control" placeholder="账号名称" value="{{ $admin->name }}">
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="text" name="email" class="form-control" placeholder="邮箱" value="{{ $admin->email }}">
        </div>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop