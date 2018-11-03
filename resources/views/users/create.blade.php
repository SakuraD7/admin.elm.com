@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
        <h3><label>添加商家账号</label></h3>
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
            <label>所属商家</label>
            <select name="shop_id" class="form-control">
                <option value="">请选择商家</option>
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}"
                            @if(old('shop_id')==$shop->id)
                            selected="selected"
                            @endif
                    >{{ $shop->shop_name }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="status" value="1">
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop