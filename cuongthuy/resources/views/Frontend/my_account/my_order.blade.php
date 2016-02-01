<?php

use App\Http\Controllers\Frontend\BaseController;

BaseController::$title = 'Liên hệ';
?>
@extends('Frontend.layout')
@section('content')
<!-- InstanceBeginEditable name="Content" -->
<div class="title title1">
    <div class="wrap">
        <div class="f_left"><span class="title_red"></span><a href="{!!action('Frontend\MyOrderController@getIndex')!!}">Đơn hàng của tôi</a></div>
    </div>
    <div class="clear"></div>
</div>
<div class="wrap cart_page" id="myorder">
    <table>
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Ngày đặt hàng</th>
                <th>Trạng thái đơn hàng</th>
                <th>Tổng tiền</th>
                <th>Xem chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($arrOrderList))
                @foreach($arrOrderList as $order)
                    <tr>
                        <td><a href="{!!action('Frontend\MyOrderDetailController@getIndex', array('order_id' => $order['id']))!!}">{!!$order['order_code']!!}</a></td>
                        <td>{!!$order['order_date'][1]!!} <br>Ngày : {!!$order['order_date'][0]!!}</td>
                        <td>{!!$order['order_status']!!}</td>
                        <td><span style="color:#38b54a;font-weight:bold;">{!!$order['totalPrice']!!} vnđ</span></td>
                        <td><a href="{!!action('Frontend\MyOrderDetailController@getIndex', array('order_id' => $order['id']))!!}"><button></button></a></td>
                    </tr>
               @endforeach
            @endif
        </tbody>
    </table>
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
              @include('Frontend.my_account.list_page')
          <?php } ?>
        </ul>
    </div>
    <div class="clear"></div>
    <div class="cart_c2">
        <a href="{!!action('Frontend\TopController@getIndex')!!}" class="f_right"><button>Mua hàng</button></a>
    </div>
</div><!-- end cart page-->
<div class="clear"></div>
@endsection