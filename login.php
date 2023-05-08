<?php
session_start();

// Login script 
include('./controllers/login.php');

//if (isset($_SESSION['id']) != "") {
//    header("Location: account.php");
//}

?>

<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php 
	$title = "Iniciar Sesión - Easy Rent Car Latinoamérica";
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
						<h1 class="page_title text-white mb-0">Login</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.php">Inicio</a></li>
							<li>Iniciar Sesión</li>
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

					<div class="register_card mb_60" data-bg-color="##F2F2F2" data-aos="fade-up" data-aos-delay="100">
						<div class="row align-items-center">
							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
								<div class="reg_image" data-aos="fade-up" data-aos-delay="300">
									<img src="assets/images/about/img_03.jpg" alt="image_not_found">
								</div>
							</div>
			
			
							<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
								<div class="reg_form" data-aos="fade-up" data-aos-delay="500">
									<h3 class="form_title">Iniciar sesión</h3>
									<p>
										Ahorros de hasta un 15 % con nuestras soluciones de alquiler de vehículos y un equipo de atención al cliente exclusivo
									</p>
									<span class="new_account mb_15 mt-5">Inicia sesión o <a href="signup.php">crea una cuenta</a></span>
									<form action="" method="post">
										
										<?php echo $accountNotExistErr; ?>
										<?php echo $emailPwdErr; ?>
										<?php echo $verificationRequiredErr; ?>
										<?php echo $email_empty_err; ?>
										<?php echo $pass_empty_err; ?>
										
										<div class="form_item">
											<input type="email" name="email_signin" placeholder="Your email">
										</div>
										<div class="form_item">
											<input type="password" name="password_signin" placeholder="Password">
										</div>
										<button type="submit" name="login" id="sign_in" class="custom_btn bg_default_red text-uppercase">Login <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></button>
										<span class="reset_pass mb_15"><a href="#!">Restablecer contraseña por correo electrónico</a></span>
										<div class="checkbox_input mb-0">
											<label for="input_save"><input id="input_save" type="checkbox"> Guardar mi nombre y correo electrónico en este navegador para la próxima vez que ingrese</label>
										</div>
									</form>
								</div>
							</div>
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