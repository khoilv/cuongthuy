<div class="slide">
    <div class="title5">
        <h2 class="wrap">Sản phẩm khác</h2>
    </div>
    <div class="wrap">
        <div class="slide-chantrang">
            <ul id="sliderOtherProducts">
                @foreach ($relativeProducts as $product)
                <li>
                    <a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $product['id']))!!}"><img src="{!!Asset('public/images/upload/products/'.$product['product_image'])!!}" title="{!!$product['product_name']!!}"/><p>{!!$product['product_name']!!}</p></a>
                </li>
                @endforeach
            </ul> 
        </div>
    </div>
</div><!-- end slide-->

