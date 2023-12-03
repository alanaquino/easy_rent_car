<?php

session_start();

if(isset($_SESSION['id']) =="") {
    header("Location: login.php");
}

// Database connection
include('config/db.php');

$customer_id_s = $_SESSION['id'];


$submit_allert = "";


if(isset($_POST['submit_form'])) {

    // Get the form data
    $customer_id 	    = $_POST['customer_id'];
    $car_selected_id 	= $_POST['car_selected'];
    $pickup_location 	= $_POST['pickup_location'];
    $pickup_date 		= $_POST['pickup_date'];
    $pickup_time 		= $_POST['pickup_time'];
    $return_location 	= $_POST['return_location'];
    $return_date 		= $_POST['return_date'];
    $return_time 		= $_POST['return_time'];
    $grand_total 		= $_POST['grand_total'];

    $extra_srvs 		    = $_POST['extra_srv'];


    // Insert the rental data into the rentals table
    $sql = "INSERT INTO rentals (customer_id, car_id, pickup_location_id, return_location_id, rental_start, rental_end, rental_start_time, rental_end_time, rental_status_id, total_price) 
					VALUES ('$customer_id', '$car_selected_id', '$pickup_location', '$return_location', '$pickup_date', '$return_date', '$pickup_time', '$return_time', 1, '$grand_total')";

    if ($connection->query($sql) === TRUE) {

        $rental_id = $connection->insert_id;

        // Insert the rental and service data into the customer_rentals and rental_extra_services tables
        $sql = "INSERT INTO customer_rentals (customer_id, rental_id) VALUES ('$customer_id', '$rental_id')";

        if ($connection->query($sql) === TRUE) {

            if (!empty($extra_srvs)) {

                foreach ($extra_srvs as $extra_srv) {

                    $sql = "INSERT INTO rental_extra_services (rental_id, services_id) VALUES ('$rental_id', '$extra_srv')";

                    if ($connection->query($sql) === TRUE) {

                        $submit_allert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
											¡Hemos recibido su reserva exisosamente! <a href='ver_reserva.php?id=".$rental_id."' class='alert-link'>Ver reserva aquí</a>
											<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
										  </div>";

                    } else {

                        echo "Error: " . $sql . "<br>" . $connection->error;
                    }
                }
            }

        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }

    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Get all the rentals
$sql = "SELECT rentals.id,
				   rentals.created_at, 
				   customers.id as id_cliente,
				   cars.id as id_vehiculo,
				   cars.brand,
				   cars.model,
				   cars.level,
				   cars.year,
				   cars.foto_principal, 
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
			INNER JOIN rental_statuses
				ON rentals.rental_status_id = rental_statuses.id
			WHERE customers.id = '{$customer_id_s}'
			ORDER BY `rentals`.`rental_end` DESC";

$result10 = $connection->query($sql);

if ($result10->num_rows > 0) {
    // output data of each row
    $rentals = array();
    while($row = $result10->fetch_array()) {
        $rentals[] = $row;
    }
} else {
    echo "falla en el query para buscar los datos";
}

// Get all the upcoming rentals
$sql = "SELECT rentals.id,
					   rentals.created_at, 
					   customers.id as id_cliente,
					   cars.id as id_vehiculo,
					   cars.brand,
					   cars.model,
					   cars.level,
					   cars.year,
					   cars.foto_principal, 
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
				INNER JOIN rental_statuses
					ON rentals.rental_status_id = rental_statuses.id
				WHERE customers.id = '{$customer_id_s}'
					AND rentals.rental_end >= CURDATE() 
					AND rentals.rental_status_id != 4
				ORDER BY rentals.rental_start ASC 
				LIMIT 1;";

$result11 = $connection->query($sql);

// check if there are any results
if ($result11->num_rows > 0) {
    // output data of each row
    while($row = $result11->fetch_assoc()) {

        $upc_reservations = "<a href='ver_reserva.php?id=". $row["id"] ."' role='button'>". $row["brand"]. " ".$row["model"]." ".$row["level"]." ". $row["year"] ."</a>";
    }
} else {
    $upc_reservations = "Aún no tiene reservas próximas";
}

// Close the database connection
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

?>


<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<?php
$title = "Account - Easy Rent Car Latinoamérica";
include('./head.php');
?>

<style>
    .modal-content {
        z-index: 1000; /* Adjust the z-index to bring it in front */
    }
</style>

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
                <h1 class="page_title text-white mb-0">Account</h1>
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
                        <h3 class="list_title mb_15">Cuenta:</h3>
                        <ul class="ul_li_block nav" role="tablist">
                            <li>
                                <a  href="account.php"><i class="fas fa-user"></i> <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?></a>
                            </li>
                            <li>
                                <a class="active" href="#history_tab"><i class="fas fa-file-alt"></i> Historial de Reservas</a>
                            </li>
                            <li>
                                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar sesión <img class="arrow" src="assets/images/icons/icon_02.png" alt="icon_not_found"></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                    <div class="account_tab_content tab-content">

                        <div id="history_tab" class="tab-pane active">
                            <div class="account_info_list" data-aos="fade-up" data-aos-delay="100">

                                <?php echo $submit_allert; ?>

                                <h3 class="list_title mb_30">Historial de reservas:</h3>
                                <ul class="ul_li_block clearfix mb-5">
                                    <li><span>Próximas reservas:</span> <?php echo $upc_reservations; ?> </li>
                                    <li><span>Total de reservas:</span> <?php echo count($rentals); ?></li>
                                </ul>

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Estado</th>
                                        <th>Vehículo</th>
                                        <th>rental_start</th>
                                        <th>rental_end</th>
                                        <th>Creado</th>
                                        <th>Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    // Check if $rentals is not empty before entering the loop
                                    if (!empty($rentals)) {
                                    foreach($rentals as $row){
                                        ?>

                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td><span class="badge badge-pill <?php if ($row['status'] == "Reserva cancelada") { echo "bg-danger"; } else { echo "bg-primary"; } ?> text-light"><?php echo $row['status']; ?></span><br>
                                                Hace <?php echo TimeAgo($row['updated_at'], date("Y-m-d H:i:s")); ?>
                                            </td>
                                            <td>
                                                <i class="fas fa-car"></i>
                                                <a href="details.php?id=<?php echo $row['id_vehiculo']; ?>" role="button">
                                                    <?php echo $row['brand'], " ",$row['model'], " ",$row['level'], " ",$row['year']; ?>
                                                </a>
                                            </td>
                                            <td>
                                                <i class="fas fa-calendar-week"></i> <?php echo date("d-m-Y", strtotime($row['rental_start'])); ?><br>
                                                <i class="fas fa-clock"></i> <?php echo $row['rental_start_time']; ?>
                                            </td>

                                            <td>
                                                <i class="fas fa-calendar-week"></i> <?php echo date("d-m-Y", strtotime($row['rental_end'])); ?><br>
                                                <i class="fas fa-clock"></i> <?php echo $row['rental_end_time']; ?>
                                            </td>
                                            <td>Hace <?php echo TimeAgo($row['created_at'], date("Y-m-d H:i:s")); ?></td>
                                            <td>

                                                <div class="d-grid gap-2">
                                                    <a class="btn btn-primary btn-sm btn-block" href="ver_reserva.php?id=<?php echo $row['id']; ?>" role="button">Ver</a>

                                                    <?php if ($row['status'] == "Reservado via web") { ?>

                                                        <?php if ($row['status'] != "Reserva cancelada"): ?>
                                                            <!-- Button trigger modal -->
                                                            <br>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $row['id']; ?>">
                                                                Cancelar
                                                            </button>
                                                        <?php endif; ?>

                                                    <?php } ?>

                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Cancelar reserva</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5>¿Estás seguro de que quieres cancelar esta reserva?</h5>
                                                        <form method="POST" action="">
                                                            <input type="hidden" name="status" value="7">
                                                            <input type="hidden" name="rental_id" value="<?php echo $row['id']; ?>">

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                                                                <button type="submit" class="btn btn-danger" name="update_status">Cancelar reserva</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                        }
                                    } else {
                                        // Display a message or take some other action if $rentals is empty
                                        echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <div class="feature_vehicle_item" data-aos="fade-up" data-aos-delay="100">
                                                <div class="alert alert-warning" role="alert">Aún no ha realizado reservas</div>
                                            </div>
                                          </div>';
                                    }
                                    ?>

                                    </tbody>
                                </table>

                                <a class="text_btn text-uppercase" href="cars.php"><span>Reservar un vehículo</span> <img src="assets/images/icons/icon_02.png" alt="icon_not_found"></a>
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