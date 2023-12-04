<?php
// Inicia la sesión de PHP
session_start();

// Incluye el archivo de conexión a la base de datos
include('config/db.php');

// Recupera los valores de filtro de datos POST
$search_vehicle_type = $_GET['vehicle_type'] ?? '';
$search_location = $_GET['location'] ?? '';
$search_pickup_date = $_GET['pickup_date'] ?? '';
$search_return_date = $_GET['return_date'] ?? '';
$search_brand = $_GET['brand'] ?? '';
$search_passengers = $_GET['passengers'] ?? '';
$search_price_range = $_GET['price_range'] ?? '';

$min_price = 0;
$max_price = 0;

// Procesa el rango de precios si está presente
if (!empty($search_price_range)) {
    // Extrae el rango de precios del parámetro GET
    $price_range_values = explode(' - ', str_replace('$', '', $search_price_range));
    $min_price = intval($price_range_values[0]);
    $max_price = intval($price_range_values[1]);
}

// Consulta SQL para obtener información sobre los vehículos
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
            locations.name as locations_name
        FROM cars
        INNER JOIN car_details
            ON cars.id = car_details.car_id
		INNER JOIN car_locations
            ON cars.id = car_locations.car_id
        INNER JOIN locations
            ON car_locations.location_id = locations.id
        WHERE 1=1";

// Agrega condiciones para cada filtro proporcionado por el usuario
if (!empty($search_location)) {
    $sql .= " AND locations.name = '$search_location'";
}
if (!empty($search_vehicle_type)) {
    $sql .= " AND cars.type = '$search_vehicle_type'";
}
if (!empty($search_brand)) {
    $sql .= " AND cars.brand LIKE '%$search_brand%'";
}
if (!empty($search_year)) {
    $sql .= " AND cars.year = '$search_year'";
}
if (!empty($search_passengers)) {
    $sql .= " AND car_details.passengers = '$search_passengers'";
}

// Agrega condiciones para el rango de precios
if ($min_price > 0 && $max_price > 0) {
    $sql .= " AND cars.daily_price BETWEEN $min_price AND $max_price";
}

// Agrega condiciones para las fechas de recogida y devolución
if (!empty($search_pickup_date) && !empty($search_return_date)) {
    $sql .= " AND cars.id NOT IN (  SELECT car_id 
                                    FROM rentals 
                                    WHERE (
                                        (rental_start BETWEEN '{$search_pickup_date}' AND '{$search_return_date}')
                                        OR (rental_end BETWEEN '{$search_pickup_date}' AND '{$search_return_date}')
                                        OR (rental_start  <= '{$search_pickup_date}' AND rental_end >= '{$search_return_date}')
                                    )
                                )";
}

// Ejecuta la consulta
$result = $connection->query($sql);

// Maneja errores en la ejecución de la consulta
if ($result === false) {
    // Maneja el error aquí, como registrarlo o mostrar un mensaje de error
    echo "Error executing query: " . $connection->error;
} else {
    if ($result->num_rows > 0) {
        // Almacena los datos de cada fila en un array
        $data = array();
        while($row = $result->fetch_array()) {
            $data[] = $row;
        }
    } else {
        // No hay filas devueltas
        $mensaje = "No hay información de alquileres disponible con esos filtros.";
    }
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

                                    <form action="">
                                        <div class="sb_widget price-range-area clearfix" data-aos="fade-up" data-aos-delay="100">
                                            <h4 class="input_title">Precio</h4>
                                            <div id="slider-range" class="slider-range clearfix"></div>
                                            <input class="price-text" type="text" id="amount" name="price_range" readonly>
                                        </div>

                                        <div class="sb_widget car_picking" data-aos="fade-up" data-aos-delay="100">
                                            <div class="form_item">
                                                <h4 class="input_title">Tipo de vehiculo</h4>
                                                <div class="position-relative">
                                                    <select class="form-select" name="vehicle_type" id="vehicle_type">
                                                        <option data-display="Tipo de vehículo" selected disabled>Seleccione una opción</option>
                                                        <option value="SUV">SUV</option>
                                                        <option value="Hatchback">Hatchback</option>
                                                        <option value="Sedan">Sedan</option>
                                                        <option value="Camioneta">Camioneta</option>
                                                        <option value="Minivan">Minivan</option>
                                                        <option value="Crossover">Crossover</option>
                                                        <option value="Coupe">Coupe</option>
                                                        <option value="Convertible">Convertible</option>
                                                        <option value="Deportivo">Deportivo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form_item">
                                                <h4 class="input_title">Marca</h4>
                                                <div class="position-relative">
                                                    <select class="form-select" name="brand" id="brand">
                                                        <option data-display="Marca de vehículo" selected disabled>Seleccione una opción</option>
                                                        <option value="Acura">Acura</option>
                                                        <option value="Audi">Audi</option>
                                                        <option value="BMW">BMW</option>
                                                        <option value="Chevrolet">Chevrolet</option>
                                                        <option value="Dodge">Dodge</option>
                                                        <option value="Ford">Ford</option>
                                                        <option value="Honda">Honda</option>
                                                        <option value="Hyundai">Hyundai</option>
                                                        <option value="Jeep">Jeep</option>
                                                        <option value="Kia">Kia</option>
                                                        <option value="Lexus">Lexus</option>
                                                        <option value="Mazda">Mazda</option>
                                                        <option value="Mercedes-Benz">Mercedes-Benz</option>
                                                        <option value="Nissan">Nissan</option>
                                                        <option value="Subaru">Subaru</option>
                                                        <option value="Toyota">Toyota</option>
                                                        <option value="Tesla">Tesla</option>
                                                        <option value="Volkswagen">Volkswagen</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form_item">
                                                <h4 class="input_title">Sucursal de recogida</h4>
                                                <div class="position-relative">
                                                    <select data-display="Sucursal de recogida" class="form-select" name="location" id="location_two">
                                                        <option value="" disabled selected>Seleccione</option>
                                                        <option value="Sucursal Distrito Nacional">Sucursal Distrito Nacional</option>
                                                        <option value="Sucursal Santo Domingo Este">Sucursal Santo Domingo Este</option>
                                                    </select>
                                                    <label for="location_two" class="input_icon"><i class="fas fa-map-marker-alt"></i></label>
                                                </div>
                                            </div>

                                            <div class="form_item">
                                                <h4 class="input_title">Fecha de recogida</h4>
                                                <input type="date" name="date">
                                            </div>
                                        </div>


                                        <div class="sb_widget" data-aos="fade-up" data-aos-delay="100">
                                            <h4 class="input_title">Número de pasajeros:</h4>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="checkbox_input">
                                                        <label for="passengers_radio1"><input type="radio" id="passengers_radio1" name="passengers" value="2"> 2</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="checkbox_input">
                                                        <label for="passengers_radio2"><input type="radio" id="passengers_radio2" name="passengers" value="5"> 5</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="checkbox_input">
                                                        <label for="passengers_radio3"><input type="radio" id="passengers_radio3" name="passengers" value="4"> 4</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="checkbox_input">
                                                        <label for="passengers_radio4"><input type="radio" id="passengers_radio4" name="passengers" value="7"> 7 o más</label>
                                                    </div>
                                                </div>
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
                                        <span class="item_available">Vehículos disponible <?php if (!empty($data)) { echo count($data); } ?></span>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <form action="#">
                                            <div class="form_item mb-0">
                                                <select>
                                                    <option data-display="Ordenar por">Seleccione una opción</option>
                                                    <option value="1" selected>Orden predeterminado</option>
                                                    <option value="2">Another option</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <?php
                                // Check if $rentals is not empty before entering the loop
                                if (!empty($data)) {
                                    foreach($data as $row){
                                    ?>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="100">
                                            <h3 class="item_title mb-0">
                                                <a href="details.php?id=<?php echo $row['id']; ?>">
                                                    <?php echo "".$row['brand']." ".$row['model']." ".$row['level']." ".$row['year']." "; ?>
                                                </a>
                                            </h3>
                                            <div class="item_image position-relative">
                                                <a class="image_wrap" href="details.php?id=<?php echo $row['id']; ?>">
                                                    <img src="uploads/<?php echo $row['foto_principal']; ?>" style="width:345px; height:260px; object-fit:cover;" alt="image_not_found">
                                                </a>
                                                <span class="item_price bg_default_blue">$<?php echo intval($row['daily_price']); ?> x día</span>
                                            </div>
                                            <ul class="info_list ul_li_center clearfix">
                                                <li><?php echo $row['type']; ?></li>
                                                <li><?php echo $row['vehicle_type']; ?></li>
                                                <li><?php echo $row['passengers']; ?> pax</li>
                                                <li><?php echo $row['fuel_type']; ?></li>
                                            </ul>
                                        </div>
                                    </div>
                                        <?php
                                    }
                                } else {
                                    // Display a message or take some other action if $rentals is empty
                                    echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="100">
                                                <div class="alert alert-warning" role="alert">'.$mensaje.'</div>
                                            </div>
                                          </div>';
                                }
                                ?>








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