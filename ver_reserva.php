<?php

session_start();

if(isset($_SESSION['id']) =="") {
    header("Location: login.php");
}

// Database connection
include('config/db.php');



// Waits for the given Car ID
$view_rental_id = $_REQUEST['id'];

$sql = "SELECT rentals.id,
               rentals.created_at, 
               customers.firstname,
               customers.lastname,
               customers.email,
               customers.address,
               customers.phone,
               customers.licencia_id,
               cars.id as id_vehiculo,
               cars.vehicle_type,
               cars.brand,
               cars.model,
               cars.level,
               cars.year,
               cars.daily_price,
               cars.foto_principal, 
               car_details.doors,
               car_details.passengers,
               car_details.engine,
               car_details.options,
               rentals.rental_start, 
               rentals.rental_end, 
               rentals.rental_start_time,	
               rentals.rental_end_time,
               rental_statuses.name as status,
               rentals.updated_at
        FROM `rentals`
        INNER JOIN customers
            ON rentals.customer_id = customers.id
        INNER JOIN cars
            ON rentals.car_id = cars.id
        INNER JOIN car_details
            ON rentals.car_id = car_details.car_id
        INNER JOIN rental_statuses
            ON rentals.id = rental_statuses.id
        WHERE rentals.id = '{$view_rental_id}'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id=$row["id"];
        $created_at=$row["created_at"];
        $firstname=$row["firstname"];
        $lastname=$row["lastname"];
        $email=$row["email"];
        $address=$row["address"];
        $phone=$row["phone"];
        $licencia_id=$row["licencia_id"];
        $vehicle_type=$row["vehicle_type"];
        $brand=$row["brand"];
        $model=$row["model"];
        $level=$row["level"];
        $year=$row["year"];
        $id_vehiculo=$row["id_vehiculo"];
        $daily_price=$row["daily_price"];
        $passengers=$row["passengers"];
        $doors=$row["doors"];
        $engine=$row["engine"];
        $options=$row["options"];
        $foto_principal=$row["foto_principal"];
        $rental_start=$row["rental_start"];
        $rental_end=$row["rental_end"];
        $rental_start_time=$row["rental_start_time"];
        $rental_end_time=$row["rental_end_time"];
        $status=$row["status"];
        $updated_at=$row["updated_at"];
    }
} else {
    echo "falla en el query para buscar la reserva";
}

$sql = "SELECT extra_services.detalles,
               extra_services.precio
        FROM rental_extra_services
        INNER JOIN rentals
            ON rentals.id = rental_extra_services.rental_id
        INNER JOIN extra_services
            ON extra_services.id = rental_extra_services.services_id
        WHERE rentals.id = '{$view_rental_id}'";
$result2 = $connection->query($sql);

if ($result2->num_rows > 0) {
    // output data of each row
    $data = array();
    while($row = $result2->fetch_array()) {
        $data[] = $row;
    }
} else {
    echo "falla en el query para buscar los datos extra";
}


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
$title = "Account - Easy Rent Car Latinoamérica";
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
                <h1 class="page_title text-white mb-0">Reserva #<?php echo date('Y', strtotime($created_at)),$id; ?></h1>
            </div>
        </div>
        <div class="breadcrumb_nav clearfix" data-bg-color="#F2F2F2">
            <div class="container">
                <ul class="ul_li clearfix">
                    <li><a href="index.php">Home</a></li>
                    <li>Account</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- breadcrumb_section - end
    ================================================== -->



    <!-- account_section - start
        ================================================== -->
    <section class="account_section sec_ptb_100 clearfix">
        <div class="container">
            <div class="row justify-content-lg-between justify-content-md-center justify-content-sm-center">

                <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12">
                    <div class="account_tabs_menu clearfix" data-bg-color="#F2F2F2" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="list_title mb_15">Reservas:</h3>
                        <ul class="ul_li_block nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#admin_tab"><i class="fas fa-user"></i> Reserva #<?php echo date('Y', strtotime($created_at)),$id; ?></a>
                            </li>
                            <li>
                                <a href="reservas.php"><i class="fas fa-file-alt"></i> Historial de Reservas</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                    <div class="account_tab_content tab-content">

                        <div id="admin_tab" class="tab-pane active">

                            <div id="invoice">

                                <div class="card">
                                    <img src="admin/assets/img/banner.jpg" class="card-img-top" alt="...">
                                    <div class="card-img-overlay">
                                        <div class="col">
                                            <button type="button" class="btn btn-dark" id="printButton" onclick="print()"><i class="fa fa-print"></i> Print</button>
                                            <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3 mt-1">
                                            <div class="col">
                                                <h3 style="color: #dc3545;">RESERVA #<?php echo date('Y', strtotime($created_at)),$id; ?></h3>
                                            </div>
                                            <div class="col">
                                                <img src="../assets/images/logo/logo_02_2x.png" width="200" alt="">
                                            </div>
                                        </div>




                                        <div class=" mb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="text-gray-light">RESERVAR A:</div>
                                                    <h2 class="to"><?php echo $firstname, " ", $lastname; ?></h2>
                                                    <div class="address"><?php echo $address; ?></div>
                                                    <div class="email"><?php echo $email; ?></div>
                                                    <div class="email"><?php echo $licencia_id ?></div>
                                                    <p>Fecha: <?php echo date("d/m/Y", strtotime($created_at));  ?></p>
                                                </div>
                                                <div class="col">
                                                    <div class="col">
                                                        <div class="text-gray-light"><br> </div>
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

                                        <div class="mb-3">
                                            Renta del <span class="badge badge-primary"><?php echo date("d F, Y", strtotime($rental_start)); ?></span>
                                            al <span class="badge badge-primary"><?php echo date("d F, Y", strtotime($rental_end)); ?></span>
                                        </div>


                                        <table class="table table-bordered mb-5">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col" style="width: 50%">Descripción</th>
                                                <th scope="col">Precio / día</th>
                                                <th scope="col">Días</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr>
                                                <th scope="row">01</th>
                                                <td class="text-left">
                                                    <p> Renta de
                                                        <a href="details.php?id=<?php echo $id_vehiculo; ?>" role="button" style="text-decoration: none;">
                                                            <?php echo "".$brand." ".$model." ".$level." ".$year." "; ?>
                                                        </a>
                                                        <br> <?php echo $doors; ?> puertas, <?php echo $passengers; ?> pasajeros, motor <?php echo $engine; ?>,</li>
                                                        </strong> <?php echo $options; ?>

                                                    </p>
                                                </td>
                                                <td class="unit">US $<?php echo $daily_price; ?></td>
                                                <td class="qty"><?php echo $dateDiff = dateDiff($rental_start, $rental_end); ?></td>
                                                <td class="total">US $<?php echo $daily_price*$dateDiff; ?></td>
                                            </tr>

                                            <?php  $precio_add = $daily_price; $num = 2; ?>

                                            <?php
                                            if(!empty($data)){
                                                foreach($data as $row){
                                                    ?>
                                                    <tr>
                                                        <th scope="row">0<?php echo $num++?></th>
                                                        <td class="text-left">
                                                            <p><?php echo $row['detalles']; ?></p>
                                                        </td>
                                                        <td class="unit">US $<?php echo $row['precio']; ?></td>
                                                        <td class="qty"><?php echo $dateDiff; ?></td>
                                                        <td class="total">US $<?php echo $row['precio']*$dateDiff; ?></td>
                                                    </tr>
                                                    <?php $precio_add += $row['precio']; ?>
                                                    <?php
                                                }
                                            }
                                            ?>


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
                                            </tr>
                                            </tfoot>
                                        </table>

                                        <div class="alert alert-warning" role="alert">
                                            <i class="fas fa-info-circle mr-1"></i> Se realizará un cargo por financiamiento del 1.5 % ssi paga después de 30 días.
                                        </div>

                                        <div class="alert alert-dark" role="alert">
                                            <i class="fas fa-info-circle mr-1"></i> La factura se creó en una computadora y es válida sin la firma y el sello.
                                        </div>


                                    </div>
                                </div>



                            </div>

                        </div>




                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- account_section - end
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