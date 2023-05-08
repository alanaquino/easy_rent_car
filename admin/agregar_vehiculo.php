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

include('./controllers/insert_car.php');

?>


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

                    <div class="card mb-4 mt-4">
                        <div class="card-body text-center">

                            <img src="https://assets-global.website-files.com/607ee530dd59915d46108839/607ee530dd59919fd6108e14_1_spin-jeep.gif" alt="avatar"
                                 class="img-fluid" class="w-100"  style="width: 300px; height: 300px; object-fit: cover;">

                            <p class="text-muted mt-3"> Agrega vehículos nuevos fácilmente a tu flotilla, y gestiona los existentes, a través de esta sección.</p>

                        </div>
                    </div>
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
                                  <label for="foto_principal" class="form-label">Foto principal</label>
                                  <input type="file" class="form-control form-control-lg mb-1" id="foto_principal" name="foto_principal">
                                  <?php echo $Upload_Err; ?>
                              </div>

                              <div class="col-12">
                                  <label for="vehicle_type" class="form-label">Tipo de vehículo</label>
                                  <select class="form-select" id="vehicle_type" name="vehicle_type" required>
                                      <option data-display="Tipo de vehículo" selected disabled>Seleccione una opción</option>
                                      <option value="Carro">Carro</option>
                                      <option value="Camioneta">Camioneta</option>
                                      <option value="Minivan">Minivan</option>
                                  </select>
                              </div>

                              <div class="col-12">
                                  <label for="brand" class="form-label">Marca del vehículo</label>
                                  <select class="form-select" id="brand" name="brand" required>
                                      <option data-display="Tipo de vehículo" selected disabled>Seleccione una opción</option>
                                      <option value="Acura">Acura</option>
                                      <option value="Audi">Audi</option>
                                      <option value="BMW">BMW</option>
                                      <option value="Chevrolet">Chevrolet</option>
                                      <option value="Dodge">Dodge</option>
                                      <option value="Ford">Ford</option>
                                      <option value="Honda">Honda</option>
                                      <option value="Hyundai">Hyundai</option>
                                      <option value="Jeep">Jeep</option>
                                      <option value="Kia">Kia</option>
                                      <option value="Lexus">Lexus</option>
                                      <option value="Mazda">Mazda</option>
                                      <option value="Mercedes-Benz">Mercedes-Benz</option>
                                      <option value="Nissan">Nissan</option>
                                      <option value="Subaru">Subaru</option>
                                      <option value="Toyota">Toyota</option>
                                      <option value="Tesla">Tesla</option>
                                      <option value="Volkswagen">Volkswagen</option>
                                  </select>
                              </div>

                              <div class="col-12">
                                  <label for="model" class="form-label">Modelo de vehículo</label>
                                  <input type="text" class="form-control" id="model" name="model" placeholder="Cruze, Aveo, Trax, Orlando, Spark, Camaro..." required>
                              </div>
                              <div class="col-12">
                                  <label for="level" class="form-label">Nivel de equipamiento</label>
                                  <input type="text" class="form-control" id="level" name="level" placeholder="S, SV, SR, EX, SXT, SE, SX, SRT, GT..." required>
                              </div>
                              <div class="col-4">
                                  <label for="year" class="form-label">Año</label>
                                  <input type="text" class="form-control" id="datepicker" name="year" placeholder="2017, 2018, 2019..." required>
                              </div>
                              <div class="col-4">
                                  <label for="type" class="form-label">Tipo</label>
                                  <select class="form-select" id="type" name="type" required>
                                      <option data-display="Tipo de vehículo" selected disabled>Seleccione una opción</option>
                                      <option value="SUV">SUV</option>
                                      <option value="Hatchback">Hatchback</option>
                                      <option value="Sedan">Sedan</option>
                                      <option value="Camioneta">Camioneta</option>
                                      <option value="Minivan">Minivan</option>
                                      <option value="Crossover">Crossover</option>
                                      <option value="Coupe">Coupe</option>
                                      <option value="Convertible">Convertible</option>
                                      <option value="Deportivo">Deportivo</option>
                                  </select>
                              </div>
                              <div class="col-4">
                                  <label for="daily_price" class="form-label">Precio por día</label>
                                  <input type="number" class="form-control" id="daily_price" name="daily_price" placeholder="US $79.99" required>
                              </div>

                              <div class="col-4">
                                  <label for="passengers" class="form-label">Pasajeros</label>
                                  <input type="number" class="form-control" id="passengers" name="passengers" placeholder="2, 4, 5, 6..." required>
                              </div>
                              <div class="col-4">
                                  <label for="suitcase" class="form-label">Maletas</label>
                                  <input type="text" class="form-control" id="suitcase" name="suitcase" placeholder="1 Large, 2 Small" required>
                              </div>
                              <div class="col-4">
                                  <label for="doors" class="form-label">Puertas</label>
                                  <input type="number" class="form-control" id="doors" name="doors" placeholder="2, 4, 5, 6..." required>
                              </div>


                              <div class="mb-3">
                                  <label for="fuel_type" class="form-label">Tipo de combustible</label>
                                  <select class="form-select" id="fuel_type" name="fuel_type" required>
                                      <option value="">Seleccione tipo de combustible</option>
                                      <option value="Diésel">Diésel</option>
                                      <option value="Gasolina">Gasolina</option>
                                      <option value="Eléctrico">Eléctrico</option>
                                      <option value="Híbrido">Híbrido</option>
                                  </select>
                              </div>

                              <div class="col-12">
                                  <label for="engine" class="form-label">Características del motor</label>
                                  <input type="text" class="form-control" id="engine" name="engine" placeholder="Motor DOHC de 4 cilindros y 1.8 litros, con 129 caballos de..."  required>
                              </div>

                              <div class="col-12 mb-3">
                                  <label for="options" class="form-label">Características adicionales del vehículo</label>
                                  <textarea class="form-control" id="options" name="options" rows="2" placeholder="Cruise Control, MP3 player, Automatic air conditioning, Wifi, GPS Navigation..."></textarea>
                              </div>


                            <p>
                                Your personal data will be used in mapping with the vehicles you added to the website, to manage access to your account, and for other purposes described in our
                            </p>

                            <button type="submit" name="submit" id="submit" class="w-100 btn btn-primary btn-lg">
                                Registrar vehículo
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

<script>
    $(document).ready(function(){
        $("#datepicker").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose:true
        });
    })
</script>

</body>
</html>
