@include('layout._head')

@include('layout._nav')

<div class="container">
    @include('layout._notice')
    @yield('contents')
</div>
@yield('javascript')
@include('layout._foot')
