@extends('Frontend.layout')
@section('content')
<div class="title title1">
    <div class="wrap">
        <div class="f_left"><span class="title_red"></span>
            @foreach ($categories as $key => $category)
            <a href="{!!action('Frontend\ProductController@getIndex', array('category_id' => $category['id']))!!}">
                <span>{!!$category['category_name']!!}
                    @if ($key == 0) > @endif
                </span>
            </a>
            @endforeach
        </div>
        <?php
            $arrParam = array();
            if ($categoryId !== '') {
                $arrParam['category_id'] = $categoryId;
            }
            if($search_key) {
                $arrParam['search_key'] = $search_key;
            }
            if($search_value) {
                $arrParam['search_value'] = $search_value;
            }
        ?>
        <div class="f_right" style="margin-top:10px;">
            <ul class="list_button">
                <li><a href="{!!action('Frontend\ProductController@getIndex', array('category_id' => $categoryId ,'search_key' => 'newer'))!!}"><button>Mới nhất</button></a></li>
                <li><a href="{!!action('Frontend\ProductController@getIndex', array('category_id' => $categoryId ,'search_key' => 'sell'))!!}"><button>Bán chạy</button></a></li>
                <li><a href="{!!action('Frontend\ProductController@getIndex', array('category_id' => $categoryId ,'search_key' => 'hot'))!!}"><button>Nổi bật</button></a></li>
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
                            <a href="{!!action('Frontend\CartController@addCart', array('product_id' => $product['id']))!!}" title="Mua sản phẩm này">Mua</a>
                            <button class="add_to_cart" title="Thêm vào giỏ"></button>
                        </div>
                    </div>
                    <p><a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $product['id']))!!}"><?php echo $product['product_name'];?></a></p>
                    <span class="price"><?php echo number_format($product['product_price']).'VNĐ';?></span>
                    @if ($product['product_discount_price'])
                        <span class="sale"><?php echo number_format($product['product_discount_price']).'VNĐ';?></span>
                    @endif
                    <input type="hidden" class='product_id'  value="{!! $product['id']!!}">
                </li>
            <?php } ?>
        <?php } else { ?>
            <p>Không có sản phẩm nào</p>
       <?php } ?>
       
    </ul>
    <div class="clear"></div>
    <div class="paging f_right">
        <ul>
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
              @include('Frontend.list_page')
          <?php } ?>
        </ul>
    </div><!-- end paging-->
</div><!-- end content-->
<div class="clear"></div>
@endsection