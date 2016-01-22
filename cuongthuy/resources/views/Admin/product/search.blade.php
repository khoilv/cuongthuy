<?php use App\Lib\InitialDefine;
?>
@extends('Admin.layout')
@section('stylesheets')
<link rel="stylesheet" href="{!!Asset('public/css/admin/sub_page.css')!!}" type="text/css" />
@endsection
@section('javascript')
<script>
    $(document).ready( function () {
        $('#search_button').click(function() {
            $('#cmd').attr({value: "search"});
            $('#product_form').submit();
        });
        $('#csv_button').click(function() {
            $('#cmd').attr({value: "csv_download"});
            $('#product_form').submit();
        });
        $(".delete_product").click(function() {
            var my = $(this).closest('tr');
            var retVal = confirm("Bạn có muốn xoá sản phẩm này không?");
            var post = {
                product_id: $(".product_id", my).val()
            };
            if( retVal == true ){
                $.ajax({
                    url: 'delete',
                    type: 'post',
                    dataType: 'json',
                    data: post,
                    success: function(result) {
                        if(result['error']) {
                            alert('Có lỗi xảy ra. Sản phẩm của bạn chưa xoá được.');
                        } else {
                            my.remove();
                            alert('Bạn đã xoá sản phẩm thành công.');
                        }
                    }
                });
            } else {
            }
        });
    });
</script>
@endsection
@section('content')
<p id="pankuzu"><a href="{!!Asset('admin/top')!!}">TOP</a> &gt; <a href="{!!Asset('admin/product/index')!!}">Quản lí sản phẩm</a> &gt; Tìm kiếm sản phẩm</p>
<h2 id="page_midashi_02">Tìm kiếm sản phẩm</h2>
<!-- InstanceBeginEditable name="content_area" -->
<div id="bg_blue">
    <p class="mb15 floatL">
        ※ Khi bạn nhập vào các mục dưới đây bạn có thể lọc theo các điều kiện tìm kiếm<br />
    </p>
    {!! Form::open(['method' => 'POST','files' => true, 'id' => 'product_form']) !!}
    <p id="csv_button">Lưu file CSV</p>
    <div class="clear"></div>
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <tr class="menu">
            <th>Tên sản phẩm</th>
            <td colspan="3">
                {!! Form::text('product_name', isset($form['product_name'])? $form['product_name']:'',['style' => 'width:450px', 'class' => 'text']) !!}
                @if ($errors->has('product_name'))<p class="error_comment">{!! $errors->first('product_name') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Mã sản phẩm</th>
            <td colspan="3">
                {!! Form::text('product_code', isset($form['product_code'])? $form['product_code']:'',['style' => 'width:450px', 'class' => 'text']) !!}
                @if ($errors->has('product_code'))<p class="error_comment">{!! $errors->first('product_code') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Loại sản phẩm</th>
            <td>
                {!! Form::select('product_category', 
                $category,
                isset($form['product_category'])? $form['product_category']:''
                ) !!}
                @if ($errors->has('product_category'))<p class="error_comment">{!! $errors->first('product_category') !!}</p>@endif
            </td>
            <th>Trạng thái</th>
            <td>
                {!! Form::select('product_status', 
                $arrProductStatus,
                isset($form['product_status'])? $form['product_status']:''
                ) !!}
                @if ($errors->has('product_status'))<p class="error_comment">{!! $errors->first('product_status') !!}</p>@endif
            </td>
        </tr>
        <tr class="menu">
            <th>Số sản phẩm hiển thị</th>
            <td colspan="3">
                {!! Form::select('limit', InitialDefine::$arrLimit, isset($form['limit'])? $form['limit']:'') !!}
                @if ($errors->has('limit'))<p style="color: red">{!! $errors->first('limit') !!}</p>@endif
            </td>
        </tr>
    </table>
    <div class="mt15">
        <input id="cmd" type="hidden" name="cmd" value=""/>
        <p id="search_button">Tìm kiếm</p>
        <div class="clear"></div>
    </div>
    {!!Form::close()!!}
</div>

<div id="bg_blue" class="mt15">
    <table cellspacing="0" class="table_blue" cellpadding="15">
        <thead>
            <tr class="table_list">
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Loại sản phẩm</th>
                <th>Giá tiền</th>
                <th>Trạng thái</th>
                <th>Số lượng</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($arrProductList))
            @foreach ($arrProductList as $key => $product)
            <tr class="table_list {!!$key % 2 == 0 ? 'bg_yellow' : ''!!}">
                <td><a href="{!!Asset('admin/product/detail/'. $product['id'])!!}">{!!$product['product_code']!!}</a></td>
                <td class="bold"><p class="alignC"><a href="{!!Asset('admin/product/detail/'. $product['id'])!!}">{!!$product['product_name']!!}</a></p></td>
                <td>{!!(isset($category[$product['product_category']])) ? $category[$product['product_category']] : ''!!}</td>
                <td>{!!$product['product_price']!!} đ</td>
                @if ($product['product_status'] == 3)
                <td class="color_red bold">{!!$arrProductStatus[$product['product_status']]!!}</td>
                @else
                <td>{!!$arrProductStatus[$product['product_status']]!!}</td>
                @endif
                <td class="{!!$product['product_quantity'] ? '' : 'color_red bold'!!}">{!!$product['product_quantity']!!}</td>
                <td> <p class="delete_product" style="cursor: pointer;" title="Xóa sản phẩm này"><img src="{!!Asset('public/images/icon16.png')!!}"></p> </img></td>
                <input type="hidden" class='product_id'  value="{!! $product['id']!!}">
            </tr>
            @endforeach
            @else 
            <tr>
                <td colspan="7" class="alignC">Không có sản phẩm nào thoả mãn</td>
            </tr>
            @endif
    </table>

    <div id="tab_area">
        <div id="page_tab">
            <?php if ($lastPage > 1){
                if($lastPage <= 5) {
                   $begin = 1; 
                   $end = $lastPage;
                } else {
                    if($currentPage < 5 ){
                       $begin = 1;
                       $end = 5;
                    } elseif ($currentPage > $lastPage-5) {
                       $begin = $lastPage - 4; 
                       $end = $lastPage;
                    } else {
                       $begin = $currentPage-2; 
                       $end = $currentPage +2;
                    }
                } ?>
              @include('Admin.product.list_page')
          <?php } ?>
        </div>
        @if ($lastPage > 1)
        <p class="alignC mt10">（{!! $maxRec * ($currentPage -1)  !!}～{!! $maxRec * $currentPage  !!}）</p>
        @endif
    </div>
</div>
<!-- InstanceEndEditable -->
@endsection