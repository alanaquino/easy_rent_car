<?php include('./controllers/user_activation.php'); ?>


<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php 
	$title = "Verificación - Easy Rent Car Latinoamérica";
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
						<h1 class="page_title text-white mb-0">Verificación</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.html">Inicio</a></li>
							<li>Verificación</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->

			<!-- register_section - start
			================================================== -->
			<section class="register_section sec_ptb_100 clearfix">
				<div class="container">


					<div class="register_card mb-0" data-bg-color="##F2F2F2" data-aos="fade-up" data-aos-delay="100">
						<div class="section_title mb_30 text-center">
							<h2 class="title_text mb-0" data-aos="fade-up" data-aos-delay="300">
								<span>Verificación de cuenta</span>
							</h2>
						</div>
						
							<div class="row justify-content-lg-between">
							

								
								<div class="col-lg-12 text-center" data-aos="fade-up" data-aos-delay="500">
								
										<?php echo $email_already_verified; ?>
										<?php echo $email_verified; ?>
										<?php echo $activation_error; ?>
									
									<h2 class="lead mb-4">Si su cuenta de usuario está verificada, haga clic en el siguiente botón para iniciar sesión:</h2>
									<a class="custom_btn bg_default_red text-uppercase mb-0" href="login.php"
									   >Click to Login <img src="assets/images/icons/icon_01.png" alt="icon_not_found">
									</a>

									
									
									
								</div>

								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="700"></div>
							</div>
					</div>
					
				</div>
			</section>
			<!-- register_section - end
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