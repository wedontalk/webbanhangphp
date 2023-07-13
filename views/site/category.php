<?php
	$per_page = 6;
	if(isset($_GET['cate'])){
		if(isset($_GET['pg'])){
			$page = $_GET['pg'];
			$start_index = ($page - 1) * $per_page;
		}else{
			$start_index = 0;
		}
		$slug = $_GET['cate'];
		$showpaginate = $prd->product_list_user_cate($slug, $start_index, $per_page);
		extract($showpaginate);
	}
?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
			<div class="col-first">
				<h1>Trang Cửa Hàng</h1>
				<nav class="d-flex align-items-center">
					<a href="index.html">Trang Chủ<span class="lnr lnr-arrow-right"></span></a>
					<a href="?page=product">Cửa Hàng
						<!-- <span class="lnr lnr-arrow-right"></span> -->
					</a>
					<!-- <a href="category.html">Fashon Category</a> -->
				</nav>
			</div>
		</div>
	</div>
</section>
<!-- End Banner Area -->
<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head">Danh Mục</div>
					<ul class="main-categories">
                        <?php
                            foreach ($cate->select_cate_user_menu() as $key => $value):                            
                        ?>
						<li class="main-nav-list"><a href="?page=category&cate=<?php echo $value['slug']?>"><?php echo $value['name_cate']?></a></li>
                        <?php endforeach;?>
					</ul>
				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head">Bộ Lọc Sản Phẩm</div>
					<div class="common-filter">
						<div class="head">Nhãn Hàng</div>
						<form action="#">
							<ul>
								<?php
									foreach ($brad->select_user_brand() as $key => $value):                            
								?>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="apple" name="brand"><label for="apple"><?php echo $value['name_brand']?></label></li>
								<?php endforeach;?>
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head">Màu Sắc</div>
						<form action="#">
							<ul>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="black" name="color"><label for="black">Black<span>(29)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="balckleather" name="color"><label for="balckleather">Black
										Leather<span>(29)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="blackred" name="color"><label for="blackred">Black
										with red<span>(19)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="gold" name="color"><label for="gold">Gold<span>(19)</span></label></li>
								<li class="filter-list"><input class="pixel-radio" type="radio" id="spacegrey" name="color"><label for="spacegrey">Spacegrey<span>(19)</span></label></li>
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head">Giá Tiền</div>
						<div class="price-range-area">
							<div id="price-range"></div>
							<div class="value-wrapper d-flex">
								<div class="price">Price:</div>
								<span>$</span>
								<div id="lower-value"></div>
								<div class="to">to</div>
								<span>$</span>
								<div id="upper-value"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select>
							<option value="1">Default sorting</option>
							<option value="1">Default sorting</option>
							<option value="1">Default sorting</option>
						</select>
					</div>
					<div class="sorting mr-auto">
						<select>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
						</select>
					</div>
					<?php
						if($total_pages > 1){
							$pagination = '<div class="pagination">';
							if($current_page > 1){
								$pagination .= 
								'
									<a href="?page=product&pg='.($current_page-1).'" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
								';
							}
							for($i = max(1, $current_page - 3); $i <= min($current_page + 3, $total_pages); $i++){
								if($i == $current_page){
									$pagination .= '<a href="?page=product&pg='.$i.'" class="active">'.$i.'</a>';
								} else {
									$pagination .= '<a href="?page=product&pg='.$i.'">'.$i.'</a>';
								}
							}
							if($current_page < $total_pages){
								$pagination .= 
								'
									<a href="?page=product&pg='.($current_page+1).'" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								';
							}
							$pagination .= '</div>';
                            echo $pagination;
						}
					?>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<!-- single product -->
						<?php if($product != ''):?>
						<?php foreach ($product as $key => $value):?>
						<div class="col-lg-4 col-md-6">
							<div class="single-product">
								<img class="img-fluid" src="./upload/images/<?php echo json_decode($value['image'])[0]?>" alt="">
								<div class="product-details">
									<h6><?php echo $value['name']?></h6>
									<div class="price">
										<?php if($value['price_discount'] == null || $value['price_discount'] == 0):?>
											<h6><?php echo number_format($value['price'])?></h6>
										<?php else:?>
											<h6><?php echo number_format($value['price_discount'])?></h6>
											<h6 class="l-through"><?php echo number_format($value['price'])?></h6>
										<?php endif;?>
									</div>
									<div class="prd-bottom">

										<a href="" class="social-info">
											<span class="ti-bag"></span>
											<p class="hover-text">Thêm giỏ Hàng</p>
										</a>
										<a href="" class="social-info">
											<span class="lnr lnr-heart"></span>
											<p class="hover-text">Yêu Thích</p>
										</a>
										<a href="?page=productdetail&slugdetail=<?php echo $value['slug_product']?>" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">Xem Thêm</p>
										</a>	
									</div>
								</div>
							</div>
						</div>
						<?php endforeach;?>
						<?php endif;?>
					</div>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">
						<select>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
						</select>
					</div>
					<?php
						if($total_pages > 1){
							$pagination = '<div class="pagination">';
							if($current_page > 1){
								$pagination .= 
								'
									<a href="?page=category&cate='.$slug.'&pg='.($current_page-1).'" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
								';
							}
							for($i = max(1, $current_page - 3); $i <= min($current_page + 3, $total_pages); $i++){
								if($i == $current_page){
									$pagination .= '<a href="?page=category&cate='.$slug.'&pg='.$i.'" class="active">'.$i.'</a>';
								} else {
									$pagination .= '<a href="?page=category&cate='.$slug.'&pg='.$i.'">'.$i.'</a>';
								}
							}
							if($current_page < $total_pages){
								$pagination .= 
								'
									<a href="?page=category&cate='.$slug.'&pg='.($current_page+1).'" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
								';
							}
							$pagination .= '</div>';
                            echo $pagination;
						}
					?>
				</div>
				<!-- End Filter Bar -->
			</div>
		</div>
	</div>
<br>