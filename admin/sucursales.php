<?php

session_start();

if(isset($_SESSION['admin_id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";

// Update location
if(isset($_POST['update_location'])) {

    $id = $_POST['location_id'];
    $name = $_POST['location_name'];
    $address = $_POST['location_address'];

    $sql = "UPDATE `locations` SET `name`='$name',`address`='$address' WHERE `id`='$id'";

    if ($connection->query($sql) === TRUE) {
        $success_msg = "Location updated successfully!.";
    } else {
        $error_msg = "Error updating location: ".$connection->error;
    }
}

// Fetch locations
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



<!-- header_section -->
<?php include('./admin-head.php'); ?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card text-bg-dark mt-3 mb-3">
                <img src="./assets/img/banner.jpg" class="card-img" alt="banner">
                <div class="card-img-overlay">
                    <h1 class="mt-5">Sucursales</h1>
                </div>
            </div>

            <?php if (isset($success_msg)): ?>
                <div class="alert alert-success"><?php echo $success_msg; ?></div>
            <?php endif; ?>

            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger"><?php echo $error_msg; ?></div>
            <?php endif; ?>

            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sucursal</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($data as $row){ ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $row['id']; ?>">Actualizar
                                </td>
                            </tr>

                            <!-- Update location modal -->
                            <div class="modal fade" id="updateModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel<?php echo $row['id']; ?>">Editar Sucursal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="">
                                                <input type="hidden" name="location_id" value="<?php echo $row['id']; ?>">
                                                <div class="form-group mb-2">
                                                    <label for="location_name">Nombre de la Sucursal:</label>
                                                    <input type="text" class="form-control" name="location_name" value="<?php echo $row['name']; ?>" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="location_address">Dirección de la Sucursal:</label>
                                                    <input type="text" class="form-control" name="location_address" value="<?php echo $row['address']; ?>" required>
                                                </div>

                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary" name="update_location">Actualizar</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
