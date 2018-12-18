<?php
    session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();
    
    $tor=mysqli_query($con,"SELECT gen_id FROM tor WHERE gen_id='$_SESSION[user_id]'") or die("SQL_ERROR".mysqli_error($con));
    list($gen_id)=mysqli_fetch_row($tor);

    if(empty($gen_id)){
        include("test_tor_stepBystep.php");
        
    }
?>