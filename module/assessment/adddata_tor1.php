<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

$scwei=$_POST['scwei']; 
$score = $_POST['score']; 
$gold = "go";
$weiht = "wei";

for($i=0;$i<5;$i++){
    $no=$i+1;
    $go = $gold.$no;
    $wei= $weiht.$no;
//echo  $no,":",$_POST['tor_id'],":",$_POST[$go],":",$score[$i],":",$_POST[$wei],":",$scwei[$i],"/"; 

$sql="INSERT INTO tort1(tort1_id,tor_id,title_name,tort1_Indicat,tort1_goal,tort1_score,tort1_weight,tort1_weighted) 
VALUES('','$_POST[tor_id]','$no','','$_POST[$go]','$score[$i]','$_POST[$wei]','$scwei[$i]') ";
// echo $sql;
mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));
}
$sqli2="INSERT INTO sum_tort1(sum_tor1id,tort_id,sum_weight,sum_weighted,sum_tort1) VALUES('','$_POST[tor_id]','$_POST[sumscwei]','$_POST[sumwei]','$_POST[sumall]')";
// echo $sqli2;
mysqli_query ($con,$sqli2) or die ("error2".mysqli_error($con));

mysqli_close($con);
echo"บันทึกแล้ว";
?>