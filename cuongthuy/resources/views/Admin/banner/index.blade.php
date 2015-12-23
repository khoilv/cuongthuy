@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP </a> &gt;Quản lí banner</p>
<h2 id="page_midashi_02">Quản lí banner</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div class="content_list_area">
    <p class="bold"><a href="{!!Asset('admin/banner/detail')!!}">&diams;Đăng kí ảnh banner</a></p>
    <p class="gaiyo">Bạn có thể đăng ký ảnh banner tại đây</p>
</div>
<div class="content_list_area">
    <p class="bold"><a href="{!!Asset('admin/banner/list')!!}">&diams;Danh sách banner</a></p>
</div>
@endsection