<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

$scwei=$_POST['scwei']; 
$score = $_POST['score']; 
$tort1_id = $_POST['id'];
$gold = "go";
$weiht = "wei";

$tor=$_POST['tor_id'];
$ctor=substr($tor,3,11);
$tor_id="TOR".$ctor;

for($i=0;$i<5;$i++){
    $no=$i+1;
    $go = $gold.$no;
    $wei= $weiht.$no; 
$sql="UPDATE asessment_t1 SET ass_id='$tor_id',title_name='$no',goal='$score[$i]',weight='$_POST[$wei]',weighted='$scwei[$i]' 
WHERE  asst1_id = '$tort1_id[$i]'";
mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));
}


$se_sumAss1 = mysqli_query($con,
"SELECT sum_asst1_id FROM sum_score_assessment_t1 WHERE ass_id='$_SESSION[yearIdpost]'")or  die("SQL-error.sumAsst1".mysqli_error($con));
list($sum_asst1_id)=mysqli_fetch_row($se_sumAss1);
mysqli_free_result($se_sumAss1);

$sqlli2="UPDATE sum_score_assessment_t1 
SET sum_weight='$_POST[sumwei]',sum_weighted='$_POST[sumscwei]',sum_asst1='$_POST[sumall]'
WHERE sum_asst1_id ='$sum_asst1_id' ";
mysqli_query ($con,$sqlli2) or die ("error2".mysqli_error($con));

mysqli_close($con);
echo"บันทึกสำเร็จแล้ว";
?>


