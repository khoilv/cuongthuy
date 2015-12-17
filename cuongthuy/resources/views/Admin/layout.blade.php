<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Màn hình quản lí</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/style.css')!!}" type="text/css" />
@yield('stylesheets')
@section('javascript')
<script type="text/javascript" src="{!!Asset('public/js/jquery-1.9.0.min.js')!!}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('javascript')
</head>
<body>
<!--▼ header -->
<div id="header">
    <div id="header_area">
        <h1 class="floatL"><img src="{!!Asset('public/images/admin/logo.png')!!}" width="180px" height="51px" /></h1>
        <div class="floatR alignR mt10">
            <p>@if (Session::has('username'))Xin chào {!!Session::get('username')!!}! @endif</p>
            <p><a href="{!!Asset('admin/top')!!}" target="_blank">Index</a>｜<a href="{!! URL::action('Admin\LoginController@logout')!!}">Logout</a></p>
        </div>
    </div>
</div>
<!--▲ header -->
<!--▼ main_content -->
<div id="main_content">
    <!--▼ left_content -->
    <div id="left_content">
            @if (strpos($_SERVER['REQUEST_URI'], 'top' ))
            <p id="left_link_01_on">Danh mục quản lí</p>
            @else
            <p id="left_link_01"><a href="{!!Asset('admin/top')!!}">Danh mục quản lí</a></p>
            @endif
            @if (strpos($_SERVER['REQUEST_URI'], 'product' ))
            <p id="left_link_02_on">Quản lí sản phẩm</p>
            @else
            <p id="left_link_02"><a href="{!!Asset('admin/product/index')!!}">Quản lí sản phẩm</a></p>
            @endif
            @if (strpos($_SERVER['REQUEST_URI'], 'order' ))
            <p id="left_link_03_on">Quản lí đơn hàng</p>
            @else
            <p id="left_link_03"><a href="{!!Asset('admin/order/index')!!}">Quản lí đơn hàng</a></p>
            @endif
            @if (strpos($_SERVER['REQUEST_URI'], 'category' ))
            <p id="left_link_04_on">Quản lí danh mục</p>
            @else
            <p id="left_link_04"><a href="{!!Asset('admin/category/index')!!}">Quản lí danh mục</a></p>
            @endif
            @if (strpos($_SERVER['REQUEST_URI'], 'user' ))
            <p id="left_link_05_on">Quản lí khách hàng</p>
            @else
            <p id="left_link_05"><a href="{!!Asset('admin/user/index')!!}">Quản lí khách hàng</a></p>
            @endif
            @if (strpos($_SERVER['REQUEST_URI'], 'sale' ))
            <p id="left_link_06_on">Thống kê bán hàng</p>
            @else
            <p id="left_link_06"><a href="{!!Asset('admin/sale/index')!!}">Thống kê bán hàng</a></p>
            @endif
            @if (strpos($_SERVER['REQUEST_URI'], 'maintenance' ))
            <p id="left_link_07_on">Bảo trì hệ thống</p>
            @else
            <p id="left_link_07"><a href="{!!Asset('admin/sale/index')!!}">Bảo trì hệ thống</a></p>
            @endif
    </div>
    <!--▲ left_content -->

    <!--▼ right_content -->
    <img src="{!!Asset('public/images/admin/light_content_header.png')!!}" />
    <div id="right_content">
            @yield('content')
            <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <!--▲ right_content -->
</div>
<!--▼ footer -->
<div id="footer">
    <div id="footer_area">
        <p id="copyright">2015 - Trang quản trị CuongThuy.vn</p>
    </div>
</div>
<!--▲ footer -->
</div>
<!--▲ main_content -->
</body>
</html>