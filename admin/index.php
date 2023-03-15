<?php
	
	session_start();
	
//	if(isset($_SESSION['id_admin']) =="") {
//		header("Location: login.php");
//	}

	// Database connection
	require_once "../config/db.php";

?>


<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php 
	$title = "Easy Rent Car Latinoamérica";
	include('../head.php'); 
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
		<?php include('../header.php'); ?>


		<!-- main body - start
		================================================== -->
		<main>

		<!-- mobile menu -->
		<?php include('../mobile_menu.php'); ?>
		
		<!-- breadcrumb_section - start
			================================================== -->
			<section class="breadcrumb_section text-center clearfix">
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="../assets/images/breadcrumb/bg_09.jpg">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Account</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.php">Home</a></li>
							<li>Account</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->
			

			
		<!-- account_section - start
			================================================== -->
			<section class="account_section sec_ptb_100 clearfix">
				<div class="container">
					<div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">

						<div class="col-lg-4 col-md-8 col-sm-10 col-xs-12">
							<div class="account_tabs_menu clearfix" data-bg-color="#F2F2F2" data-aos="fade-up" data-aos-delay="100">
								<h3 class="list_title mb_15">Account Details:</h3>
								<ul class="ul_li_block nav" role="tablist">
									<li>
										<a class="active" data-toggle="tab" href="#admin_tab"><i class="fas fa-user"></i> <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?></a>
									</li>
									<li>
										<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out <img class="arrow" src="assets/images/icons/icon_02.png" alt="icon_not_found"></a>
									</li>
									<li>
										<a data-toggle="tab" href="#profile_tab"><i class="fas fa-address-book"></i> Booking Profiles</a>
									</li>
									<li>
										<a data-toggle="tab" href="#history_tab"><i class="fas fa-file-alt"></i> Booking History</a>
									</li>
								</ul>
							</div>
						</div>

						<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
							<div class="account_tab_content tab-content">
								<div id="admin_tab" class="tab-pane active">
									<div class="account_info_list" data-aos="fade-up" data-aos-delay="100">
										<h3 class="list_title mb_30">Account:</h3>
										<ul class="ul_li_block clearfix">
											<li><span>Name:</span> <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?></li>
											<li><span>E-mail:</span> <?php echo $_SESSION['email']; ?></li>
											<li><span>Phone Number:</span> +1-202-555-0104</li>
											<li><span>Country:</span> United States</li>
											<li><span>Address:</span> 60 Stonybrook Lane Atlanta, GA 30303</li>
										</ul>
										<a class="text_btn text-uppercase" href="#!"><span>Change Account Information</span> <img src="assets/images/icons/icon_02.png" alt="icon_not_found"></a>
									</div>

									<div class="account_info_list" data-aos="fade-up" data-aos-delay="300">
										<h3 class="list_title mb_30">Booking Profiles:</h3>
										<ul class="ul_li_block clearfix">
											<li><span>Profile ID:</span> 1234557jt</li>
											<li><span>Payment Method:</span> Visa Credit Card</li>
											<li><span>Phone Number:</span> +1-202-555-0104</li>
										</ul>
									</div>

									<div class="account_info_list" data-aos="fade-up" data-aos-delay="500">
										<h3 class="list_title mb_30">Booking History:</h3>
										<ul class="ul_li_block clearfix">
											<li><span>Upcoming Reservations:</span> No Reservations Yet</li>
											<li><span>Past Rentals:</span> 0</li>
										</ul>
										<a class="text_btn text-uppercase" href="#!"><span>Book A Car</span> <img src="assets/images/icons/icon_02.png" alt="icon_not_found"></a>
									</div>
								</div>

								<div id="profile_tab" class="tab-pane fade">
									<div class="account_info_list" data-aos="fade-up" data-aos-delay="100">
										<h3 class="list_title mb_30">Booking Profiles:</h3>
										<ul class="ul_li_block clearfix">
											<li><span>Profile ID:</span> 1234557jt<?php echo $_SESSION['id']; ?></li>
											<li><span>Payment Method:</span> Visa Credit Card</li>
											<li><span>Phone Number:</span> +1-202-555-0104</li>
										</ul>
									</div>

									<div class="account_info_list" data-aos="fade-up" data-aos-delay="300">
										<h3 class="list_title mb_30">Booking History:</h3>
										<ul class="ul_li_block clearfix">
											<li><span>Upcoming Reservations:</span> No Reservations Yet</li>
											<li><span>Past Rentals:</span> 0</li>
										</ul>
										<a class="text_btn text-uppercase" href="#!"><span>Book A Car</span> <img src="assets/images/icons/icon_02.png" alt="icon_not_found"></a>
									</div>

									<div class="account_info_list" data-aos="fade-up" data-aos-delay="500">
										<h3 class="list_title mb_30">Account:</h3>
										<ul class="ul_li_block clearfix">
											<li><span>Name:</span> Rakibul Islam Dewan</li>
											<li><span>E-mail:</span> myname@email.com</li>
											<li><span>Phone Number:</span> +1-202-555-0104</li>
											<li><span>Country:</span> United States</li>
											<li><span>Address:</span> 60 Stonybrook Lane Atlanta, GA 30303</li>
										</ul>
										<a class="text_btn text-uppercase" href="#!"><span>Change Account Information</span> <img src="assets/images/icons/icon_02.png" alt="icon_not_found"></a>
									</div>
								</div>

								<div id="history_tab" class="tab-pane fade">
									<div class="account_info_list" data-aos="fade-up" data-aos-delay="100">
										<h3 class="list_title mb_30">Booking History:</h3>
										<ul class="ul_li_block clearfix">
											<li><span>Upcoming Reservations:</span> No Reservations Yet</li>
											<li><span>Past Rentals:</span> 0</li>
										</ul>
										<a class="text_btn text-uppercase" href="#!"><span>Book A Car</span> <img src="assets/images/icons/icon_02.png" alt="icon_not_found"></a>
									</div>

									<div class="account_info_list" data-aos="fade-up" data-aos-delay="300">
										<h3 class="list_title mb_30">Booking Profiles:</h3>
										<ul class="ul_li_block clearfix">
											<li><span>Profile ID:</span> 1234557jt</li>
											<li><span>Payment Method:</span> Visa Credit Card</li>
											<li><span>Phone Number:</span> +1-202-555-0104</li>
										</ul>
									</div>

									<div class="account_info_list" data-aos="fade-up" data-aos-delay="500">
										<h3 class="list_title mb_30">Account:</h3>
										<ul class="ul_li_block clearfix">
											<li><span>Name:</span> Rakibul Islam Dewan</li>
											<li><span>E-mail:</span> myname@email.com</li>
											<li><span>Phone Number:</span> +1-202-555-0104</li>
											<li><span>Country:</span> United States</li>
											<li><span>Address:</span> 60 Stonybrook Lane Atlanta, GA 30303</li>
										</ul>
										<a class="text_btn text-uppercase" href="#!"><span>Change Account Information</span> <img src="assets/images/icons/icon_02.png" alt="icon_not_found"></a>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</section>
			<!-- account_section - end
			================================================== -->

		</main>
		<!-- main body - end
		================================================== -->


		<!-- footer_section -->
		<?php include('../footer.php'); ?>
		
		<!-- include_section -->
		<?php include('../include.php'); ?>
		
	</body>
</html>