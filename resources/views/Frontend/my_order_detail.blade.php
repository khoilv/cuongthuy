@extends('Frontend.layout')
@section('content')
<script type='text/javascript'>
    $( document ).ready(function() {
        $(".add_cart2").click(function () {
            var my = $(this).closest("tr");
            $.ajax({
                url : "{!!Asset('addCart')!!}",
                type : 'post',
                dataType: 'json',
                data : { product_id : $(".product_id", my).val() },
                beforeSend: function() {
                    $('#img_ajax').addClass('loading');
                },
                success : function (result){
                    $(".button_cart").html("Giỏ hàng ("+result+")");
                    $('#img_ajax').removeClass('loading');
                }

            });
        });
    });
    
</script>
<div class="title title1">
            <div class="wrap">
                <div class="f_left"><span class="title_red"></span><a {{--href="{!!action('Frontend\MyOrderController@getIndex')!!}"--}}><span>Đơn hàng của tôi ></span></a><a href="{!!action('Frontend\MyOrderDetailController@getIndex', array('order_id' => $id))!!}"><span> Chi tiết đơn hàng</span></a></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="wrap cart_page" id="myorder_detail">
        	<table>
            	<thead>
                	<tr>
                        <th>Hình ảnh</th>
                        <th>Tên,mã sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Thêm vào giỏ hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    @foreach ($orderDetail as $key => $value)
                    <tr>
			<td><a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $value['product_id']))!!}"><img src="{!!Asset('public/images/upload/products/'.$value['detail']['product_image'])!!}"></a></td>
                        <td><a href="{!!action('Frontend\DetailController@getIndex', array('product_id' => $value['product_id']))!!}"><b>{!!$value['detail']['product_name']!!}</b> <br>{!!$value['detail']['product_code']!!}</a></td>
                        <td>{!!number_format($value['unitPrice'],0,",",".")!!}</td>
                        <td>{!!$value['quantity']!!}</td>
                        <td><span style="color:#38b54a;font-weight:bold;">{!!number_format($value['unitPrice']*$value['quantity'],0,",",".")!!}</span></td>
                        <td><a class="add_cart2" title="Thêm vào giỏ hàng nếu bạn muốn tiếp tục mua sản phẩm này"></a></td>
                        <input type="hidden" class='product_id'  value="{!! $value['product_id']!!}">
                    </tr>
                    <?php $total += $value['unitPrice']*$value['quantity']; ?>
                    @endforeach
                </tbody>
            </table>
            <div class="clear"></div>
            <div class="cart_c2">
		<p class="f_left total_price">Tổng tiền : {!!number_format($total,0,",",".")!!} đ</p>
                <a href="{!!Asset('cart')!!}" class="f_right"><button>Mua hàng</button></a>
            </div>
        </div><!-- end cart page-->
        <div class="clear"></div>
@endsection