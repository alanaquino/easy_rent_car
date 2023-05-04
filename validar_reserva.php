<?php

session_start();

if(!isset($_SESSION['email'])){ //if login in session is not set
    header("Location: login.php");
}

// Database connection
include('config/db.php');

// Waits for the given Car ID
$view_car_id = $_POST['car_selected'];

$sql = "SELECT 
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
            locations.name,
            locations.address
        FROM cars
        INNER JOIN car_details
            ON cars.id = car_details.car_id
        INNER JOIN car_locations
            ON cars.id = car_locations.car_id
        INNER JOIN locations
            ON car_locations.location_id = locations.id
        WHERE cars.id = '{$view_car_id}'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $brand=$row["brand"];
        $model=$row["model"];
        $level=$row["level"];
        $year=$row["year"];
        $type=$row["type"];
        $foto_principal=$row["foto_principal"];
        $daily_price=$row["daily_price"];
        $passengers=$row["passengers"];
        $suitcase=$row["suitcase"];
        $doors=$row["doors"];
        $engine=$row["engine"];
        $fuel_type=$row["fuel_type"];
        $options=$row["options"];
        $location_name=$row["name"];
    }
} else {
    echo "falla en el query para buscar los datos";
}

$id_client = $_SESSION['id'];


$sql = "SELECT 
            customers.firstname,
            customers.lastname, 
            customers.email, 
            customers.phone, 
            customers.nacionalidad, 
            customers.licencia_id, 
            customers.address
        FROM customers
        WHERE customers.id = '{$id_client}'";

$result4 = $connection->query($sql);

if ($result4->num_rows > 0) {
    // output data of each row
    while($row = $result4->fetch_assoc()) {
        $firstname     = $row['firstname'];
        $lastname      = $row['lastname'];
        $email         = $row['email'];
        $phone         = $row['phone'];
        $nacionalidad  = $row['nacionalidad'];
        $licencia_id   = $row['licencia_id'];
        $address       = $row['address'];
    }
} else {
    echo "falla en el query para buscar los datos del cliente";
}

$sql = "SELECT * FROM `extra_services` ORDER BY obligatorio DESC,  tipo ASC";
$result3 = $connection->query($sql);

if ($result3->num_rows > 0) {
    // output data of each row
    $extra_services = array();
    while($row = $result3->fetch_array()) {
        $extra_services[] = $row;
    }
} else {
    echo "falla en el query para buscar extra_services";
}

$connection->close();


//Creating Function
function TimeAgo ($oldTime, $newTime) {
    $timeCalc = strtotime($newTime) - strtotime($oldTime);
    if ($timeCalc >= (60*60*24*30*12*2)){
        $timeCalc = intval($timeCalc/60/60/24/30/12) . " años";
    }else if ($timeCalc >= (60*60*24*30*12)){
        $timeCalc = intval($timeCalc/60/60/24/30/12) . " año";
    }else if ($timeCalc >= (60*60*24*30*2)){
        $timeCalc = intval($timeCalc/60/60/24/30) . " meses";
    }else if ($timeCalc >= (60*60*24*30)){
        $timeCalc = intval($timeCalc/60/60/24/30) . " mes";
    }else if ($timeCalc >= (60*60*24*2)){
        $timeCalc = intval($timeCalc/60/60/24) . " días";
    }else if ($timeCalc >= (60*60*24)){
        $timeCalc = " 1 día";
    }else if ($timeCalc >= (60*60*2)){
        $timeCalc = intval($timeCalc/60/60) . " horas";
    }else if ($timeCalc >= (60*60)){
        $timeCalc = intval($timeCalc/60/60) . " hora";
    }else if ($timeCalc >= 60*2){
        $timeCalc = intval($timeCalc/60) . " minutos";
    }else if ($timeCalc >= 60){
        $timeCalc = intval($timeCalc/60) . " minuto";
    }else if ($timeCalc > 0){
        $timeCalc .= " segundos";
    }
    return $timeCalc;
}

function dateDiff($rental_start, $rental_end)
{
    $date1_ts = strtotime($rental_start);
    $date2_ts = strtotime($rental_end);
    $diff = $date2_ts - $date1_ts;
    return round($diff / 86400);
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
        <div class="page_title_area has_overlay d-flex align-items-center clearfix" data-bg-image="assets/images/breadcrumb/bg_03.jpg">
            <div class="overlay"></div>
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <h1 class="page_title text-white mb-0">Reservar auto</h1>
            </div>
        </div>
        <div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
            <div class="container">
                <ul class="ul_li clearfix">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="cars.php">Vehículos</a></li>
                    <li>Reservar</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- breadcrumb_section - end
    ================================================== -->

    <!-- reservation_section - start
	================================================== -->
    <section class="reservation_section sec_ptb_100 clearfix">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">



                <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12">

                    <div class="feature_vehicle_item mt-0 ml-0" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="item_title mb-0">
                            <?php echo "".$brand." ".$model." ".$level." ".$year." "; ?>
                        </h3>
                        <div class="item_image position-relative">
                            <a class="image_wrap" href="#!">
                                <img src="uploads/<?php echo $foto_principal; ?>" alt="image_not_found">
                            </a>
                            <span class="item_price bg_default_blue">$<?php echo $daily_price; ?>/día</span>
                        </div>

                        <ul class="ul_li_block mb_15 clearfix" data-aos="fade-up" data-aos-delay="100" style="margin-top: 22px; margin-left: 22px; margin-right: 22px; margin-bottom: 0px;">
                            <li><strong>Pasajeros:</strong> <?php echo $passengers; ?></li>
                            <li><strong>Maletas:</strong> <?php echo $suitcase; ?></li>
                            <li><strong>Puertas:</strong> <?php echo $doors; ?></li>
                            <li><strong>Motor:</strong> <?php echo $engine; ?></li>
                            <li><strong>Combustible:</strong> <?php echo $fuel_type; ?></li>
                            <li><strong>Opciones:</strong> <?php echo $options; ?></li>
                            <li><strong>Disponible en:</strong> <?php echo $location_name; ?></li>
                        </ul>
                        <br>
                    </div>
\
                </div>

                <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12">



                </div>

                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                    <div class="reservation_form">

                        <form action="" method="post">

                            <input type="text" name="val_car_selected" class="d-none" value="<?php echo $_POST['car_selected']; ?>" readonly>








                            <div class="row">
                                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="z-index: 500;">

                                    <div class="form_item" data-aos="fade-up" data-aos-delay="100">
                                        <h4 class="input_title">Sucursal de recogida</h4>
                                        <input class="form-control-plaintext" type="text" value="<?php echo $_POST['res_pickup_location']; ?>" readonly>
                                    </div>

                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="200">
                                        <h4 class="input_title">Fecha de recogida</h4>
                                        <input class="form-control-plaintext" type="text"  value="<?php echo $_POST['res_pickup_date']; ?>" aria-label="Disabled input example"  readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="300">
                                        <h4 class="input_title">Hora</h4>
                                        <input class="form-control-plaintext" type="text" value="<?php echo $_POST['res_pickup_time']; ?>" aria-label="Disabled input example"  readonly>
                                    </div>
                                </div>

                                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="z-index: 500;">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="100">
                                        <h4 class="input_title">Sucursal de entrega</h4>
                                        <input class="form-control-plaintext" type="text" value="<?php echo $_POST['res_dropoff_location']; ?>" aria-label="Disabled input example"  readonly>

                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="500">
                                        <h4 class="input_title">Fecha de entrega</h4>
                                        <input class="form-control-plaintext" type="text" value="<?php echo $_POST['res_return_date']; ?>" aria-label="Disabled input example"  readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="600">
                                        <h4 class="input_title">Hora</h4>
                                        <input class="form-control-plaintext" type="text" value="<?php echo $_POST['res_return_time']; ?>" aria-label="Disabled input example"  readonly>
                                    </div>
                                </div>
                            </div>


                            <hr class="mt-0" data-aos="fade-up" data-aos-delay="700">

                            <div>
                                <div class="reservation_offer_checkbox">
                                    <h4 class="input_title" data-aos="fade-up" data-aos-delay="800">Opciones adicionales</h4>
                                    <div class="row">
                                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="900">



                                            <?php
                                            // Función para mostrar datos del checkbox en el preview
                                                foreach($_POST['res_extra_srv'] as $extra_srv) {

                                                    $service_values = explode('|', $extra_srv);
                                                    $service_id = $service_values[0];
                                                    $service_details = $service_values[1];
                                                    $service_price = $service_values[2];
                                            ?>

                                                <div class="checkbox_input">
                                                    <label for="extra_srv">
                                                        <input type="checkbox" id="extra_srv_<?php echo $service_id ?>" name="extra_srv[]" checked readonly value="<?php echo $service_id; ?>" disabled> <?php echo $service_details; ?>
                                                    </label>
                                                </div>

                                            <?php } ?>

                                        </div>

                                    </div>
                                </div>

                                
                                <hr data-aos="fade-up" data-aos-delay="200">




                                <div class="reservation_customer_details">


                                    <div data-aos="fade-up" data-aos-delay="100">
                                        <a class="terms_condition" href="#!"><i class="fas fa-info-circle mr-1"></i> Debe tener al menos 18 años para alquilar este vehículo</a>
                                    </div>

                                    <hr data-aos="fade-up" data-aos-delay="200">

                                    <div class="row align-items-center justify-content-lg-between">

                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                                            <div class="checkbox_input mb-0">
                                                <label for="accept"><input type="checkbox" id="accept"> Acepto toda la información.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="300">
                                            <button type="submit" class="custom_btn bg_default_red text-uppercase">Continuar <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- reservation_section - end
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