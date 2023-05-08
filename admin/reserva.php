<?php

session_start();

if(isset($_SESSION['id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";


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
               rentals.updated_at
        FROM `rentals`
        INNER JOIN customers
            ON rentals.customer_id = customers.id
        INNER JOIN cars
            ON rentals.car_id = cars.id
        INNER JOIN car_details
            ON rentals.car_id = car_details.car_id
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
        $updated_at=$row["updated_at"];
    }
} else {
    echo "falla en el query para buscar las reservas";
}


$sql = "SELECT id, tipo_pago, monto_pago, fecha_pago
        FROM rental_pagos
        WHERE rental_id = '{$view_rental_id}'";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $pago_id=$row["id"];
        $tipo_pago=$row["tipo_pago"];
        $monto_pago=$row["monto_pago"];
        $fecha_pago=$row["fecha_pago"];
    }
} else {
    $error_msg = "No se ha registrado ningun pago para esta reserva";
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
    $error_msg2 = "No se ha registrado ningun servicio extra para esta reserva";
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


<!-- header_section -->
<?php include('./admin-head.php'); ?>

<link href="css/invoice.css" rel="stylesheet" />


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">


            <div class="container mt-4">
                <div class="card">
                    <div class="card-body">
                        <div id="invoice">
                            <div class="toolbar d-print-none">
                                <div class="text-end">
                                    <button type="button" class="btn btn-dark" id="printButton" onclick="print()"><i class="fa fa-print"></i> Print</button>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                                </div>


                            </div>
                            <div class="invoice overflow-auto printTable">
                                <div style="min-width: 600px">
                                    <header>
                                        <div class="row">

                                            <h3 class="invoice-id" style="color: #dc3545;">FACTURA #<?php echo date('Y', strtotime($created_at)),$id; ?></h3>
                                            <div class="date">Fecha: <?php echo date("d/m/Y", strtotime($created_at));  ?></div>

                                            <div class="col invoice-to mt-5">
                                                <div class="text-gray-light">FACTURADO A:</div>
                                                <h2 class="to"><?php echo $firstname, " ", $lastname; ?></h2>
                                                <div class="address"><?php echo $address; ?></div>
                                                <div class="email"><?php echo $email; ?></div>
                                                <div class="email"><?php echo $licencia_id ?></div>
                                            </div>

                                            <div class="col invoice-details">
                                                <a href="javascript:;" class="mb-5">
                                                    <img src="../assets/images/logo/logo_02_2x.png" width="200" alt="">
                                                </a>
                                                <br><br>
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

                                    </header>
                                    <main>


                                        <table>
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-left">DESCRIPCIÓN</th>
                                                <th class="text-right">PRECIO / DÍA</th>
                                                <th class="text-right">DÍAS</th>
                                                <th class="text-right">TOTAL</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr>
                                                <td class="no">01</td>
                                                <td class="text-left">
                                                    <h3> Renta de
                                                        <a href="vehiculo.php?id=<?php echo $id_vehiculo; ?>" role="button" style="text-decoration: none;">
                                                            <?php echo "".$brand." ".$model." ".$level." ".$year." "; ?>
                                                        </a>
                                                        <br> <?php echo $doors; ?> puertas, <?php echo $passengers; ?> pasajeros, motor <?php echo $engine; ?>,</li>
                                                        </strong> <?php echo $options; ?>

                                                    </h3>
                                                </td>
                                                <td class="unit">US $<?php echo intval($daily_price); ?></td>
                                                <td class="qty"><?php echo $dateDiff = dateDiff($rental_start, $rental_end); ?></td>
                                                <td class="total">US $<?php echo $daily_price*$dateDiff; ?></td>
                                            </tr>

                                        <?php  $precio_add = $daily_price; $num = 2; ?>

                                            <?php
                                            if(!empty($data)){
                                                foreach($data as $row){
                                                    ?>
                                                    <tr>
                                                        <td class="no">0<?php echo $num++; ?></td>
                                                        <td class="text-left">
                                                            <h3><?php echo $row['detalles']; ?></h3>
                                                        </td>
                                                        <td class="unit">US $<?php echo intval($row['precio']); ?></td>
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
                                        <div class="thanks">Thank you!</div>

                                        <?php if (isset($error_msg2)): ?>
                                            <div class="alert alert-warning"><?php echo $error_msg2; ?></div>
                                        <?php endif; ?>

                                        <?php if (isset($error_msg)): ?>
                                            <div class="alert alert-danger"><?php echo $error_msg; ?></div>
                                        <?php endif; ?>

                                        <div class="notices">
                                            <div>NOTICE:</div>
                                            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                                        </div>
                                    </main>
                                    <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                                </div>
                                <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </main>


    <footer class="py-4 bg-light mt-auto d-print-none">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Easy Rent Car 2023</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>




</div>

<!-- header_section -->
<?php include('./admin-script.php'); ?>


</body>
</html>
