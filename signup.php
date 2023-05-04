<?php

include('./controllers/register.php');

// Función para obtener la lista de nacionalidades desde la API de REST Countries en español
function getNacionalidades() {
	$url = 'https://restcountries.com/v3.1/all?fields=name;translations';
	$response = file_get_contents($url);
	$data = json_decode($response, true);
	$nacionalidades = array();
	foreach ($data as $country) {
		if (isset($country['translations']['es'])) { // Solo incluir si hay una traducción en español
			$nacionalidades[] = array(
				'code' => $country['cca2'], // Usar el código ISO de dos letras del país
				'name' => $country['translations']['es'],
			);
		}
	}
	return $nacionalidades;
}

// Obtener la lista de nacionalidades en español
$nacionalidades = getNacionalidades();

?>

<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php 
	$title = "Registro - Easy Rent Car Latinoamérica";
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
						<h1 class="page_title text-white mb-0">Registro</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.php">Home</a></li>
							<li>Registro</li>
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
								<span>Registro</span>
							</h2>
						</div>
						
							<div class="row justify-content-lg-between">
							
								<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
									<div class="reg_image" data-aos="fade-up" data-aos-delay="300">
										<img src="assets/images/about/img_04.jpg" alt="image_not_found">
									</div>
								</div>
								
								<div class="col-lg-8 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="500">

									<form action="" method="post">
										<?php echo $success_msg; ?>
										<?php echo $email_exist; ?>

										<?php echo $email_verify_err; ?>
										<?php echo $email_verify_success; ?>


										<div class="form_item">
											<input type="text" name="firstname" id="firstname" placeholder="Nombre*" value="<?php echo $_POST['firstname']??''; ?>"class="form-control">

											<?php echo $fNameEmptyErr; ?>
											<?php echo $f_NameErr; ?>
										</div>
										
										<div class="form_item">
											<input type="text" name="lastname" id="lastname" placeholder="Apellidos*" value="<?php echo $_POST['lastname']??''; ?>" class="form-control">
											
											<?php echo $l_NameErr; ?>
											<?php echo $lNameEmptyErr; ?>
										</div>
										
										<div class="form_item">
											<input type="email" name="email" id="email" placeholder="Email*" value="<?php echo $_POST['email']??''; ?>" class="form-control">
											
											<?php echo $_emailErr; ?>
											<?php echo $emailEmptyErr; ?>
										</div>

										<div class="form_item">
											<input type="text" name="licencia_id" id="licencia_id" placeholder="Licencia de conducir*" value="<?php echo $_POST['firstname']??''; ?>"class="form-control">

											<?php echo $fNameEmptyErr; ?>
											<?php echo $f_NameErr; ?>
										</div>

										<div class="form_item">
											<input type="tel" name="phone" id="phone" placeholder="Celular*" value="<?php echo $_POST['firstname']??''; ?>"class="form-control">

											<?php echo $fNameEmptyErr; ?>
											<?php echo $f_NameErr; ?>
										</div>

										<div class="form_item">
											<select class="form-select" name="nacionalidad" id="nacionalidad" aria-label="Default select example">
												<option disabled selected>Nacionalidad</option>
												<?php foreach ($nacionalidades as $nacionalidad): ?>
													<option value="<?php echo $nacionalidad['code']; ?>"><?php echo $nacionalidad['name']; ?></option>
												<?php endforeach; ?>
											</select>

											<?php echo $fNameEmptyErr; ?>
											<?php echo $f_NameErr; ?>
										</div>
										
										<div class="form_item">
											<input type="password" name="password" id="password" placeholder="Password*" class="form-control">
											
											<?php echo $_passwordErr; ?>
											<?php echo $passwordEmptyErr; ?>
										</div>
										
										<p>
											Your personal data will be used in mapping with the vehicles you added to the website, to manage access to your account, and for other purposes described in our 
										</p>
										<button type="submit" name="submit" id="submit" class="custom_btn bg_default_red text-uppercase mb-0">Registrate <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></button>
								
										

										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="700">
										
										
										</div>
									
									
									</form>
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