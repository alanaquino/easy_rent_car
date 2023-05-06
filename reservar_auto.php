<?php

session_start();

if(!isset($_SESSION['email'])){ //if login in session is not set
    header("Location: login.php");
}

// Database connection
include('config/db.php');

// Waits for the given Car ID
$view_car_id = $_REQUEST['id'];

global $availability_allert;

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
            locations.id as location_id,
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
        $location_id=$row["location_id"];
        $location_name=$row["name"];
    }
} else {
    echo "falla en el query para buscar los datos";
}


$sql = "SELECT * FROM locations";
$result2 = $connection->query($sql);

if ($result2->num_rows > 0) {
    // output data of each row
    $locations_name = array();
    while($row = $result2->fetch_array()) {
        $locations_name[] = $row;
    }
} else {
    echo "falla en el query para buscar las ubicaciones";
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


$availability_allert = "";

// Check if the car is available
if (isset($_POST['check_availability'])) {
    $pickup_date = $_POST['pickup_date'];
    $return_date = $_POST['return_date'];

    $sql = "SELECT * FROM rentals WHERE car_id = '{$view_car_id}' AND (
            (rental_start BETWEEN '{$pickup_date}' AND '{$return_date}')
            OR (rental_end BETWEEN '{$pickup_date}' AND '{$return_date}')
            OR (rental_start  <= '{$pickup_date}' AND rental_end >= '{$return_date}'))";

    $result = $connection->query($sql);

    if($result->num_rows > 0) {
        $availability_status = "not_available";
    } else {
        $availability_status = "available";
    }


    if ($availability_status == 'not_available') {
        $availability_allert = "<div class='alert alert-danger' role='alert'>
                                         Vehículo no disponible para la fecha seleccionada. Por favor, seleccione otra fecha
                                      </div>";
        // header("Location: verificar_disponibilidad.php?id=".$view_car_id);

    } else {
        $availability_allert = "<div class='alert alert-success' role='alert'>
                                         Vehículo disponible para la fecha seleccionada. ¡Procede a reservar!
                                      </div>";
    }

}


$connection->close();


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



                </div>



                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                    <div class="reservation_form">

                        <form action="validar_reserva.php" method="POST">

                                <?php echo $availability_allert; ?>

                            <input type="text" name="val_car_selected" class="d-none" value="<?php echo $view_car_id; ?>" readonly>

                            <div class="row">
                                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="z-index: 500;">

                                    <div class="form_item" data-aos="fade-up" data-aos-delay="100">
                                        <h4 class="input_title">Sucursal de recogida</h4>
                                            <select class="form-select is-valid" name="res_pickup_location" readonly="">
                                                <option selected value="<?php echo $location_id; ?>"><?php echo $location_name; ?></option>
                                            </select>
                                    </div>

                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="200">
                                        <h4 class="input_title">Fecha de recogida</h4>
                                        <input type="date" name="res_pickup_date" value="<?php echo $_POST['pickup_date']; ?>" class="form-control <?php if ($availability_status == 'available') { echo 'is-valid'; } ?>" min="<?php echo date("Y-m-d"); ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="300">
                                        <h4 class="input_title">Hora</h4>
                                        <input type="time" name="res_pickup_time" class="form-control" value="<?php echo $_POST['pickup_time']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12" style="z-index: 500;">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="100">
                                        <h4 class="input_title">Sucursal de entrega</h4>
                                        <select id="return_location"  name="res_dropoff_location" aria-label="Default select example">

                                            <?php foreach($locations_name as $row){ ?>
                                                <option selected value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="500">
                                        <h4 class="input_title">Fecha de entrega</h4>
                                        <input class="form-control <?php if ($availability_status == 'available') { echo 'is-valid'; } ?>" type="date" name="res_return_date" value="<?php echo $_POST['return_date']; ?>" min="<?php echo date("Y-m-d"); ?>" required>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="600">
                                        <h4 class="input_title">Hora</h4>
                                        <input type="time" name="res_return_time" class="form-control" value="<?php echo $_POST['return_time']; ?>" required>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-4 <?php if ($availability_status == 'available') { echo 'd-none'; } ?>" data-aos="fade-up" data-aos-delay="300">
                                <button type="submit" name="check_availability" id="check_availability" class="custom_btn bg_default_red text-uppercase">Verificar disponibilidad <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></button>
                            </div>


                            <hr class="mt-0" data-aos="fade-up" data-aos-delay="700">

                            <div class="<?php if ($availability_status == 'available') { echo ""; } else { echo "d-none"; } ?>">

                                <div class="reservation_offer_checkbox">
                                    <h4 class="input_title" data-aos="fade-up" data-aos-delay="800">Elija opciones adicionales</h4>
                                    <div class="row">
                                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="900">

                                            <?php if(!empty($extra_services)): ?>
                                                <?php foreach($extra_services as $row): ?>
                                                    <div class="checkbox_input">
                                                        <label for="extra_srv_<?php echo $row['id']; ?>">
                                                            <input type="checkbox" id="extra_srv_<?php echo $row['id']; ?>" name="res_extra_srv[]" <?php if($row['obligatorio'] == 1){ echo "checked";}; ?> value="<?php echo $row['id'].'|'.$row['detalles'].'|'.$row['precio']; ?>">
                                                            <?php echo $row['detalles']; ?>
                                                            <?php echo $row['precio']; ?>/día
                                                        </label>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        </div>

                                    </div>
                                </div>




                                <div class="reservation_customer_details">

                                    <div data-aos="fade-up" data-aos-delay="100">
                                        <a class="terms_condition" href="#!"><i class="fas fa-info-circle mr-1"></i> Debe tener al menos 18 años para alquilar este vehículo</a>
                                    </div>

                                    <hr data-aos="fade-up" data-aos-delay="200">

                                    <div class="row align-items-center justify-content-lg-between">



                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="300">
                                            <button type="submit" value="submit" name="submit_form" id="submit_form" class="custom_btn bg_default_red text-uppercase">Continuar <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></button>
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