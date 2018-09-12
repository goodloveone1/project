<?php
include("../../function/db_function.php");
$con=connect_db();

$degree_id = $_POST['degree_id'];
$degree_name = $_POST['degree_name'];

$sql = "UPDATE degree SET degree_id = '$degree_id' , degree_name = '$degree_name' WHERE  degree_id = '$degree_id'";


$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
$con->close();

?>