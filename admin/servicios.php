<?php

session_start();

if(isset($_SESSION['id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";


$sql = "SELECT 
        extra_services.id, 
        extra_services_tipo.detalle_tipo,
        extra_services.detalles, 
        extra_services.obligatorio,
        extra_services.precio
        FROM `extra_services`
        INNER JOIN extra_services_tipo
            ON extra_services.tipo = extra_services_tipo.id";
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
                    <h1 class="mt-5">Servicios extra</h1>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Detalle servicio</th>
                            <th>Precio por día</th>
                            <th>Obligatorio</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach($data as $row){ ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['detalle_tipo']; ?></td>
                                <td><?php echo $row['detalles']; ?></td>
                                <td><?php echo $row['precio']; ?></td>
                                <td><?php echo $row['obligatorio']; ?></td>
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
