<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

$tor=$_POST['pre'];

$ctor=substr($tor,3,11);
$tor_id="TOR".$ctor;

$sql = "INSERT INTO  assessments (ass_id,staff,year_id,leader,hleader,sleader,sumwork,punishment)
VALUES('$tor_id','$_SESSION[user_id]','$_POST[a_no]','$_POST[leader_id]','$_POST[hleader_id]','$_POST[stleader_id]','$_POST[sum_work]','$_POST[punishment]')";
//echo $sql;
$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
// $_SESSION['tor_id']=$tor_id;
// echo $tor_id;
echo "บันทึกเสร็จแล้ว";
$con->close();

?>