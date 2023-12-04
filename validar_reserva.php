<?php
// Inicia la sesión para manejar datos de sesión
session_start();

// Verifica si la variable de sesión 'email' está seteada, si no redirige a la página de login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

// Se incluye la conexión a la base de datos desde el archivo 'db.php'
include('config/db.php');

// Obtiene el ID del coche seleccionado del formulario anterior
$view_car_id = $_POST['val_car_selected'];

// Consulta para obtener información detallada del coche seleccionado
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
        INNER JOIN car_details ON cars.id = car_details.car_id
        INNER JOIN car_locations ON cars.id = car_locations.car_id
        INNER JOIN locations ON car_locations.location_id = locations.id
        WHERE cars.id = '{$view_car_id}'";
$result = $connection->query($sql);

// Verifica si hay resultados en la consulta y asigna valores a variables
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        // Asigna los valores obtenidos a variables
        $brand = $row["brand"];
        $model = $row["model"];
        $level = $row["level"];
        $year = $row["year"];
        $type = $row["type"];
        $foto_principal = $row["foto_principal"];
        $daily_price = $row["daily_price"];
        $passengers = $row["passengers"];
        $suitcase = $row["suitcase"];
        $doors = $row["doors"];
        $engine = $row["engine"];
        $fuel_type = $row["fuel_type"];
        $options = $row["options"];
        $location_name = $row["name"];
    }
} else {
    echo "falla en el query para buscar los datos del vehículo";
}

// Obtiene el ID del cliente desde la sesión
$id_client = $_SESSION['id'];

// Consulta para obtener información del cliente actual
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

// Verifica si hay resultados en la consulta y asigna valores a variables del cliente
if ($result4->num_rows > 0) {
    while($row = $result4->fetch_assoc()) {
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $nacionalidad = $row['nacionalidad'];
        $licencia_id = $row['licencia_id'];
        $address = $row['address'];
    }
} else {
    echo "falla en el query para buscar los datos del cliente";
}

// Consulta para obtener información sobre servicios extra
$sql = "SELECT * FROM `extra_services` ORDER BY obligatorio DESC,  tipo ASC";
$result3 = $connection->query($sql);

// Verifica si hay resultados en la consulta y almacena los servicios extra en un arreglo
if ($result3->num_rows > 0) {
    $extra_services = array();
    while($row = $result3->fetch_array()) {
        $extra_services[] = $row;
    }
} else {
    echo "falla en el query para buscar extra_services";
}

// Consulta para obtener información de todas las ubicaciones
$sql = "SELECT * FROM locations";
$result2 = $connection->query($sql);

// Verifica si hay resultados en la consulta y almacena las ubicaciones en un arreglo
if ($result2->num_rows > 0) {
    $locations_name = array();
    while($row = $result2->fetch_array()) {
        $locations_name[] = $row;
    }
} else {
    echo "falla en el query para buscar las ubicaciones";
}

// Cierra la conexión a la base de datos
$connection->close();


// Get day from string in spanish PHP
setlocale(LC_ALL,"es_ES");

// Función para calcular el tiempo transcurrido
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
// Calcula la diferencia de tiempo entre dos fechas
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
                </div>


                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                    <div class="reservation_form">

                        <form action="reservas.php" method="post">

                            <input type="text" name="car_selected" class="d-none" value="<?php echo $_POST['val_car_selected']; ?>" readonly>
                            <input type="text" name="customer_id" class="d-none" value="<?php echo $id_client; ?>" readonly>



                            <div class="row">
                                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 d-none" style="z-index: 500;">

                                    <div class="form_item" data-aos="fade-up" data-aos-delay="100">
                                        <h4 class="input_title">Sucursal de recogida</h4>
                                        <input class="form-control-plaintext" name="pickup_location" type="text" value="<?php echo $_POST['res_pickup_location']; ?>" readonly>
                                    </div>


                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 d-none">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="200">
                                        <h4 class="input_title">Fecha de recogida</h4>
                                        <input class="form-control-plaintext" name="pickup_date" type="text"  value="<?php echo $_POST['res_pickup_date']; ?>" aria-label="Disabled input example"  readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 d-none">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="300">
                                        <h4 class="input_title">Hora</h4>
                                        <input class="form-control-plaintext" name="pickup_time" type="text" value="<?php echo $_POST['res_pickup_time']; ?>" aria-label="Disabled input example"  readonly>
                                    </div>
                                </div>

                                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 d-none" style="z-index: 500;">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="100">
                                        <h4 class="input_title">Sucursal de entrega</h4>
                                        <input class="form-control-plaintext" name="return_location" type="text" value="<?php echo $_POST['res_dropoff_location']; ?>" aria-label="Disabled input example"  readonly>

                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 d-none">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="500">
                                        <h4 class="input_title">Fecha de entrega</h4>
                                        <input class="form-control-plaintext" name="return_date" type="text" value="<?php echo $_POST['res_return_date']; ?>" aria-label="Disabled input example"  readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 d-none">
                                    <div class="form_item" data-aos="fade-up" data-aos-delay="600">
                                        <h4 class="input_title">Hora</h4>
                                        <input class="form-control-plaintext" name="return_time" type="text" value="<?php echo $_POST['res_return_time']; ?>" aria-label="Disabled input example"  readonly>
                                    </div>
                                </div>
                            </div>


                            <hr class="mt-0" data-aos="fade-up" data-aos-delay="700">

                            <!-- Información del cliente aquí -->

                            <div class="container mb-5">
                                <div class="row">
                                    <div class="col">
                                        <div class="text-gray-light">RESERVAR A:</div>
                                        <h2 class="to"><?php echo $firstname, " ", $lastname; ?></h2>
                                        <div class="address"><?php echo $address; ?></div>
                                        <div class="email"><?php echo $email; ?></div>
                                        <div class="email"><?php echo $licencia_id ?></div>
                                        <div class="email"><?php echo $location_name ?></div>
                                    </div>
                                    <div class="col">
                                        <a href="javascript:;" class="mb-3">
                                            <img src="../assets/images/logo/logo_02_2x.png" width="200" alt="">
                                        </a>
                                        <div class="col">
                                            <h2 class="name">
                                                Easy Rent Car
                                            </h2>
                                            <div>455 Foggy Heights, AZ 85004, US</div>
                                            <div>(123) 456-789</div>
                                            <div>info@easyrentcar.com</div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div>
                                <div class="reservation_offer_checkbox d-none">
                                    <h4 class="input_title" data-aos="fade-up" data-aos-delay="800">Opciones adicionales</h4>
                                    <div class="row">
                                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="900">



                                            <?php
                                            // Función para mostrar datos del checkbox en el preview
                                            foreach($_POST['res_extra_srv'] as $extra_srv) {
                                                // Extract the checkbox values
                                                $service_values = explode('|', $extra_srv);
                                                $service_id = $service_values[0];
                                                $service_details = $service_values[1];
                                                $service_price = $service_values[2];
                                                ?>

                                                <div class="checkbox_input">
                                                    <!-- Create a label with a disabled checkbox -->
                                                    <label for="extra_srv">
                                                        <input type="checkbox" id="extra_srv_<?php echo $service_id ?>" name="extra_srv[]" value="<?php echo $service_id; ?>" checked readonly> <?php echo $service_details; ?>
                                                    </label>
                                                </div>

                                            <?php } ?>

                                        </div>

                                    </div>
                                </div>




                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" style="width: 50%">Descripción</th>
                                        <th scope="col">Precio x día</th>
                                        <th scope="col">Días</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <th scope="row">01</th>
                                        <td>
                                            Alquiler en <?php echo $location_name; ?>
                                            <a href="details.php?id=<?php echo $view_car_id; ?>" role="button" style="text-decoration: none;">
                                                <?php echo "".$brand." ".$model." ".$level." ".$year." "; ?>
                                            </a> <br>
                                             Del <span class="badge badge-primary"><?php echo date("d F", strtotime($_POST['res_pickup_date'])); ?></span>
                                              al <span class="badge badge-primary"><?php echo date("d F, Y", strtotime($_POST['res_return_date'])); ?></span>
                                        </td>
                                        <td>US $<?php echo intval($daily_price); ?></td>
                                        <td><?php echo $dateDiff = dateDiff($_POST['res_pickup_date'], $_POST['res_return_date']); ?></td>
                                        <td>US $<?php echo $daily_price*$dateDiff; ?></td>
                                    </tr>

                                    <?php  $precio_add = $daily_price; $num = 2; ?>

                                    <?php foreach($_POST['res_extra_srv'] as $extra_srv) {

                                        $service_values = explode('|', $extra_srv);
                                        $service_id = $service_values[0];
                                        $service_details = $service_values[1];
                                        $service_price = $service_values[2];

                                        ?>
                                        <tr>
                                            <th scope="row">0<?php echo $num++?></th>
                                            <td class="text-left">
                                                <p><?php echo $service_details; ?></p>
                                            </td>
                                            <td class="unit">US $<?php echo $service_price; ?></td>
                                            <td class="qty"><?php echo $dateDiff ?></td>
                                            <td class="total">US $<?php echo $service_price*$dateDiff; ?></td>
                                        </tr>

                                        <?php  $precio_add += $service_price; ?>

                                    <?php } ?>


                                    </tbody>


                                    <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>US $<?php echo $precio_add*$dateDiff; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TAX 18%</td>
                                        <td>US $<?php echo ($precio_add*$dateDiff)*0.18; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td>US $<?php echo ($precio_total = $precio_add * $dateDiff)*1.18; ?></td>
                                        <input type="text" name="grand_total" class="d-none" value="<?php echo ($precio_total = $precio_add * $dateDiff)*1.18; ?>" readonly>
                                    </tr>
                                    </tfoot>


                                </table>




                                <div class="reservation_customer_details mt-5">

                                    <div class="alert alert-info" role="alert">
                                        <i class="fas fa-info-circle mr-1"></i> PAGO EN OFICINA: Pagarás en el mostrador el día de la recogida.
                                    </div>

                                    <div class="alert alert-warning" role="alert">
                                        <i class="fas fa-info-circle mr-1"></i> Se realizará un cargo por financiamiento del 1.5 % ssi paga después de 30 días.
                                    </div>

                                    <div class="alert alert-dark" role="alert">
                                        <i class="fas fa-info-circle mr-1"></i> Debe tener al menos 18 años para alquilar este vehículo
                                    </div>



                                    <div class="mt-5" data-aos="fade-up" data-aos-delay="100">
                                        <a class="terms_condition" href="#!"></a>
                                    </div>

                                    <hr data-aos="fade-up" data-aos-delay="200">

                                    <div class="row align-items-center justify-content-lg-between">

                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="200">
                                            <div class="checkbox_input mb-0">
                                                <label for="accept"><input type="checkbox" id="accept"> Acepto toda la información.</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12" data-aos="fade-up" data-aos-delay="300">
                                            <button type="submit" name="submit_form" id="submit_form" class="custom_btn bg_default_red text-uppercase">Reservar ahora <img src="assets/images/icons/icon_01.png" alt="icon_not_found"></button>
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