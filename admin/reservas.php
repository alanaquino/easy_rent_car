<?php

session_start();

if(isset($_SESSION['id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";

// Update status
if(isset($_POST['update_status'])) {

    $id = $_POST['rental_id'];
    $status = $_POST['status'];

    $sql = "UPDATE rentals SET rental_status_id = '$status' WHERE rentals.id = '$id'";

    if ($connection->query($sql) === TRUE) {
        $success_msg = "¡Estado de la reserva actualizada exitosamente!";
    } else {
        $error_msg = "Error actualizando el estado de la reserva: ".$connection->error;
    }
}

// Process the form data when the form is submitted
if (isset($_POST['pagar_reserva'])) {

    // Get the form data
    $rental_id = $_POST['rental_id'];
    $usuario_cobro = $_POST['usuario_cobro'];
    $tipo_pago = $_POST['tipo_pago'];
    $monto_pagado = $_POST['monto_pagado'];

    // Insert the data into the database
    $sql = "INSERT INTO rental_pagos (rental_id, usuario_cobro, tipo_pago, monto_pago) 
            VALUES ('$rental_id', '$usuario_cobro', '$tipo_pago', '$monto_pagado')";

    if ($connection->query($sql) === TRUE) {

        $sql = "UPDATE rentals SET rental_status_id = '2' WHERE rentals.id = '{$rental_id}'";

        if ($connection->query($sql) === TRUE) {
            $success_msg = "Pago de reserva insertado correctamente en la base de datos";
        }

    } else {
        $error_msg = "Error al insertar el pago de reserva: " .$connection->error;
    }
}

$sql = "SELECT rentals.id,
               rentals.created_at, 
               customers.id as id_cliente,
               customers.firstname,
               customers.lastname,
               cars.id as id_vehiculo,
               cars.brand,
               cars.model,
               cars.level,
               cars.year,
               cars.foto_principal, 
               rentals.rental_start, 
               rentals.rental_end, 
               rentals.rental_start_time,	
               rentals.rental_end_time,
               rental_statuses.name as status,
               rentals.total_price,
               rentals.updated_at
        FROM `rentals`
        INNER JOIN customers
            ON rentals.customer_id = customers.id
        INNER JOIN cars
            ON rentals.car_id = cars.id
        INNER JOIN rental_statuses
            ON rentals.rental_status_id = rental_statuses.id";
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



//Creating Function
function TimeAgo ($oldTime, $newTime) {
    $timeCalc = strtotime($newTime) - strtotime($oldTime);
    if ($timeCalc >= (60*60*24*30*12*2)){
        $timeCalc = intval($timeCalc/60/60/24/30/12) . " años";
    }else if ($timeCalc >= (60*60*24*30*12)){
        $timeCalc = intval($timeCalc/60/60/24/30/12) . " año";
    }else if ($timeCalc >= (60*60*24*30*2)){
        $timeCalc = intval($timeCalc/60/60/24/30) . " meses";
    }else if ($timeCalc >= (60*60*24*30)){
        $timeCalc = intval($timeCalc/60/60/24/30) . " mes";
    }else if ($timeCalc >= (60*60*24*2)){
        $timeCalc = intval($timeCalc/60/60/24) . " días";
    }else if ($timeCalc >= (60*60*24)){
        $timeCalc = " 1 día";
    }else if ($timeCalc >= (60*60*2)){
        $timeCalc = intval($timeCalc/60/60) . " horas";
    }else if ($timeCalc >= (60*60)){
        $timeCalc = intval($timeCalc/60/60) . " hora";
    }else if ($timeCalc >= 60*2){
        $timeCalc = intval($timeCalc/60) . " minutos";
    }else if ($timeCalc >= 60){
        $timeCalc = intval($timeCalc/60) . " minuto";
    }else if ($timeCalc > 0){
        $timeCalc .= " segundos";
    }
    return $timeCalc;
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
                    <h1 class="mt-5">Reservas</h1>
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
                    <table id="datatablesSimple" class="hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Cliente</th>
                            <th>Vehículo</th>
                            <th>rental_start</th>
                            <th>rental_end</th>
                            <th>Creado</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach($data as $row){ ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td>
                                    <button type="button" class="btn badge rounded-pill <?php if ($row['status'] == "Reserva cancelada") { echo "bg-danger"; } elseif ($row['status'] == "Pagado en sucursal") { echo "bg-success"; } else { echo "bg-primary"; } ?>" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $row['id']; ?>"><?php echo $row['status']; ?></button>
                                    <br>Hace <?php echo TimeAgo($row['updated_at'], date("Y-m-d H:i:s")); ?>
                                </td>
                                <td>
                                    <i class="fas fa-user-circle"></i>
                                    <a href="cliente.php?id=<?php echo $row['id_cliente']; ?>" role="button">
                                        <?php echo $row['firstname'], " ", $row['lastname']; ?>
                                    </a>

                                </td>
                                <td>
                                    <i class="fas fa-car"></i>
                                    <a href="vehiculo.php?id=<?php echo $row['id_vehiculo']; ?>" role="button">
                                        <?php echo $row['brand'], " ",$row['model'], " ",$row['level'], " ",$row['year']; ?>
                                    </a>
                                </td>
                                <td>
                                    <i class="fas fa-calendar-week"></i> <?php echo date("d-m-Y", strtotime($row['rental_start'])); ?><br>
                                    <i class="fas fa-clock"></i> <?php echo $row['rental_start_time']; ?>
                                </td>

                                <td>
                                    <i class="fas fa-calendar-week"></i> <?php echo date("d-m-Y", strtotime($row['rental_end'])); ?><br>
                                    <i class="fas fa-clock"></i> <?php echo $row['rental_end_time']; ?>
                                </td>
                                <td>Hace <?php echo TimeAgo($row['created_at'], date("Y-m-d H:i:s")); ?></td>
                                <td>

                                    <div class="d-grid gap-2">
                                        <a class="btn btn-primary btn-sm" href="reserva.php?id=<?php echo $row['id']; ?>" role="button">Ver</a>
                                        <a class="btn btn-warning btn-sm" href="editar_reserva.php?id=<?php echo $row['id']; ?>" role="button">Editar</a>
                                        <?php if ($row['status'] != "Reserva cancelada"): ?>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#payModal<?php echo $row['id']; ?>">Pagar</button>
                                        <?php endif; ?>

                                    </div>
                                </td>
                            </tr>

                            <!-- Modal for updating the status -->
                            <div class="modal fade" id="updateModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel">Actualizar estado</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="">
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Estado de la renta</label>
                                                    <select class="form-select" id="status" name="status">
                                                        <option disabled selected>Seleccione</option>
                                                        <option value="1">Reservado via web</option>
                                                        <option value="3">Entregado en sucursal</option>
                                                        <option value="4">En ruta</option>
                                                        <option value="5">Recibido en sucursal</option>
                                                        <option value="6">Completado</option>
                                                        <option value="7">Reserva cancelada</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="rental_id" value="<?php echo $row['id']; ?>">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="update_status">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for PAYING the booking -->
                            <div class="modal fade" id="payModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel">Pagar reserva #2023<?php echo $row['id']; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="">

                                                <div class="alert alert-warning" role="alert">
                                                   El monto total de la reserva es <b>US $<?php echo $row['total_price']; ?></b>, asegurese de que coincida con el monto a cobrar en sucursal.
                                                </div>

                                                <div class="mb-3">
                                                    <label for="tipo_pago" class="form-label">Tipo de pago</label>
                                                    <select class="form-select" id="tipo_pago" name="tipo_pago">
                                                        <option disabled selected>Seleccione</option>
                                                        <option value="Pago con tarjeta en sucursal">Pago con tarjeta en sucursal</option>
                                                        <option value="Pago en efectivo en sucursal">Pago en efectivo en sucursal</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="monto_pagado" class="form-label">Monto a pagar (US$)</label>
                                                    <input type="text" class="form-control" id="monto_pagado"name="monto_pagado" value="<?php echo $row['total_price']; ?>">
                                                </div>
                                                <input type="hidden" name="rental_id" value="<?php echo $row['id']; ?>">
                                                <input type="hidden" name="usuario_cobro" value="<?php echo $_SESSION['id']; ?>">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary" name="pagar_reserva">Pagar reserva</button>
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
