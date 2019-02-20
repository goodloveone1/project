<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();


$score = $_POST['score']; 
$gold = "go";


for($i=0;$i<5;$i++){
    $no=$i+1;
    $go = $gold.$no;
   

$sql="INSERT INTO preasessment_t1(pret1_id,ass_id,title_name,goal,score) 
VALUES('','$_POST[tor_id]','$no','$_POST[$go]','$score[$i]') ";
echo $sql;
mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));
}



mysqli_close($con);
echo"บันทึกสำเร็จแล้ว";
?>


