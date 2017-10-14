<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />

<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!--[if lt IE 9]>
  <script type="text/javascript" src="{{ asset('/admin/lib/html5shiv.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/admin/lib/respond.min.js') }}"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{ asset('/admin/static/h-ui/css/H-ui.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('/admin/static/h-ui.admin/css/H-ui.admin.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('/admin/lib/Hui-iconfont/1.0.8/iconfont.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('/admin/static/h-ui.admin/skin/default/skin.css') }}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{ asset('/admin/static/h-ui.admin/css/style.css') }}" />

<title>添加用户</title>
</head>
<body>

<div class="pd-20">
  @yield('content')
</div>
@include('admin.common._footer')

</body>
</html>

@section('script')

@show