<?php
include("../../function/db_function.php");
$con=connect_db();

$degree_name = empty($_POST['degree_id'])?'':$_POST['degree_id'];


$sql = "INSERT INTO  degree (degree_id,degree_name) VALUES ('','$degree_name')";

$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
?>