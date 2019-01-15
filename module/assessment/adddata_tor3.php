<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();
$score=$_POST['sa'];
$n="name";
$w="wei";
for($i=0;$i<3;$i++){
    $name=$n.($i+1);
    $wei=$w.($i+1);
   

    $sql="INSERT INTO tort3(tort3_id,tor_id,tort3_name,tort3_weignt,tort3_sum) 
    VALUES('','$_POST[tor_id]','$_POST[$name]','$_POST[$wei]','$score[$i]')";
   //echo $sql;
//    mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));
}
$sql2="INSERT INTO sum_tort3(tort3_id,tor_id,tort3_sum) VALUES('','$_POST[tor_id]','$_POST[sumall]')";
//echo $sql2;
mysqli_query ($con,$sql2) or die ("error1".mysqli_error($con));
echo"บันทึกสำเร็จแล้ว";
mysqli_close($con);
?>