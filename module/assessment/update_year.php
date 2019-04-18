<?php
    include("../../function/db_function.php");

    $con=connect_db();

    $year=$_POST['year']-543;
    $update="UPDATE  years SET y_year = '$year',y_no='$_POST[no]',y_start='$_POST[start]',y_end='$_POST[end]' WHERE y_id= '$_POST[y_id]'"; 
   // echo $update;
   mysqli_query($con,$update) or  die ("mysql error=>>".mysqli_error($con));
  
    mysqli_close($con);
?>