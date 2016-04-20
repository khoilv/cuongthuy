@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP </a> &gt;Quản lí đơn hàng</p>
<h2 id="page_midashi_02">Quản lí đơn hàng</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div class="content_list_area">
    <p class="bold"><a href="{!!Asset('admin/order/search')!!}">&diams;Tìm kiếm thông tin đặt hàng, hiển thị danh sách đặt hàng</a></p>
    <p class="gaiyo">Bạn có thể tìm kiếm thông tin đặt hàng, xem danh sách đặt hàng của từng khách hàng<br />
        Khi bạn xem chi tiết, bạn cũng có thể thay đổi thông tin tin đơn hàng như: trạng thái đơn hàng, địa chỉ giao hàng...</p>
</div>
@endsection