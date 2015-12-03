@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP</a> &gt; <a href="{!!Asset('admin/product/index')!!}">Quản lí sản phẩm</a> &gt; Đăng kí sản phẩm</p>
<h2 id="page_midashi_02">Đăng kí sản phẩm</h2>
<div id="bg_blue">
    <p class="mb15 big">※Đăng ký sản phẩm. Tại đây bạn có thể thực hiện update sản phẩm.</p>
    <p class="alert_red_error mb10">Đã xảy ra lỗi.Vui lòng kiểm tra các mục bên dưới</p>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th><span class="color_red">※</span>Mã sản phẩm</th>
            <td>
                <input type="text" name="product_code" class="text" style="width:300px;" />
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Tên sản phẩm</th>
            <td>
                <input type="text" name="product_name" class="text" style="width:400px;" />
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Loại sản phẩm</th>
            <td>
                <p class="floatL mt5 mr10">
                    <select name="product_category">
                        <option value="0">Mỹ phẩm</option>
                        <option value="1">Son</option>
                        <option value="2">Dầu gội</option>
                    </select>
                </p>
            </td>
        </tr>
        <tr class="menu">
            <th rowspan="5"><span class="color_red">※</span>Ảnh sản phẩm</th>
            <td>
                <p><span class="color_blue bold ml30">※Kích thước ảnh：W230×H230px Image type：jpg</span></p>
                <input type="file" name="file" size="50" />
                <p><img src="img/gift_img_main.jpg" /></p>
            </td>
        </tr>
        <tr class="menu">
            <td >
                <p><span class="color_blue bold ml30">※Kích thước ảnh：W230×H230px Image type：jpg</span></p>
                <input type="file" name="file" size="50" />
                <p class="error_comment">Hãy thiết lập ảnh</p>
                <p><img src="img/gift_img_main.jpg" /></p>
            </td>
        </tr>
        <tr class="menu">
            <td>
                <p><span class="color_blue bold ml30">※Kích thước ảnh：W230×H230px Image type：jpg</span></p>
                <input type="file" name="file" size="50" />
                <p><img src="img/gift_img_main.jpg" /></p>
            </td>
        </tr>
        <tr class="menu">
            <td>
                <p><span class="color_blue bold ml30">※Kích thước ảnh：W230×H230px Image type：jpg</span></p>
                <input type="file" name="file" size="50" />
                <p><img src="img/gift_img_main.jpg" /></p>
            </td>
        </tr>
        <tr class="menu">
            <td>
                <p><span class="color_blue bold ml30">※Kích thước ảnh：W230×H230px Image type：jpg</span></p>
                <input type="file" name="file" size="50" />
                <p><img src="img/gift_img_main.jpg" /></p>
            </td>
        </tr>
         <tr class="menu">
            <th><span class="color_red">※</span>Trạng thái sản phẩm</th>
            <td>
                <p class="floatL mt5 mr10">
                    <select name="product_status">
                        <option value="1">Sản phẩm đang bán</option>
                        <option value="2">Sản phẩm sắp có hàng</option>
                        <option value="3">Sản phẩm hết hàng</option>
                    </select>
                </p>
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Mô tả ngắn gọn về sản phẩm</th>
            <td>
                <textarea name="product_short_description" style="width:550px;height:50px;"></textarea>
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Mô tả sản phẩm</th>
            <td>
                <textarea name="product_description" style="width:550px;height:150px;"></textarea>
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Giá sản phẩm</th>
            <td>
                <input type="text" name="product_price" class="text" style="width:200px;" />　VNĐ
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Giá sản phẩm khi đã giảm giá</th>
            <td>
                <input type="text" name="product_discount_price" class="text" style="width:200px;" />　VNĐ
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Số lượng</th>
            <td>
                <input type="text" name="product_quantity" class="text" style="width:200px;" />　VNĐ
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Hiển thị sản phẩm</th>
            <td>
                <label><input type="radio" name="product_display" id="syoarea" value="1" checked> Hiển thị sản phẩm</label>&nbsp;&nbsp;&nbsp;
                <label><input type="radio" name="product_display" id="syoarea" value="2"> Không hiển thị sản phẩm</label>
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Trạng thái bán sản phẩm</th>
            <td>
                <label><input type="checkbox" name="product_sell_status[]" id="syoarea" value="1" checked> Sản phẩm mới</label>&nbsp;&nbsp;&nbsp;
                <label><input type="checkbox" name="product_sell_status[]" id="syoarea" value="2"> Sản phẩm bán chạy</label>&nbsp;&nbsp;&nbsp;
                <label><input type="checkbox" name="product_sell_status[]" id="syoarea" value="3"> Sản phẩm nổi bật</label>&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Số lượng sản phẩm đã bán</th>
            <td>
                <label>0</label>
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