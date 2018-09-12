<?php
include("../../function/db_function.php");
$con=connect_db();

$degree_name = empty($_POST['ed_name'])?'':$_POST['ed_name'];


$sql = "INSERT INTO  degree (degree_id,degree_name) VALUES ('','$degree_name')";

$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
$con->close();
?>