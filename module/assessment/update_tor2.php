<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

// $tit_sub=$_POST['stit0'];
// echo $tit_sub;
$exp = $_POST['exp'];
$scr = $_POST['go'];
$Pscore = $_POST['score'];
$Asst2_id = $_POST['asst2_id'];
$st="stit";
$x="x";
$sg="sumgo";

$max=$_POST['max'];

for($i=0;$i<$max;$i++){
    $tit_sub=$st.$i;
    // $sql="INSERT INTO asessment_t2(asst2_id,ass_id,subcap_id,goal,score) 
    // VALUES('','$_POST[tor_id]','$_POST[$tit_sub]','$exp[$i]','$scr[$i]')";

    $sql = "UPDATE asessment_t2 
    SET subcap_id='$_POST[$tit_sub]',goal='$exp[$i]',score='$scr[$i]'
    WHERE  asst2_id = '$Asst2_id[$i]' ";
    //echo $sql;
    mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));
}
$sk_id = $_POST['skill_id'];
for($i=0;$i<4;$i++){
    $px=$x.($i+1);
    $sumgo=$sg.($i+1);
 
    $sql2="UPDATE assessment_t2_skill
    SET score_skil='$_POST[$sumgo]',score_x='$_POST[$px]',score='$Pscore[$i]'
    WHERE asst2_skid='$sk_id[$i]' ";
   mysqli_query ($con,$sql2) or die ("error2".mysqli_error($con));
}
//echo $sql2;
$se_sumAss1 = mysqli_query($con,
"SELECT sum_asst2id FROM sum_score_assessment_t2 WHERE ass_id='$_SESSION[yearIdpost]'")or  die("SQL-error.sumAsst1".mysqli_error($con));
list($sum_asst2id)=mysqli_fetch_row($se_sumAss1);
mysqli_free_result($se_sumAss1);
$sql3="UPDATE sum_score_assessment_t2 SET sumscore='$_POST[sumscore]',sum_asst2='$_POST[sumAllscore]'
WHERE sum_asst2id = '$sum_asst2id' ";
// echo $sql3;
mysqli_query ($con,$sql3) or die ("error3".mysqli_error($con));

echo"บันทึกเสร็จแล้ว";
mysqli_close($con);
?>


