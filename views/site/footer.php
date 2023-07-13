
	<!-- start footer Area -->
	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Về Chúng Tôi</h6>
						<p>
							Với phương châm mang đến cho khách hàng niềm vui, sự mới mẻ trong khi mua sắm chúng tôi sẽ luôn luôn đồng hành cũng như mang đến những điều mới lạ đến ngay bên bạn.
						</p>
					</div>
				</div>
				<div class="col-lg-4  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Bản Tin</h6>
						<p>Hãy nhập Email để có thể nhận những thông tin sớm nhất.</p>
						<div class="" id="mc_embed_signup">

							<form target="_blank" novalidate="true" action=""
							 method="get" class="form-inline">

								<div class="d-flex flex-row">

									<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
									 required="" type="email">


									<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
									<div style="position: absolute; left: -5000px;">
										<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
									</div>

									<!-- <div class="col-lg-4 col-md-4">
												<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
											</div>  -->
								</div>
								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget mail-chimp">
						<h6 class="mb-20">Instragram Feed</h6>
						<ul class="instafeed d-flex flex-wrap">
							<li><img src="./public/site/img/i1.jpg" alt=""></li>
							<li><img src="./public/site/img/i2.jpg" alt=""></li>
							<li><img src="./public/site/img/i3.jpg" alt=""></li>
							<li><img src="./public/site/img/i4.jpg" alt=""></li>
							<li><img src="./public/site/img/i5.jpg" alt=""></li>
							<li><img src="./public/site/img/i6.jpg" alt=""></li>
							<li><img src="./public/site/img/i7.jpg" alt=""></li>
							<li><img src="./public/site/img/i8.jpg" alt=""></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Theo dõi ngay</h6>
						<p>Những mạng xã hội quen thuộc</p>
						<div class="footer-social d-flex align-items-center">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->

	<script src="./public/site/js/vendor/jquery-2.2.4.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="./public/site/js/vendor/bootstrap.min.js"></script>
	<script src="./public/site/js/jquery.ajaxchimp.min.js"></script>
	<script src="./public/site/js/jquery.nice-select.min.js"></script>
	<script src="./public/site/js/jquery.sticky.js"></script>
	<script src="./public/site/js/nouislider.min.js"></script>
	<script src="./public/site/js/countdown.js"></script>
	<script src="./public/site/js/jquery.magnific-popup.min.js"></script>
	<script src="./public/site/js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="./public/site/js/gmaps.min.js"></script>
	<script src="./public/site/js/main.js"></script>



		<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>
<script>
	$('.choose').on('change', function(e) {
          var action = $(this).attr('id');
          var id_province = $(this).val();
        //   var _token = $('input[name="token"]').val();
          var result = '';		
          if (action == 'id_city') {
              result = 'province';
          }else if(action = 'province'){
			  result = 'wards';
		  }
          else {
			result ='street';
          }
          $.ajax({
				url: './lib/checkselect.php',
				method: 'post',
				dataType: 'json', // set the expected data type
				data: {action: action, id_province: id_province},
				success: function(data) {
					console.log(data);
					$('#' + result).empty(); // clear existing options
					$('#wards').empty(); // clear existing options
					// $('#wards').append('<option value="">--- chọn xã phường ---</option>'); // clear existing options
					$.each(data, function(key, value) {
						$('#' + result).append('');
                        $('#' + result).append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
				},
			});
      });
</script>
<script>
	function click_message(){
		alertify.alert('Thông Báo','không có sản phẩm trong giỏ hàng');
	}
</script>
<!-- <script>
	$('#update_cart').on('click', function(e){
		var quantityy = document.querySelectorAll('.qty');
		for(var i = 0; i<= quantityy.length; i++){
			var element = quantityy[i].value;
			alert(element)
		}
	})
</script> -->
<script>
function delay(callback, ms) {
  var timer = 0;
  return function() {
    var context = this, args = arguments;
    clearTimeout(timer);
    timer = setTimeout(function () {
      callback.apply(context, args);
    }, ms || 0);
  };
}

	var proQty = $('.product_count');
	proQty.addClass('increase items-count');
	proQty.addClass('reduced items-count');
	proQty.on('click', '.items-count', function () {
		var id = $(this).data('id')
		var $button = $(this);
		var oldValue = $button.parent().find('input').val();
		if ($button.hasClass('increase')) {
			var newVal = parseFloat(oldValue) + 1;
		} else if($button.hasClass('reduced')){
			// Don't allow decrementing below zero
			if (oldValue > 1) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 1;
			}
		}
		$button.parent().find('input').val(newVal);
	
		$.ajax({
			url: 'index.php?page=cart',
			method: 'POST',
			data: {id: id, newVal: newVal},
			success: function(data) {
				alertify.alert('Thông Báo','Đã Cập Nhật Thành Công', function(){ location.replace("index.php?page=cart"); });
			},
		});
	});
	proQty.on('keyup', '.qty',delay(function () {
		var id = $(this).data('id')
		var $button = $(this);
		var newVal = $button.val();
		
		$.ajax({
			url: 'index.php?page=cart',
			method: 'POST',
			data: {id: id, newVal: newVal},
			success: function(data) {
					alertify.alert('Thông Báo Giỏ Hàng','Đã Cập Nhật Thành Công', function(){ location.replace("index.php?page=cart"); });
			},
		});
	}, 700));

	$(document).on('click','#deleteCart', function(){
		var deleteid = $(this).data('id');
		$.ajax({
			url: 'index.php?page=cart',
			method: 'POST',
			data: {deleteid: deleteid},
			success: function(data) {
				alertify.alert('Thông Báo Giỏ Hàng','Đã Xóa Sản Phẩm Thành Công !', function(){ location.replace("index.php?page=cart"); });
			},
		});
	})
</script>
</html>