			<!-- mobile menu - start
			================================================== -->
			<div class="sidebar-menu-wrapper">
				<div class="mobile_sidebar_menu">
					<button type="button" class="close_btn"><i class="fal fa-times"></i></button>

					<div class="about_content mb_60">
						<div class="brand_logo mb_15">
							<a href="index.php">
								<img src="assets/images/logo/logo_01_1x.png" srcset="assets/images/logo/logo_01_2x.png 2x" alt="logo_not_found">
							</a>
						</div>
						<p class="mb-0">
							El Rent Car de confianza para su próximo viaje. Easy Rent Car, donde rentar un vehículo es más fácil
						</p>
					</div>

					<div class="menu_list mb_60 clearfix">
						<ul class="ul_li_block clearfix">
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
					</div>

					<div class="booking_car_form">
						<h3 class="title_text text-white mb-2">Book A Car</h3>
						<p class="mb_15">
							¿Buscas un coche? Estás en el lugar adecuado
						</p>
						<form autocomplete="off" action="cars.php">
							<div class="form_item">
								<h4 class="input_title text-white">Fecha de recogida</h4>
								<input type="date" name="pickup_date">
							</div>
							<div class="form_item">
								<h4 class="input_title text-white">Fecha de entrega</h4>
								<input type="date" name="return_date">
							</div>
							<button type="submit" class="custom_btn bg_default_red btn_width text-uppercase">Buscar <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></button>
						</form>
					</div>

				</div>
				<div class="overlay"></div>
			</div>
			<!-- mobile menu - end
			================================================== -->