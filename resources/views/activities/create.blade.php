@extends('layout.default')

@section('contents')
    @include('layout._errors')
    @include('vendor.ueditor.assets')
    <form method="post" action="{{ route('activities.store') }}" enctype="multipart/form-data">
        <h3><label>添加活动</label></h3>
        <div class="form-group">
            <label>活动名称</label>
            <input type="text" name="title" class="form-control" placeholder="活动名称" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label>活动详情</label>
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            </script>
            <script id="container" name="text" type="text/plain"></script>
        </div>
        <div class="form-group">
            <label>活动开始时间</label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{ old('start_time') }}">
        </div>
        <div class="form-group">
            <label>活动结束时间</label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{ old('end_time') }}">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop