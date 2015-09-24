@extends('Frontend.layout')
@section('content')
<div class="title title1">
    <div class="wrap">
        <?php if ($categoryName){?>
            <div class="f_left"><span class="title_red"></span><a><?php echo $categoryName;?></a></div>
        <?php } ?>
        <?php
            $arrParam = array();
            if ($categoryId !== '') {
                $arrParam['category_id'] = $categoryId;
            }
        ?>
        <div class="f_right" style="margin-top:10px;">
            <ul class="list_button">
                <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('order_type' => 'newer'))!!}"><button>Mới nhất</button></a></li>
                <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('order_type' => 'sell'))!!}"><button>Bán chạy</button></a></li>
                <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('order_type' => 'hot'))!!}"><button>Nổi bật</button></a></li>
            </ul>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="wrap list_page">
    <ul class="top_product">
        <?php if(!empty($arrProductList)) { ?>
            <?php foreach ($arrProductList as $product){?>
                <li>
                    <div>
                        <a href="#"><img src="{!!Asset('public/images/upload/products/'.$product['product_image'])!!}"></a>
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
        <?php } else { ?>
            <p>Không có sản phẩm nào</p>
       <?php } ?>
       
    </ul>
    <div class="clear"></div>
    <div class="paging f_right">
        <ul>
            <?php if ($lastPage > 1){ ?>
                <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('page' => 1))!!}"><<</a></li>
                <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('page' => $previousPage))!!}"><</a></li>
                <?php for($page = 1; $page <= $lastPage; $page++) {?>
                    <?php if ($page == $currentPage) { ?>
                        <li><?php echo $page; ?></li>
                    <?php } else { ?>
                        <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('page' => $page))!!}"><?php echo $page; ?></a></li>
                    <?php } ?>
                <?php } ?>
                <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('page' => $nextPage))!!}">></a></li>
                <li><a href="{!!action('Frontend\ProductController@getIndex', $arrParam + array('page' => $lastPage))!!}">>></a></li>
            <?php } ?>
        </ul>
    </div><!-- end paging-->
</div><!-- end content-->
@endsection