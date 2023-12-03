<?php

session_start();

if(isset($_SESSION['admin_id']) =="") {
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
        WHERE cars.id = '{$view_car_id}'";
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

            <?php foreach($data as $row){ ?>

                <div class="mt-3 g-4 ">




                        <section>
                            <div >

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card mb-4">
                                            <div class="card-body text-center">

                                                <img src="https://cdn.dribbble.com/users/417470/screenshots/5401056/dribbble_shot.gif" alt="avatar"
                                                     class="rounded-circle img-fluid" style="width: 300px;">

                                                <h5 class="my-3"><?php echo "".$row['brand']." ".$row['model']." ".$row['level']." ".$row['year']." "; ?></h5>
                                                <h5 class="text-muted mb-4">USD $<?php echo $row['daily_price']; ?> x día</h5>

                                                <div class="d-flex justify-content-center mb-2">
                                                    <button type="button" class="btn btn-danger">Editar</button>
                                                    <button type="button" class="btn btn-outline-danger ms-1">Desactivar</button>
                                                </div>

                                                <p class="text-muted mt-3">Actualizado el <?php echo $row['updated_at']; ?></p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-lg-8">
                                        <div class="card mb-4">


                                            <img src="../uploads/<?php echo $row['foto_principal']; ?>" class="w-100"  style="width: 300px; height: 320px; object-fit: cover;">
                                            <div class="card-body">
                                                <span class="badge bg-primary"><?php echo $row['vehicle_type']; ?></span>
                                                <h3 class="card-title"><?php echo "".$row['brand']." ".$row['model']." ".$row['level']." ".$row['year']." "; ?></h3>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                                <p>
                                                    <b>Pasajeros:</b> <?php echo $row['passengers']; ?><br>
                                                    <b>Maletas:</b> <?php echo $row['suitcase']; ?><br>
                                                    <b>Puertas:</b> <?php echo $row['doors']; ?><br>
                                                    <b>Motor:</b> <?php echo $row['engine']; ?><br>
                                                    <b>Tipo de combustible:</b> <?php echo $row['fuel_type']; ?><br>
                                                    <b>Opciones:</b> <?php echo $row['options']; ?><br>
                                                </p>

                                                <p class="card-text mt-2"><small class="text-muted">Last updated <?php echo $row['updated_at']; ?></small></p>
                                            </div>



                                        </div>

                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>




            <?php } ?>





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
