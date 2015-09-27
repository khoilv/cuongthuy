<?php use App\Http\Controllers\Frontend\BannerController as BannerController; ?>
@extends('Frontend.layout')
@section('banner')
<?php echo BannerController::getBanner();?>
@endsection
@section('content')
<div class="top_content1">
    <div class="title title1">
        <div class="wrap">
            <div class="f_left"><span class="title_red"></span><a href="{!!action('Frontend\ProductController@getIndex')!!}">Sản phẩm mới</a></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <ul class="wrap top_product">
        <?php foreach ($arrProductNew as $product) { ?>
            <li>
                <div>
                    <a href="#"><img src="{!!Asset('public/images/upload/products/'.$product['product_image'])!!}"></a>
                    <div>
                        <p>Giao sản phẩm miễn phí tại Hà Nội</p>
                        <a href="#">Mua</a>
                        <button></button>
                    </div>
                </div>
                <p><a href="#"><?php echo $product['product_name']; ?></a></p>
                <span class="price"><?php echo $product['product_price'] . 'VND'; ?></span> 
                <?php if ($product['product_discount_price']) { ?>
                <span class="sale"><?php echo $product['product_discount_price']; ?></span>
                <?php } ?>
                <input type="hidden" class='product_id'  value="{!! $product['product_id']!!}">
            </li>
        <?php } ?>
    </ul>
</div><!-- end content 1-->
<div class="clear"></div>
<?php foreach ($arrParentList as $key => $val){?>
    <?php if(isset($arrChirdList[$key])) {?>
        <div class="top_content2 ">
            <div class="title title2">
                <div class="wrap">
                    <div class="f_left"><span class="title_orange"></span><a href="{!!action('Frontend\ProductController@getIndex', array('category_id' => $val['id']))!!}"><?php echo $val['category_name'];?></a></div>
                    <div class="f_right">
                        <ul class="owl-demo owl-carousel">
                            <?php foreach ($arrChirdList[$key] as $k => $v ){?>
                            <li><a href="{!!action('Frontend\ProductController@getIndex', array('category_id' => $v['id']))!!}"><?php echo $v['category_name'];?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="clear"></div>
            <ul class="wrap top_product">
                <?php foreach ($arrProductList[$key] as $product){?>
                <li>
                    <div>
                        <a href="#"><img src="{!!Asset('public/images/upload/products/'.$product['product_image'])!!}"></a>
                        <div>
                            <p>Giao sản phẩm miễn phí tại Hà Nội</p>
                            <a href="#">Mua</a>
                            <button></button>
                        </div>
                    </div>
                    <p><a href="#"><?php echo $product['product_name'];?></a></p>
                    <span class="price"><?php echo $product['product_price'].'VND';?></span> 
                    <?php if ($product['product_discount_price']) { ?>
                    <span class="sale"><?php echo $product['product_discount_price'];?></span>
                    <?php } ?>
                    <input type="hidden" class='product_id'  value="{!! $product['product_id']!!}">
                </li>
                <?php } ?>
            </ul>
        </div><!-- end content 2-->
        <div class="clear"></div>
    <?php }?>
<?php } ?>
<div class="content_bottom">
    <div class="wrap">
        <div class="f_left">
            <ul>
                <li>
                    <h3>Giới thiệu</h3>
                    <ul>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </li>
                <li>
                    <h3>Khách hàng</h3>
                    <ul>
                        <li><a href="#">Hướng dẫn mua hàng</a></li>
                        <li><a href="#">Quy đổi trả sản phẩm</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="f_right">
            <img src="{!!Asset('public/images/banner-b.png')!!}">
        </div>
        <div class="clear"></div>
    </div>
</div><!-- end content bottom-->
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $("button").click(function () {
            var my = $(this).parent().parent().parent();
            $.ajax({
                url : 'addCart',
                type : 'post',
                dataType: 'json',
                data : { product_id : $(".product_id", my).val() },
                success : function (result){
                    $(".button_cart").html("Giỏ hàng ("+result+")")
                }
            });
        });
    });
</script>
@endsection