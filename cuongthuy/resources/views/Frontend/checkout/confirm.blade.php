@extends('Frontend.layout')
@section('content')
<?php use App\Http\Controllers\Frontend\CartController ?>
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
                <td style="width:128px;">Họ và tên :</td>
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
        <p class="bs1_bold">Địa chỉ nhận hàng :</p>
        <table>
            <tr>
                <td style="width:128px;">Số nhà, Đường / phố :</td>
                <td>{!!$billing['street']!!}</td>
            </tr>
            <tr>
                <td>Phường / Xã :</td>
                <td>{!!$billing['ward']!!}</td>
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
        @if ($billing['note'])
        <div class="clear"></div>
        <p class="bs1_bold">Ghi chú</p>
        <table>
            <tr>
                <td style="width:128px;">Ghi chú về đơn hàng :</td>
                <td>{!!$billing['note']!!}</td>
            </tr>
        </table>
        @endif
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
                        <td><a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $product->id))!!}">{!!$product->product_code!!}</a></td>
                        <td><a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $product->id))!!}">{!!$product->product_name!!}</a></td>
                        <td>{!!$cart[$product->id]!!}</td>
                        <td>{!!number_format ($product->product_price * $cart[$product->id])!!} đ</td>
                    </tr>
                @endforeach
            </tbody>
            <td colspan="5" style="color:#da2027; text-align:right; font-weight:bold;">Tổng tiền : {!!number_format (CartController::getTotalPriceCart())!!} đ</td>
        </table>
    </div><!-- end content right-->
    <div class="clear"></div>
    {!! Form::open(array('url' => 'checkout/confirm')) !!}
    <ul class="bs1_button">
        <li><a href="{!!Asset('checkout/shipping')!!}">Quay lại</a></li>
        <li><input type="submit" name="submit" value="Xác nhận"></li>
    </ul>
    {!! Form::close() !!}
    <div class="clear"></div>
</div><!-- end wrap-->
<!-- InstanceEndEditable -->
@endsection