<?php

session_start();

if(isset($_SESSION['id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";


$sql = "SELECT rentals.id,
               rentals.created_at, 
               customers.firstname,
               customers.lastname,
               cars.vehicle_type,
               cars.brand,
               cars.model,
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
        $timeCalc = intval($timeCalc/60/60/24/30/12) . " years ago";
    }else if ($timeCalc >= (60*60*24*30*12)){
        $timeCalc = intval($timeCalc/60/60/24/30/12) . " year ago";
    }else if ($timeCalc >= (60*60*24*30*2)){
        $timeCalc = intval($timeCalc/60/60/24/30) . " months ago";
    }else if ($timeCalc >= (60*60*24*30)){
        $timeCalc = intval($timeCalc/60/60/24/30) . " month ago";
    }else if ($timeCalc >= (60*60*24*2)){
        $timeCalc = intval($timeCalc/60/60/24) . " days ago";
    }else if ($timeCalc >= (60*60*24)){
        $timeCalc = " Yesterday";
    }else if ($timeCalc >= (60*60*2)){
        $timeCalc = intval($timeCalc/60/60) . " horas";
    }else if ($timeCalc >= (60*60)){
        $timeCalc = intval($timeCalc/60/60) . " hour ago";
    }else if ($timeCalc >= 60*2){
        $timeCalc = intval($timeCalc/60) . " minutes ago";
    }else if ($timeCalc >= 60){
        $timeCalc = intval($timeCalc/60) . " minute ago";
    }else if ($timeCalc > 0){
        $timeCalc .= " seconds ago";
    }
    return $timeCalc;
}

?>



<!-- header_section -->
<?php include('./admin-head.php'); ?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Reservas</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active"></li>
            </ol>


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Creado</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Tipo de vehículo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>rental_start</th>
                            <th>rental_start_time</th>
                            <th>rental_end</th>
                            <th>rental_end_time</th>
                            <th>updated_at</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($data as $row){ ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>Hace <?php echo TimeAgo($row['created_at'], date("Y-m-d H:i:s")); ?></td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><?php echo $row['vehicle_type']; ?></td>
                                <td><?php echo $row['brand']; ?></td>
                                <td><?php echo $row['model']; ?></td>
                                <td><?php echo $row['rental_start']; ?></td>
                                <td><?php echo $row['rental_start_time']; ?></td>
                                <td><?php echo $row['rental_end']; ?></td>
                                <td><?php echo $row['rental_end_time']; ?></td>
                                <td><?php echo $row['updated_at']; ?></td>
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
