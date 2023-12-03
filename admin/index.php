<?php

// Iniciar una nueva sesión
session_start();

// Verificar si el administrador no ha iniciado sesión, redirigir a la página de inicio de sesión
if(isset($_SESSION['admin_id']) =="") {
    header("Location: login.php");
}

// Conexión a la base de datos
require_once "config/db.php";

// Consulta para obtener el recuento de reservas para cada estado de reserva
$sql = "SELECT rental_statuses.name as label, COUNT(`rental_status_id`) as cant
        FROM `rentals` 
        INNER JOIN rental_statuses
        ON rental_statuses.id = rentals.rental_status_id
        GROUP BY 1";
$result = $connection->query($sql);

// Procesar el resultado de la primera consulta
if ($result->num_rows > 0) {
    // output data of each row
    $estatus_reserva = array();
    while($row = $result->fetch_array()) {
        $estatus_reserva[] = $row;
    }
} else {
    echo "falla en el query para buscar los datos";
}

// Consulta para obtener varios recuentos relacionados con clientes, autos y reservas
$sql2 = "SELECT
            COUNT(DISTINCT customers.id) AS total_customers,
            COUNT(DISTINCT cars.id) AS total_cars,
            COUNT(rentals.id) AS total_reservas,
            SUM(rentals.total_price) AS total_price_sum
        FROM
            `rentals`
        INNER JOIN
            customers ON rentals.customer_id = customers.id
        INNER JOIN
            cars ON rentals.car_id = cars.id;";
$result2 = $connection->query($sql2);

// Procesar el resultado de la segunda consulta
if ($result2->num_rows > 0) {
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        $total_customers =  $row['total_customers'];
        $total_cars =  $row['total_cars'];
        $total_reservas =  $row['total_reservas'];
        $total_price_sum =  $row['total_price_sum'];
    }
} else {
    echo "falla en el query para buscar los total_reservas";
}

// Consulta para obtener el recuento de reservas para cada mes
$sql3 = "SELECT
            YEAR(rental_start) AS year,
            CONVERT(MONTHNAME(rental_start) USING utf8) AS month,
            COUNT(*) AS total_rentals
        FROM
            rentals
        GROUP BY
            year,
            month
        ORDER BY
            year DESC,
            FIELD(month,
                'January', 'February', 'March', 'April', 'May', 'June', 'July',
                'August', 'September', 'October', 'November', 'December') DESC;";
$result3 = $connection->query($sql3);

if ($result3->num_rows > 0) {
    // output data of each row
    $reservas_por_mes = array();
    while($row = $result3->fetch_array()) {
        $reservas_por_mes[] = $row;
    }
} else {
    echo "falla en el query para buscar los datos";
}

// Consulta para obtener detalles de las últimas 10 reservas activas
$sql3 = "SELECT rentals.id,
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
            ON rentals.rental_status_id = rental_statuses.id
        WHERE rentals.rental_status_id = 1
        ORDER BY rentals.id DESC   
        LIMIT 10";
$result3 = $connection->query($sql3);

if ($result3->num_rows > 0) {
    // output data of each row
    $data = array();
    while($row = $result3->fetch_array()) {
        $data[] = $row;
    }
} else {
    echo "falla en el query para buscar los datos";
}

// Cerrar la conexión a la base de datos
$connection->close();


// Función para calcular la diferencia de tiempo en un formato legible
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
// Función para formatear números en un formato legible (por ejemplo, 1k, 1m)
function thousandsCurrencyFormat($num) {

    if($num>1000) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('k', 'm', 'b', 't');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;

    }

    return $num;
}

?>

<!-- header_section -->
<?php include('./admin-head.php'); ?>


<!-- Include the fusioncharts core library -->
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<!-- Include the fusion theme -->
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>

<script type="text/javascript">
    const dataSource_status = {
        chart: {
            plottooltext: "$label: <b>$percentValue</b>",
            showvalues: "1",
            showlegend: "1",
            showpercentvalues: "1",
            legendposition: "bottom",
            usedataplotcolorforlabels: "1",
            theme: "fusion",
            use3DLighting: "0",
            decimals: "1"
        },
        data: [
            <?php foreach($estatus_reserva as $row): ?>
            {
                label: "<?php echo $row['label']; ?>",
                value: "<?php echo $row['cant'] / $total_reservas * 100; ?>"
            },
            <?php endforeach; ?>
        ]
    };

    FusionCharts.ready(function() {
        var myChartStatus = new FusionCharts({
            type: "doughnut2d",
            renderAt: "rental_statuses_chart",
            width: "100%",
            height: "320",
            dataFormat: "json",
            dataSource: dataSource_status
        }).render();
    });
</script>

<script type="text/javascript">
    const dataSource_por_mes = {
        chart: {
            plottooltext: "En <b>$label</b> se completaron <b>$value</b> reservas",
            yaxisname: "Cantidad",
            rotatelabels: "1",
            setadaptiveymin: "1",
            theme: "fusion"
        },
        data: [
            <?php foreach($reservas_por_mes as $row2): ?>
            {
                label: "<?php echo $row2['month']; ?>",
                value: "<?php echo $row2['total_rentals']; ?>"
            },
            <?php endforeach; ?>
        ]
    };

    FusionCharts.ready(function() {
        var myChart = new FusionCharts({
            type: "column2d",
            renderAt: "rentals_per_month_chart",
            width: "100%",
            height: "320",
            dataFormat: "json",
            dataSource: dataSource_por_mes
        }).render();
    });
</script>




            <div id="layoutSidenav_content">

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">

                        </ol>

                        <div class="row">
                            <div class="col-xl-3 col-md-6 text-white mb-4">
                                <div class="card card-stats bg-primary">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-receipt fa-5x"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <div class="numbers">
                                                    <p class="card-category mb-0">Reservas</p>
                                                    <h1 class="card-title"><?php echo $total_reservas; ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 text-white mb-4">
                                <div class="card card-stats bg-success">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-user fa-5x"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <div class="numbers">
                                                    <p class="card-category mb-0">Clientes</p>
                                                    <h1 class="card-title"><?php echo $total_customers; ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 text-white mb-4">
                                <div class="card card-stats bg-secondary">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-car fa-5x"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <div class="numbers">
                                                    <p class="card-category mb-0">Vehículos</p>
                                                    <h1 class="card-title"><?php echo $total_cars; ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6 text-white mb-4">
                                <div class="card card-stats bg-info">
                                    <div class="card-body ">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fas fa-coins fa-5x"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <div class="numbers">
                                                    <p class="card-category mb-0">Facturado (US$)</p>
                                                    <h1 class="card-title">$<?php echo thousandsCurrencyFormat($total_price_sum); ?></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Estado actual de reservas
                                    </div>
                                    <div id="rental_statuses_chart" class="p-1">FusionCharts XT will load here!</div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Total de reservas completadas por mes
                                    </div>
                                    <div id="rentals_per_month_chart" class="p-1">FusionCharts XT will load here!</div>
                                </div>
                            </div>
                        </div>
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
                                        <th>Monto</th>
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
                                            <td><?php echo $row['total_price']; ?></td>
                                            <td>

                                                <div class="d-grid gap-2">
                                                    <a class="btn btn-primary btn-sm" href="reserva.php?id=<?php echo $row['id']; ?>" role="button">Ver</a>
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
