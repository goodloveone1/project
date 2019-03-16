<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

$scwei=$_POST['scwei']; 
$score = $_POST['score']; 
$gold = "go";
$weiht = "wei";

$tor=$_POST['tor_id'];
$ctor=substr($tor,3,11);
$tor_id="TOR".$ctor;

for($i=0;$i<5;$i++){
    $no=$i+1;
    $go = $gold.$no;
    $wei= $weiht.$no;
//echo  $no,":",$_POST['tor_id'],":",$_POST[$go],":",$score[$i],":",$_POST[$wei],":",$scwei[$i],"/"; 

$sql="INSERT INTO asessment_t1(asst1_id,ass_id,title_name,goal,score,weight,weighted) 
VALUES('','$tor_id','$no','$_POST[$go]','$score[$i]','$_POST[$wei]','$scwei[$i]') ";
 echo $sql;
mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));
}
$sqli2="INSERT INTO sum_score_assessment_t1(sum_asst1_id,ass_id,sum_weight,sum_weighted,sum_asst1) 
VALUES('','$tor_id','$_POST[sumscwei]','$_POST[sumwei]','$_POST[sumall]')";
//echo $sqli2;
mysqli_query ($con,$sqli2) or die ("error2".mysqli_error($con));

mysqli_close($con);
echo"บันทึกสำเร็จแล้ว";
?>


