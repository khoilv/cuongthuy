@extends('Frontend.layout')
@section('content')
<div class="top_content1">
    <div class="title title1">
        <div class="wrap">
            <div class="f_left"><span class="title_red"></span><a href="#">Sản phẩm mới</a></div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
    <ul class="wrap top_product">
        <?php foreach ($arrProductNew as $product) { ?>
            <li>
                <div>
                    <a href="#"><img src="public/images/upload/products/<?php echo $product['product_image'] ?>"></a>
                    <div>
                        <p>Giao sản phẩm miễ phí tại Hà Nội</p>
                        <a href="#">Mua</a>
                        <button></button>
                    </div>
                </div>
                <p><a href="#"><?php echo $product['product_name']; ?></a></p>
                <span class="price"><?php echo $product['product_price'] . 'VND'; ?></span> <span class="sale"><?php echo $product['product_discount_price']; ?></span>
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
                    <div class="f_left"><span class="title_orange"></span><a href="#"><?php echo $val['category_name'];?></a></div>
                    <div class="f_right">
                        <ul class="owl-demo owl-carousel">
                            <?php foreach ($arrChirdList[$key] as $k => $v ){?>
                            <li><a href="#"><?php echo $v['category_name'];?></a></li>
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
                        <a href="#"><img src="public/images/upload/products/<?php echo $product['product_image']?>"></a>
                        <div>
                            <p>Giao sản phẩm miễ phí tại Hà Nội</p>
                            <a href="#">Mua</a>
                            <button></button>
                        </div>
                    </div>
                    <p><a href="#"><?php echo $product['product_name'];?></a></p>
                    <span class="price"><?php echo $product['product_price'].'VND';?></span> <span class="sale"><?php echo $product['product_discount_price'];?></span>
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
            <img src="public/images/banner-b.png">
        </div>
        <div class="clear"></div>
    </div>
</div><!-- end content bottom-->
@endsection
