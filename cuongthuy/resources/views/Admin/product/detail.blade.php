@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('javascript')
<script type="text/javascript" src="{!!Asset('public/js/ckeditor/ckeditor.js')!!}"></script>
<script>
    $(document).ready( function () {
        $('#button').click(function() {
            $('#product_form').submit();
        });
    });
</script>
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP</a> &gt; <a href="{!!Asset('admin/product/index')!!}">Quản lí sản phẩm</a> &gt; {!! isset($product['id']) ? 'Cập nhật sản phẩm' : 'Đăng kí sản phẩm' !!}</p>
<h2 id="page_midashi_02">{!! isset($product['id']) ? 'Cập nhật sản phẩm' : 'Đăng kí sản phẩm' !!}</h2>
<div id="bg_blue">
    <p class="mb15 big">
        ※Đăng ký sản phẩm. Tại đây bạn có thể thực hiện update sản phẩm.<br>
        Các mục đánh dấu ※ là mục bắt buộc phải nhập giá trị.
    </p>
    @if(Session::has('msg_error'))
    <p class="alert_red_error mb10">{!!Session::get('msg_error')!!}</p>
    {{ Session::forget('msg_error') }}
    @endif
    @if(Session::has('success'))
    <p class="alignC mt15 mb10 bold" style="font-size:1.6em;">{!!Session::get('success')!!}</p>
    {{ Session::forget('success') }}
    @endif
    {!! Form::open(['method' => 'POST','files' => true, 'id' => 'product_form']) !!}
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th><span class="color_red">※</span>Mã sản phẩm</th>
            <td colspan="2">
                {!! Form::text('product_code', isset($product['product_code'])? $product['product_code']:'',['style' => 'width:300px', 'class' => 'text']) !!}
                @if ($errors->has('product_code'))<p class="error_comment">{!! $errors->first('product_code') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Tên sản phẩm</th>
            <td colspan="2">
                {!! Form::text('product_name', isset($product['product_name'])? $product['product_name']:'',['style' => 'width:400px', 'class' => 'text']) !!}
                @if ($errors->has('product_name'))<p class="error_comment">{!! $errors->first('product_name') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Loại sản phẩm</th>
            <td colspan="2">
                <p class="floatL mt5 mr10">
                    {!! Form::select('product_category', 
                    $category,
                    isset($product['product_category'])? $product['product_category']:''
                    ) !!}
                </p>
                @if ($errors->has('product_category'))<p class="error_comment">{!! $errors->first('product_category') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Ảnh sản phẩm(ảnh chính)</th>
            <td colspan="2">
                <p><span class="color_blue bold ml30">※Ảnh chính</span></p>
                {!! Form::file('product_image') !!}
                @if ($errors->has('product_image'))<p class="error_comment">{!! $errors->first('product_image') !!}</p>@endif
                <p><img src="@if(isset($product['product_image'])){!!Asset('public/images/upload/products/'. $product['product_image'])!!} @endif" width="138px" height="134px"/></p>
            </td>
        </tr>
        <tr class="menu">
            <th rowspan="3"><span class="color_red">※</span>Ảnh sản phẩm(ảnh khác)</th>
            <td>
                {!! Form::file('product_other_image_0') !!}
                @if ($errors->has('product_other_image_0'))<p class="error_comment">{!! $errors->first('product_other_image_0') !!}</p>@endif
                <p><img src="@if(isset($product['product_other_image'][0])) {!!Asset('public/images/upload/products/'. $product['product_other_image'][0])!!} @endif" width="138px" height="134px"/></p>
            </td>
            <td>
                {!! Form::file('product_other_image_1') !!}
                @if ($errors->has('product_other_image_1'))<p class="error_comment">{!! $errors->first('product_other_image_1') !!}</p>@endif
                <p><img src="@if(isset($product['product_other_image'][1])) {!!Asset('public/images/upload/products/'. $product['product_other_image'][1])!!} @endif" width="138px" height="134px"/></p>
            </td>
        </tr>
        <tr class="menu">
            <td>
                {!! Form::file('product_other_image_2') !!}
                @if ($errors->has('product_other_image_2'))<p class="error_comment">{!! $errors->first('product_other_image_2') !!}</p>@endif
                <p><img src="@if(isset($product['product_other_image'][2])) {!!Asset('public/images/upload/products/'. $product['product_other_image'][2])!!} @endif" width="138px" height="134px"/></p>
            </td>
            <td>
                {!! Form::file('product_other_image_3') !!}
                @if ($errors->has('product_other_image_3'))<p class="error_comment">{!! $errors->first('product_other_image_3') !!}</p>@endif
                <p><img src="@if(isset($product['product_other_image'][3])) {!!Asset('public/images/upload/products/'. $product['product_other_image'][3])!!} @endif" width="138px" height="134px"/></p>
            </td>
        </tr>
        <tr class="menu">
            <td colspan="2">
                {!! Form::file('product_other_image_4') !!}
                @if ($errors->has('product_other_image_4'))<p class="error_comment">{!! $errors->first('product_other_image_4') !!}</p>@endif
                <p><img src="@if(isset($product['product_other_image'][4])) {!!Asset('public/images/upload/products/'. $product['product_other_image'][4])!!} @endif" width="138px" height="134px"/></p>
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Trạng thái sản phẩm</th>
            <td colspan="2">
                <p class="floatL mt5 mr10">
                    {!! Form::select('product_status',
                    $arrProductStatus,
                    isset($product['product_status'])? $product['product_status']:''
                    ) !!}
                </p>
                @if ($errors->has('product_status'))<p class="error_comment">{!! $errors->first('product_status') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Mô tả ngắn gọn về sản phẩm</th>
            <td colspan="2">
                {!! Form::textarea('product_short_description', isset($product['product_short_description'])? $product['product_short_description']:'',['style' => 'width:550px;height:50px', 'class' => 'text']) !!}
                @if ($errors->has('product_short_description'))<p class="error_comment">{!! $errors->first('product_short_description') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Mô tả chi tiết sản phẩm</th>
            <td colspan="2">
                {!! Form::textarea('product_description', isset($product['product_description'])? $product['product_description']:'',['style' => 'width:550px;height:150px', 'class' => 'text']) !!}
                @if ($errors->has('product_description'))<p class="error_comment">{!! $errors->first('product_description') !!}</p>@endif
                <script>
                    CKEDITOR.replace( 'product_description' );
                </script>
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Giá sản phẩm</th>
            <td colspan="2">
                <p><span class="color_blue bold ml30">※Giá sản phẩm là giá hiện tại được bán</span></p>
                {!! Form::text('product_price', isset($product['product_price'])? $product['product_price']:'',['style' => 'width:200px', 'class' => 'text']) !!} VNĐ
                @if ($errors->has('product_price'))<p class="error_comment">{!! $errors->first('product_price') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red"></span>Giá sản phẩm khi đã giảm giá</th>
            <td colspan="2">
                <p><span class="color_blue bold ml30">※Giá sản phẩm khi đã giảm giá: là giá của sản phẩm trước khi được sale off</span></p>
                {!! Form::text('product_discount_price', isset($product['product_discount_price'])? $product['product_discount_price']:'',['style' => 'width:200px', 'class' => 'text']) !!} VNĐ
                @if ($errors->has('product_discount_price'))<p class="error_comment">{!! $errors->first('product_discount_price') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Số lượng</th>
            <td colspan="2">
                {!! Form::text('product_quantity', isset($product['product_quantity'])? $product['product_quantity']:'',['style' => 'width:200px', 'class' => 'text']) !!}
                @if ($errors->has('product_quantity'))<p class="error_comment">{!! $errors->first('product_quantity') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red">※</span>Hiển thị sản phẩm</th>
            <td colspan="2">
                <label>{!! Form::radio('product_display',1, (isset($product['product_display']) && $product['product_display'] == 1)? $product['product_display']:'1') !!} Hiển thị sản phẩm</label>&nbsp;&nbsp;&nbsp;
                <label>{!! Form::radio('product_display',2, (isset($product['product_display']) && $product['product_display'] == 2)? $product['product_display']:'') !!} Không hiển thị sản phẩm</label>
                @if ($errors->has('product_display'))<p class="error_comment">{!! $errors->first('product_display') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th><span class="color_red"></span>Trạng thái bán sản phẩm</th>
            <td colspan="2">
                @foreach ($arrProductSellStatus as $key => $val)
                <label>{!! Form::checkbox("product_sell_status[$key]", $key, (isset($product['product_sell_status']) && strpos($product['product_sell_status'], "$key") !== false)? $product['product_sell_status']:'') !!} Sản phẩm mới</label>&nbsp;&nbsp;&nbsp;
                @endforeach
                @if ($errors->has('product_sell_status'))<p class="error_comment">{!! $errors->first('product_sell_status') !!}</p>@endif
            </td>
        </tr>
    </table>

    <div class="mt15">
        @if ($product_id)
        <p id="button">Cập nhật</p>
        @else
        <p id="button">Tạo mới</p>
        @endif
        <div class="clear"></div>
    </div>
    {!!Form::close()!!}
</div>
<!-- InstanceEndEditable -->
@endsection