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

    <div class="wrap cart_page">
        <table>
            <thead>
            <tr>
                <th>STT</th>
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
            @if(count($products)> 0)
                @foreach($products as $key => $product)
                    <tr>
                        <td class="serial">{!! $key+1 !!}</td>
                        <td><a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $product->id))!!}">{!! $product->product_code !!}</a></td>
                        <td><a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $product->id))!!}">{!! $product->product_name !!}</a></td>
                        <td>
                            <input type='text' class='product_quantity' name='quantity[{!!$product->id!!}]' size='5' value="{!! $cart[$product->id] !!}"/>
                        </td>
                        <td>
                            <a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $product->id))!!}"><img src="public/images/upload/products/{!! $product->product_image !!}"></a>
                        </td>
                        <td class="product_price">{!! $product->product_price!!}</td>
                        <td class="line_price">{!! $product->product_price * $cart[$product->id] !!}</td>
                        <td><button class="button delete_product" title="Xóa sản phẩm này khỏi giỏ hàng"></button></td>
                        <input type="hidden" class='product_id'  value="{!! $product->id!!}">
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8"><span class="notification">Bạn không có sản phẩm nào trong giỏ hàng</span></td>
                </tr>
            </tbody>
            @endif
        </table>
        @if(count($products)> 0)
        <div class="cart_c2">
            <p class="f_left total_price">Tổng tiền : {!!CartController::getTotalPriceCart()!!}đ</p>

            <a href="{!!action('Frontend\CheckoutController@getBilling')!!}" class="f_right"><button class="buy">Mua hàng</button></a>
        </div>
        @endif
    </div>
            <!--end cart page-->
    <div class="clear"></div>
    <div class="slide">
        <div class="title5">
            <h2 class="wrap">Sản phẩm khác</h2>
        </div>
        <div class="wrap">
            <div class="slide-chantrang">
                <ul id="sliderOtherProducts">
                    <li>
                        <a href="#"><img src="public/images/img10.jpg" /><p>Cafe Việt</p></a>
                    </li>
                    <li>
                        <a href="#"><img src="public/images/img9.jpg" />
                            <p>Thực phẩm chức năng</p></a>
                    </li>
                    <li>
                        <a href="#"><img src="public/images/img10.jpg" /><p>Cafe Việt</p></a>
                    </li>
                    <li>
                        <a href="#"><img src="public/images/img11.jpg" /><p>Trà sữa</p></a>
                    </li>
                    <li>
                        <a href="#"><img src="public/images/img9.jpg" /><p>Bỉm người lớn</p></a>
                    </li>
                    <li>
                        <a href="#"><img src="public/images/img11.jpg" /><p>Phụ kiện - thời trang</p></a>
                    </li>
                </ul>
            </div>
        </div>
    </div><!-- end slide-->
    <div class="clear"></div>
    <!-- InstanceEndEditable -->
    @endsection
@section('javascript')
    <script type="text/javascript" src="public/js/jquery.flexisel.js"></script>
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
                    beforeSend: function() {
                        $('#img_ajax').addClass('loading');
                    },
                    success : function (result){
                        $('.line_price', my).html(result['linePrice']);
                        $('.total_price').html('Tổng tiền : '+result['totalPrice']+'đ' );
                        if (result['totalCart']) {
                            $(".button_cart").html("Giỏ hàng ("+result['totalCart']+")");
                        } else {
                            $(".button_cart").html("Giỏ hàng");
                        }
                        $('#img_ajax').removeClass('loading');
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
                    beforeSend: function() {
                        $('#img_ajax').addClass('loading');
                    },
                    success : function (result){
                        $('.total_price').html('Tổng tiền : '+result['totalPrice']+'đ' );
                        my.remove();
                        if (result['totalCart']) {
                            $(".button_cart").html("Giỏ hàng ("+result['totalCart']+")");
                        } else {
                            $(".button_cart").html("Giỏ hàng");
                        }
                        $.each($('.serial'),function(i){
                            $(this).text(i+1);
                        });
                        $('#img_ajax').removeClass('loading');
                    }
                });
            });

            $("#sliderOtherProducts").flexisel({
                visibleItems: 5,
                animationSpeed: 1000,
                autoPlay: true,
                autoPlaySpeed: 3000,
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                    portrait: {
                        changePoint: 480,
                        visibleItems: 1
                    },
                    landscape: {
                        changePoint: 640,
                        visibleItems: 2
                    },
                    tablet: {
                        changePoint: 768,
                        visibleItems: 3
                    }
                }
            });

            // Fix the bug of dupliate left/right arrows of the slider [Other products]
            $("div.slide-chantrang > div.nbs-flexisel-container > div.nbs-flexisel-nav-left").hide();
            $("div.slide-chantrang > div.nbs-flexisel-container > div.nbs-flexisel-nav-right").hide();
        });
    </script>
@endsection