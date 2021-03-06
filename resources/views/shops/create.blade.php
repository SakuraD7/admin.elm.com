@extends('layout.default')

@section('contents')
    @include('layout._errors')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>

    <form method="post" action="{{ route('shops.store') }}" enctype="multipart/form-data">
        <h3><label>添加商家</label></h3>
        <div class="form-group">
            <label>商家分类</label>
            <select name="shop_category_id" class="form-control">
                <option value="">请选择商家分类</option>
                @foreach($shopgories as $shopgory)
                    <option value="{{ $shopgory->id }}"
                            @if(old('shop_category_id')==$shopgory->id)
                            selected="selected"
                            @endif
                    >{{ $shopgory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>商家名称</label>
            <input type="text" name="shop_name" class="form-control" placeholder="商家名称" value="{{ old('shop_name') }}">
        </div>
        <div class="form-group">
            <label>商家图片</label>
            {{--<input type="file" name="shop_img">--}}
            <input type="hidden" name="img" id="img">
            <!--dom结构部分-->
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img id="pic"/>
        </div>
        <div class="form-group">
            <label>商家评分</label>
            <input type="text" name="shop_rating" class="form-control" placeholder="商家评分" value="{{ old('shop_rating') }}">
        </div>
        <div class="row">
            <div class="form-group col-lg-2">
                <label>是否是品牌</label>
                <div>
                    <label>
                        <input type="radio" name="brand" value="1"> 是
                        <input type="radio" name="brand" value="0" checked> 否
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>是否准时送达</label>
                <div>
                    <label>
                        <input type="radio" name="on_time" value="1"> 是
                        <input type="radio" name="on_time" value="0" checked> 否
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>是否蜂鸟配送</label>
                <div>
                    <label>
                        <input type="radio" name="fengniao" value="1"> 是
                        <input type="radio" name="fengniao" value="0" checked> 否
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>	是否保标记</label>
                <div>
                    <label>
                        <input type="radio" name="bao" value="1"> 是
                        <input type="radio" name="bao" value="0" checked> 否
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>是否票标记</label>
                <div>
                    <label>
                        <input type="radio" name="piao" value="1"> 是
                        <input type="radio" name="piao" value="0" checked> 否
                    </label>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>是否准标记</label>
                <div>
                    <label>
                        <input type="radio" name="zhun" value="1"> 是
                        <input type="radio" name="zhun" value="0" checked> 否
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>起送金额</label>
            <input type="text" name="start_send" class="form-control" placeholder="起送金额" value="{{ old('start_send') }}">
        </div>
        <div class="form-group">
            <label>配送费</label>
            <input type="text" name="send_cost" class="form-control" placeholder="配送费" value="{{ old('send_cost') }}">
        </div>
        <div class="form-group">
            <label>店公告</label>
            <input type="text" name="notice" class="form-control" placeholder="店公告" value="{{ old('notice') }}">
        </div>
        <div class="form-group">
            <label>优惠信息</label>
            <input type="text" name="discount" class="form-control" placeholder="优惠信息" value="{{ old('discount') }}">
        </div>

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

        {{--输入框：<input type="text" name="a" id="a" onkeyup="document.getElementById('b').value=this.value" onblur="document.getElementById('b').value=this.value">--}}
        {{--<br>--}}
        {{--<br>--}}
        {{--自动赋值框：<input type="text" name="shop_name" id="shop_name">--}}

        {{--<div class="form-group">--}}
            {{--<label>所属商家</label>--}}
            {{--<select name="shop_id" class="form-control">--}}
                {{--<option value="{{'shop_name'}}"></option>--}}
                {{--@foreach($shops as $shop)--}}
                    {{--<option value="{{ $shop->id }}"--}}
                            {{--@if(old('shop_id')==$shop->id)--}}
                            {{--selected="selected"--}}
                            {{--@endif--}}
                    {{-->{{ $shop->shop_name }}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}
        {{--@foreach($shops as $shop)--}}
            {{--<option value="{{ $shop->id }}"--}}
                    {{--@if(old('shop_id')==$shopgory->id)--}}
                    {{--selected="selected"--}}
                    {{--@endif--}}
            {{-->{{ $shopgory->name }}</option>--}}
        {{--@endforeach--}}
        {{--<input type="text" name="shop_id" id="shop_name">--}}
        {{----}}
        <input type="hidden" name="status" value="1">
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@section('javascript')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            //swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: '{{ route('upload') }}',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData: {
                _token:"{{ csrf_token() }}"
            }
        });
        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file,response ) {
            console.log(response);
            //$( '#'+file.id ).addClass('upload-state-done');
            //显示上传成功图片
            $("#pic").attr('src',response.path);
            //将图片地址写入数据库
            $("#img").val(response.path);
        });
    </script>
@stop
@stop