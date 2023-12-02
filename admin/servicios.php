<?php

session_start();

if(isset($_SESSION['admin_id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";

// If a form has been submitted for updating a service, process it
if (isset($_POST['update_service'])) {

    $service_id = $_POST['service_id'];
    $service_details = $_POST['service_details'];
    $service_price = $_POST['service_price'];
    $service_obligatory = $_POST['service_obligatory'];

    $update_query = "UPDATE extra_services SET detalles = '$service_details', precio = '$service_price', obligatorio = '$service_obligatory' WHERE id = '$service_id'";
    $result = $connection->query($update_query);

    if ($result) {
        // Display success message
        $success_msg = "Service updated successfully.";
    } else {
        // Display error message
        $error_msg = "Failed to update service.";
    }
}

// Retrieve data from database
$sql = "SELECT 
        extra_services.id, 
        extra_services_tipo.detalle_tipo,
        extra_services.detalles, 
        extra_services.obligatorio,
        extra_services.precio
        FROM `extra_services`
        INNER JOIN extra_services_tipo
            ON extra_services.tipo = extra_services_tipo.id";

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
                            <th>Tipo</th>
                            <th>Detalle servicio</th>
                            <th>Precio por día</th>
                            <th>Obligatorio</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach($data as $row){ ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><span class="badge rounded-pill bg-secondary"><?php echo $row['detalle_tipo']; ?></span></td>
                                <td><?php echo $row['detalles']; ?></td>
                                <td>US $<?php echo $row['precio']; ?></td>
                                <td>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?php if ($row['obligatorio'] == "1") { echo "checked"; } ?> readonly>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $row['id']; ?>">Actualizar
                                </td>
                            </tr>

                            <!-- Update modal -->
                            <div class="modal fade" id="updateModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel">Editar servicio extra</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Update form -->
                                            <form method="POST" action="">
                                                <input type="hidden" name="service_id" value="<?php echo $row['id']; ?>">
                                                <div class="mb-3">
                                                    <label for="tipo" class="form-label">Tipo</label>
                                                    <select class="form-select" name="tipo" id="tipo">
                                                        <?php
                                                        $sql_tipo = "SELECT * FROM extra_services_tipo";
                                                        $result_tipo = $connection->query($sql_tipo);
                                                        if ($result_tipo->num_rows > 0) {
                                                            while($row_tipo = $result_tipo->fetch_assoc()) {
                                                                if($row_tipo['id'] == $row['tipo']) {
                                                                    echo "<option value=\"{$row_tipo['id']}\" selected>{$row_tipo['detalle_tipo']}</option>";
                                                                } else {
                                                                    echo "<option value=\"{$row_tipo['id']}\">{$row_tipo['detalle_tipo']}</option>";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="service_details" class="form-label">Detalle servicio</label>
                                                    <input type="text" class="form-control" name="service_details" id="service_details" value="<?php echo $row['detalles']; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="service_price" class="form-label">Precio por día en US$</label>
                                                    <input type="number" class="form-control" name="service_price" id="service_price" value="<?php echo $row['precio']; ?>" min="1" step="5" required>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="checkbox" name="service_obligatory" id="service_obligatory" value="1" <?php if($row['obligatorio']) { echo "checked"; } ?>>
                                                    <label class="form-check-label" for="service_obligatory">
                                                        Obligatorio
                                                    </label>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="update_service" class="btn btn-primary">Guardar cambios</button>
                                                </div>
                                            </form>
                                            <!-- End update form -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End update modal -->




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
