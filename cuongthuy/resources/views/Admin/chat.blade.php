@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP </a> &gt;Quản lí chat</p>
<h2 id="page_midashi_02">Quản lí chat</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div class="content_list_area">
    <p class="bold"><a href="">&diams;Chat với khách hàng</a></p>
    <p class="gaiyo">Bạn có thể chat, hỗ trợ, giải đáp cho khách hàng những thắc mắc về hóa đơn, sản phẩm...<br /></p>
    <p class="gaiyo">Truy cập vào link sau và đăng nhập</p>
    <a href="https://dashboard.tawk.to/login">https://dashboard.tawk.to/login</a>
    <p class="gaiyo">Tên đăng nhập: </p>
    <p class="gaiyo">Mật khẩu: </p>
</div>
@endsection
