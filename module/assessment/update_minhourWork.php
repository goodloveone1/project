<?php
include("../../function/db_function.php");
$con=connect_db();


$update="UPDATE  work_hour SET min_hour = '$_POST[minwork]' WHERE hw_id= '$_POST[id]'"; 
   // echo $update;
mysqli_query($con,$update) or  die ("mysql error=>>".mysqli_error($con));
  
mysqli_close($con);
?>