<?php
function connect_db(){
	$con=mysqli_connect("localhost","root","","assessment");
	mysqli_set_charset($con,"utf8");
	return $con;
}	
?>

