<?php
session_start();

?>
<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php 
	$title = "Cars - Easy Rent Car Latinoamérica";
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
		<main>

		<!-- mobile menu -->
		<?php include('./mobile_menu.php'); ?>


			<!-- breadcrumb_section - start
                ================================================== -->
			<section class="breadcrumb_section text-center clearfix">
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="assets/images/breadcrumb/bg_06.jpg">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Contacts</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.html">Home</a></li>
							<li>Contact</li>
							<li>Contact Simple</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->


			<!-- google_map_section - start
			================================================== -->
			<div class="google_map_section clearfix" data-aos="fade-up" data-aos-delay="100">
				<div id="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="12" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia." data-mlat="40.701083" data-mlon="-74.1522848">
				</div>
			</div>
			<!-- google_map_section - end
			================================================== -->


			<!-- contact_section - start
			================================================== -->
			<section class="contact_section clearfix">
				<div class="container">
					<div class="contact_details_wrap text-white" data-bg-color="#1F2B3E" data-aos="fade-up" data-aos-delay="100">
						<div class="row justify-content-lg-between">

							<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
								<div class="image_area">
									<div class="brand_logo mb_15">
										<a href="index.php">
											<img src="assets/images/logo/logo_01_1x.png" srcset="assets/images/logo/logo_01_2x.png 2x" alt="logo_not_found">
										</a>
									</div>
									<p class="mb_30">
										Mauris dignissim condimentum viverra. Curabitur blandit eu justo id porta
									</p>
									<div class="image_wrap">
										<img src="assets/images/about/img_02.jpg" alt="image_not_found">
									</div>
								</div>
							</div>

							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
								<div class="content_area">
									<h3 class="item_title text-white mb_30">Contact Details:</h3>
									<ul class="ul_li_block mb_30 clearfix">
										<li>
											<i class="fas fa-map-marker-alt"></i>
											Unit 9, Manor Industrial Estate, Lower Wash Lane, Warrington, WA4
										</li>
										<li><i class="fas fa-clock"></i> WH: 8:00am - 9:30pm</li>
										<li><i class="fas fa-phone"></i> 01967 411232</li>
										<li><i class="fas fa-envelope"></i> rotorseml@eml.fr</li>
									</ul>
									<form action="#">
										<div class="form_item mb-0">
											<input id="search_input" type="search" name="search" placeholder="Search">
											<label for="search_input" class="input_icon"><i class="fal fa-search"></i></label>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- contact_section - end
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