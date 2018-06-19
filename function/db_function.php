<?php
//Step1 ติดต่อฐานข้อมูล
function connect_db(){
	$con=mysqli_connect("localhost","root","","assessment");
	mysqli_set_charset($con,"utf8");
	return $con;
}	
?>