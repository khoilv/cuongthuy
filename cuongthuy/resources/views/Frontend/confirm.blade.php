@extends('Frontend.layout')
@section('content')
<!-- InstanceBeginEditable name="Content" -->
<div class="title title1">
    <div class="wrap">
        <div class="f_left"><span class="title_red"></span><a href="#">Xác nhận</a></div>
    </div>
    <div class="clear"></div>
</div>
<div class="wrap steps3_c">
    <div class="f_left">
        <p class="bs1_bold">Thông tin liên hệ</p>
        <table>
            <tr>
                <td>Họ và tên :</td>
                <td>{!!$billing['name']!!}</td>
            </tr>
            <tr>
                <td>Số điện thoại :</td>
                <td>{!!$billing['telephone']!!}</td>
            </tr>
            <tr>
                <td>Email :</td>
                <td>{!!$billing['email']!!}</td>
            </tr>
        </table>
        <div class="clear"></div>
        <p class="bs1_bold">Địa chỉ nhận hàng</p>
        <table>
            <tr>
                <td>Số nhà :</td>
                <td>{!!$billing['houseNumber']!!}</td>
            </tr>
            <tr>
                <td>Đường / Phố :</td>
                <td>{!!$billing['street']!!}</td>
            </tr>
            <tr>
                <td>Quận / Huyện :</td>
                <td>{!!$billing['district']!!}</td>
            </tr>
            <tr>
                <td>Tỉnh thành :</td>
                <td>{!!$billing['city']!!}</td>
            </tr>
        </table>
    </div><!-- end content left-->
    <div class="f_right">
        <p class="bs1_bold">Thông tin đơn hàng</p>
        <table>
            <thead>
                <tr>
                    <td>STT</td>
                    <td>Mã sản phẩm</td>
                    <td>Tên sản phẩm</td>
                    <td>Số lượng</td>
                    <td>Thành tiền</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $key => $product)
                    <tr>
                        <td>{!!$key+1!!}</td>
                        <td>{!!$product->product_code!!}</td>
                        <td>{!!$product->product_name!!}</td>
                        <td>{!!$cart[$product->id]!!}</td>
                        <td>{!!$product->product_price * $cart[$product->id]!!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- end content right-->
    <div class="clear"></div>
    <ul class="bs1_button">
        <li><a href="{!!Asset('checkout/shipping')!!}">Quay lại</a></li>
        <li><a href="#">Xác nhận</a></li>
        <li><input type="submit" name="submit" value="Xác nhận"></li>
    </ul>
</div><!-- end wrap-->
<!-- InstanceEndEditable -->
@endsection