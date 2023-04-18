<?php 

$hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";
    
    
    $conexion = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.");

  
 if ($connection = true) {
     

 // echo "Coneccion establecida ";

 }else{

    echo "error de conexion";
 }

?>