<?php
session_start();

// Database connection
include('config/db.php');


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
            car_details.options
        FROM cars
        INNER JOIN car_details
            ON cars.id = car_details.car_id";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $data = array();
    while($row = $result->fetch_array()) {
        $data[] = $row;
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
				<div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="assets/images/breadcrumb/bg_01.jpg">
					<div class="overlay"></div>
					<div class="container" data-aos="fade-up" data-aos-delay="100">
						<h1 class="page_title text-white mb-0">Vehículos disponibles</h1>
					</div>
				</div>
				<div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
					<div class="container">
						<ul class="ul_li clearfix">
							<li><a href="index.php">Inicio</a></li>
							<li>Vehículos</li>
						</ul>
					</div>
				</div>
			</section>
			<!-- breadcrumb_section - end
			================================================== -->


            <!-- car_section - start
            ================================================== -->
            <div class="car_section sec_ptb_100 clearfix">
                <div class="container">
                    <div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">

                        <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
                            <aside class="filter_sidebar sidebar_section" data-bg-color="#F2F2F2">
                                <div class="sidebar_header" data-bg-gradient="linear-gradient(90deg, #0C0C0F, #292D45)">
                                    <h3 class="text-white mb-0">Filtros</h3>
                                </div>
                                <div class="sb_widget">
                                    <form action="#">
                                        <div class="sb_widget price-range-area clearfix" data-aos="fade-up" data-aos-delay="100">
                                            <h4 class="input_title">Precio</h4>
                                            <div id="slider-range" class="slider-range clearfix"></div>
                                            <input class="price-text" type="text" id="amount" readonly>
                                        </div>

                                        <div class="sb_widget car_picking" data-aos="fade-up" data-aos-delay="100">
                                            <div class="form_item">
                                                <h4 class="input_title">Sucursal de recogida</h4>
                                                <div class="position-relative">
                                                    <input id="location_two" type="text" name="location" placeholder="Arroyo Hondo">
                                                    <label for="location_two" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
                                                </div>
                                            </div>

                                            <div class="form_item">
                                                <h4 class="input_title">Fecha de recogida</h4>
                                                <input type="date" name="date">
                                            </div>
                                        </div>

                                        <div class="sb_widget" data-aos="fade-up" data-aos-delay="100">
                                            <div class="checkbox_input">
                                                <label for="return_checkbox"><input type="checkbox" id="return_checkbox"> Entregar vehículo en una ubicación diferente</label>
                                            </div>
                                        </div>

                                        <div class="sb_widget" data-aos="fade-up" data-aos-delay="100">
                                            <h4 class="input_title">Número de pasajeros:</h4>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="checkbox_input">
                                                        <label for="passengers_radio1"><input type="radio" id="passengers_radio1" name="passengers" checked> 2</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="checkbox_input">
                                                        <label for="passengers_radio2"><input type="radio" id="passengers_radio2" name="passengers"> 5</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="checkbox_input">
                                                        <label for="passengers_radio3"><input type="radio" id="passengers_radio3" name="passengers"> 4</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="checkbox_input">
                                                        <label for="passengers_radio4"><input type="radio" id="passengers_radio4" name="passengers"> 7 o más</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="sb_widget" data-aos="fade-up" data-aos-delay="100">
                                            <div class="form_item">
                                                <select>
                                                    <option data-display="Transmisión">Seleccione una opción</option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3" disabled>Option 3</option>
                                                    <option value="4">Option 4</option>
                                                </select>
                                            </div>

                                            <div class="form_item">
                                                <select>
                                                    <option data-display="Tipo de combustible">Seleccione una opción</option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3" disabled>Option 3</option>
                                                    <option value="4">Option 4</option>
                                                </select>
                                            </div>

                                            <div class="form_item">
                                                <select>
                                                    <option data-display="Espacio de equipaje">Seleccione una opción</option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3" disabled>Option 3</option>
                                                    <option value="4">Option 4</option>
                                                </select>
                                            </div>

                                            <div class="form_item">
                                                <select>
                                                    <option data-display="Tipo de modelo">Seleccione una opción</option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3" disabled>Option 3</option>
                                                    <option value="4">Option 4</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div data-aos="fade-up" data-aos-delay="100">
                                            <button type="submit" class="custom_btn bg_default_red text-uppercase">Aplicar filtros <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></button>
                                        </div>
                                    </form>
                                </div>
                            </aside>
                        </div>

                        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                            <div class="item_shorting clearfix" data-aos="fade-up" data-aos-delay="100">
                                <div class="row align-items-center justify-content-lg-between">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <span class="item_available">Vehículos disponible <?php echo count($data); ?></span>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <form action="#">
                                            <div class="form_item mb-0">
                                                <select>
                                                    <option data-display="Short By">Seleccione una opción</option>
                                                    <option value="1" selected>Orden predeterminado</option>
                                                    <option value="2">Another option</option>
                                                    <option value="3" disabled>A disabled option</option>
                                                    <option value="4">Potato</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <?php foreach($data as $row){ ?>
                                    <div class="col-lg-6 col-md-6">
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
                                                <span class="item_price bg_default_blue">$<?php echo $row['daily_price']; ?>/día</span>
                                            </div>
                                            <ul class="info_list ul_li_center clearfix">
                                                <li><?php echo $row['type']; ?></li>
                                                <li><?php echo $row['vehicle_type']; ?></li>
                                                <li><?php echo $row['passengers']; ?> pasajeros</li>
                                                <li><?php echo $row['fuel_type']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="col-lg-6 col-md-6">
                                    <div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="300">
                                        <h3 class="item_title mb-0">
                                            <a href="details.php">
                                                2019 Chevrolet Corvette Stingray Red
                                            </a>
                                        </h3>
                                        <div class="item_image position-relative">
                                            <a class="image_wrap" href="details.php">
                                                <img src="assets/images/feature/img_02.jpg" alt="image_not_found">
                                            </a>
                                            <span class="item_price bg_default_blue">$230/Day</span>
                                        </div>
                                        <ul class="info_list ul_li_center clearfix">
                                            <li>Sports</li>
                                            <li>Auto</li>
                                            <li>2 Passengers</li>
                                            <li>Hybrid</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="100">
                                        <h3 class="item_title mb-0">
                                            <a href="details.php">
                                                2015 Chevrolet Corvette Stingray Z51
                                            </a>
                                        </h3>
                                        <div class="item_image position-relative">
                                            <a class="image_wrap" href="details.php">
                                                <img src="assets/images/feature/img_09.jpg" alt="image_not_found">
                                            </a>
                                            <span class="item_price bg_default_blue">$120/Day</span>
                                        </div>
                                        <ul class="info_list ul_li_center clearfix">
                                            <li>Sports</li>
                                            <li>Auto</li>
                                            <li>2 Passengers</li>
                                            <li>Gasoline</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="300">
                                        <h3 class="item_title mb-0">
                                            <a href="details.php">
                                                2020 Audi New Generation P00234
                                            </a>
                                        </h3>
                                        <div class="item_image position-relative">
                                            <a class="image_wrap" href="details.php">
                                                <img src="assets/images/feature/img_03.jpg" alt="image_not_found">
                                            </a>
                                            <span class="item_price bg_default_blue">$230/Day</span>
                                        </div>
                                        <ul class="info_list ul_li_center clearfix">
                                            <li>Sports</li>
                                            <li>Auto</li>
                                            <li>2 Passengers</li>
                                            <li>Electro</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6">
                                    <div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="100">
                                        <h3 class="item_title mb-0">
                                            <a href="details.php">
                                                2015 Chevrolet Corvette Stingray Z51
                                            </a>
                                        </h3>
                                        <div class="item_image position-relative">
                                            <a class="image_wrap" href="details.php">
                                                <img src="assets/images/feature/img_06.jpg" alt="image_not_found">
                                            </a>
                                            <span class="item_price bg_default_blue">$160/Day</span>
                                        </div>
                                        <ul class="info_list ul_li_center clearfix">
                                            <li>Sports</li>
                                            <li>Auto</li>
                                            <li>2 Passengers</li>
                                            <li>Gasoline</li>
                                        </ul>
                                    </div>
                                </div>



                            </div>

                            <div class="pagination_wrap clearfix" data-aos="fade-up" data-aos-delay="100">
                                <div class="row align-items-center justify-content-lg-between">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <span class="page_number">Página 1 de 3</span>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <ul class="pagination_nav ul_li_right clearfix">
                                            <li><a href="#!"><i class="fal fa-angle-double-left"></i></a></li>
                                            <li class="active"><a href="#!">1</a></li>
                                            <li><a href="#!">2</a></li>
                                            <li><a href="#!">3</a></li>
                                            <li><a href="#!"><i class="fal fa-angle-double-right"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- car_section - end
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