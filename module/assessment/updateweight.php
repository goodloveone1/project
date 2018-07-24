<?php
    include("../../function/db_function.php");

    $con=connect_db();

    $update"UPDATE  weights SET weights = '$_POST[wid]' WHERE w_id= '$_POST[w_id]'"; 
    mysqli_query($con,$update) or  die ("mysql error=>>".mysql_error($con));
    //echo $update;
    mysqli_close($con);
?>