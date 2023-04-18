<?php include("head.php"); ?>
<?php include("header.php"); ?>

<?php
echo "<br>";
echo "<br>";


$txtID = (isset($_POST['txtID'])) ? $_POST['txtID']:"";
$txtCarro = (isset($_POST['txtCarro'])) ? $_POST['txtCarro']:"";
$txtPas = (isset($_POST['txtPas'])) ? $_POST['txtPas']:"";
$txtBol = (isset($_POST['txtBol'])) ? $_POST['txtBol']:"";
$txtDoor = (isset($_POST['txtDoor'])) ? $_POST['txtDoor']:"";
$txtMoto = (isset($_POST['txtMoto'])) ? $_POST['txtMoto']:"";
$txtFuel = (isset($_POST['txtFuel'])) ? $_POST['txtFuel']:"";
$txtOpc = (isset($_POST['txtOpc'])) ? $_POST['txtOpc']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";


include("config/conexion-01.php");


switch ($accion) {

    case 'agregar':

        $sentenciaSQL = $conexion->query("INSERT INTO `car_details` (passengers, suitcase, doors, engine, fuel_type, options
        ) VALUES ('$_POST[txtPas]', '$_POST[txtBol]','$_POST[txtDoor]', '$_POST[txtMoto]', '$_POST[txtFuel]', '$_POST[txtOpc]');");
       

        
       // echo "presiono el boton agregar";

        break;

    case 'modificar':

        //$sentenciaSQL = $conexion->query("select * from cars");
        //$res3 = $sentenciaSQL->fetch_all(MYSQLI_ASSOC);

       // $sentenciaSQL = $conexion->query("update cars set year = $txtYear where id = $txtID ");
        
        
/*
        if ($txtImagen!="") {

             $sentenciaSQL = $conexion->prepare("update libros set imagen = :imagen where id = :id");
             $sentenciaSQL->bindParam(':imagen', $txtImagen);
             $sentenciaSQL->bindParam(':id',$txtID);
             $sentenciaSQL->execute();
            
        }
       */

            //echo "presino el boton modificar";
            
        break;

    case 'cancelar':
                echo "presiono el boton cancelar";
                
        break;


    case 'seleccionar':

        $sentenciaSQL = $conexion->query("select id, car_id, passengers, suitcase, doors, engine, fuel_type, options, from car_details");
        $res2 = $sentenciaSQL->fetch_all(MYSQLI_ASSOC);

        $txtNombre = $res2['id'];
        $txtImagen = $res2['car_id'];

            //echo "presiono el boton seleccionar";    

            break;

        case 'borrar':
       
            $sentenciaSQL = $conexion->prepare("DELETE FROM car_details WHERE id = $txtID");
            $sentenciaSQL->execute();
                
            break;
    
    default:
        # code...
        break;
}

$sentenciaSQL = $conexion->query("select * from car_details");
$res1 = $sentenciaSQL->fetch_all(MYSQLI_ASSOC);

?>

<div class="container">
    <br>
    <div class="row">


<div class="col-md-4">


<div class="card">

    <div class="card-header">
     Ingresar  Detalles del Vehiculo
    </div>

    <div class="card-body">
        
    <!--agregar libros-->

<form method="post" enctype="multipart/form-data" action=""> 

<div class = "form-group">
<label for="txtID">ID: </label>
<input type="text" class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID"  placeholder="ID">
</div>

<div class = "form-group">
<label for="txtCarro">codigo: </label>
<input type="text" class="form-control" value=" <?php echo $txtCarro;?> " name="txtCarro" id="txtCarro"  placeholder="ID del vehiculo">
</div>

<div class = "form-group">
<label for="txtPas">pasajeros: </label>
<input type="text" class="form-control" value=" <?php echo $txtPas;?> " name="txtPas" id="txtPas"  placeholder="numero de pasajeros">
</div>

<div class = "form-group">
<label for="txtBol">suitcase: </label>
<input type="text" class="form-control" value=" <?php echo $txtBol;?> " name="txtBol" id="txtBol"  placeholder="Bolsa">
</div>

<div class = "form-group">
<label for="txtDoor">Puertas: </label>
<input type="text" class="form-control" value=" <?php echo $txtDoor;?> " name="txtDoor" id="txtDoor"  placeholder="numero de puertas">
</div>


<div class = "form-group">
<label for="txtMoto">Motor: </label>
<input type="text" class="form-control" value=" <?php echo $txtMoto;?> " name="txtMoto" id="txtMoto"  placeholder="Motor del vehiculo">
</div>

<div class = "form-group">
<label for="txtFuel">Combustible: </label>
<input type="text" class="form-control" value=" <?php echo $txtFuel; ?> " name="txtFuel" id="txtFuel"  placeholder="combustible del vehiculo">
</div>

<div class = "form-group">
<label for="txtOpc">Opciones: </label>
<input type="text" class="form-control" value=" <?php echo $txtOpc;?> " name="txtOpc" id="txtOpc"  placeholder="Opciones">
</div>


<div class="btn-group" role="group" aria-label="">
    <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
    <button type="submit" name="accion" value="modificar" class="btn btn-warning">Modificar</button>
    <button type="submit" name="accion" value="cancelar" class="btn btn-info">Cancelar</button>
</div>

</form>


    
</div>

    </div>
   
</div>




<div class="col-md-8">

<!--mostrar datos en la tabla -->

<table class="table table-borderless">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Car_ID</th>
            <th>Pasajeros</th>
            <th>suitcase</th>
            <th>puertas</th>
            <th>motor</th>
            <th>Combustible</th>
            <th> Opciones </th>
        </tr>
    </thead>
    <tbody>

    <?php foreach ($res1 as $res01) { ?>

        <tr>
            <td><?php echo $res01['id']; ?></td>
            <td><?php echo $res01['car_id']; ?></td>
            <td><?php echo $res01['passengers']; ?></td>
            <td><?php echo $res01['suitcase']; ?></td>
            <td><?php echo $res01['doors']; ?></td>
            <td><?php echo $res01['engine']; ?></td>
            <td><?php echo $res01['fuel_type']; ?></td>
            <td><?php echo $res01['options']; ?></td>
            

            <td>

           <form method="post">

           <input type="hidden" name="txtID" value="<?php echo $res01['id']; ?>">

           <input type="submit" name="accion" value="selecc" class="btn btn-primary"/>

          <input type="submit" name="accion" value="borrar" class="btn btn-danger">
            
           </form>

            </td>

        </tr>

        <?php } ?>

    </tbody>
</table>

    
</div>

 
</div>
       </div>

     </body>
</html>

<?php   //include("../template/pie.php");  ?>

