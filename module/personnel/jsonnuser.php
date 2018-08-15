<?php
    
    include("../../function/db_function.php");

    $con=connect_db();
    $re=mysqli_query($con,"SELECT gen_user FROM general" ) or  die ("mysql error=>>".mysql_error($con));
    $username = array();
    while (list($gen_user)=mysqli_fetch_row($re)) {
    	array_push($username,$gen_user);
    }
    echo json_encode($username);
    // print_r($username);
    // print_r($euser);
    mysqli_close($con);
?>