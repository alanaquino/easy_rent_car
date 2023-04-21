<?php

session_start();

if(isset($_SESSION['id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";


$sql = "SELECT * FROM `extra_services`";
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
            <h1 class="mt-4">Servicios extra</h1>
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
                                <td><?php echo $row['tipo']; ?></td>
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