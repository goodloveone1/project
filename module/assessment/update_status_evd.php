<?php
include("../../function/db_function.php");
$con=connect_db();

if(!empty($_POST['check'])){

    $sql = "UPDATE evidence SET  evd_status = '2' WHERE evd_id='$_POST[evdid]'";

    //echo $sql;
    
   mysqli_query($con,$sql) or die(mysqli_error($con));

   echo "ยืนยันข้อมูลหลักฐานแล้ว";
}


?>