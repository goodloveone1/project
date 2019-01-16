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



$sql="INSERT INTO tort5(tort5_id,tor_id,tot5_accept,tort5_sent,tort5_Nreport,tort5_datereport,tort5_datewitn,tort5_assessor,tort5_date)
        VALUES('','$_POST[tor_id]','$accept','$taccept','$_POST[uname]','$_POST[tdate]','$_POST[sname]','$_POST[t_pos]','$_POST[tdate]')";
        echo $sql;
       mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));
        echo"บันทึกสำเร็จแล้ว";
?>