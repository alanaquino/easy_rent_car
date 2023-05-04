<?php

session_start();

if(isset($_SESSION['id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";

$sql = "SELECT * FROM `locations`";
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


<?php include('./controllers/insert_car.php'); ?>

<!-- header_section -->
<?php include('./admin-head.php'); ?>


<div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-4 mt-2">

            <div class="card text-bg-dark mb-3">
                <img src="./assets/img/banner.jpg" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <h1 class="mt-5">Agregar vehículo</h1>
                </div>
            </div>



            <div class="row g-5 ">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Your cart</span>
                        <span class="badge bg-primary rounded-pill">3</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Product name</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">$12</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Second product</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">$8</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Third item</h6>
                                <small class="text-muted">Brief description</small>
                            </div>
                            <span class="text-muted">$5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Promo code</h6>
                                <small>EXAMPLECODE</small>
                            </div>
                            <span class="text-success">−$5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (USD)</span>
                            <strong>$20</strong>
                        </li>
                    </ul>

                    <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Promo code">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                    </form>
                </div>
                    <div class="col-md-7 col-lg-8">



                        <form action="" method="post" enctype="multipart/form-data">
                          <div class="row g-3">

                            <?php echo $success_msg; ?>
                            <?php echo $email_exist; ?>

                            <?php echo $email_verify_err; ?>
                            <?php echo $email_verify_success; ?>


                              <div class="col-12">
                                  <label for="car_location" class="form-label">Sucursal</label>
                                  <select class="form-select" id="car_location" name="car_location" required>
                                      <?php foreach($data as $row){ ?>
                                          <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                      <?php } ?>
                                  </select>
                              </div>



                              <div class="col-12">
                                  <label for="foto_principal" class="form-label">foto_principal</label>
                                  <input type="file" class="form-control" id="foto_principal" name="foto_principal">
                                  <?php echo $Upload_Err; ?>
                              </div>

                              <div class="col-12">
                                  <label for="brand" class="form-label">Brand</label>
                                  <input type="text" class="form-control" id="brand" name="brand" required>
                              </div>


                            <div class="col-12">
                                <label for="vehicle_type" class="form-label">Vehicle Type</label>
                                <select class="form-select" id="vehicle_type" name="vehicle_type" required>
                                    <option value="">Select Vehicle Type</option>
                                    <option value="Sedan">Sedan</option>
                                    <option value="SUV">SUV</option>
                                    <option value="Sports Car">Sports Car</option>
                                </select>
                            </div>

                              <div class="col-12">
                                  <label for="model" class="form-label">Model</label>
                                  <input type="text" class="form-control" id="model" name="model" required>
                              </div>
                              <div class="col-12">
                                  <label for="level" class="form-label">Level</label>
                                  <input type="text" class="form-control" id="level" name="level" required>
                              </div>
                              <div class="col-12">
                                  <label for="year" class="form-label">Year</label>
                                  <input type="number" class="form-control" id="year" name="year" required>
                              </div>
                              <div class="col-12">
                                  <label for="type" class="form-label">Type</label>
                                  <input type="text" class="form-control" id="type" name="type" required>
                              </div>
                              <div class="col-12">
                                  <label for="daily_price" class="form-label">Daily Price</label>
                                  <input type="number" class="form-control" id="daily_price" name="daily_price" required>
                              </div>

                              <div class="col-12">
                                  <label for="passengers" class="form-label">Passengers</label>
                                  <input type="number" class="form-control" id="passengers" name="passengers" required>
                              </div>
                              <div class="col-12">
                                  <label for="suitcase" class="form-label">Suitcase</label>
                                  <input type="number" class="form-control" id="suitcase" name="suitcase" required>
                              </div>
                              <div class="col-12">
                                  <label for="doors" class="form-label">Doors</label>
                                  <input type="number" class="form-control" id="doors" name="doors" required>
                              </div>


                              <div class="mb-3">
                                  <label for="fuel_type" class="form-label">Fuel Type</label>
                                  <select class="form-select" id="fuel_type" name="fuel_type" required>
                                      <option value="">Select Fuel Type</option>
                                      <option value="Gasolina">Gasolina</option>
                                      <option value="Diesel">Diesel</option>
                                  </select>
                              </div>

                              <div class="col-12">
                                  <label for="engine" class="form-label">Engine</label>
                                  <input type="text" class="form-control" id="engine" name="engine" required>
                              </div>

                              <div class="col-12 mb-3">
                                  <label for="options" class="form-label">Options</label>
                                  <textarea class="form-control" id="options" name="options" rows="2"></textarea>
                              </div>


                            <p>
                                Your personal data will be used in mapping with the vehicles you added to the website, to manage access to your account, and for other purposes described in our
                            </p>

                            <button type="submit" name="submit" id="submit" class="w-100 btn btn-primary btn-lg">
                                Registrate
                            </button>

                        </form>

                    </div>
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
