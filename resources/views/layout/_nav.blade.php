<nav class="navbar navbar-default navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">平台管理</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            {{--@auth--}}
            <ul class="nav navbar-nav">
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员管理 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{ route('admins.index') }}">管理员列表</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家管理 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{ route('shops.index') }}">商家信息</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="{{ route('users.index') }}">商家账号</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="{{ route('shopcategories.index') }}">商家分类</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="{{ route('shops.home') }}">商家审核</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">会员管理 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{ route('members.index') }}">会员列表</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">活动管理 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{ route('activities.index') }}">活动列表</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="{{ route('prepare') }}">未开始活动</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="{{ route('conduct') }}">进行中活动</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="{{ route('end') }}">已结束活动</a></li>--}}
                        {{--{{ csrf_field() }}--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">RBAC <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{ route('roles.index') }}">角色列表</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="{{ route('permissions.index') }}">权限列表</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">数据分析 <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="{{ route('order') }}">商家订单统计</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="{{ route('sales_volume') }}">商家菜品销量统计</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                {!! \App\Models\Nav::getNavs() !!}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">导航菜单管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('navs.index') }}">导航菜单列表</a></li>
                    </ul>
                </li>
                {{--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>--}}
                {{--<li><a href="#">Link</a></li>--}}
            </ul>
            {{--@endauth--}}
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span> {{ auth()->user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">个人中心</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('admins.show',[auth()->user()]) }}">修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout') }}">安全退出</a></li>
                        {{ csrf_field() }}
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>