<?php

session_start();

if(isset($_SESSION['id']) =="") {
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
            <h1 class="mt-4">Vehículos</h1>
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
                            <th>id</th>
                            <th>vehicle_type</th>
                            <th>brand</th>
                            <th>model</th>
                            <th>level</th>
                            <th>year</th>
                            <th>type</th>
                            <th>foto_principal</th>
                            <th>daily_price</th>
                            <th>passengers</th>
                            <th>suitcase</th>
                            <th>doors</th>
                            <th>engine</th>
                            <th>fuel_type</th>
                            <th>options</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($data as $row){ ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['vehicle_type']; ?></td>
                                <td><?php echo $row['brand']; ?></td>
                                <td><?php echo $row['model']; ?></td>
                                <td><?php echo $row['level']; ?></td>
                                <td><?php echo $row['year']; ?></td>
                                <td><?php echo $row['type']; ?></td>
                                <td><?php echo $row['foto_principal']; ?></td>
                                <td><?php echo $row['daily_price']; ?></td>
                                <td><?php echo $row['passengers']; ?></td>
                                <td><?php echo $row['suitcase']; ?></td>
                                <td><?php echo $row['doors']; ?></td>
                                <td><?php echo $row['engine']; ?></td>
                                <td><?php echo $row['fuel_type']; ?></td>
                                <td><?php echo $row['options']; ?></td>
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
