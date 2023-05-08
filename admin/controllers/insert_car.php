<?php


// Database connection
include('config/db.php');


// Error & success messages
global $success_msg, $email_exist, $f_NameErr, $Upload_Err, $_emailErr, $_mobileErr, $_passwordErr;
global $fNameEmptyErr, $lNameEmptyErr, $emailEmptyErr, $passwordEmptyErr, $email_verify_err, $email_verify_success;


if(isset($_POST['submit'])) {
    $vehicle_type = $_POST['vehicle_type'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $level = $_POST['level'];
    $year = $_POST['year'];
    $type = $_POST['type'];
    $daily_price = $_POST['daily_price'];
    $passengers = $_POST['passengers'];
    $suitcase = $_POST['suitcase'];
    $doors = $_POST['doors'];
    $engine = $_POST['engine'];
    $fuel_type = $_POST['fuel_type'];
    $options = $_POST['options'];
    $car_location = $_POST['car_location'];

    $foto_principal = "";

    if($_FILES["foto_principal"]["name"] != "") {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["foto_principal"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["foto_principal"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
            $Upload_Err = '<div class="alert alert-danger">
                            Error al subir la foto: Solo se permiten letras y espacios en blanco.
                        </div>';
        }
        // Check file size
        if ($_FILES["foto_principal"]["size"] > 500000) {
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["foto_principal"]["tmp_name"], $target_file)) {
                $foto_principal = basename( $_FILES["foto_principal"]["name"]);
            } else {
                $foto_principal = "";
            }
        } else {
            $foto_principal = "";
        }
    }

    $sql = "INSERT INTO cars (vehicle_type, brand, model, level, year, type, daily_price, foto_principal) VALUES ('{$vehicle_type}', '{$brand}', '{$model}', '{$level}', '{$year}', '{$type}', '{$daily_price}', '{$foto_principal}')";

    if ($connection->query($sql) === TRUE) {

        $car_id = $connection->insert_id;

        $sql = "INSERT INTO car_details (car_id, passengers, suitcase, doors, engine, fuel_type, options) VALUES ('{$car_id}', '{$passengers}', '{$suitcase}', '{$doors}', '{$engine}', '{$fuel_type}', '{$options}')";

        if ($connection->query($sql) === TRUE) {

            $sql2 = "INSERT INTO car_locations (car_id, location_id) VALUES ('{$car_id}', '{$car_location}')";

            if ($connection->query($sql2) === TRUE) {

                $success_msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
											¡Hemos recibido su registro exisosamente! <a href='vehiculo.php?id=".$car_id."' class='alert-link'>Ver registro aquí</a>
											<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
										  </div>";
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }

        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}