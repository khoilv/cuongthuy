@extends('Frontend.layout')
@section('content')
<!-- InstanceBeginEditable name="Content" -->
<div class="title title1">
    <div class="wrap">
        <div class="f_left"><span class="title_red"></span><a href="#">Mua hàng</a></div>
    </div>
    <div class="clear"></div>
</div>
<div class="wrap">
    <div class="steps1_c1">
        <ul>
            <li>
                <p class="big_text active">1</p>
                <div><span class="text_smal">Nhập<br></span><span class="text_bold">Thông tin cá nhân</span></div>
            </li>
            <li>
                <p class="big_text">2</p>
                <div><span class="text_smal">Chọn<br></span><span class="text_bold">Hình thức nhận hàng</span></div>
            </li>
            <li>
                <p class="big_text">3</p>
                <div><span class="text_smal">Xác nhận<br></span><span class="text_bold">Đơn hàng</span></div>
            </li>
        </ul>
        <div class="clear"></div>
    </div><!-- end Steps 1 content-->
    <div class="clear"></div>
    {!! Form::open(array('url' => 'checkout/billing', 'name' => 'test')) !!}
    <div class="steps1_c2">
        <p class="bs1_bold">Thông tin liên hệ</p>
        <table>
            <tr>
                <td>Họ và tên :</td>
                <td><input type="text" name="name" value=@if(isset($billing['name'])) {!!$billing['name']!!} @endif></td>
            </tr>
            <tr>
                <td>Số điện thoại :</td>
                <td><input type="text" name="telephone" value=@if(isset($billing['telephone'])) {!!$billing['telephone']!!} @endif></td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><input type="text" name="email" value=@if(isset($billing['email'])) {!!$billing['email']!!} @endif></td>
            </tr>
        </table>
        <div class="clear"></div>
        <p class="bs1_bold">Địa chỉ nhận hàng</p>
        <table>
            <tr>
                <td>Số nhà :</td>
                <td><input type="text" name="houseNumber" value=@if(isset($billing['houseNumber'])) {!!$billing['houseNumber']!!} @endif></td>
            </tr>
            <tr>
                <td>Đường / Phố :</td>
                <td><input type="text" name="street" value=@if(isset($billing['street'])) {!!$billing['street']!!} @endif></td>
            </tr>
            <tr>
                <td>Quận / Huyện :</td>
                <td><input type="text" name="district" value=@if(isset($billing['district'])) {!!$billing['district']!!} @endif></td>
            </tr>
            <tr>
                <td>Tỉnh thành :</td>
                <td>
                    <select name="city">
                        <option @if (isset( $billing['city']) && $billing['city'] == "Hà Nội") selected @endif value="Hà Nội">Hà Nội</option>
                        <option @if (isset ($billing['city']) && $billing['city'] == "Tp. Hồ Chí Minh") selected @endif value="Tp. Hồ Chí Minh">Tp. Hồ Chí Minh</option>
                        <option @if (isset ($billing['city']) && $billing['city'] == "Hải Phòng") selected @endif value="Hải Phòng">Hải Phòng</option>
                        <option @if (isset ($billing['city']) && $billing['city'] == "Đà Nẵng") selected @endif value="Đà Nẵng">Đà Nẵng</option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="clear"></div>
        <ul class="bs1_button">
            <li><a href="#">Xóa</a></li>
            <li onclick="test.submit();"><a >Hoàn thành</a></li>
            <li><input type="reset" value="Xóa"></li>
            <li><input type="submit" name="submit" value="Hoàn thành"></li>
    </div>
    {!! Form::close() !!}
</div><!-- end wrap-->

<!-- InstanceEndEditable -->
@endsection