<?php

include("../../function/db_function.php");
$con=connect_db();

$sql = "INSERT INTO education VALUES ('','".$_POST['genid']."','".$_POST['ed_name']."','".$_POST['ed_loc']."','".$_POST['degree_id']."')";
 
//echo $sql;

mysqli_query($con,$sql) or die("SQL ERROR >>>".mysqli_error($con));

mysqli_close($con);
?>

     