@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form method="post" action="{{ route('permissions.store') }}" enctype="multipart/form-data">
        <h3><label>添加权限</label></h3>
        <div class="form-group">
            <label>名称（路由）</label>
            <input type="text" name="name" class="form-control" placeholder="名称" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>描述</label>
            <input type="text" name="describe" class="form-control" placeholder="描述" value="{{ old('describe') }}">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop