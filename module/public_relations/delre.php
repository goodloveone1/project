<?php
include("../../function/db_function.php");
$con=connect_db();

$re_id = $_POST['reid'];  
$sql = "DELETE FROM relations WHERE re_id = '$re_id'";
 mysqli_query($con,$sql) or die("SQL ERROR >>> ".mysqli_error($con));

mysqli_close($con);
?>	