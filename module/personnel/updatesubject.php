<?php
    session_start();
    include("function/db_function.php");

    $con=connect_db();
    mysqli_query($con,"UPDATE  branch SET branch_name = '$_POST[branch_name]' WHERE branch_id= '$_POST[id]' " );
    mysqli_close($con);
?>