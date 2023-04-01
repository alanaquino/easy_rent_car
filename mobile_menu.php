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
							Nullam id dolor auctor, dignissim magna eu, mattis ante. Pellentesque tincidunt, elit a facilisis efficitur, nunc nisi scelerisque enim, rhoncus malesuada
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
							Nullam id dolor auctor, dignissim magna eu, mattis ante. Pellentesque tincidunt, elit a facilisis efficitur.
						</p>
						<form action="#">
							<div class="form_item">
								<h4 class="input_title text-white">Pick Up Location</h4>
								<div class="position-relative">
									<input id="location_one" type="text" name="location" placeholder="City, State or Airport Code">
									<label for="location_one" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
								</div>
							</div>
							<div class="form_item">
								<h4 class="input_title text-white">Pick A Date</h4>
								<input type="date" name="date">
							</div>
							<button type="submit" class="custom_btn bg_default_red btn_width text-uppercase">Book A Car <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></button>
						</form>
					</div>

				</div>
				<div class="overlay"></div>
			</div>
			<!-- mobile menu - end
			================================================== -->