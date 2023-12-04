<?php
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID']:"";
$txtNombre = (isset($_POST['txtNombre'])) ? $_POST['txtNombre']:"";
$txtMarca = (isset($_POST['txtMarca'])) ? $_POST['txtMarca']:"";
$txtModel = (isset($_POST['txtModel'])) ? $_POST['txtModel']:"";
$txtLevel = (isset($_POST['txtLevel'])) ? $_POST['txtLevel']:"";
$txtYear = (isset($_POST['txtYear'])) ? $_POST['txtYear']:"";
$txtTipo = (isset($_POST['txtTipo'])) ? $_POST['txtTipo']:"";
$txtImagen = (isset($_FILES['txtImagen']['name'])) ? $_FILES['txtImagen']['name']:"";
$txtPrice = (isset($_POST['txtPrice'])) ? $_POST['txtPrice']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

include("config/db.php");


switch ($accion) {

    case 'agregar':

        $sentenciaSQL = $connection->query("INSERT INTO `cars` (vehicle_type, brand, model, level, year, type, foto_principal,
        daily_price) VALUES ('$_POST[txtNombre]', '$_POST[txtMarca]', '$_POST[txtModel]', '$_POST[txtLevel]', '$_POST[txtYear]', '$_POST[txtTipo]',
        '$_FILES[txtImagen][name]', '$_POST[txtPrice]' );");
        //$sentenciaSQL->execute();

        $fecha = new DateTime();
        $nombre_archivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES['txtImagen']['name']:"imagenx7.jpg";

        $tmpImagen = $_FILES['txtImagen']['tmp_name'];

        if ($tmpImagen!="") {

            move_uploaded_file($tmpImagen, "assets/img/" . $nombre_archivo);

        }


        break;

    case 'modificar':


        if (isset($_POST['txtID'])) {

            $sentenciaSQL = $connection->query("update cars set year = $txtYear  where id = $txtID ");



        } else {

            if (isset($_POST['txtNombre'])){

                $sentenciaSQL = $connection->query("update cars set vehicle_type = $txtNombre  where id = $txtID ");

            }

        }


        break;

    case 'cancelar':
        echo "presiono el boton cancelar";

        break;


    case 'seleccionar':

        $sentenciaSQL = $conexion->query("select id, vehicle_type, brand, model,car level, year, type, foto_principal,
        daily_price from cars");
        $res2 = $sentenciaSQL->fetch_all(MYSQLI_ASSOC);

        $txtNombre = $res2['id'];
        $txtImagen = $res2['brand'];

        //echo "presiono el boton seleccionar";

        break;

    case 'borrar':

        $sentenciaSQL = $connection->prepare("DELETE FROM cars WHERE id = $txtID");
        $sentenciaSQL->execute();

        break;

    default:
        # code...
        break;
}

$sentenciaSQL = $connection->query("select * from cars");
$res1 = $sentenciaSQL->fetch_all(MYSQLI_ASSOC);