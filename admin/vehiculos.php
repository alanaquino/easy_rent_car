<?php

session_start();

if(isset($_SESSION['admin_id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";


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
            car_details.options
        FROM cars
        INNER JOIN car_details
            ON cars.id = car_details.car_id";
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

?>



<!-- header_section -->
<?php include('./admin-head.php'); ?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="card text-bg-dark mt-3 mb-3">
                <img src="./assets/img/banner.jpg" class="card-img" alt="banner">
                <div class="card-img-overlay">
                    <h1 class="mt-5">Vehículos</h1>
                </div>
            </div>



            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple" class="row-border">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Vehículo</th>
                            <th>Año</th>
                            <th>Tipo</th>
                            <th>Motor</th>
                            <th>Combustible</th>
                            <th>Características</th>
                            <th>Acciones</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($data as $row){ ?>

                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><span class="badge rounded-pill bg-primary"><?php echo $row['vehicle_type']; ?></span></td>
                                <td><?php echo $row['brand'], " ", $row['model'], " ", $row['level']; ?></td>
                                <td><?php echo $row['year']; ?></td>
                                <td><?php echo $row['type']; ?></td>
                                <td><?php echo $row['engine']; ?></td>
                                <td><?php echo $row['fuel_type']; ?></td>
                                <td><?php echo $row['options']; ?></td>
                                <td>
                                    <div class="d-grid gap-2">
                                        <a class="btn btn-primary btn-sm" href="vehiculo.php?id=<?php echo $row['id']; ?>" role="button">Ver</a>
                                        <a class="btn btn-warning btn-sm" href="editar_vehiculo.php?id=<?php echo $row['id']; ?>" role="button">Editar</a>
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
