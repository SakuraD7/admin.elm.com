@extends('layout.default')

@section('contents')
    <h3>商家信息列表</h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>商家分类</th>
            <th>商家名称</th>
            <th>商家图片</th>
            <th>商家评分</th>
            <th>是否是品牌</th>
            <th>是否准时送达</th>
            <th>是否蜂鸟配送</th>
            <th>是否保标记</th>
            <th>是否票标记</th>
            <th>是否准标记</th>
            <th>起送金额</th>
            <th>配送费</th>
            <th>店公告</th>
            <th>优惠信息</th>
            <th>商家状态</th>
            <th>操作</th>
        </tr>
        @foreach ($shops as $shop)
            <tr>
                <td>{{ $shop->id }}</td>
                <td>{{ $shop->ShopCategory->name }}</td>
                <td>{{ $shop->shop_name }}</td>
                <td>
                    <img src="{{ $shop->shop_img }}" width="100px"/>
                    {{--@if( $shop->shop_img )--}}
                        {{--<img class="img-thumbnail"--}}
                             {{--src="{{ \Illuminate\Support\Facades\Storage::url($shop->shop_img) }}"--}}
                             {{--width="100px"--}}
                        {{--/>--}}
                    {{--@endif--}}
                </td>
                <td>{{ $shop->shop_rating }}</td>
                <td>{{ $shop->brand == 1 ? '是' : '否' }}</td>
                <td>{{ $shop->on_time  == 1 ? '是' : '否'}}</td>
                <td>{{ $shop->fengniao  == 1 ? '是' : '否'}}</td>
                <td>{{ $shop->bao  == 1 ? '是' : '否'}}</td>
                <td>{{ $shop->piao  == 1 ? '是' : '否'}}</td>
                <td>{{ $shop->zhun  == 1 ? '是' : '否'}}</td>
                <td>{{ $shop->start_send }}</td>
                <td>{{ $shop->send_cost }}</td>
                <td>{{ $shop->notice }}</td>
                <td>{{ $shop->discount }}</td>
                <td>{{ $shop->status == 1 ? '正常' : '禁用' }}</td>
                <td><a href="{{ route('shops.edit',[$shop]) }}" class="btn btn-warning btn-xs">修改</a>
                    <form method="post" action="{{ route('shops.destroy',[$shop]) }}" style="display: inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $shops->links() }}
    <a href="{{ route('shops.create') }}" class="btn btn-info btn-s pull-right" role="button" >添加商家</a>
@endsection