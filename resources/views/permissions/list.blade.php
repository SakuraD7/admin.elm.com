@extends('layout.default')

@section('contents')
    <h3>权限列表</h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->describe }}</td>
                <td>
                    <a href="{{ route('permissions.edit',[$permission]) }}" class="btn btn-warning btn-xs">修改权限信息</a>
                    <form method="post" action="{{ route('permissions.destroy',[$permission]) }}" style="display: inline">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger btn-xs">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $permissions->links() }}
    <a href="{{ route('permissions.create') }}" class="btn btn-info btn-s pull-right" role="button" >添加权限</a>
@endsection