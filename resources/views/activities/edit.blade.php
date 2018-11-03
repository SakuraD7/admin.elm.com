@extends('layout.default')

@section('contents')
    @include('layout._errors')
    @include('vendor.ueditor.assets')
    <form method="post" action="{{ route('activities.update',[$activity]) }}" enctype="multipart/form-data">
        <h3><label>修改活动信息</label></h3>
        <div class="form-group">
            <label>活动名称</label>
            <input type="text" name="title" class="form-control" value="{{ $activity->title }}">
        </div>
        <div class="form-group">
            <label>活动详情</label>
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            </script>
            <script id="container" name="text" type="text/plain" >{!!$activity->text!!}</script>
        </div>
        <div class="form-group">
            <label>活动开始时间</label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{ date('Y-m-d\TH:i:s',strtotime($activity->start_time)) }}">
        </div>
        <div class="form-group">
            <label>活动结束时间</label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{ date('Y-m-d\TH:i:s',strtotime($activity->end_time)) }}">
        </div>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button class="btn btn-primary btn-block">提交</button>
    </form>
@stop