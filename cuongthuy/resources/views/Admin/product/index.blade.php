@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP </a> &gt;Quản lí sản phẩm</p>
<h2 id="page_midashi_02">Quản lí sản phẩm</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div class="content_list_area">
    <p class="bold"><a href="{!!Asset('admin/product/detail')!!}">&diams;Đăng kí sản phẩm mới</a></p>
    <p class="gaiyo">Bạn có thể đăng ký sản phẩm tại đây</p>
</div>
<div class="content_list_area">
    <p class="bold"><a href="{!!Asset('admin/product/search')!!}">&diams;Tìm kiếm sản phẩm</a></p>
    <p class="gaiyo">Thực hiện tìm kiếm danh sách các sản phẩm đã đăng ký<br />Hãy làm cũng thay đổi trạng thái của hàng hoá từ đây</p>
</div>
@endsection