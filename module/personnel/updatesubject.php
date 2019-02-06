<?php
    //session_start();
    include("../../function/db_function.php");

    $con=connect_db();
    mysqli_query($con,"UPDATE  departments SET dept_name = '$_POST[branch_name]' WHERE dept_id= '$_POST[branch_id]' " ) or  die ("mysql error=>>".mysql_error($con));
    mysqli_close($con);
?>