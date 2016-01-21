<?php use App\Lib\InitialDefine ?>
@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<script>
    $(document).ready( function () {
        $('.delete_product').click(function () {
            if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi đơn hàng của khách?")) {
                var my = $(this).closest('tr');
                var post = {
                    id : $(".order_detail_id", my).val(),
                    order_id: $(".order_id", my).val()
                };

                $.ajax({
                    url: 'order_detail/delete-order',
                    type: 'post',
                    dataType: 'json',
                    data: post,
                    success: function() {
                        location.reload();
                    }
                });
            }
            return false;
        });
        
        $('#button').click(function() {
            $('#order_form').submit();
        });
    });
</script>
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP</a> &gt; 
    <a href="{!!Asset('admin/order/index')!!}">Quản lí đơn hàng</a> &gt; 
    <a href="{!!Asset('admin/order/search')!!}">Tìm kiếm đơn hàng</a> &gt; 
    Chi tiết đơn hàng</p>
<h2 id="page_midashi_02">Xem và chỉnh sửa thông tin đơn hàng</h2>
<div id="bg_blue">
    <p class="mb15 big" style="color:red">
        ※ Bạn có thể thay đổi thông tin đơn hàng sau đó click vào "Lưu đơn hàng" để lưu lại<br />
    </p>
    @if(Session::has('msg_error'))
    <p class="alert_red_error mb10">{!!Session::get('msg_error')!!}</p>
    {!! Session::forget('msg_error') !!}
    @endif
    @if(Session::has('success'))
        <p class="alignC mt15 mb10 bold" style="font-size:1.6em;">{!!Session::get('success')!!}</p>
        {!! Session::forget('success') !!}
    @endif
    <div class="clear"></div>
    {!! Form::open(['method' => 'POST', 'url' => 'admin/order_detail?order_id='.$order['id'], 'id' => 'order_form']) !!}
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th style="width:150px">Mã đơn hàng</th>
            <td colspan='5'>
                {!!$order['order_code']!!}
            </td>
        </tr>
        <tr class="menu">
            <th>Thời gian đặt hàng</th>
            <td colspan='5'>{!!date("H:i:s d-m-Y", strtotime($order['order_date']))!!}</td>
        </tr>
        <tr class="menu">
            <th>Tên khách hàng</th>
            <td colspan='5'>
            {!! Form::text('order_customer_name', isset($order['order_customer_name'])? $order['order_customer_name']:'',['style' => 'width:300px', 'class' => 'text']) !!}
            @if ($errors->has('order_customer_name'))<p style="color: red">{!! $errors->first('order_customer_name') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Số điện thoại</th>
            <td colspan='5'>
            {!! Form::text('order_phone', isset($order['order_phone'])? $order['order_phone']:'',['style' => 'width:200px', 'class' => 'text']) !!}
            @if ($errors->has('order_phone'))<p style="color: red">{!! $errors->first('order_phone') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Email</th>
            <td colspan='5'>
                {!! Form::text('order_email', isset($order['order_email'])? $order['order_email']:'',['style' => 'width:300px', 'class' => 'text']) !!}
                @if ($errors->has('order_email'))<p style="color: red">{!! $errors->first('order_email') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Địa chỉ</th>
            <td colspan='5'>
            {!! Form::text('order_ship_address', isset($order['order_ship_address'])? str_replace(";"," - ",$order['order_ship_address']):'',['style' => 'width:300px', 'class' => 'text']) !!}
            @if ($errors->has('order_ship_address'))<p style="color: red">{!! $errors->first('order_ship_address') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Tỉnh/Thành</th>
            <td colspan="5">
            {!! Form::select('order_ship_city', InitialDefine::$arrCity, isset($order['order_ship_city'])? $order['order_ship_city']:'') !!}
            @if ($errors->has('order_ship_city'))<p style="color: red">{!! $errors->first('order_ship_city') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Trạng thái đơn hàng</th>
            <td colspan="5">
            {!! Form::select('order_status', InitialDefine::$arrayOderStatus, isset($order['order_status'])? $order['order_status']:'') !!}
            @if ($errors->has('order_status'))<p style="color: red">{!! $errors->first('order_status') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Phương thức nhận hàng</th>
            <td colspan="5">
            {!! Form::select('payment_method', InitialDefine::$arrayPaymentMethod, isset($order['payment_method'])? $order['payment_method']:'') !!}
            @if ($errors->has('payment_method'))<p style="color: red">{!! $errors->first('payment_method') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Ghi chú của khách hàng về đơn hàng</th>
            <td colspan='5'>
            {!! Form::textarea('order_note', isset($order['order_note'])? $order['order_note']:'',['style' => 'width:550px;height:50px', 'class' => 'text']) !!}
            @if ($errors->has('order_note'))<p style="color: red">{!! $errors->first('order_note') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Thời gian sửa đổi đơn hàng lần cuối</th>
            <td colspan='5'>{!!isset($order['date_time_last_modify'])? date("H:i:s d-m-Y", strtotime($order['date_time_last_modify'])): ''!!}</td>
        </tr>
        <tr class="table_list bg_yellow">
            <th colspan='6'>Chi tiết đơn hàng</th>
        </tr>
        <tr class="menu">
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá (thời điểm mua hàng)</th>
            <th>Đơn giá (hiện tại)</th>
            <th>Thành tiền</th>
            <th>Xóa</th>
        </tr>
        <?php $totalPrice = 0 ?>
        @if (!empty($orderDetail))
            @foreach ($orderDetail as $key => $value)
                @if (isset($arrProducts[$value['product_id']]['product_name']))
                <?php $linePrice = $value['quantity']*$value['unitPrice'] ?>
                <?php $totalPrice += $linePrice; ?>
                <tr class="menu">
                    <td><a href="{!!Asset('admin/product/detail/'. $value['product_id'])!!}">{!!$arrProducts[$value['product_id']]['product_name']!!}</a></td>
                    <td>{!! Form::text('quantity['.$value['product_id'].']', isset($value['quantity'])? $value['quantity']:'',['style' => 'width:30px', 'class' => 'product_quantity']) !!}
                        @if ($errors->has('quantity['.$value['product_id'].']'))
                            <p style="color: red">{!! $errors->first('quantity['.$value['product_id'].']') !!}</p>
                        @endif
                    </td>
                    <td>{!!number_format ($value['unitPrice'],0,",",".")!!} đ</td>
                    <td>{!!number_format ($arrProducts[$value['product_id']]['product_price'],0,",",".")!!} đ</td>
                    <td class="line_price">{!!number_format ($linePrice,0,",",".")!!} đ</td>
                    <td> <p class="delete_product" style="cursor: pointer;" title="Xóa sản phẩm này khỏi đơn hàng"><img src="{!!Asset('public/images/icon16.png')!!}"></p> </img></td>
                    <input type="hidden" class="order_detail_id" value="{!! $value['id'] !!}">
                    <input type="hidden" class="order_id" value="{!! $order['id'] !!}">
                </tr>
                @endif
            @endforeach
        @endif
        <tr class="table_list">
            <th class="total_price" colspan='6' style="text-align:right">Tổng tiền: {!!number_format ($totalPrice,0,",",".")!!} đ</th>
        </tr>
    </table>
    <div class="mt15">
        <p id="button">Lưu đơn hàng</p>
        <div class="clear"></div>
    </div>
    {!! Form::close() !!}
</div>
@endsection