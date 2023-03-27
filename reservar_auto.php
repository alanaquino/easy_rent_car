<?php include('head.php'); ?>

<?php include('./header.php'); ?>

<? include('config/db.php'); ?>

<?php echo "<br><br>"; ?>
<?php echo "<br><br>"; ?>



<div class="container">

<div class="row">
  
</div>

<div class="row">
  <div class="col-xs-1-12">
    <div class="card">
      <div class="card-body">
        
      <form>

<div class = "form-group">
<label for="exampleInputEmail1">Email del cliente</label>
<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
</div>

<div class="form-group">
<label for="example1">Numero de Telefono</label>
<input type="text" class="form-control" id="example1" placeholder="ciudad" size="35">
</div>

<div class="form-group">
<label for="example1">Ciudad en que vive</label>
<input type="text" class="form-control" id="example1" placeholder="ciudad" size="35">
</div>


<div class="form-group">
 
<label for="aut">Elija el modelo</label>
<select name="vehiculo" id="input" class="form-control" required="required">

<?php include('config/db.php');

$regi = mysqli_query($connection, "SELECT * FROM car_details ") or die("error en el query " . mysqli_error($connection)); ?>

<?php $registro = mysqli_query($connection, "SELECT * FROM cars ") 

                             or die("error en el query " . mysqli_error($connection));
                             
   while ($reg = mysqli_fetch_array($registro)) {
    
   //if ($regi['car_id'] == $reg['id']) {
    # code...

    echo "<option value=\"$reg[id]\">$reg[model]</option>" , "<br />";
  
  // }

   
      }   

                             
      ?>

</select>

</div>


<?php 
include('config/db.php');
$registro = mysqli_query($connection, "SELECT * FROM cars ") 

or die("error en el query " . mysqli_error($connection));

if ($reg = mysqli_fetch_array($registro)) {
  

  echo "<div class=\"form-group\">";
  echo "<label for=\"example1\">" . "Id del auto que quiere reservar" . "</label>";
  echo "<input type=\"text\"  class=\"form-control\" id=\"example1\" name=\"cod\" value=\"$reg[id]\" >";
  echo "</div>";


}

?>


<div class="form-group">
<label for="example1">marca del auto </label>
<input type="text" class="form-control" id="example1" placeholder="ciudad" size="35">
</div>

<button type="submit" class="btn btn-primary">reservar auto</button>

</form>



      </div>
    </div>
  </div>
  
  
</div>
  

  </body>
</html>