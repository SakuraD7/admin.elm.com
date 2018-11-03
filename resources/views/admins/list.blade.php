@extends('layout.default')

@section('contents')
    <h3>管理员列表</h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>管理员名称</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    <a href="{{ route('admins.edit',[$admin]) }}" class="btn btn-warning btn-xs">修改个人信息</a>
                    <form method="post" action="{{ route('admins.destroy',[$admin]) }}" style="display: inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $admins->links() }}
    <a href="{{ route('admins.create') }}" class="btn btn-info btn-s pull-right" role="button" >添加管理员账号</a>
@endsection