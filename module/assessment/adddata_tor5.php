<?php
session_start();
include("../../function/db_function.php");
$con=connect_db();

if(empty($_POST['ac'])){
    $accept=0;
}else{
    $accept=1;
}

if(empty($_POST['tappcetp'])){
    $taccept=0;
}else{
    $taccept=1;
}

$sql="INSERT INTO asessment_t5(asst5_id,ass_id,accept,inform,date_inform)
        VALUES('','$_POST[tor_id]','$accept','$taccept','$_POST[tdate]')";
        echo $sql;
       mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));



mysqli_close($con);       
echo"บันทึกสำเร็จแล้ว";
?>

