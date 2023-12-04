<?php

session_start();

if(isset($_SESSION['admin_id']) =="") {
    header("Location: login.php");
}

// Database connection
require_once "config/db.php";

$sql = "SELECT * FROM `locations`";
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

include('./controllers/edit_car.php');

?>


    <!-- header_section -->
<?php include('./admin-head.php'); ?>


    <div id="layoutSidenav_content">

        <main>
            <div class="container-fluid px-4 mt-2">

                <div class="card text-bg-dark mb-3">
                    <img src="./assets/img/banner.jpg" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <h1 class="mt-5">Editar vehículo</h1>
                    </div>
                </div>

                <div class="row g-5 ">
                    <div class="col-md-5 col-lg-4 order-md-last">

                        <div class="card mb-4 mt-4">
                            <div class="card-body text-center">

                                <img src="https://assets-global.website-files.com/607ee530dd59915d46108839/607ee530dd59919fd6108e14_1_spin-jeep.gif" alt="avatar"
                                     class="img-fluid" class="w-100"  style="width: 300px; height: 300px; object-fit: cover;">

                                <p class="text-muted mt-3"> Agrega vehículos nuevos fácilmente a tu flotilla, y gestiona los existentes, a través de esta sección.</p>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 col-lg-8">



                        <form method="post" enctype="multipart/form-data" action="">
                            <div class="form-group">
                                <label for="txtID">
                                    ID:
                                </label>
                                <input type="text" class="form-control" value="<?php echo $txtID;?>" name="txtID"
                                       id="txtID" placeholder="ID">
                            </div>
                            <div class="form-group">
                                <label for="txtNombre">
                                    Nombre vehiculo:
                                </label>
                                <input type="text" class="form-control" value=" <?php echo $txtNombre;?> "
                                       name="txtNombre" id="txtNombre" placeholder="Nombre de vehiculo">
                            </div>
                            <div class="form-group">
                                <label for="txtMarca">
                                    Marca:
                                </label>
                                <input type="text" class="form-control" value=" <?php echo $txtMarca;?> "
                                       name="txtMarca" id="txtMarca" placeholder="Marca del vehiculo">
                            </div>
                            <div class="form-group">
                                <label for="txtModel">
                                    Modelo:
                                </label>
                                <input type="text" class="form-control" value=" <?php echo $txtModel;?> "
                                       name="txtModel" id="txtModel" placeholder="Modelo vehiculo">
                            </div>
                            <div class="form-group">
                                <label for="txtLevel">
                                    Nivel:
                                </label>
                                <input type="text" class="form-control" value=" <?php echo $txtLevel;?> "
                                       name="txtLevel" id="txtLevel" placeholder="Nivel del vehiculo">
                            </div>
                            <div class="form-group">
                                <label for="txtYear">
                                    Año del vehiculo:
                                </label>
                                <input type="text" class="form-control" value=" <?php echo $txtYear; ?> "
                                       name="txtYear" id="txtYear" placeholder="Año del vehiculo">
                            </div>
                            <div class="form-group">
                                <label for="txtTipo">
                                    Tipo:
                                </label>
                                <input type="text" class="form-control" value=" <?php echo $txtTipo;?> "
                                       name="txtTipo" id="txtTipo" placeholder="Nombre del libro">
                            </div>
                            <div class="form-group">
                                <label for="txtImagen">
                                    Imagen
                                </label>
                                <?php echo $txtImagen;?>
                                <input type="file" class="form-control" name="txtImagen" id="txtImagen"
                                       placeholder="Imagen">
                            </div>
                            <div class="form-group">
                                <label for="txtPrice">
                                    Precio por dia:
                                </label>
                                <input type="text" class="form-control" value=" <?php echo $txtPrice;?> "
                                       name="txtPrice" id="txtPrice" placeholder="Precio por dia">
                            </div>
                            <div class="btn-group" role="group" aria-label="">
                                <button type="submit" name="accion" value="agregar" class="btn btn-success">
                                    Agregar
                                </button>
                                <button type="submit" name="accion" value="modificar" class="btn btn-warning">
                                    Modificar
                                </button>
                                <button type="submit" name="accion" value="cancelar" class="btn btn-info">
                                    Cancelar
                                </button>
                            </div>
                        </form>



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

    <script>
        $(document).ready(function(){
            $("#datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose:true
            });
        })
    </script>

    </body>
    </html>














<div class="container">
    <br>
    <div class="row">


<div class="col-md-5">


<div class="card">

    <div class="card-header">
     Ingresar  Datos del Vehiculo
    </div>

    <div class="card-body">
        


    
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