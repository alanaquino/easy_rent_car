<!doctype html>
<html lang="en">
  <head>
  <?php include("head.php"); ?>

<?php include("header.php"); ?>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    

<?php 


include("conexion.php");


$cons = mysqli_query($conexion, "select c.id, c.vehicle_type, c.model, c.year, cd.fuel_type from cars as c join car_details as cd 
on cd.id=c.id   ")  or die("Error");

$registro = mysqli_fetch_array($cons);

//echo $registro['id'];
 
 ?>
 
 
<div class="col-md-7">

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Vehiculo</th>
            <th>Modelo</th>
            <th>localizacion</th>
            <th>sucursal rent</th>
            <th> Acciones </th>
        </tr>
    </thead>
    <tbody>

  

        <tr>
            <td><?php echo $registro['id']; ?></td>
            <td><?php echo $registro['model']; ?></td>
            <td><?php echo $registro['vehicle_type']; ?></td>

        </tr>

    </tbody>
</table>

    
</div>



  </body>
</html>