@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<p id="pankuzu"><a href="../index.html">TOP</a> &gt; <a href="index">Quản lí sản phẩm</a> &gt; Đăng kí sản phẩm</p>
<h2 id="page_midashi_02">Đăng kí sản phẩm</h2>
<div id="bg_blue">
    <p class="mb15 big">※Đăng ký sản phẩm, bạn có thể thực hiện update sản phẩm.</p>
    <p class="alert_red_error mb10">Đã xảy ra lỗi.Vui lòng kiểm tra các mục bên dưới</p>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th rowspan="2"><span class="color_red">※</span>Ảnh sản phẩm</th>
            <td>
                <p><img src="img/gift_img_main.jpg" /></p>
            </td>
        </tr>
        <tr class="menu">
            <td>
                <p><span class="color_blue bold ml30">※Kích thước ảnh：W230×H230px Image type：jpg</span></p>
                <input type="file" name="file" size="50" />
                <p class="error_comment">Hãy thiết lập ảnh</p>
            </td>
        </tr>

        <tr class="menu">
            <th><span class="color_red">※</span>Mã sản phẩm</th>
            <td>
                <input type="text" name="product_code" class="text" style="width:300px;" />
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Tên sản phẩm</th>
            <td>
                <input type="text" name="gift_name" class="text" style="width:400px;" />
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Mô tả sản phẩm</th>
            <td>
                <textarea name="gift_explanation" style="width:550px;height:150px;"></textarea>
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Giá tiền</th>
            <td><input type="text" name="heart" class="text" style="width:100px;" />　VNĐ
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Loại sản phẩm</th>
            <td>
                <p class="floatL mt5 mr10">
                    <select name="ranking">
                        <option label="0" value="0">Mỹ phẩm</option>
                        <option label="1" value="1">Son</option>
                        <option label="2" value="2">Dầu gội</option>
                    </select>
                </p>
                <div class="clear"></div>
            </td>
        </tr>

    </table>

    <div class="mt15">
        <p id="button">Register</p>
        <div class="clear"></div>
    </div>
</div>
<!-- InstanceEndEditable -->
@endsection