<?php use App\Http\Controllers\Frontend\CartController as CartController; ?>
@extends('Frontend.layout')
@section('content')
<!-- InstanceBeginEditable name="Content" -->
<div class="title title1">
    <div class="wrap">
        <div class="f_left"><span class="title_red"></span><a href="#">Giỏ hàng</a></div>
    </div>
    <div class="clear"></div>
</div>
@if(count($products)> 0)
<div class="wrap cart_page">
    <table>
        <thead>
            <tr>
                <th>Mã Sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Hình ảnh sản phẩm</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $key => $product)
            <tr>
                <td>{!! $product->product_code !!}</td>
                <td>{!! $product->product_name !!}</td>
                <td>
                    <input type='text' class='product_quantity' name='quantity[{!!$product->id!!}]' size='5' value="{!! $cart[$product->id] !!}"/>
                </td>
                <td>
                    <img src="public/images/upload/products/{!! $product->product_image !!}">
                </td>
                <td class="product_price">{!! $product->product_price!!}</td>
                <td class="line_price">{!! $product->product_price * $cart[$product->id] !!}</td>
                <td><button class="button delete_product"></button></td>
                <input type="hidden" class='product_id'  value="{!! $product->id!!}">
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="cart_c2">
        <p class="f_left total_price">Tổng tiền : {!!CartController::getTotalPriceCart()!!}đ</p>
        
        <a href="{!!Asset('checkout/billing')!!}" class="f_right"><button>Mua hàng</button></a>
    </div>
</div>
@else
    <div class="wrap">
        Bạn không có sản phẩm nào trong giỏ hàng
    </div>
@endif
<!--end cart page-->
<div class="clear"></div>

<div class="slide">
    <div class="title5">
        <h2 class="wrap">Sản phẩm khác</h2>
    </div>
    <div class="wrap">
        <ul class="owl-demo owl-carousel">
            <li>
                <a href="#"><img src="public/images/upload/products/img9.jpg"></a>
                <p><a href="#">Bỉm Pamper dành cho trẻ em</a></p>
            </li>
            <li>
                <a href="#"><img src="public/images/upload/products/img9.jpg"></a>
                <p><a href="#">Bỉm Pamper dành cho trẻ em</a></p>
            </li>
            <li>
                <a href="#"><img src="public/images/upload/products/img9.jpg"></a>
                <p><a href="#">Bỉm Pamper dành cho trẻ em</a></p>
            </li>
            <li>
                <a href="#"><img src="public/images/upload/products/img9.jpg"></a>
                <p><a href="#">Bỉm Pamper dành cho trẻ em</a></p>
            </li>
            <li>
                <a href="#"><img src="public/images/upload/products/img9.jpg"></a>
                <p><a href="#">Bỉm Pamper dành cho trẻ em</a></p>
            </li>
            <li>
                <a href="#"><img src="public/images/upload/products/img9.jpg"></a>
                <p><a href="#">Bỉm Pamper dành cho trẻ em</a></p>
            </li>
        </ul>
    </div>
</div> 
<!--end slide-->
<!-- InstanceEndEditable -->
@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function(){
        $(".product_quantity").change(function() {
            var my = $(this).closest('tr');
            var post = {
                    quantity : $(this).val(),
                    product_id : $(".product_id", my).val()
                };
            $.ajax({
                url : 'updateCart',
                type : 'post',
                dataType: 'json',
                data : post,
                success : function (result){
                    $('.line_price', my).html(result['linePrice']);
                    $('.total_price').html('Tổng tiền : '+result['totalPrice']+'đ' );
                    if (result['totalCart']) {
                        $(".button_cart").html("Giỏ hàng "+result['totalCart']);
                    } else {
                        $(".button_cart").html("Giỏ hàng");
                    }
                }
            });
        });
        
        $(".delete_product").click(function() {
            var my = $(this).closest('tr');
            var post = {
                    quantity : $(".product_quantity", my).val(),
                    product_id : $(".product_id", my).val()
                };
            
            $.ajax({
                url : 'deleteCart',
                type : 'post',
                dataType: 'json',
                data : post,
                success : function (result){
                    $('.total_price').html('Tổng tiền : '+result['totalPrice']+'đ' );
                    my.hide();
                    if (result['totalCart']) {
                        $(".button_cart").html("Giỏ hàng "+result['totalCart']);
                    } else {
                        $(".button_cart").html("Giỏ hàng");
                    }
                }
            });
        });
    });
    
</script>
@endsection