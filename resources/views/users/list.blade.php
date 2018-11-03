@extends('layout.default')

@section('contents')
    <h3>商家账号列表</h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>账号名称</th>
            <th>邮箱</th>
            <th>账号状态</th>
            <th>所属商家</th>
            <th>操作</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->status == 1 ? '启用' : '禁用' }}</td>
                <td>{{ $user->shop->shop_name }}</td>
                <td>
                    <a href="{{ route('users.edit',[$user]) }}" class="btn btn-warning btn-xs">修改</a>
                    <form method="post" action="{{ route('users.destroy',[$user]) }}" style="display: inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>
                    <a href="{{ route('users.show',[$user]) }}" class="btn btn-primary btn-xs">重置密码</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
    <a href="{{ route('users.create') }}" class="btn btn-info btn-s pull-right" role="button" >添加商家账号</a>
@endsection