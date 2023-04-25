<?php

session_start();

if(isset($_SESSION['id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";

// Waits for the given Car ID
$view_car_id = $_REQUEST['id'];

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
            cars.updated_at,
            car_details.passengers, 
            car_details.suitcase, 
            car_details.doors, 
            car_details.engine, 
            car_details.fuel_type, 
            car_details.options
        FROM cars
        INNER JOIN car_details
            ON cars.id = car_details.car_id
        WHERE cars.id = 1";
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
        <div class="container-fluid px-4" >


            <div class="card-body">

                <?php foreach($data as $row){ ?>



                    <div class="row g-0 mt-4 mb-5 justify-content-center align-items-center">

                        <div class="card" style="width: 40rem;">
                            <img src="../uploads/<?php echo $row['foto_principal']; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <span class="badge bg-primary"><?php echo $row['vehicle_type']; ?></span>
                                <h5 class="card-title"><?php echo "".$row['brand']." ".$row['model']." ".$row['level']." ".$row['year']." "; ?></h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                <p>
                                    <b>Pasajeros:</b> <?php echo $row['passengers']; ?><br>
                                    <b>Maletas:</b> <?php echo $row['suitcase']; ?><br>
                                    <b>Puertas:</b> <?php echo $row['doors']; ?><br>
                                    <b>Motor:</b> <?php echo $row['engine']; ?><br>
                                    <b>Tipo de combustible:</b> <?php echo $row['fuel_type']; ?><br>
                                    <b>Opciones:</b> <?php echo $row['options']; ?><br>
                                </p>

                                <h5>USD $<?php echo $row['daily_price']; ?>/día</h5>


                                <p class="card-text mt-2"><small class="text-muted">Last updated <?php echo $row['updated_at']; ?></small></p>
                            </div>
                            <div class="card-img-overlay text-end">
                                <a href="#" class="btn btn-warning">Editar</a>
                            </div>
                        </div>

                    </div>

                <?php } ?>

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
