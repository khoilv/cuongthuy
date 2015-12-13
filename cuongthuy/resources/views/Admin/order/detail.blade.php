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
    <p class="mb15 floatL">
        ※ Bạn có thể thay đổi thông tin đơn hàng sau đó click vào "Lưu đơn hàng" để lưu lại<br />
    </p>
    <div class="clear"></div>
    <?php var_dump($order) ?>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th>Mã đơn hàng</th>
            <td colspan='3'>{!!$order['order_code']!!}</td>
        </tr>
        <tr class="menu">
            <th>Ngày đặt hàng</th>
            <td colspan='3'>{!!$order['order_date']!!}</td>
        </tr>
        <tr class="menu">
            <th>Tên khách hàng</th>
            <td colspan='3'>{!!$order['order_customer_name']!!}</td>
        </tr>
        <tr class="menu">
            <th>Số điện thoại</th>
            <td colspan='3'>{!!$order['order_phone']!!}</td>
        </tr>
        <tr class="menu">
            <th>Email</th>
            <td colspan='3'>{!!$order['order_email']!!}</td>
        </tr>
        <tr class="menu">
            <th>Địa chỉ</th>
            <td colspan='3'>{!!$order['order_ship_address']!!}</td>
        </tr>
        <tr class="menu">
            <th>Trạng thái đơn hàng</th>
            <td colspan='3'>{!!$order['order_status']!!}</td>
        </tr>
        <tr class="menu">
            <th>Phương thức nhận hàng</th>
            <td colspan='3'>{!!$order['payment_method']!!}</td>
        </tr>
        <tr class="menu">
            <th>Ghi chú của khách hàng về đơn hàng</th>
            <td colspan='3'>{!!$order['order_note']!!}</td>
        </tr>
        <tr class="table_list bg_yellow">
            <th colspan='4'>Chi tiết đơn hàng</th>
        </tr>
        <tr class="menu">
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
        <?php var_dump($orderDetail) ?>
        @foreach ($orderDetail as $key => $value)
        <tr class="menu">
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
        @endforeach
    </table>
    <div class="mt15">
        <p id="search_button">Lưu đơn hàng</p>
        <div class="clear"></div>
    </div>
</div>

@endsection