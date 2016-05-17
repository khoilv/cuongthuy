<footer>
    <div class="wrap">
        <div class="f_left">
            <div class="f_c1">
				<img src="{!!Asset('public/images/logo-2.png')!!}" alt="myphamtienthoi.vn">
				<div>
					<h2>BẢN QUYỀN THUỘC myphamtienthoi.vn</h2>
					<p>Địa chỉ : Số 31 Vương Thừa Vũ - Thanh Xuân - Hà Nội<br>Tell : 096 677 1102 - (04)3 999 2325  <br>Mail : myphamcuongthuy@gmail.com </p>
				</div>
			</div>
			<div class="f_c2">
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
        </div>
        <p class="f_right"><div class="fb-page" data-href="https://www.facebook.com/cuahangcuongthuy" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/cuahangcuongthuy"><a href="https://www.facebook.com/cuahangcuongthuy">Mỹ Phẩm Cường Thủy</a></blockquote></div></div></p>
        <div class="clear"></div>
    </div>
</footer>
@section('javascript')
<script type="text/javascript">
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>
@yield('javascript')