@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP </a> &gt;<a href="{!!Asset('admin/banner/index')!!}">Quản lí banner</a></p>
<h2 id="page_midashi_02">Danh sách banner</h2>
<div id="bg_blue" class="mt15">
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <thead>
            <tr class="table_list">
                <th>Banner Id</th>
                <th>Trạng thái</th>
                <th>Ảnh banner</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $key => $banner)
            <tr class="table_list {!!$key % 2 == 0 ? 'bg_yellow' : ''!!}">
                <td class="bold"><p class="alignC"><a href="{!!Asset('admin/banner/detail/'. $banner['id'])!!}">{!!$banner['id']!!}</a></p></td>
                <td><p class="alignC">{!!($banner['banner_status'] == 1) ? 'Đang hoạt động' : 'Kết thúc'!!}</p></td>
                <td ><p class="alignC"><img src="@if(isset($banner['banner_image_path'])) {!!Asset('public/images/upload/banner/'. $banner['banner_image_path'])!!} @endif" width="500px" height="134px"/></p></td>
            </tr>
            @endforeach
    </table>
</div>
@endsection