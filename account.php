<?php
	
	session_start();
	
	if(isset($_SESSION['id']) =="") {
		header("Location: login.php");
	}

	// Database connection
	include('config/db.php');

$customer_id = $_SESSION['id'];

// Get all the rentals
$sql = "SELECT 	firstname,
				lastname,
				email,
				phone,
				nacionalidad,
				licencia_id,
				address
			FROM customers
			WHERE customers.id = '{$customer_id}'";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$firstname		=$row["firstname"];
		$lastname		=$row["lastname"];
		$email			=$row["email"];
		$phone			=$row["phone"];
		$nacionalidad	=$row["nacionalidad"];
		$licencia_id	=$row["licencia_id"];
		$address		=$row["address"];
	}
} else {
	echo "falla en el query para buscar los datos del usuario";
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
										<a class="active" data-toggle="tab" href="#admin_tab"><i class="fas fa-user"></i> <?php echo $firstname." ".$lastname; ?></a>
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



										<h3 class="list_title mb_30">Información de la cuenta:</h3>
										<ul class="ul_li_block clearfix">
											<li><span>Nombre:</span> <?php echo $firstname." ".$lastname; ?></li>
											<li><span>E-mail:</span> <?php echo $email; ?></li>
											<li><span>Celular:</span> <?php echo $phone; ?></li>
											<li><span>Licencia:</span> <?php echo $licencia_id; ?></li>
											<li><span>Nacionalidad:</span> <?php echo $nacionalidad; ?></li>
											<li><span>Dirección:</span> <?php echo $address; ?></li>
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