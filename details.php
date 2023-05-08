<?php

session_start();

// Database connection
include('config/db.php');

// Waits for the given Car ID
$view_car_id = $_REQUEST['id'];

$sql = "SELECT 
    		cars.id,
            cars.brand, 
            cars.model, 
            cars.level, 
            cars.year, 
            cars.type,
            cars.foto_principal, 
            cars.daily_price, 
            car_details.passengers, 
            car_details.suitcase, 
            car_details.doors, 
            car_details.engine, 
            car_details.fuel_type, 
            car_details.options
        FROM cars
        INNER JOIN car_details
            ON cars.id = car_details.car_id
        WHERE cars.id = '{$view_car_id}'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$id=$row["id"];
        $brand=$row["brand"];
        $model=$row["model"];
        $level=$row["level"];
        $year=$row["year"];
        $type=$row["type"];
        $foto_principal=$row["foto_principal"];
        $daily_price=$row["daily_price"];
        $passengers=$row["passengers"];
        $suitcase=$row["suitcase"];
        $doors=$row["doors"];
        $engine=$row["engine"];
        $fuel_type=$row["fuel_type"];
        $options=$row["options"];
    }
} else {
    echo "falla en el query para buscar los datos";
}

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
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="assets/images/breadcrumb/bg_02.jpg">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Detalles del vehículo</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.php">Inicio</a></li>
							<li><a href="cars.php">Vehículos</a></li>
							<li>Detalle</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->


			<!-- details_section - start
			================================================== -->
			<div class="details_section sec_ptb_100 pb-0 clearfix">
				<div class="container">
					<div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">

						<div class="col-lg-12 col-md-8 col-sm-10 col-xs-12">
							<div class="car_choose_carousel mb_30 clearfix">
								<div class="thumbnail_carousel" data-aos="fade-up" data-aos-delay="100">
									<div class="item">
										<div class="item_head">
											<h4 class="item_title mb-0"><?php echo "".$brand." ".$model." ".$level." ".$year." "; ?></h4>
											<ul class="review_text ul_li_right clearfix">
												<li class="text-right">
													<strong>Super</strong>
													<small>24+ Reviews</small>
												</li>
												<li><span class="bg_default_blue">4.8/5</span></li>
											</ul>
										</div>
										<img src="uploads/<?php echo $foto_principal; ?>" alt="image_not_found">
										<ul class="btns_group ul_li_center clearfix">
											<li>
												<span class="custom_btn btn_width bg_default_blue"><del><?php echo $daily_price+20; ?> x día</del> $<?php echo intval($daily_price); ?> x día</span>
											</li>
											<li>
												<a href="verificar_disponibilidad.php?id=<?php echo $id; ?>" class="custom_btn btn_width bg_default_red text-uppercase">Rentar este vehículo <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></a>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="car_choose_content">
								<ul class="info_list ul_li_block mb_15 clearfix" data-aos="fade-up" data-aos-delay="100">
									<li><strong>Pasajeros:</strong> <?php echo $passengers; ?></li>
									<li><strong>Maletas:</strong> <?php echo $suitcase; ?></li>
									<li><strong>Puertas:</strong> <?php echo $doors; ?></li>
									<li><strong>Motor:</strong> <?php echo $engine; ?></li>
									<li><strong>Tipo de combustible:</strong> <?php echo $fuel_type; ?></li>
									<li><strong>Opciones:</strong> <?php echo $options; ?></li>
								</ul>
								<div data-aos="fade-up" data-aos-delay="200">
									<a class="terms_condition" href="#!"><i class="fas fa-info-circle mr-1"></i> Términos y condiciones</a>
								</div>

								<hr data-aos="fade-up" data-aos-delay="300">

								<div class="rent_details_info">
									<h4 class="list_title" data-aos="fade-up" data-aos-delay="100">Detalles del alquiler:</h4>
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<ul class="info_list ul_li_block mb_15 clearfix" data-aos="fade-up" data-aos-delay="200">
												<li><i class="fas fa-id-card"></i> Pago garantizado</li>
												<li><i class="fas fa-business-time"></i> Pólisa de seguros de ley</li>
												<li><i class="fas fa-business-time"></i> Recibo por correo electrónico</li>
											</ul>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<ul class="info_list ul_li_block mb_15 clearfix" data-aos="fade-up" data-aos-delay="300">
												<li><i class="fas fa-user-friends"></i> Auto compartido</li>
												<li><i class="fas fa-language"></i> Soporte en varios idiomas</li>
												<li><i class="fas fa-money-bill"></i> Multiples opciones de pago</li>
											</ul>
										</div>
									</div>
								</div>
								
								<hr data-aos="fade-up" data-aos-delay="50">
								
							</div>
						</div>
					</div>
					
					<div class="mb_30" data-aos="fade-up" data-aos-delay="500">

						<a class="custom_btn bg_default_red text-uppercase mb-0" href="verificar_disponibilidad.php?id=<?php echo $id; ?>">Rentar este vehículo <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></a>
						<!--<span class="custom_btn btn_width bg_default_blue"><del>$800/Day</del> $400/Day</span> -->			
					</div>
					
				</div>
			</div>
			
			<!-- details_section - end
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