<?php
error_reporting(E_ALL & ~(E_NOTICE));

use App\Http\Controllers\Frontend\MenuController as MenuController;
use App\Http\Controllers\Frontend\CartController as CartController;
use App\Http\Controllers\Frontend\BaseController;
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="Mỹ phẩm - tạp hóa Cường Thủy" />
        <meta name="description" content="Mỹ phẩm - tạp hóa Cường Thủy" />
        <meta name="viewport" content="width=device-width, maximum-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Cường Thủy - {!!BaseController::$title!!}</title>
        @section('stylesheets')
        <link rel="icon" type="image/png" href="{!!Asset('public/images/icon_logo.png')!!}">
        <link href="{!!Asset('public/css/common.css')!!}" rel="stylesheet" type="text/css">
        <link href="{!!Asset('public/css/style.css')!!}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{!!Asset('public/css/slide.css')!!}">
        <!-- slider -->
        <link href="{!!Asset('public/css/nivo-slider.css')!!}" rel="stylesheet" type="text/css">
        <!-- navigation mobile-->
        <link type="text/css" rel="stylesheet" href="{!!Asset('public/css/jquery.mmenu.all.css')!!}" />
        <link rel="canonical" href="http://cuongthuy.vn" />
        @yield('stylesheets')
        @section('javascript')
        <script type="text/javascript" src="{!!Asset('public/js/jquery-1.9.0.min.js')!!}"></script>
        <script type="text/javascript" src="{!!Asset('public/js/jquery.nivo.slider.js')!!}"></script>
        <script type="text/javascript" src="{!!Asset('public/js/jquery.mmenu.min.all.js')!!}"></script>
        <script src="{!!Asset('public/js/owl.carousel.js')!!}"></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
            $(function() {
                $('nav#menu').mmenu({
                extensions	: [ 'effect-slide-menu', 'pageshadow' ],
                searchfield	: true,
                counters	: true,
                navbar 		: {
                    title		: 'Menu'
                },
                navbars		: [{
                        position	: 'top',
                        content		: [ 'searchfield' ]
                    }, {
                        position	: 'top',
                        content		: [
                            'prev',
                            'title',
                            'close'
                        ]
                    }
                ]
                });
            });
            //  jquery go to top
            $(function() {
                var showFlag = false;
                var topBtn = $('#top_gototop');
                topBtn.css('bottom', '-100px');
                var showFlag = false;
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        if (showFlag == false) {
                        showFlag = true;
                                topBtn.stop().animate({'bottom' : '55px'}, 300);
                        }
                    } else {
                        if (showFlag) {
                        showFlag = false;
                                topBtn.stop().animate({'bottom' : '-100px'}, 300);
                        }
                    }
                });
                topBtn.click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 500);
                    return false;
                });
                
                
                var owl = $(".owl-demo"),
                status = $(".owlStatus");
                owl.owlCarousel({
                navigation : true,
                        afterAction : afterAction
                });
                function updateResult(pos, value){
                status.find(pos).find(".result").text(value);
                }

                function afterAction(){
                    updateResult(".owlItems", this.owl.owlItems.length);
                    updateResult(".currentItem", this.owl.currentItem);
                    updateResult(".prevItem", this.prevItem);
                    updateResult(".visibleItems", this.owl.visibleItems);
                    updateResult(".dragDirection", this.owl.dragDirection);
                }
                $(".add_to_cart").click(function () {
                    var my = $(this).closest("li");
                    $.ajax({
                        url : 'addCart',
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
        <!-- Navigation scroll-->
        <script type="text/javascript">
            $("document").ready(function($){
            // Create a clone of the nav_top, right next to original.
            $('.nav_top').addClass('original').clone().insertAfter('.nav_top').addClass('cloned').css('position', 'fixed').css('top', '0').css('margin-top', '0').css('z-index', '500').removeClass('original').hide();
                    scrollIntervalID = setInterval(stickIt, 10);
                    function stickIt() {
                    var orgElementPos = $('.original').offset();
                            orgElementTop = orgElementPos.top;
                            if ($(window).scrollTop() >= (orgElementTop)) {
                    // scrolled past the original position; now only show the cloned, sticky element.
                    // Cloned element should always have same left position and width as original element.     
                    orgElement = $('.original');
                            coordsOrgElement = orgElement.offset();
                            leftOrgElement = coordsOrgElement.left;
                            widthOrgElement = orgElement.css('width');
                            $('.cloned').css('left', leftOrgElement + 'px').css('top', 0).css('width', widthOrgElement).show();
                            $('.original').css('visibility', 'hidden');
                    } else {
                    // not scrolled past the nav_top; only show the original nav_top.
                    $('.cloned').hide();
                            $('.original').css('visibility', 'visible');
                    }
                    }
            });
        </script>
        <!--like facebook -->
        <script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1086178621393432";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        @yield('javascript')
    </head>
    <body>
        <header>
            <div class="content_top">
                <div class="wrap">
                    <div class="f_left" style="margin-top:7px;">
                        <div class="fb-like" data-href="http://cuongthuy.vn" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                        <div class="g-plusone" data-size="medium" ></div>
                    </div>
                    <ul class="f_right">
                        <?php if (Session::has('customer_name')) { ?>
                            <li><a><?php echo 'Xin chào ' . Session::get('customer_name'); ?></a></li>
                            <li><a style="cursor:pointer" id="logout">Thoát</a></li>
                        <?php } else { ?>
                            <li><a href="#login">Đăng nhập</a></li>
                            <li><a href="#register">Đăng ký</a></li>
                        <?php } ?>
                        <li><a href="{!!Asset(cart)!!}" class="button_cart">Giỏ hàng @if (CartController::getCart()) ({!! CartController::getCart() !!})@endif </a></li>
                        <li><a href="#">Hỗ trợ : 0988 123 123</a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <!--popup login-->
                @include('Frontend.login')
                <!-- popup register-->
                @include('Frontend.register')
            </div>
            <div class="clear"></div>
            <div class="wrap header_top">
                <a class="f_left" href="{!!action('Frontend\TopController@getIndex')!!}"><img src="{!!Asset('public/images/logo.png')!!}" alt="cuongthuy.vn"></a>
                <div class="f_right ">
                    <ul>
                        <li>Giao hàng 24h miễn phí</li>
                        <li>Thương hiệu uy tín</li>
                    </ul>
                    <form name="form1" action="list" method="GET">
                        <div class="search">
                            <select class="f_left" name="search_key">
                                <option value ="product_code" select="selected" >Mã sản phẩm</option>
                                <option value="product_name" <?php if ($search_key == 'product_name') { ?> selected="selected"<?php } ?>>Tên sản phẩm</option>
                            </select>
                            <input type="text" name="search_value" value="<?php echo $search_value; ?>" placeholder="Nhập từ khóa">
                            <button onclick="document.form1.submit()"></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        <!-- banner -->
        @yield('banner')
        <div class="clear"></div>
        <!-- menu -->
        {!! MenuController::getMenu(); !!}
        <div class="clear"></div>
        <div id="img_ajax"></div>
        <!-- connent -->
        @yield('content')
        <div class="content_bottom">
            <div class="wrap">
                <div class="f_left">
                    <ul>
                        <li>
                            <h3>Giới thiệu</h3>
                            <ul>
                                <li><a href="/about">Giới thiệu</a></li>
                                <li><a href="/contact">Liên hệ</a></li>
                            </ul>
                        </li>
                        <li>
                            <h3>Khách hàng</h3>
                            <ul>
                                <li><a href="/shopping_guide">Hướng dẫn mua hàng</a></li>
                                <li><a href="/rule_change_pay">Quy đổi trả sản phẩm</a></li>
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
        <div class="clear"></div>
        <!-- footer -->
        @include('Frontend.footer')
        <div id="top_gototop"><a href="#" class="gototop clearfix"><img src="{!!Asset('public/images/gotop.png')!!}" alt="lên đầu trang" /></a></div> 
<!--        <script lang="javascript">
        (function() {var _h1 = document.getElementsByTagName('title')[0] || false;
        var product_name = ''; if (_h1){product_name = _h1.textContent || _h1.innerText; }var ga = document.createElement('script'); ga.type = 'text/javascript';
        ga.src = '//live.vnpgroup.net/js/web_client_box.php?hash=7d5b36ce59e63870cd1f00f2488f3c22&data=eyJoYXNoIjoiNDBlMTg4MDljNjYzMWIwN2UyOTFmNTA1N2VhY2I3YjEiLCJzc29faWQiOjExMTcwMDd9&pname=' + product_name;
        var s = document.getElementsByTagName('script'); s[0].parentNode.insertBefore(ga, s[0]); })();
        </script>-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/56188e9b2f8f9ad267b0d517/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--<script src="http://uhchat.net/code.php?f=a30ece"></script>-->
        <!--<script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=96204503"></script>-->
        <!--<script src='https://livesupporti.com/Scripts/client.js?acc=dcb5276e-02c3-449b-9e74-c6f89c580637&skin=Modern'></script>-->
    </body>
</html>
