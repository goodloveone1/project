<?php
    include("../../function/db_function.php");

    $con=connect_db();

    $update="UPDATE aptitudes SET  score= '$_POST[score]' WHERE atb_id= '$_POST[atbid]'"; 
    //echo $update;
    mysqli_query($con,$update) or  die ("mysql error=>>".mysqli_error($con));
  
    mysqli_close($con);
?>