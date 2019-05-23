<?php
session_start();
include("../../function/db_function.php");
$con=connect_db();
$sumscore=$_POST['sa'];
$n="name";
$w="wei";
$s="sum";
$asst3=$_POST['asst3_id'];
for($i=0;$i<3;$i++){
    $name=$n.($i+1);
    $wei=$w.($i+1);
    $score=$s.($i+1);
   $sql ="UPDATE asessment_t3 
   SET score='$_POST[$score]',weignt='$_POST[$wei]',sum='$sumscore[$i]'
   WHERE asst3_id='$asst3[$i]' ";
    // $sql="INSERT INTO asessment_t3(asst3_id,ass_id,name,score,weignt,sum) 
    // VALUES('','$_POST[tor_id]','$_POST[$name]','$_POST[$score]','$_POST[$wei]','$sumscore[$i]')";

   // echo $sql;
   mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));
}
$se_asst3 = mysqli_query($con,"SELECT sumasst3_id FROM sum_score_assessment_t3 WHERE ass_id='$_SESSION[yearIdpost]'")or die("SQL-error_SeAss3".mysqli_error($con));
list($sumasst3_id)=mysqli_fetch_row($se_asst3);
mysqli_free_result($se_asst3);
$sql2 = "UPDATE sum_score_assessment_t3 SET sum_score='$_POST[sumall]' WHERE sumasst3_id ='$sumasst3_id'"; 


//$sql2="INSERT INTO sum_score_assessment_t3(sumasst3_id,ass_id,sum_score) VALUES('','$_POST[tor_id]','$_POST[sumall]')";
//echo $sql2;
mysqli_query ($con,$sql2) or die ("error1".mysqli_error($con));
echo"บันทึกสำเร็จแล้ว";
mysqli_close($con);
?>