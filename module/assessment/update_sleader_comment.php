<?php
include("../../function/db_function.php");
$con=connect_db();

if(empty($_POST['comt'])){
    $s_comt='';
}else{
    $hs_comt=$_POST['comt'];
}

$update="UPDATE  asessment_t6 SET supervisor_comt = '$_POST[uagree]',supervisor_comtdisc=' $s_comt',supervisor_comt_date='$_POST[date]' WHERE ass6_id= '$_POST[id]'"; 
  echo $update;
//mysqli_query($con,$update) or  die ("mysql error=>>".mysqli_error($con));
  
mysqli_close($con);
?>