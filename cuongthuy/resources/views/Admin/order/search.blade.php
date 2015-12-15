<?php use App\Lib\InitialDefine ?>
@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<p id="pankuzu"><a href="../top">TOP</a> &gt; <a href="index">Quản lí đơn hàng</a> &gt; Tìm kiếm đơn hàng</p>
<h2 id="page_midashi_02">Tìm kiếm đơn hàng</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div id="bg_blue">
    <p class="mb15 floatL">
        ※ Khi bạn nhập vào các mục dưới đây bạn có thể lọc theo các điều kiện tìm kiếm<br />
    </p>
    <p id="csv_button">Lưu file CSV</p>
    <div class="clear"></div>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th>Ngày đặt hàng</th>
            <td colspan="3">
                <label><input type="radio" name="sort" id="syoarea" value="ASC" >Thứ tự tăng dần</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="sort" id="syoarea" value="DESC" checked>Thứ tự giảm dần</label>&nbsp;&nbsp;&nbsp;
                <input type="text" name="zip1" id="zip1" class="text" style="width:100px;" />&nbsp;
                ～&nbsp;<input type="text" name="zip1" id="zip1" class="text" style="width:100px;" />&nbsp;
                <p class="error_comment">Vui lòng nhập ngày đặt hàng。</p>
            </td>
        </tr>
        <tr class="menu">
            <th>Mã đơn hàng</th>
            <td><input type="text" name="gift_no" class="text" style="width:180px;" /></td>
            <th>Trạng thái đơn hàng </th>
            <td>
                <select name="status">
                    <option label="" value="" selected>Chọn trạng thái</option>
                    <option label="" value="status_on">Đã order</option>
                    <option label="" value="status_off">Đang đợi comfirm</option>
                </select>
            </td>
        </tr>
        <tr class="menu">
            <th>Tên sản phẩm</th>
            <td colspan="3"><input type="text" name="" class="text" style="width:400px;" /></td>
        </tr>
    </table>
    <div class="mt15">
        <p id="search_button">Search</p>
        <div class="clear"></div>
    </div>
</div>

<div id="bg_blue" class="mt15">
    <p class="mb15" style="color:red">※ Click vào mã đơn hàng để xem chi tiết đơn hàng.</p>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <thead>
            <tr class="table_list">
                <th>STT</th>
                <th>Thời gian đặt hàng</th>
                <th>Mã đơn hàng</th>
                <th>Trạng thái đơn hàng</th>
                <th>Tên khách hàng</th>
                <th>Số điện thoại</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $key => $order)
            <tr class="table_list bg_yellow">
                <td class="bold"><a href="{!!action('Admin\OrderDetailController@getIndex', array('order_id' => $order['id']))!!}">{!!$key+1!!}</a></td>
                <td><span class="lh12">{!!date("H:i:s d-m-Y", strtotime($order['order_date']))!!}</span></td>
                <td class="bold"><a href="{!!action('Admin\OrderDetailController@getIndex', array('order_id' => $order['id']))!!}">{!!$order['order_code']!!}</a></td>
                <td class="color_blue bold">{!!InitialDefine::selectValue($order['order_status'], InitialDefine::$arrayOderStatus)!!}</td>
                <td>{!!$order['order_customer_name']!!}</td>
                <td>{!!$order['order_phone']!!}</td>
            </tr>
            @endforeach
    </table>

<!--    <div id="tab_area">
        <div id="page_tab">
            <a href="#" class="tab_off">&lt;&lt;</a>
            <a href="#" class="tab_off">&lt;</a>
            <a href="#" class="tab_off">100</a>
            <a href="#" class="tab_off">101</a>
            <a href="#" class="tab_off">102</a>
            <em>103</em>
            <a href="#" class="tab_off">104</a>
            <a href="#" class="tab_off">105</a>
            <a href="#" class="tab_off">106</a>
            <a href="#" class="tab_off">&gt;</a>
            <a href="#" class="tab_off">&gt;&gt;</a>
        </div>
        <p class="alignC mt10">（1550～1600）</p>
    </div>-->
</div>
<!-- InstanceEndEditable -->
@endsection