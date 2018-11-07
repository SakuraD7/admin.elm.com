@extends('layout.default')

@section('contents')
    <h3>角色列表</h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach ($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->describe }}</td>
                <td>
                    <a href="{{ route('roles.edit',[$role]) }}" class="btn btn-warning btn-xs">修改角色信息</a>
                    <form method="post" action="{{ route('roles.destroy',[$role]) }}" style="display: inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $roles->links() }}
    <a href="{{ route('roles.create') }}" class="btn btn-info btn-s pull-right" role="button" >添加角色</a>
@endsection