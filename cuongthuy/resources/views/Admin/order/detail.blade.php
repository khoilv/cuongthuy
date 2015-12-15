<?php use App\Lib\InitialDefine ?>
@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<p id="pankuzu"><a href="../top">TOP</a> &gt; 
    <a href="index">Quản lí đơn hàng</a> &gt; 
    <a href="index">Tìm kiếm đơn hàng</a> &gt; 
    Chi tiết đơn hàng</p>
<h2 id="page_midashi_02">Xem và chỉnh sửa thông tin đơn hàng</h2>
<div id="bg_blue">
    <p class="mb15 floatL" style="color:red">
        ※ Bạn có thể thay đổi thông tin đơn hàng sau đó click vào "Lưu đơn hàng" để lưu lại<br />
    </p>
    @if(Session::has('msg_error'))
    <p class="alert_red_error mb10">{!!Session::get('msg_error')!!}</p>
    {{ Session::forget('msg_error') }}
    @endif
    @if(Session::has('success'))
        <p class="alignC mt15 mb10 bold" style="font-size:1.6em;">{!!Session::get('success')!!}</p>
        {{ Session::forget('success') }}
    @endif
    <div class="clear"></div>
    {!! Form::open(['method' => 'POST']) !!}
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th style="width:150px">Mã đơn hàng</th>
            <td colspan='4'>
                {!! Form::text('order_code', isset($order['order_code'])? $order['order_code']:'',['style' => 'width:300px', 'class' => 'text']) !!}
                @if ($errors->has('order_code'))<p class="error_comment">{!! $errors->first('order_code') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Thời gian đặt hàng</th>
            <td colspan='4'>{!!date("H:i:s d-m-Y", strtotime($order['order_date']))!!}</td>
        </tr>
        <tr class="menu">
            <th>Tên khách hàng</th>
            <td colspan='4'>
            {!! Form::text('order_customer_name', isset($order['order_customer_name'])? $order['order_customer_name']:'',['style' => 'width:300px', 'class' => 'text']) !!}
            @if ($errors->has('order_customer_name'))<p class="error_comment">{!! $errors->first('order_customer_name') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Số điện thoại</th>
            <td colspan='4'>
            {!! Form::text('order_phone', isset($order['order_phone'])? $order['order_phone']:'',['style' => 'width:200px', 'class' => 'text']) !!}
            @if ($errors->has('order_phone'))<p class="error_comment">{!! $errors->first('order_phone') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Email</th>
            <td colspan='4'>
                {!! Form::text('order_email', isset($order['order_email'])? $order['order_email']:'',['style' => 'width:300px', 'class' => 'text']) !!}
                @if ($errors->has('order_email'))<p class="error_comment">{!! $errors->first('order_email') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Địa chỉ</th>
            <td colspan='4'>
                {!! Form::text('order_ship_address', isset($order['order_ship_address'])? str_replace(";"," - ",$order['order_ship_address']):'',['style' => 'width:300px', 'class' => 'text']) !!}
                @if ($errors->has('order_ship_address'))<p class="error_comment">{!! $errors->first('order_ship_address') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Tỉnh/Thành</th>
            <td colspan='4'>{!!$order['order_ship_city']!!}</td>
            
        </tr>
        <tr class="menu">
            <th>Trạng thái đơn hàng</th>
            <td colspan='4'>{!!InitialDefine::selectValue($order['order_status'], InitialDefine::$arrayOderStatus)!!}</td>
        </tr>
        <tr class="menu">
            <th>Phương thức nhận hàng</th>
            <td colspan='4'>{!!InitialDefine::selectValue($order['payment_method'], InitialDefine::$arrayPaymentMethod)!!}</td>
        </tr>
        <tr class="menu">
            <th>Ghi chú của khách hàng về đơn hàng</th>
            <td colspan='4'>
                {!! Form::textarea('order_note', isset($order['order_note'])? $order['order_note']:'',['style' => 'width:550px;height:50px', 'class' => 'text']) !!}
            </td>
        </tr>
        <tr class="table_list bg_yellow">
            <th colspan='5'>Chi tiết đơn hàng</th>
        </tr>
        <tr class="menu">
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá (thời điểm mua hàng)</th>
            <th>Đơn giá (hiện tại)</th>
            <th>Thành tiền</th>
        </tr>
        <?php $totalPrice = 0 ?>
        @foreach ($orderDetail as $key => $value)
        <?php $linePrice = $value['quantity']*$value['unitPrice'] ?>
        <?php $totalPrice += $linePrice; ?>
        <tr class="menu">
            <td>{!!$arrProducts[$value['product_id']]['product_name']!!}</td>
            <td>{!!$value['quantity']!!}</td>
            <td>{!!number_format ($value['unitPrice'],0,",",".")!!} đ</td>
            <td>{!!number_format ($arrProducts[$value['product_id']]['product_price'],0,",",".")!!} đ</td>
            <td>{!!number_format ($linePrice,0,",",".")!!} đ</td>
        </tr>
        @endforeach
        <tr class="table_list">
            <th colspan='5' style="text-align:right">Tổng tiền: {!!number_format ($totalPrice,0,",",".")!!} đ</th>
        </tr>
    </table>
    <div class="mt15">
        <p id="search_button">Lưu đơn hàng</p>
        <div class="clear"></div>
    </div>
    {!! Form::close() !!}
</div>

@endsection