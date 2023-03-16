<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php 
	$title = "Easy Rent Car Latinoamérica";
	include('./head.php'); 
?>


	<body>


		<!-- backtotop - start -->
		<div id="thetop"></div>
		<div class="backtotop">
			<a href="#" class="scroll">
				<i class="far fa-arrow-up"></i>
			</a>
		</div>
		<!-- backtotop - end -->

		<!-- preloader - start -->
		<div class="preloader">
			<div class="animation_preloader">
				<div class="spinner"></div>
				<p class="text-center">Loading</p>
			</div>
			<div class="loader">
				<div class="row vh-100">
					<div class="col-3 loader_section section-left">
						<div class="bg"></div>
					</div>
					<div class="col-3 loader_section section-left">
						<div class="bg"></div>
					</div>
					<div class="col-3 loader_section section-right">
						<div class="bg"></div>
					</div>
					<div class="col-3 loader_section section-right">
						<div class="bg"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- preloader - end -->

		<!-- header_section -->
		<?php include('./header.php'); ?>


		<!-- main body - start
		================================================== -->
		<main class="mt-0">

		<!-- mobile menu -->
		<?php include('./mobile_menu.php'); ?>
			


			<!-- slider_section - start
			================================================== -->
			<section class="slider_section text-white text-center position-relative clearfix">
				<div class="main_slider clearfix">
					<div class="item has_overlay d-flex align-items-center" data-bg-image="assets/images/backgrounds/bg_02.jpg">
						<div class="overlay"></div>
						<div class="container">
							
							<div class="row justify-content-center">
								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
									<div class="slider_content text-center">
										<h3 class="text-white text-uppercase" data-animation="fadeInUp" data-delay=".3s">Lamborghini Aventador LP700-4</h3>
										<p data-animation="fadeInUp" data-delay=".5s">
											6.6L V8 32V DDI OHV Turbo Diesel, 5-Speed Automatic, Fuel Type: Diesel, Color: Black
										</p>
										<div class="abtn_wrap clearfix" data-animation="fadeInUp" data-delay=".7s">
											<a class="custom_btn bg_default_red btn_width text-uppercase" href="#!">Book Now <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="item has_overlay d-flex align-items-center" data-bg-image="assets/images/backgrounds/bg_02.jpg">
						<div class="overlay"></div>
						<div class="container">
							
							<div class="row justify-content-center">
								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
									<div class="slider_content text-center">
										<h3 class="text-white text-uppercase" data-animation="fadeInUp" data-delay=".3s">Lamborghini Aventador LP700-4</h3>
										<p data-animation="fadeInUp" data-delay=".5s">
											6.6L V8 32V DDI OHV Turbo Diesel, 5-Speed Automatic, Fuel Type: Diesel, Color: Black
										</p>
										<div class="abtn_wrap clearfix" data-animation="fadeInUp" data-delay=".7s">
											<a class="custom_btn bg_default_red btn_width text-uppercase" href="#!">Reservar ahora <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="item has_overlay d-flex align-items-center" data-bg-image="assets/images/backgrounds/bg_02.jpg">
						<div class="overlay"></div>
						<div class="container">
							
							<div class="row justify-content-center">
								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
									<div class="slider_content text-center">
										<h3 class="text-white text-uppercase" data-animation="fadeInUp" data-delay=".3s">Lamborghini Aventador LP700-4</h3>
										<p data-animation="fadeInUp" data-delay=".5s">
											6.6L V8 32V DDI OHV Turbo Diesel, 5-Speed Automatic, Fuel Type: Diesel, Color: Black
										</p>
										<div class="abtn_wrap clearfix" data-animation="fadeInUp" data-delay=".7s">
											<a class="custom_btn bg_default_red btn_width text-uppercase" href="#!">Book Now <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="carousel_nav clearfix">
					<button type="button" class="main_left_arrow"><i class="fal fa-chevron-left"></i></button>
					<button type="button" class="main_right_arrow"><i class="fal fa-chevron-right"></i></button>
				</div>
			</section>
			<!-- slider_section - end
			================================================== -->


			<!-- search_section - start
			================================================== -->
			<section class="search_section clearfix">
				<div class="container">
					<div class="advance_search_form2" data-bg-color="#161829" data-aos="fade-up" data-aos-delay="100">
						<form action="#">
							<div class="row align-items-end">
								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<div class="form_item">
										<h4 class="input_title text-white">Pick Up Location</h4>
										<div class="position-relative">
											<input id="location_two" type="text" name="location" placeholder="City, State or Airport Code">
											<label for="location_two" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
										</div>
									</div>
								</div>

								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<div class="form_item">
										<h4 class="input_title text-white">Pick A Date</h4>
										<input type="date" name="date">
									</div>
								</div>

								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<div class="price-range-area clearfix">
										<h4 class="input_title text-white">Price</h4>
										<div id="slider-range" class="slider-range clearfix"></div>
										<input class="price-text" type="text" id="amount" readonly>
									</div>
								</div>

								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<button type="submit" class="custom_btn bg_default_red text-uppercase">Find A Car <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</section>
			<!-- search_section - end
			================================================== -->


			<!-- feature_section - start
			================================================== -->
			<section class="feature_section sec_ptb_150 clearfix">
				<div class="container">

					<div class="row justify-content-center">
						<div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
							<div class="section_title mb_60 text-center" data-aos="fade-up" data-aos-delay="100">
								<h2 class="title_text mb_15">
									<span>Featured Vehicles</span>
								</h2>
								<p class="mb-0">
									Mauris cursus quis lorem sed cursus. Aenean aliquam pellentesque magna, ut dictum ex pellentesque
								</p>
							</div>
						</div>
					</div>

					<ul class="button-group filters-button-group ul_li_center mb_30 clearfix" data-aos="fade-up" data-aos-delay="300">
						<li><button class="button active" data-filter="*">All</button></li>
						<li><button class="button" data-filter=".sedan">Sedan</button></li>
						<li><button class="button" data-filter=".sports">Sports</button></li>
						<li><button class="button" data-filter=".luxury">Luxury</button></li>
					</ul>

					<div class="feature_vehicle_filter element-grid clearfix">
						<div class="element-item sedan " data-category="sedan">
							<div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="100">
								<h3 class="item_title mb-0">
									<a href="#!">
										2015 Chevrolet Corvette Stingray Z51
									</a>
								</h3>
								<div class="item_image position-relative">
									<a class="image_wrap" href="#!">
										<img src="assets/images/feature/img_01.jpg" alt="image_not_found">
									</a>
									<span class="item_price bg_default_blue">$230/Day</span>
								</div>
								<ul class="info_list ul_li_center clearfix">
									<li>Sports</li>
									<li>Auto</li>
									<li>2 Passengers</li>
									<li>Gasoline</li>
								</ul>
							</div>
						</div>

						<div class="element-item sports " data-category="sports">
							<div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="300">
								<h3 class="item_title mb-0">
									<a href="#!">
										2019 Chevrolet Corvette Stingray Red
									</a>
								</h3>
								<div class="item_image position-relative">
									<a class="image_wrap" href="#!">
										<img src="assets/images/feature/img_02.jpg" alt="image_not_found">
									</a>
									<span class="item_price bg_default_blue">$230/Day</span>
								</div>
								<ul class="info_list ul_li_center clearfix">
									<li>Sports</li>
									<li>Auto</li>
									<li>2 Passengers</li>
									<li>Hybrid</li>
								</ul>
							</div>
						</div>

						<div class="element-item luxury " data-category="luxury">
							<div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="500">
								<h3 class="item_title mb-0">
									<a href="#!">
										2015 Chevrolet Corvette Stingray Z51
									</a>
								</h3>
								<div class="item_image position-relative">
									<a class="image_wrap" href="#!">
										<img src="assets/images/feature/img_03.jpg" alt="image_not_found">
									</a>
									<span class="item_price bg_default_blue">$120/Day</span>
								</div>
								<ul class="info_list ul_li_center clearfix">
									<li>Sports</li>
									<li>Auto</li>
									<li>2 Passengers</li>
									<li>Gasoline</li>
								</ul>
							</div>
						</div>

						<div class="element-item sedan " data-category="sedan">
							<div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="100">
								<h3 class="item_title mb-0">
									<a href="#!">
										2020 Audi New Generation P00234
									</a>
								</h3>
								<div class="item_image position-relative">
									<a class="image_wrap" href="#!">
										<img src="assets/images/feature/img_04.jpg" alt="image_not_found">
									</a>
									<span class="item_price bg_default_blue">$230/Day</span>
								</div>
								<ul class="info_list ul_li_center clearfix">
									<li>Sports</li>
									<li>Auto</li>
									<li>2 Passengers</li>
									<li>Electro</li>
								</ul>
							</div>
						</div>

						<div class="element-item sports " data-category="sports">
							<div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="300">
								<h3 class="item_title mb-0">
									<a href="#!">
										2015 Chevrolet Corvette Stingray Z51
									</a>
								</h3>
								<div class="item_image position-relative">
									<a class="image_wrap" href="#!">
										<img src="assets/images/feature/img_05.jpg" alt="image_not_found">
									</a>
									<span class="item_price bg_default_blue">$160/Day</span>
								</div>
								<ul class="info_list ul_li_center clearfix">
									<li>Sports</li>
									<li>Auto</li>
									<li>2 Passengers</li>
									<li>Gasoline</li>
								</ul>
							</div>
						</div>

						<div class="element-item luxury " data-category="luxury">
							<div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="500">
								<h3 class="item_title mb-0">
									<a href="#!">
										2015 Chevrolet Corvette Stingray Z51
									</a>
								</h3>
								<div class="item_image position-relative">
									<a class="image_wrap" href="#!">
										<img src="assets/images/feature/img_06.jpg" alt="image_not_found">
									</a>
									<span class="item_price bg_default_blue">$230/Day</span>
								</div>
								<ul class="info_list ul_li_center clearfix">
									<li>Sports</li>
									<li>Auto</li>
									<li>2 Passengers</li>
									<li>Hybrid</li>
								</ul>
							</div>
						</div>	
					</div>

					<div class="abtn_wrap text-center clearfix" data-aos="fade-up" data-aos-delay="100">
						<a class="custom_btn bg_default_red btn_width text-uppercase" href="#!">Book A Car <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></a>
					</div>

				</div>
			</section>
			<!-- feature_section - end
			================================================== -->


		</main>
		<!-- main body - end
		================================================== -->


		<!-- footer_section -->
		<?php include('./footer.php'); ?>
		
		<!-- include_section -->
		<?php include('./include.php'); ?>
		
	</body>
</html>