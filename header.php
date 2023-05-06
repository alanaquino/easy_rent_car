        <?php
            $directoryURI = $_SERVER['REQUEST_URI'];
            $path = parse_url($directoryURI, PHP_URL_PATH);
            $components = explode('/', $path);
            $first_part = $components[1];
        ?>

		<!-- header_section - start
		================================================== -->
		<header class="header_section secondary_header sticky text-white clearfix">


			<div class="header_bottom clearfix">
				<div class="container">
					<div class="row align-items-center">

						<div class="col-lg-3 col-md-6 col-sm-6 col-6">
							<div class="brand_logo">
								<a href="index.php">
									<img src="assets/images/logo/logo_01_1x.png" srcset="assets/images/logo/logo_01_2x.png 2x" alt="logo_not_found">
									<img src="assets/images/logo/logo_02_1x.png" srcset="assets/images/logo/logo_02_2x.png 2x" alt="logo_not_found">
								</a>
							</div>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-6 col-6 order-last">
							<ul class="header_action_btns ul_li_right clearfix">
								<li>
									<button type="button" class="search_btn" data-toggle="collapse" data-target="#collapse_search_body" aria-expanded="false" aria-controls="collapse_search_body">
										<i class="fal fa-search"></i>
									</button>
								</li>
								
						

								<li class="dropdown">
									<button type="button" class="user_btn" id="user_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fal fa-user"></i>
									</button>
									
									<?php if(isset($_SESSION['id']) !="") { ?>
									<div class="user_dropdown rotors_dropdown dropdown-menu clearfix" aria-labelledby="user_dropdown">
										<div class="profile_info clearfix">
											<a href="#!" class="user_thumbnail">
												<img src="assets/images/meta/img_01.png" alt="thumbnail_not_found">
											</a>
											<div class="user_content">
												<h4 class="user_name"><a href="account.php"><?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?></a></h4>
												<span class="user_title">Cliente</span>
											</div>
										</div>
										<ul class="ul_li_block clearfix">
											<li><a href="account.php"><i class="fal fa-user-circle"></i> Perfil</a></li>
											<li><a href="settings.php"><i class="fal fa-user-cog"></i> Ajustes</a></li>
											<li><a href="logout.php"><i class="fal fa-sign-out"></i> Salir</a></li>
										</ul>
									</div>
									<?php } else { ?>
									
									<div class="user_dropdown rotors_dropdown dropdown-menu clearfix" aria-labelledby="user_dropdown">
										<ul class="ul_li_block clearfix">
											<li><a href="login.php"><i class="fal fa-sign-in"></i> Iniciar Sesión</a></li>
											<li><a href="signup.php"><i class="fal fa-user-plus"></i> Regístrate</a></li>
										</ul>
									</div>
								
									
									<?php }	?>	
								</li>
								
								<script>
								if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
								  // true for mobile device
								  document.write("<li class='mobile_sidebar_btn'>	<button type='button' class='mobile_sidebar_btn'><i class='fal fa-align-right'></i></button></li>");
								}
								</script> 

								
								
								
								
								
								
							</ul>
						</div>

						<div class="col-lg-6 col-md-12">
							<nav class="main_menu clearfix">
								<ul class="ul_li_center clearfix">
								
									<li class="<?php if ($first_part=="") {echo "active"; } else  {echo "noactive";}?>">
										<a href="index.php">Inicio</a>
									</li>
									<li class="<?php if ($first_part=="cars.php") {echo "active"; } else  {echo "noactive";}?>">
										<a href="cars.php">Vehículos</a>
									</li>
									<li class="<?php if ($first_part=="about.php") {echo "active"; } else  {echo "noactive";}?>">
										<a href="about.php">Nosotros</a>
									</li>
									
									<li class="<?php if ($first_part=="contact.php") {echo "active"; } else  {echo "noactive";}?>">
										<a href="contact.php">Contacto</a>
									</li>


								</ul>
							</nav>
						</div>

					</div>
				</div>
			</div>

			<div id="collapse_search_body" class="collapse_search_body collapse">
				<div class="search_body">
					<div class="container">
						<form action="#">
							<div class="form_item">
								<input type="search" name="search" placeholder="Buscar...">
								<button type="submit"><i class="fal fa-search"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</header>
		<!-- header_section - end
		================================================== -->