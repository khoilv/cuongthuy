<?php use App\Lib\InitialDefine;
use App\Http\Controllers\Controller\Admin\OrderController;
?>
@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<link rel="stylesheet" href="{!!Asset('public/css/jquery.datetimepicker.css')!!}" type="text/css" />
<script src="{!!Asset('public/js/jquery.datetimepicker.full.min.js')!!}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#search_button').click(function() {
            $('#order_form').submit();
        });
        
//        $('#datetimepicker12').datetimepicker({
//            beforeShowDay: function(date) {
//            if (date.getMonth() == dateToDisable.getMonth() && date.getDate() == dateToDisable.getDate()) {
//                    return [true, "custom-date-style"];
//            }
//            return [true, ""];
//	}
//});   
        $('.default_datetimepicker').datetimepicker({
            format:'d/m/Y',
            formatDate:'d.m.Y',
//            value:'2015/04/15',
//            defaultDate:'20/12/2015',
            timepicker:false,
            timepickerScrollbar:false
        });
       
    });
</script>
<p id="pankuzu"><a href="../top">TOP</a> &gt; <a href="index">Quản lí đơn hàng</a> &gt; Tìm kiếm đơn hàng</p>
<h2 id="page_midashi_02">Tìm kiếm đơn hàng</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div id="bg_blue">
    <p class="mb15 floatL color_red">
        ※ Khi bạn nhập vào các mục dưới đây bạn có thể lọc theo các điều kiện tìm kiếm<br />
    </p>
    <p id="csv_button">Lưu file CSV</p>
    <div class="clear"></div>
    {!! Form::open(['method' => 'GET', 'url' => 'admin/order/search', 'id' => 'order_form']) !!}
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th>Ngày đặt hàng</th>
            <td colspan="3">
                <label><input type="radio" name="order_sort" value="ASC" @if (isset($input['order_sort']) && $input['order_sort'] == "ASC") checked @endif>
                    Thứ tự tăng dần
                </label>
                <label><input type="radio" name="order_sort" value="DESC" @if (!isset($input['order_sort']) || (isset($input['order_sort']) && $input['order_sort'] == "DESC")) checked @endif>
                    Thứ tự giảm dần
                </label>
                    <input type="text" name="order_date_start" class="default_datetimepicker" style='width:100px;'/> ~ <input type="text" name="order_date_end" class="default_datetimepicker" style='width:100px;'/>
            </td>
        </tr>
        <tr class="menu">
            <th>Mã đơn hàng</th>
            <td>
                {!! Form::text('order_code', isset($input['order_code'])? $input['order_code']:'',['style' => 'width:180px', 'class' => 'text']) !!}
                @if ($errors->has('order_code'))<p style="color: red">{!! $errors->first('order_code') !!}</p>@endif
            </td>
            
            
            <th>Trạng thái đơn hàng </th>
            <td>
                {!! Form::select('order_status', array('' => 'Chọn trạng thái')+ InitialDefine::$arrayOderStatus, isset($input['order_status'])? $input['order_status']:'') !!}
                @if ($errors->has('order_status'))<p style="color: red">{!! $errors->first('order_status') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Tên khách hàng</th>
            <td colspan="3">
                {!! Form::text('order_customer_name', isset($input['order_customer_name'])? $input['order_customer_name']:'',['style' => 'width:400px', 'class' => 'text']) !!}
                @if ($errors->has('order_customer_name'))<p style="color: red">{!! $errors->first('order_customer_name') !!}</p>@endif
            </td>
            
        </tr>
        <tr class="menu">
            <th>Điện thoại khách hàng</th>
            <td colspan="3">
                {!! Form::text('order_phone', isset($input['order_phone'])? $input['order_phone']:'',['style' => 'width:400px', 'class' => 'text']) !!}
                @if ($errors->has('order_phone'))<p style="color: red">{!! $errors->first('order_phone') !!}</p>@endif
            </td>
        </tr>
    </table>
    <div class="mt15">
        <p id="search_button">Search</p>
        <div class="clear"></div>
    </div>
    {!! Form::close() !!}
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
            @if (isset($orders))
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
            @endif
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
@endsection