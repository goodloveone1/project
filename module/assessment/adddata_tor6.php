<?php
session_start();
include("../../function/db_function.php");
$con=connect_db();

if(empty($_POST['apc'])){
        $_POST['apc']="";
}
if(empty($_POST['hcompt'])){
        $_POST['hcompt']="";
}
if(empty($_POST['uagree'])){
        $_POST['uagree']="";
}
if(empty($_POST['scompt'])){
        $_POST['scompt']="";
}

$sql="INSERT INTO asessment_t6
(ass6_id,ass_id,leader_comt,leader_comt_disc,supervisor_comt,supervisor_comtdisc)
VALUES('','$_POST[tor_id]','$_POST[apc]','$_POST[hcompt]','$_POST[uagree]','$_POST[scompt]')";

//echo $sql;
mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));




 

// unset($_SESSION['genIdpost']);
// unset($_SESSION['yearIdpost']);
echo"บันทึกสำเร็จแล้ว";
mysqli_close($con);
?>