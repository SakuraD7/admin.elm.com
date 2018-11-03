@extends('layout.default')

@section('contents')
    <form method="post" action="{{ route('users.update',[$user]) }}" enctype="multipart/form-data">
        <h3><label>修改商家账号</label></h3>
        <div class="form-group">
            <label>账号名称</label>
            <input type="text" name="name" class="form-control" placeholder="账号名称" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label>邮箱</label>
            <input type="text" name="email" class="form-control" placeholder="邮箱" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label>所属商家</label>
            <select name="shop_id" class="form-control">
                <option value="">请选择商家</option>
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}"
                            @if($user->shop_id==$shop->id)
                            selected="selected"
                            @endif
                    >{{ $shop->shop_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>账号状态</label>
            <div>
                <label>
                    <input type="radio" name="status" value="1" checked> 启用
                    <input type="radio" name="status" value="0"> 禁用
                </label>
            </div>
        </div>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop