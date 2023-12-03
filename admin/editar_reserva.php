<?php include('head.php'); ?>
<?php include('header.php'); ?>

<?php
echo "<br>";
echo "<br>";


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

        //$sentenciaSQL->bindParam(':imagen', $nombre_archivo);
        //$sentenciaSQL->execute();

        // echo "presiono el boton agregar";

        break;

    case 'modificar':

        //$sentenciaSQL = $conexion->query("select * from cars");
        //$res3 = $sentenciaSQL->fetch_all(MYSQLI_ASSOC);



        if (isset($_POST['txtID'])) {

            $sentenciaSQL = $connection->query("update cars set year = $txtYear  where id = $txtID ");



        } else {

            if (isset($_POST['txtNombre'])){

                $sentenciaSQL = $connection->query("update cars set vehicle_type = $txtNombre  where id = $txtID ");

            }

        }


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

?>



    <div class="container">
        <br>
        <div class="row">


            <div class="col-md-5">


                <div class="card">

                    <div class="card-header">
                        Ingresar  Datos del Vehiculo
                    </div>

                    <div class="card-body">

                        <!--agregar libros-->

                        <form method="post" enctype="multipart/form-data" action="">

                            <div class = "form-group">
                                <label for="txtID">ID: </label>
                                <input type="text" class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID"  placeholder="ID">
                            </div>

                            <div class = "form-group">
                                <label for="txtNombre">Nombre vehiculo: </label>
                                <input type="text" class="form-control" value=" <?php echo $txtNombre;?> " name="txtNombre" id="txtNombre"  placeholder="Nombre de vehiculo">
                            </div>

                            <div class = "form-group">
                                <label for="txtMarca">Marca: </label>
                                <input type="text" class="form-control" value=" <?php echo $txtMarca;?> " name="txtMarca" id="txtMarca"  placeholder="Marca del vehiculo">
                            </div>

                            <div class = "form-group">
                                <label for="txtModel">Modelo: </label>
                                <input type="text" class="form-control" value=" <?php echo $txtModel;?> " name="txtModel" id="txtModel"  placeholder="Modelo vehiculo">
                            </div>

                            <div class = "form-group">
                                <label for="txtLevel">Nivel: </label>
                                <input type="text" class="form-control" value=" <?php echo $txtLevel;?> " name="txtLevel" id="txtLevel"  placeholder="Nivel del vehiculo">
                            </div>

                            <div class = "form-group">
                                <label for="txtYear">Año del vehiculo: </label>
                                <input type="text" class="form-control" value=" <?php echo $txtYear; ?> " name="txtYear" id="txtYear"  placeholder="Año del vehiculo">
                            </div>

                            <div class = "form-group">
                                <label for="txtTipo">Tipo: </label>
                                <input type="text" class="form-control" value=" <?php echo $txtTipo;?> " name="txtTipo" id="txtTipo"  placeholder="Nombre del libro">
                            </div>



                            <div class = "form-group">
                                <label for="txtImagen">Imagen</label>

                                <?php echo $txtImagen;?>

                                <input type="file" class="form-control" name="txtImagen" id="txtImagen"  placeholder="Imagen">
                            </div>

                            <div class = "form-group">
                                <label for="txtPrice">Precio por dia: </label>
                                <input type="text" class="form-control" value=" <?php echo $txtPrice;?> " name="txtPrice" id="txtPrice"  placeholder="Precio por dia">
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




            <div class="col-md-7">

                <!--mostrar datos en la tabla -->

                <table class="table table-borderless">
                    <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>level</th>
                        <th>año</th>
                        <th> Acciones </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($res1 as $res01) { ?>

                        <tr>
                            <td><?php echo $res01['id']; ?></td>
                            <td><?php echo $res01['vehicle_type']; ?></td>
                            <td><?php echo $res01['brand']; ?></td>
                            <td><?php echo $res01['model']; ?></td>
                            <td><?php echo $res01['level']; ?></td>
                            <td><?php echo $res01['year']; ?></td>


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

<?php //include('./footer.php'); ?>