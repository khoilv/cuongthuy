<?php 
use App\Http\Controllers\Frontend\BannerController; 
?>
@extends('Frontend.layout')
@section('banner')
{!! BannerController::getBanner(); !!}
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
                    <a href="{!!action('Frontend\DetailController@getIndex')!!}">
                        <img src="{!!Asset('public/images/upload/products/'.$product['product_image'])!!}"></a>
                        <div>
                            <p>Giao sản phẩm miễn phí tại Hà Nội</p>
                            <a href="{!!action('Frontend\CartController@addCart', array('product_id' => $product['id']))!!}" title="Mua sản phẩm này">Mua</a>
                            <button class="add_to_cart" title="Thêm vào giỏ"></button>
                            <span><a href="#" class="todetail"></a></span>
                        </div>
                    
                </div>
                <p><a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $product['id']))!!}"><?php echo $product['product_name']; ?></a></p>
                <span class="price"><?php echo number_format ($product['product_price'],0,",",".") . 'VNĐ'; ?></span> 
                <?php if ($product['product_discount_price']) { ?>
                <span class="sale"><?php echo number_format ($product['product_discount_price'],0,",",".") . 'VNĐ'; ?></span>
                <?php } ?>
                <input type="hidden" class='product_id'  value="{!! $product['id']!!}">
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
                            <a href="{!!action('Frontend\CartController@addCart', array('product_id' => $product['id']))!!}" title="Mua sản phẩm này">Mua</a>
                            <button class="add_to_cart" title="Thêm vào giỏ"></button>
                            <span><a href="#" class="todetail"></a></span>
                        </div>
                    </div>
                    <p><a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $product['id']))!!}"><?php echo $product['product_name'];?></a></p>
                    <span class="price"><?php echo number_format ($product['product_price'],0,",",".").'VNĐ';?></span> 
                    <?php if ($product['product_discount_price']) { ?>
                    <span class="sale"><?php echo number_format ($product['product_discount_price'],0,",",".").'VNĐ';?></span>
                    <?php } ?>
                    <input type="hidden" class='product_id'  value="{!! $product['id']!!}">
                </li>
                <?php } ?>
            </ul>
        </div><!-- end content 2-->
        <div class="clear"></div>
    <?php }?>
<?php } ?>
@endsection