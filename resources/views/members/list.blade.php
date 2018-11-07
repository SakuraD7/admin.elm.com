@extends('layout.default')

@section('contents')
    <h3>会员列表</h3>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>会员名</th>
            <th>电话号码</th>
            <th>账号状态</th>
            <th>操作</th>
        </tr>
        @foreach ($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->tel }}</td>
                <td>{{ $member->status == 0 ? '启用' : '禁用' }}</td>
                <td>
                    <a href="{{ route('members.edit',[$member]) }}" class="btn btn-warning btn-xs">禁用</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ csrf_field() }}
    {{ $members->links() }}
@endsection