<?php error_reporting(E_ALL & ~(E_NOTICE));
use App\Http\Controllers\Frontend\MenuController as MenuController;
use App\Http\Controllers\Frontend\CartController as CartController;
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="keywords" content="Mỹ phẩm - tạp hóa Cường Thủy" />
        <meta name="description" content="Mỹ phẩm - tạp hóa Cường Thủy" />
        <meta name="viewport" content="width=device-width, maximum-scale=1" />
        <meta name="_token" content="{!! csrf_token() !!}"/>
        <title>Home page</title>
        @section('stylesheets')
        <link href="{!!Asset('public/css/common.css')!!}" rel="stylesheet" type="text/css">
        <link href="{!!Asset('public/css/style.css')!!}" rel="stylesheet" type="text/css">
        <link rel="icon" type="image/png" href="{!!Asset('public/images/icon_logo.png')!!}">
        <!-- slider -->
        <link href="{!!Asset('public/css/nivo-slider.css')!!}" rel="stylesheet" type="text/css">
        <!-- navigation mobile-->
        <link type="text/css" rel="stylesheet" href="{!!Asset('public/css/jquery.mmenu.all.css')!!}" />
        @yield('stylesheets')
        @section('javascript')
        <script type="text/javascript" src="{!!Asset('public/js/jquery-1.9.0.min.js')!!}"></script>
        <script type="text/javascript" src="{!!Asset('public/js/jquery.nivo.slider.js')!!}"></script>
        <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
        </script>
        <script type="text/javascript" src="{!!Asset('public/js/jquery.mmenu.min.all.js')!!}"></script>
        <script type="text/javascript">
            $(function() {
                $('nav#menu').mmenu({
                    extensions	: [ 'effect-slide-menu', 'pageshadow' ],
                    searchfield	: true,
                    counters	: true,
                    navbar 		: {
                        title		: 'Menu'
                    },
                    navbars		: [
                        {
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
        </script>
        <!-- go to top -->
        <script>
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
            });
        </script>
        <!-- Navigation scroll-->
        <script type="text/javascript">
            $("document").ready(function($){
                    // Create a clone of the nav_top, right next to original.
            $('.nav_top').addClass('original').clone().insertAfter('.nav_top').addClass('cloned').css('position','fixed').css('top','0').css('margin-top','0').css('z-index','500').removeClass('original').hide();
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
                        $('.cloned').css('left',leftOrgElement+'px').css('top',0).css('width',widthOrgElement).show();
                        $('.original').css('visibility','hidden');
                  } else {
                        // not scrolled past the nav_top; only show the original nav_top.
                        $('.cloned').hide();
                        $('.original').css('visibility','visible');
                  }
                }
            });
        </script>
        <!-- InstanceBeginEditable name="doctitle" -->
        <title>home</title>
        <!-- InstanceEndEditable -->
        
        <!-- InstanceBeginEditable name="head" -->
        <!-- porduction -->
        <script src="{!!Asset('public/js/owl.carousel.js')!!}"></script>
		<script>
			$(document).ready(function() {

			  var owl = $(".owl-demo"),
				  status = $(".owlStatus");

			  owl.owlCarousel({
				navigation : true,
				afterAction : afterAction
			  });

			  function updateResult(pos,value){
				status.find(pos).find(".result").text(value);
			  }

			  function afterAction(){
				updateResult(".owlItems", this.owl.owlItems.length);
				updateResult(".currentItem", this.owl.currentItem);
				updateResult(".prevItem", this.prevItem);
				updateResult(".visibleItems", this.owl.visibleItems);
				updateResult(".dragDirection", this.owl.dragDirection);
			  }

			});
		</script>
        <!-- InstanceEndEditable -->
        @yield('javascript')
    </head>
    <body>
        <header>
            <div class="content_top">
                <div class="wrap">
                    <ul class="f_right">
                        <li><a href="#login">Đăng nhập</a></li>
                        <li><a href="#register">Đăng ký</a></li>
                        <li><a href="{!!Asset(cart)!!}" class='button_cart'>Giỏ hàng {!! CartController::getCart() !!}</a></li>
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
                            <select class="f_left" name="type">
                                <option select="selected" name="msp">Mã sản phẩm</option>
                                <option>Tên sản phẩm</option>
                                <option>Loại sản phẩm</option>
                            </select>
                            <input type="text" placeholder="Nhập từ khóa">
                            <button onclick="document.form1.submit()"></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clear"></div>
            <!-- navigation mobile-->      
            <div id="menu_m">
                <div class="header">
                    <a href="#menu"></a>
                </div>
                
                <nav id="menu">
                    <ul>
                        <li><a href="#">Sản phẩm mới</a></li>
                        <li><a href="#">Mỹ phẩm</a>
                        	<ul>
                            	<li><a href="#">Mascara</a></li>
                                <li><a href="#">Phấn hồng</a></li>
                                <li><a href="#">Phấn phủ - BB cream</a></li>
                                <li><a href="#">Kem dưỡng da</a></li>
                                <li><a href="#">Son môi</a></li>
                                <li><a href="#">Chăm sóc tóc</a>
                                	<ul>
                                    	<li><a href="#">Dầu gội</a></li>
                                        <li><a href="#">Hấp ủ tinh chất dưỡng</a></li>
                                        <li><a href="#">Dầu xả</a></li>
                                        <li><a href="#">Gôm - Gel uốn tóc</a></li>
                                        <li><a href="#">Nhuộn tóc</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#">Chăm sóc sức khỏe</a></li>
                        <li><a href="#">Hàng tiêu dùng</a>
                        	<ul>
                            	<li><a href="#">Bột giặt</a></li>
                                <li><a href="#">Bỉm</a>
                                	<ul class="ul3">
                                    	<li><a href="#">Bỉm người lớn</a></li>
                                        <li><a href="#">Bỉm trẻ em</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Đồ gia dụng</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Phụ kiện - Thời trang</a>
                        	<ul>
                            	<li><a href="#">Túi xách</a></li>
                                <li><a href="#">Mũ thời trang</a></li>
                                <li><a href="#">Bikini</a></li>
                                <li><a href="#">Phụ kiện</a></li>
                            </ul>
                        </li>
                        <li><a href="#login">Đăng nhập</a></li>
                        <li><a href="#register">Đăng ký</a></li>
                        <li><a href="#">Giỏ hàng (6)</a></li>
                    </ul>
                </nav>
                <div class="clear"></div> 
            </div>
        </header>
        <div class="clear"></div>
        <!-- banner -->
        @yield('banner')
        <div class="clear"></div>
        <!-- menu -->
       {!! MenuController::getMenu(); !!}
        <div class="clear"></div>
        <!-- connent -->
        @yield('content')
        <div class="clear"></div>
        <!-- footer -->
        @include('Frontend.footer')
        <div class="gototop"></div>
    </body>
</html>