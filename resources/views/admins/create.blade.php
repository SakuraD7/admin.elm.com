@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form method="post" action="{{ route('admins.store') }}" enctype="multipart/form-data">
        <h3><label>添加管理员账号</label></h3>
        <div class="form-group">
            <label>账号名称</label>
            <input type="text" name="name" class="form-control" placeholder="账号名称" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="email" name="email" class="form-control" placeholder="邮箱" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" name="password" class="form-control" placeholder="密码" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label>角色</label>
            <div>
                @foreach($roles as $role)
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1" value="{{$role->name}}" name="roles[]"> {{$role->name}}
                    </label>
                @endforeach
            </div>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop