<?php

session_start();

if(isset($_SESSION['id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";


$sql = "SELECT rentals.id,
               rentals.created_at, 
               customers.id as id_cliente,
               customers.firstname,
               customers.lastname,
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
            ON rentals.id = rental_statuses.id";
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

            <div class="card text-bg-dark mt-3 mb-3">
                <img src="./assets/img/banner.jpg" class="card-img" alt="banner">
                <div class="card-img-overlay">
                    <h1 class="mt-5">Reservas</h1>
                </div>
            </div>


            <div class="card mb-4">

                <div class="card-body">
                    <table id="datatablesSimple" class="hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Cliente</th>
                            <th>Vehículo</th>
                            <th>rental_start</th>
                            <th>rental_end</th>
                            <th>Creado</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($data as $row){ ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td>
                                    <span class="badge bg-primary"><?php echo $row['status']; ?></span><br>
                                    Hace <?php echo TimeAgo($row['updated_at'], date("Y-m-d H:i:s")); ?>
                                </td>
                                <td>
                                    <i class="fas fa-user-circle"></i>
                                    <a href="cliente.php?id=<?php echo $row['id_cliente']; ?>" role="button">
                                        <?php echo $row['firstname'], " ", $row['lastname']; ?>
                                    </a>

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
                                        <a class="btn btn-primary btn-sm" href="reserva.php?id=<?php echo $row['id']; ?>" role="button">Ver</a>
                                        <a class="btn btn-warning btn-sm" href="editar_reservs.php?id=<?php echo $row['id']; ?>" role="button">Editar</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
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
