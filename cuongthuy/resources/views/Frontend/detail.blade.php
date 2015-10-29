@extends('Frontend.layout')
@section('content')
<?php use App\Http\Controllers\Frontend\FrameRelativeProductsController; ?>
<!-- InstanceBeginEditable name="Content" -->
<div class="title title1">
    <div class="wrap">
        <div class="f_left"><span class="title_red"></span>
            @foreach ($categories as $key => $category)
            <a href="{!!action('Frontend\ProductController@getIndex', array('category_id' => $category->id))!!}">
                <span>{!!$category->category_name!!}
                    @if ($key != count($categories)-1) > @endif
                </span>
            </a>
            @endforeach
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="detail_page wrap">
    <div class="detail_c1">
        <div class="box2 f_left">
            <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 492px; height: 400px; overflow: hidden; visibility: hidden;">
                <!--Loading Screen--> 
                <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                    <div style="; opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                    <div style="position:absolute;display:block;top:0px;left:0px;width:100%;height:100%;"></div>
                </div>
                <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 492px; height: 300px; overflow: hidden;">
                    <?php $arrImg = explode(",", $product->product_other_image); ?>
                    @foreach($arrImg as $img)
                    <div data-p="144.50" style="display: none;">
                        <img u="image" src="{!!Asset('public/images/upload/products/'.$img)!!}" />
                        <img u="thumb" src="{!!Asset('public/images/upload/products/thumb_'.$img)!!}" />
                    </div>
                    @endforeach
                </div>
                <!--Thumbnail Navigator--> 
                <div data-u="thumbnavigator" class="jssort01" style="position:absolute;left:0px;bottom:0px;width:490px;height:100px;" data-autocenter="1">
                    <!--Thumbnail Item Skin Begin--> 
                    <div data-u="slides" style="cursor: default;">
                        <div data-u="prototype" class="p">
                            <div class="w">
                                <div data-u="thumbnailtemplate" class="t"></div>
                            </div>
                            <div class="c"></div>
                        </div>
                    </div>
                    <!--Thumbnail Item Skin End--> 
                </div>
                <!--Arrow Navigator--> 
                <span data-u="arrowleft" class="jssora05l" style="top:158px;left:8px;width:40px;height:40px;"></span>
                <span data-u="arrowright" class="jssora05r" style="top:158px;right:8px;width:40px;height:40px;"></span>
                <a href="http://www.jssor.com" style="display:none">Jssor Slider</a>
            </div>
            <!-- #endregion Jssor Slider End -->
        </div>
        <div class="box2 f_right">
            <h2>{!!$product->product_name!!}</h2>
            <p>{!!$product->product_short_description!!}</p>
            <div class="assess">
                <p class="f_left">Đánh giá : </p>
                <div class="rating"></div>
                <div class="rating_value"></div>
                <div class="clear"></div> 
            </div>
            <span>Ngày đăng : {!!date("d-m-Y", strtotime($product->product_date_added))!!}</span>
            <p style="margin-top:20px;">Giá bán :<span class="price2">{!!$product->product_price!!} VNĐ</span></p>
            @if ($product->product_discount_price)
            <p>Giá cũ :<span class="price_old">{!!$product->product_discount_price!!} VNĐ</span></p>
            @endif
            <a href="{!!action('Frontend\CartController@addCart', array('product_id' => $product->id))!!}" ><button></button></a> 
            <div class="clear"></div>                  
        </div> 
        <div class="clear"></div>                
    </div><!-- end detail content 1-->
    <div class="clear"></div>
    <div class="detail_c2">
        <h3>Mô tả chi tiết</h3>
        {!!$product->product_description!!}
    </div><!-- edn detail content 2-->
</div><!-- end content-->
{!!FrameRelativeProductsController::getProducts($product->product_category)!!}
<div class="clear"></div>
<script type="text/javascript" src="{!!Asset('public/js/jquery.flexisel.js')!!}"></script>
<script type="text/javascript" src="{!!Asset('public/js/jssor.slider.mini.js')!!}"></script>
<script type="text/javascript" src="{!!Asset('public/js/jssor.slider.js')!!}"></script>
<script type="text/javascript" src="{!!Asset('public/js/jRate.js')!!}"></script>
<script type="text/javascript">
$(window).load(function () {
    $("#flexiselDemo3").flexisel({
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
    
    $(".rating").jRate({
        max: 5,
        precision: 1,
        rating: <?php echo $average ?>,
        onSet: function(rating) {
        if (rating !== 0) {
            $('.rating_value').text("Cảm ơn bạn đã đánh giá");
                var post = {
                rating : rating,
                    product_id : <?php echo $product->id ?>
                };
                $.ajax({
                url : 'updateRating',
                    type : 'post',
                    dataType: 'json',
                    data : post
                });
            }
        }
        });
    });
</script>  
<!-- InstanceEndEditable -->
@endsection