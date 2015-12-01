<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Màn hình quản lí</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/style.css')!!}" type="text/css" />
@yield('stylesheets')
</head>
<body>
<!--▼ header -->
<div id="header">
    <div id="header_area">
        <h1 class="floatL"><img src="{!!Asset('public/images/admin/logo.png')!!}" width="180px" height="51px" /></h1>
        <div class="floatR alignR mt10">
            <p>Xin chào Lan!</p>
            <p><a href="../web/index.html" target="_blank">Index</a>｜<a href="login.html">Logout</a></p>
        </div>
    </div>
</div>
<!--▲ header -->
<!--▼ main_content -->
<div id="main_content">
    <!--▼ left_content -->
    <div id="left_content">
            <p id="left_link_01_on">Danh mục quản lí</p>
            <p id="left_link_02"><a href="{!!Asset('admin/product/index')!!}">Quản lí sản phẩm</a></p>
            <p id="left_link_03"><a href="order/index.html">Quản lí đơn hàng</a></p>
            <p id="left_link_04"><a href="event/index.html">Quản lí danh mục</a></p>
            <p id="left_link_05"><a href="user/index.html">Quản lí khách hàng</a></p>
            <p id="left_link_06"><a href="sale/index.html">Thống kê bán hàng</a></p>
            <p id="left_link_07"><a href="maintenance/index.html">Bảo trì hệ thống</a></p>
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