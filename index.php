<?php
session_start();


// Database connection
include('config/db.php');
// Hola, Soy Miguel
// Somos duros!
//Find all cars in the database
$sql = "SELECT 
            cars.id,
            vehicle_type,
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
            car_details.options,
            locations.id as location_id,
            locations.name,
            locations.address
        FROM cars
        INNER JOIN car_details
            ON cars.id = car_details.car_id
		INNER JOIN car_locations
            ON cars.id = car_locations.car_id
        INNER JOIN locations
            ON car_locations.location_id = locations.id
        LIMIT 6";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	$cars = array();
	while($row = $result->fetch_array()) {
		$cars[] = $row;
	}
} else {
	echo "falla en el query para buscar los vehículos";
}


?>
<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php 
	$title = "Easy Rent Car ";
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

					<?php foreach($cars as $row){ ?>
					<div class="item has_overlay d-flex align-items-center" data-bg-image="uploads/<?php echo $row['foto_principal']; ?>">
						<div class="overlay"></div>
						<div class="container">
							
							<div class="row justify-content-center">
								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
									<div class="slider_content text-center">
										<h3 class="text-white text-uppercase" data-animation="fadeInUp" data-delay=".3s">
											<?php echo "".$row['brand']." ".$row['model']." ".$row['level']." ".$row['year']." "; ?>
										</h3>
										<p data-animation="fadeInUp" data-delay=".5s">
											<?php echo "Motor ".$row['engine']." | ".$row['fuel_type']." | ".$row['options']." "; ?>
										</p>
										<div class="abtn_wrap clearfix" data-animation="fadeInUp" data-delay=".7s">
											<a class="custom_btn bg_default_red btn_width text-uppercase" href="verificar_disponibilidad.php?id=<?php echo $row['id']; ?>">Reservar ahora <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>

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

						<form autocomplete="off" action="cars.php">
							<div class="row align-items-end">

								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<div class="form_item">
										<h4 class="input_title text-white">Fecha de recogida</h4>
										<input type="date" name="pickup_date">
									</div>
								</div>

								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<div class="form_item">
										<h4 class="input_title text-white">Fecha de entrega</h4>
										<input type="date" name="return_date">
									</div>
								</div>

								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<div class="price-range-area clearfix">
										<h4 class="input_title text-white">Price</h4>
										<div id="slider-range" class="slider-range clearfix"></div>
										<input class="price-text" type="text" id="amount" name="price_range" readonly>
									</div>
								</div>

								<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
									<button type="submit" class="custom_btn bg_default_red text-uppercase">Buscar <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></button>
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
									<span>Vehículos destacados</span>
								</h2>
								<p class="mb-0">
									¿Buscas un coche? Estás en el lugar adecuado
								</p>
							</div>
						</div>
					</div>

					<ul class="button-group filters-button-group ul_li_center mb_30 clearfix" data-aos="fade-up" data-aos-delay="300">
						<li><button class="button active" data-filter="*">All</button></li>
						<li><button class="button" data-filter=".Sedan">Sedan</button></li>
						<li><button class="button" data-filter=".SUV">SUV</button></li>
						<li><button class="button" data-filter=".Deportivo">Sport</button></li>
					</ul>

					<div class="feature_vehicle_filter element-grid clearfix">

						<?php foreach($cars as $row){ ?>

						<div class="element-item <?php echo $row['type']; ?> " data-category="<?php echo $row['type']; ?>">
							<div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="100">
								<h3 class="item_title mb-0">
									<a href="details.php?id=<?php echo $row['id']; ?>">
										<?php echo "".$row['brand']." ".$row['model']." ".$row['level']." ".$row['year'].""; ?>
									</a>
								</h3>
								<div class="item_image position-relative">
									<a class="image_wrap" href="details.php?id=<?php echo $row['id']; ?>">
										<img src="uploads/<?php echo $row['foto_principal']; ?>" style="width:345px; height:260px; object-fit:cover;" alt="image_not_found">
									</a>
									<span class="item_price bg_default_blue">$<?php echo intval($row['daily_price']); ?> x día</span>
								</div>
								<ul class="info_list ul_li_center clearfix">
									<li><?php echo $row['vehicle_type']; ?></li>
									<li><?php echo $row['type']; ?></li>
									<li><?php echo $row['passengers']; ?> pax</li>
									<li><?php echo $row['fuel_type']; ?></li>
								</ul>
							</div>
						</div>

						<?php } ?>

					</div>

					<div class="abtn_wrap text-center clearfix" data-aos="fade-up" data-aos-delay="100">
						<a class="custom_btn bg_default_red btn_width text-uppercase" href="cars.php">Renta tu vehículo aquí<img src="assets/images/icons/icon_01.png" alt="icon_not_found"></a>
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

		<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

		<script>
			$(document).ready(function() {
				// Initialize Autocomplete widget
				$('#location_two').autocomplete({
					source: function(request, response) {
						// Fetch list of locations from PHP script
						$.getJSON('controllers/get_locations.php', {
							term: request.term
						}, function(data) {
							// Return filtered list of locations based on user input
							var filtered = $.grep(data, function(item) {
								return item.toLowerCase().indexOf(request.term.toLowerCase()) === 0;
							});
							response(filtered);
						});
					}
				});
			});
		</script>
		
	</body>
</html>