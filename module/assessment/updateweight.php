<?php
    include("../../function/db_function.php");

    $con=connect_db();

    $update="UPDATE  weights SET weights = '$_POST[wid]' WHERE w_id= '$_POST[w_id]'"; 
    echo $update;
   mysqli_query($con,$update) or  die ("mysql error=>>".mysqli_error($con));
  
    mysqli_close($con);
?>