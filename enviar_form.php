<?php
// Incluye el archivo de conexión a la base de datos
include('config/db.php');

// Verifica si se ha enviado el formulario
if(isset($_POST['submit_form'])) {

    // Obtiene los datos del formulario
    $customer_id        = $_POST['customer_id'];
    $car_selected_id    = $_POST['car_selected'];
    $pickup_location    = $_POST['pickup_location'];
    $pickup_date        = $_POST['pickup_date'];
    $pickup_time        = $_POST['pickup_time'];
    $return_location    = $_POST['return_location'];
    $return_date        = $_POST['return_date'];
    $return_time        = $_POST['return_time'];
    $grand_total        = $_POST['grand_total'];

    // Extrae los servicios adicionales del formulario
    $extra_srvs         = $_POST['extra_srv'];

    // Inserta los datos de alquiler en la tabla rentals
    $sql = "INSERT INTO rentals (customer_id, car_id, pickup_location_id, return_location_id, rental_start, rental_end, rental_start_time, rental_end_time, rental_status_id, total_price) 
            VALUES ('$customer_id', '$car_selected_id', '$pickup_location', '$return_location', '$pickup_date', '$return_date', '$pickup_time', '$return_time', 1, '$grand_total')";

    if ($connection->query($sql) === TRUE) {

        // Obtiene el ID del alquiler recién insertado
        $rental_id = $connection->insert_id;

        // Inserta datos en las tablas customer_rentals y rental_extra_services
        $sql = "INSERT INTO customer_rentals (customer_id, rental_id) VALUES ('$customer_id', '$rental_id')";

        if ($connection->query($sql) === TRUE) {

            // Verifica si hay servicios adicionales seleccionados
            if (!empty($extra_srvs)) {

                foreach ($extra_srvs as $extra_srv) {

                    // Inserta los servicios adicionales en la tabla rental_extra_services
                    $sql = "INSERT INTO rental_extra_services (rental_id, services_id) VALUES ('$rental_id', '$extra_srv')";

                    if ($connection->query($sql) === TRUE) {

                        // Mensaje de alerta si hay un problema con la disponibilidad del vehículo
                        $submit_allert = "<div class='alert alert-danger' role='alert'>
                                              Vehículo no disponible para la fecha seleccionada. Por favor, seleccione otra fecha
                                          </div>";
                    } else {
                        // Muestra un mensaje de error si hay un problema con la consulta SQL
                        echo "Error: " . $sql . "<br>" . $connection->error;
                    }
                }
            }

        } else {
            // Muestra un mensaje de error si hay un problema con la consulta SQL
            echo "Error: " . $sql . "<br>" . $connection->error;
        }

    } else {
        // Muestra un mensaje de error si hay un problema con la consulta SQL
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    // Cierra la conexión a la base de datos
    $connection->close();
}
?>
