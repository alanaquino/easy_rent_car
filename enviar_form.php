<?php

// Database connection
include('config/db.php');

if(isset($_POST['submit_form'])) {

    // Get the form data
    $customer_id 	    = $_POST['customer_id'];
    $car_selected_id 	= $_POST['car_selected'];
    $pickup_location 	= $_POST['pickup_location'];
    $pickup_date 		= $_POST['pickup_date'];
    $pickup_time 		= $_POST['pickup_time'];
    $return_location 	= $_POST['return_location'];
    $return_date 		= $_POST['return_date'];
    $return_time 		= $_POST['return_time'];
    $grand_total 		= $_POST['grand_total'];

    $extra_srvs 		    = $_POST['extra_srv'];


    // Insert the rental data into the rentals table
    $sql = "INSERT INTO rentals (customer_id, car_id, pickup_location_id, return_location_id, rental_start, rental_end, rental_start_time, rental_end_time, rental_status_id, total_price) 
				VALUES ('$customer_id', '$car_selected_id', '$pickup_location', '$return_location', '$pickup_date', '$return_date', '$pickup_time', '$return_time', 1, '$grand_total')";

    if ($connection->query($sql) === TRUE) {

        $rental_id = $connection->insert_id;

        // Insert the rental and service data into the customer_rentals and rental_extra_services tables
        $sql = "INSERT INTO customer_rentals (customer_id, rental_id) VALUES ('$customer_id', '$rental_id')";

        if ($connection->query($sql) === TRUE) {

            if (!empty($extra_srvs)) {

                foreach ($extra_srvs as $extra_srv) {

                    $sql = "INSERT INTO rental_extra_services (rental_id, services_id) VALUES ('$rental_id', '$extra_srv')";

                    if ($connection->query($sql) === TRUE) {

                        $submit_allert = "<div class='alert alert-danger' role='alert'>
                                              Vehículo no disponible para la fecha seleccionada. Por favor, seleccione otra fecha
                                          </div>";

                    } else {

                        echo "Error: " . $sql . "<br>" . $connection->error;
                    }
                }
            }

        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }

    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    // Close the database connection
    $connection->close();

}


