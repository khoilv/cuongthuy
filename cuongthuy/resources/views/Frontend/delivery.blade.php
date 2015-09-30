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
    <div class="steps1_c2">
        <p class="bs1_bold">Thông tin liên hệ</p>
        <table>
            <tr>
                <td>Họ và tên :</td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td>Số điện thoại :</td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><input type="text"></td>
            </tr>
        </table>
        <div class="clear"></div>
        <p class="bs1_bold">Địa chỉ nhận hàng</p>
        <table>
            <tr>
                <td>Số nhà :</td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td>Đường / Phố :</td>
                <td><input type="text"></td>
            </tr>
            <tr>
                <td>Tỉnh thành :</td>
                <td>
                    <select>
                        <option>Hà Nội</option>
                        <option>Tp. Hồ Chí Minh</option>
                        <option>Đà Nẵng</option>
                        <option>Hải Phòng</option>
                        <option>Hà Nội</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Quận / Huyện :</td>
                <td>
                    <select>
                        <option>Ba Đình</option>
                        <option>Nguyễn Trãi</option>
                        <option>Thanh Xuân</option>
                        <option>Bắc từ liêm</option>
                        <option>Nam Từ Liêm</option>
                    </select>

                </td>
            </tr>
        </table>
        <div class="clear"></div>
        <ul class="bs1_button">
            <li><a href="#">Xóa</a></li>
            <li><a href="#">Hoàn thành</a></li>
        </ul>
    </div>
</div><!-- end wrap-->

<!-- InstanceEndEditable -->
@endsection