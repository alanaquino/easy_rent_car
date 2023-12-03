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
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="assets/images/breadcrumb/bg_05.jpg">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Sobre Nosotros</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.php">Inicio</a></li>
							<li>Nosotros</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->


			<!-- service_section - start
			================================================== -->
			<section class="service_section sec_ptb_150 clearfix">
				<div class="container">

					<div class="section_title mb_30 text-center" data-aos="fade-up" data-aos-delay="100">
						<h2 class="title_text mb-0">
							<span>Easy Rent Car</span>
						</h2>

						<h3 class="mb-0">
							El equipo de Easy Rent Car esta dedicado a brindarte la mejor experiencia de usuario y facilitarte
							la vida para que puedas rentar el vehiculo de tus sueños de manera mas facil, somos el rent car de
							confianza para su proximo viaje.
						</h3>

					</div>

					<div class="row justify-content-center">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="service_primary text-center" data-aos="fade-up" data-aos-delay="100">
								<div class="item_icon">
									<i class="far fa-shield-alt"></i>
								</div>
								<h3 class="item_title">Garantia de Seguridad en Pagos</h3>
								<p class="mb-0">
									Plataforma de pagos segura y confiable.
								</p>
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="service_primary text-center" data-aos="fade-up" data-aos-delay="300">
								<div class="item_icon">
									<i class="fal fa-headset"></i>
								</div>
								<h3 class="item_title">Ayuda y Soporte 24/7</h3>
								<p class="mb-0">
									El equipo de ayuda y soporte esta disponible para asistir las 24 horas los 7 dias de la semana.
								</p>
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="service_primary text-center" data-aos="fade-up" data-aos-delay="500">
								<div class="item_icon">
									<i class="fas fa-gem"></i>
								</div>
								<h3 class="item_title">Reserva de Vehiculos de cualquier clase</h3>
								<p class="mb-0">
									Ya sea un vehiculo de baja gama o alta gama, puedes reservar el vehiculo que desees.
								</p>
							</div>
						</div>

						<!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="service_primary text-center" data-aos="fade-up" data-aos-delay="100">
								<div class="item_icon">
									<i class="fas fa-briefcase"></i>
								</div>
								<h3 class="item_title">Corporate and Business Services</h3>
								<p class="mb-0">
									Vestibulum at ultrices elit. Maecenas faucibus vulputate vestibulum
								</p>
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="service_primary text-center" data-aos="fade-up" data-aos-delay="300">
								<div class="item_icon">
									<i class="fas fa-user-plus"></i>
								</div>
								<h3 class="item_title">Car Sharing Options</h3>
								<p class="mb-0">
									Vestibulum at ultrices elit. Maecenas faucibus vulputate vestibulum
								</p>
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="service_primary text-center" data-aos="fade-up" data-aos-delay="500">
								<div class="item_icon">
									<i class="fas fa-gem"></i>
								</div>
								<h3 class="item_title">Limousine and Chauffeur Hire</h3>
								<p class="mb-0">
									Vestibulum at ultrices elit. Maecenas faucibus vulputate vestibulum
								</p>
							</div>
						</div>
					</div> -->

				</div>
			</section>
			<!-- service_section - end
			================================================== -->


			<!-- gallery_section - start
			================================================== -->
			<section class="gallery_section clearfix">
				<div class="updown_style_wrap minus_bottom">

					<div class="">
						<div class="gallery_fullimage" data-aos="fade-up" data-aos-delay="100">
							<img src="assets/images/backgrounds/bg_02.jpg" alt="image_not_found">
							<div class="item_content text-white">
								<h3 class="item_title text-white">Has realidad tus sueños</h3>
								<p>
									Es el tiempo de que hagas ese viaje que tanto has planeado, reserva tu vehiculo con nosotros
								</p>
								<a class="text_btn text-uppercase mb-5" href="cars.php"><span>Reservar Ahora</span> <img src="assets/images/icons/icon_02.png" alt="icon_not_found"></a>
							</div>
						</div>
					</div>


				</div>
			</section>
			<!-- gallery_section - end
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