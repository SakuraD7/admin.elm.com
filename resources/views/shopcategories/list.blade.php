@extends('layout.default')

@section('contents')
    <h3>商家分类列表</h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>商家分类名</th>
            <th>商家分类图片</th>
            <th>商家分类状态</th>
            <th>操作</th>
        </tr>
        @foreach ($shopgories as $shopgory)
            <tr>
                <td>{{ $shopgory->id }}</td>
                <td>{{ $shopgory->name }}</td>
                <td>
                    <img src="{{ $shopgory->img }}" width="100px"/>
                    {{--@if( $shopgory->img )--}}
                    {{--<img class="img-thumbnail"--}}
                    {{--src=""--}}
                    {{--{{ \Illuminate\Support\Facades\Storage::url($shopgory->img) }}--}}
                    {{--width="100px"--}}
                    {{--/>--}}
                    {{--@endif--}}
                </td>
                <td>{{ $shopgory->status  == 1 ? '显示' : '隐藏'}}</td>
                <td><a href="{{ route('shopcategories.edit',[$shopgory]) }}" class="btn btn-warning btn-xs">修改</a>
                    <form method="post" action="{{ route('shopcategories.destroy',[$shopgory]) }}" style="display: inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{--{{ $shopgories->links() }}--}}
    <a href="{{ route('shopcategories.create') }}" class="btn btn-info btn-s pull-right" role="button" >添加商家分类</a>
@endsection