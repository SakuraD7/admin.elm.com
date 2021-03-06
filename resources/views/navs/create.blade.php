@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <form method="post" action="{{ route('navs.store') }}" enctype="multipart/form-data">
        <h3><label>添加导航菜单</label></h3>
        <div class="form-group">
            <label>名称</label>
            <input type="text" name="name" class="form-control" placeholder="名称" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>所属菜单</label>
            <select name="pid" class="form-control">
                <option value="0">顶级分类</option>
                @foreach($navs as $nav)
                    <option value="{{ $nav->id }}">{{ $nav->name }}</option>
                @endforeach
            </select>
            {{--<input type="text" name="describe" class="form-control" placeholder="上级菜单" value="{{ old('describe') }}">--}}
        </div>
        <div class="form-group">
            <label>URL地址/路由</label>
            <select name="url" class="form-control" name="url">
                <option value="无">请选择URL地址/路由</option>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->name }}">
                        {{ $permission->describe.'('.$permission->name.')' }}
                    </option>
                @endforeach
            </select>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop