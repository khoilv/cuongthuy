@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP</a> &gt; 
    <a href="{!!Asset('admin/contact/index')!!}">Danh sách liên hệ</a> &gt; 
    Chi tiết liên hệ</p>
<div id="bg_blue">
    <div class="clear"></div>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th style="width:150px">Tên khách hàng</th>
            <td colspan='5'>
                {!!$contact_name!!}
            </td>
        </tr>
        <tr class="menu">
            <th>Thời gian gửi liên hệ</th>
            <td colspan='5'>{!!date("H:i:s d-m-Y", strtotime($contact_datetime))!!}</td>
        </tr>
        <tr class="menu">
            <th>Số điện thoại</th>
            <td colspan='5'>
                {!!$contact_phone!!}
            </td>
        </tr>
        <tr class="menu">
            <th>Email</th>
            <td colspan='5'>
                {!!$contact_email!!}
            </td>
        </tr>
        <tr class="menu">
            <th>Địa chỉ</th>
            <td colspan='5'>
                {!!$contact_address!!}
            </td>
        </tr>
        <tr class="menu">
            <th>Nội dung</th>
            <td colspan='5'>
                {!!$contact_content!!}
            </td>
        </tr>
    </table>
</div>

@endsection