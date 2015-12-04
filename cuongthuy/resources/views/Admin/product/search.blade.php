@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP</a> &gt; <a href="{!!Asset('admin/product/index')!!}">Quản lí sản phẩm</a> &gt; Tìm kiếm sản phẩm</p>
<h2 id="page_midashi_02">Tìm kiếm sản phẩm</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div id="bg_blue">
    <p class="mb15 floatL">
        ※ Khi bạn nhập vào các mục dưới đây bạn có thể lọc theo các điều kiện tìm kiếm<br />
    </p>
    <p id="csv_button">Lưu file CSV</p>
    <div class="clear"></div>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th>Tên sản phẩm</th>
            <td colspan="3"><input type="text" name="product_name" class="text" style="width:450px;" /></td>
        </tr>
        <tr class="menu">
            <th>Mã sản phẩm</th>
            <td colspan="3"><input type="text" name="product_code" class="text" style="width:450px;" /></td>
        </tr>
        <tr class="menu">
            <th>Loại sản phẩm</th>
            <td>
                <select name="product_category">
                    <option label="" value="" selected>Chọn loại sản phẩm</option>
                    <option label="" value="">Mỹ phẩm</option>
                    <option label="" value="">Dầu gội</option>
                    <option label="" value="">Sữa tắm</option>
                </select>
            </td>
            <th>Trạng thái</th>
            <td>
                <select name="status">
                    <option value="0">Chọn trạng thái</option>
                    <option value="1">Sản phẩm đang bán</option>
                    <option value="2">Sản phẩm sắp có hàng</option>
                    <option value="3">Sản phẩm hết hàng</option>
                </select>
            </td>
        </tr>
    </table>
    <div class="mt15">
        <p id="search_button">Search</p>
        <div class="clear"></div>
    </div>
</div>

<div id="bg_blue" class="mt15">
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <thead>
            <tr class="table_list">
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá tiền</th>
                <th>Trạng thái</th>
                <th>Số lượng</th>
                <th>Mô tả</th>
            </tr>
        </thead>
        <tbody>
            <tr class="table_list">
                <td><a href="../order/search.html">001</a></td>
                <td class="bold"><p class="alignC"><a href="detailed.html">Phụ kiện-Thời trang</a></p></td>
                <td>100000</td>
                <td>Đang chạy</td>
                <td>100</td>
                <td>Deserunt non doloribus velit voluptas porro occaecati. Ab et aut voluptatem molestiae vel ullam qui</td>
            </tr>
            <tr class="table_list bg_yellow">
                <td><a href="../order/search.html">001</a></td>
                <td class="bold"><p class="alignC"><a href="detailed.html">Phụ kiện-Thời trang</a></p></td>
                <td>100000</td>
                <td>Đang chạy</td>
                <td>100</td>
                <td>Deserunt non doloribus velit voluptas porro occaecati. Ab et aut voluptatem molestiae vel ullam qui</td>
            </tr>
    </table>

    <div id="tab_area">
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
    </div>
</div>
<!-- InstanceEndEditable -->
@endsection