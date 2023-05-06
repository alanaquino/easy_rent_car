<?php

// Enable us to use Headers
ob_start();

// Set sessions
//if(!isset($_SESSION)) {
//    session_start();
//}

//$hostname = "50.87.151.191";
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "rotary40_car_rental_app";

$connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.");



?>