@extends('layout.default')

@section('contents')
    <h3>活动信息列表</h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach ($activities as $activity)
            <tr>
                <td>{{ $activity->id }}</td>
                <td>{{ $activity->title }}</td>
                <td>{{ $activity->start_time }}</td>
                <td>{{ $activity->end_time }}</td>
                <td>
                    <a href="{{ route('activities.show',[$activity]) }}" class="btn btn-warning btn-xs">活动详情</a>
                    <a href="{{ route('activities.edit',[$activity]) }}" class="btn btn-warning btn-xs">修改</a>
                    <form method="post" action="{{ route('activities.destroy',[$activity]) }}" style="display: inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{--{{ $activities->links() }}--}}
    <a href="{{ route('activities.create') }}" class="btn btn-info btn-s pull-right" role="button" >添加活动</a>
@endsection