@extends('layout.default')

@section('contents')
    <form method="post" action="{{ route('permissions.update',[$permission]) }}" enctype="multipart/form-data">
        <h3><label>权限信息修改</label></h3>
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="name" class="form-control" placeholder="账号名称" value="{{ $permission->name }}">
        </div>
        <div class="form-group">
            <label>描述</label>
            <input type="text" name="describe" class="form-control" placeholder="邮箱" value="{{ $permission->describe }}">
        </div>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop