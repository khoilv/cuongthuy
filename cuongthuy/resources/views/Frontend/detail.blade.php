@extends('Frontend.layout')
@section('content')
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
        <div class="box2 f_left" style="border:1px solid red;">
            <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 450px;
                 height: 390px; background: #f8f8f8; overflow: hidden;">
                <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 450px; height: 293px; overflow: hidden;">
                    <?php $arrImg = explode(",", $product->product_other_image); ?>
                    @foreach($arrImg as $img)
                    <div>
                        <img u="image" src="{!!Asset('public/images/upload/products/'.$img)!!}" />
                        <img u="thumb" src="{!!Asset('public/images/upload/products/thumb_'.$img)!!}" />
                    </div>
                    @endforeach
                </div>
                <span u="arrowleft" class="jssora05l" style="top: 158px; left: 8px;"></span>
                <span u="arrowright" class="jssora05r" style="top: 158px; right: 8px"></span>
                <div u="thumbnavigator" class="jssort01" style="left: 0px; bottom: 0px;">
                    <div u="slides" style="cursor: default;">
                        <div u="prototype" class="p">
                            <div class=w><div u="thumbnailtemplate" class="t"></div></div>
                            <div class=c></div>
                        </div>
                    </div>
                    <!-- Thumbnail Item Skin End -->
                </div>
            </div>
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
            <a href="#" ><button></button></a> 
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
<div class="slide">
    <div class="title5">
        <h2 class="wrap">Sản phẩm khác</h2>
    </div>
    <div class="wrap">
        <div class="slide-chantrang">
            <ul id="flexiselDemo3">
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
<script type="text/javascript" src="public/js/jquery.flexisel.js"></script>
<script type="text/javascript" src="{!!Asset('public/js/jssor.js')!!}"></script>
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
//            onChange: function(rating) {
//                if (rating > 0) {
//                    $('.rating_value').text("Đánh giá của bạn về sản phẩm này: "+rating);
//                }
//            },
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