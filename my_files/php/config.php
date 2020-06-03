<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "eshop";

$con = new mysqli($hostname,$username,$password,$dbname);

if($con->connect_error){
  die("Connection failed !!!".$con->connect_error);
}

?>