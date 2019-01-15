<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();


$score = $_POST['score']; 
$gold = "go";


for($i=0;$i<5;$i++){
    $no=$i+1;
    $go = $gold.$no;
   

$sql="INSERT INTO tort1pre(tort1_id,tor_id,year_id,title_name,tort1_goal,tort1_score) 
VALUES('','$_POST[tor_id]','$_POST[y_id]','$no','$_POST[$go]','$score[$i]') ";
//echo $sql;
mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));
}



mysqli_close($con);
echo"บันทึกสำเร็จแล้ว";
?>


