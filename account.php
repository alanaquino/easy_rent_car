<?php
	
	session_start();
	
	if(isset($_SESSION['id']) =="") {
		header("Location: login.php");
	}

	// Database connection
	include('config/db.php');


	$submit_allert = "";


	if(isset($_POST['submit_form'])) {

		// Get the form data
		$customer_id 	    = $_POST['customer_id'];
		$car_selected_id 	= $_POST['car_selected'];
		$pickup_location 	= $_POST['pickup_location'];
		$pickup_date 		= $_POST['pickup_date'];
		$pickup_time 		= $_POST['pickup_time'];
		$return_location 	= $_POST['return_location'];
		$return_date 		= $_POST['return_date'];
		$return_time 		= $_POST['return_time'];
		$grand_total 		= $_POST['grand_total'];

		$extra_srvs 		    = $_POST['extra_srv'];


		// Insert the rental data into the rentals table
		$sql = "INSERT INTO rentals (customer_id, car_id, pickup_location_id, return_location_id, rental_start, rental_end, rental_start_time, rental_end_time, rental_status_id, total_price) 
						VALUES ('$customer_id', '$car_selected_id', '$pickup_location', '$return_location', '$pickup_date', '$return_date', '$pickup_time', '$return_time', 1, '$grand_total')";

		if ($connection->query($sql) === TRUE) {

			$rental_id = $connection->insert_id;

			// Insert the rental and service data into the customer_rentals and rental_extra_services tables
			$sql = "INSERT INTO customer_rentals (customer_id, rental_id) VALUES ('$customer_id', '$rental_id')";

			if ($connection->query($sql) === TRUE) {

				if (!empty($extra_srvs)) {

					foreach ($extra_srvs as $extra_srv) {

						$sql = "INSERT INTO rental_extra_services (rental_id, services_id) VALUES ('$rental_id', '$extra_srv')";

						if ($connection->query($sql) === TRUE) {

							$submit_allert = "<div class='alert alert-danger' role='alert'>
													  Vehículo no disponible para la fecha seleccionada. Por favor, seleccione otra fecha
												  </div>";

						} else {

							echo "Error: " . $sql . "<br>" . $connection->error;
						}
					}
				}

			} else {
				echo "Error: " . $sql . "<br>" . $connection->error;
			}

		} else {
			echo "Error: " . $sql . "<br>" . $connection->error;
	}

	// Close the database connection
	$connection->close();

	}


?>


<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php 
	$title = "Account - Easy Rent Car Latinoamérica";
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
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="assets/images/breadcrumb/bg_09.jpg">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Cuenta</h1>
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
								<h3 class="list_title mb_15">Cuenta:</h3>
								<ul class="ul_li_block nav" role="tablist">
									<li>
										<a class="active" data-toggle="tab" href="#admin_tab"><i class="fas fa-user"></i> <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?></a>
									</li>
									<li>
										<a href="reservas.php"><i class="fas fa-file-alt"></i> Historial de Reservas</a>
									</li>
									<li>
										<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión <img class="arrow" src="assets/images/icons/icon_02.png" alt="icon_not_found"></a>
									</li>
								</ul>
							</div>
						</div>

						<div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
							<div class="account_tab_content tab-content">
								<div id="admin_tab" class="tab-pane active">
									<div class="account_info_list" data-aos="fade-up" data-aos-delay="100">

										<?php echo $submit_allert; ?>

										<h3 class="list_title mb_30">Información de la cuenta:</h3>
										<ul class="ul_li_block clearfix">
											<li><span>Name:</span> <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?></li>
											<li><span>E-mail:</span> <?php echo $_SESSION['email']; ?></li>
											<li><span>Phone Number:</span> +1-202-555-0104</li>
											<li><span>Country:</span> United States</li>
											<li><span>Address:</span> 60 Stonybrook Lane Atlanta, GA 30303</li>
										</ul>
										<a class="text_btn text-uppercase" href="#!"><span>Cambiar la información de la cuenta</span> <img src="assets/images/icons/icon_02.png" alt="icon_not_found"></a>
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
		<?php include('./footer.php'); ?>
		
		<!-- include_section -->
		<?php include('./include.php'); ?>
		
	</body>
</html>