<?php

session_start();

if(isset($_SESSION['admin_id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";

// Waits for the given Car ID
$view_customer_id = $_REQUEST['id'];

$sql = "SELECT * FROM `customers` WHERE id = '{$view_customer_id}'";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id =  $row['id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $nacionalidad = $row['nacionalidad'];
        $licencia_id = $row['licencia_id'];
        $address = $row['address'];
        $created_at = $row['created_at'];
        $updated_at = $row['updated_at'];
    }
} else {
    echo "falla en el query para buscar los CLIENTES";
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
			WHERE customers.id = '{$view_customer_id}'
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



<!-- header_section -->
<?php include('./admin-head.php'); ?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">



            <div class="mb-4">

                <section>
                    <div>

                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <img src="https://cliply.co/wp-content/uploads/2020/08/442008112_GLANCING_AVATAR_3D_400px.gif" alt="avatar"
                                             class="rounded-circle img-fluid" style="width: 400px;">
                                        <h5 class=""><?php echo $firstname, " ", $lastname; ?></h5>
                                        <p class="text-muted mb-1"><?php echo $licencia_id; ?></p>
                                        <p class="text-muted mb-4">Cuenta creada hace <?php echo TimeAgo($created_at, date("Y-m-d H:i:s")); ?></p>
                                    </div>
                                </div>
                                <div class="card mb-4 mb-lg-0">
                                    <div class="card-body p-0">
                                        <ul class="list-group list-group-flush rounded-3">
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="fas fa-globe fa-lg text-warning"></i>
                                                <p class="mb-0">https://mdbootstrap.com</p>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                                                <p class="mb-0">mdbootstrap</p>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                                <p class="mb-0">@mdbootstrap</p>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                                <p class="mb-0">mdbootstrap</p>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                                <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                                <p class="mb-0">mdbootstrap</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Full Name</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $firstname, " ", $lastname; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $email; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Nacionalidad</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $nacionalidad; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Licencia</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $licencia_id; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Mobile</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $phone; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Address</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $address; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="card mb-4 mb-md-0">
                                            <div class="card-body">
                                                <p class="mb-4"><span class="text-primary font-italic me-1">Reservas</span>realizadas por <?php echo $firstname; ?>
                                                </p>
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
                                                                <a href="vehiculo.php?id=<?php echo $row['id_vehiculo']; ?>" role="button">
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
                                                                    <a class="btn btn-primary btn-sm  btn-block" href="reserva.php?id=<?php echo $row['id']; ?>" role="button">Ver</a>
                                                                    <?php

                                                                    if ($row['status'] == "Reservado via web") {
                                                                        echo "<a class='btn btn-danger btn-sm  btn-block' href='ver_reserva.php?id=". $row['id'] ."' role='button'>Cancelar</a>";
                                                                    }

                                                                    ?>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    } else {
                                                        // Display a message or take some other action if $rentals is empty
                                                        echo '<tr><td colspan="7">No hay información de alquileres disponible.</td></tr>';
                                                    }
                                                    ?>

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </main>


    <footer class="py-4 bg-light mt-auto">
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
