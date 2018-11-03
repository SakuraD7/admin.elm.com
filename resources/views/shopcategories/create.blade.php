@extends('layout.default')

@section('contents')
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>

    <!--SWF在初始化的时候指定，在后面将展示-->
    @include('layout._errors')
    <form method="post" action="{{ route('shopcategories.store') }}" enctype="multipart/form-data">
        <h3><label>添加商家分类</label></h3>
        <div class="form-group">
            <label>商家分类名</label>
            <input type="text" name="name" class="form-control" placeholder="商家分类名" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>商家分类图片</label>
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
            <label>商家分类状态</label>
            <div>
                <label>
                    <input type="radio" name="status" value="1" checked> 显示
                    <input type="radio" name="status" value="0"> 隐藏
                </label>
            </div>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop

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