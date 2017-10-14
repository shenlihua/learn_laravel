@include('admin.common._meta')

<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页

    @yield('c-gray')


    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" >
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<div class="page-container">
    @yield('content')
</div>
<!--_footer 作为公共模版分离出去-->
@include('admin.common._footer')
{{--各种操作js--}}
<script src="{{ asset('/admin/static/h-ui/js/operate.js') }}"></script>

@section('script')

@show

</body>
</html>