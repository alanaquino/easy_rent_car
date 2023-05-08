<?php

session_start();

if(isset($_SESSION['id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";


$sql = "SELECT * FROM `customers`";
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
                    <h1 class="mt-5">Clientes</h1>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Correo electrónico</th>
                            <th>Licencia de conducir</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($data as $row){ ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td>
                                    <i class="fas fa-user-circle"></i>
                                    <a href="cliente.php?id=<?php echo $row['id']; ?>" class="text-decoration-none" role="button">
                                        <?php echo $row['firstname'], " ", $row['lastname']; ?>
                                    </a>
                                </td>
                                <td><i class="fas fa-envelope"></i> <?php echo $row['email']; ?></td>
                                <td><i class="fas fa-id-badge"></i> <?php echo $row['licencia_id']; ?></td>
                                <td>
                                    <div class="d-grid gap-2">
                                        <a class="btn btn-primary btn-sm" href="cliente.php?id=<?php echo $row['id']; ?>" role="button">Ver</a>
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
