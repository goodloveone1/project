
<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

// $tit_sub=$_POST['stit0'];
// echo $tit_sub;
$exp = $_POST['exp'];
$scr = $_POST['go'];
$Pscore = $_POST['score'];
$st="stit";
$x="x";
$sg="sumgo";
for($i=0;$i<15;$i++){
    $tit_sub=$st.$i;
    $sql="INSERT INTO asessment_t2(asst2_id,ass_id,subcap_id,goal,score) 
    VALUES('','$_POST[tor_id]','$_POST[$tit_sub]','$exp[$i]','$scr[$i]')";
  mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));
}
for($i=0;$i<4;$i++){
    $px=$x.($i+1);
    $sumgo=$sg.($i+1);
    // echo "|",$_POST[$px],"-",$_POST[$sumgo],"-";
    // echo $Pscore[$i];

    $sql2="INSERT INTO assessment_t2_skill(asst2_skid,ass_id,score_skil,score_x,score)
    VALUES('','$_POST[tor_id]','$_POST[$sumgo]','$_POST[$px]','$Pscore[$i]')";
     mysqli_query ($con,$sql2) or die ("error1".mysqli_error($con));
}

$sql3 = "INSERT INTO sum_score_assessment_t2(sum_asst2id,ass_id,sumscore,sum_asst2)
VALUES('','$_POST[tor_id]','$_POST[sumscore]','$_POST[sumAllscore]')";
echo $sql3;
mysqli_query ($con,$sql3) or die ("error3".mysqli_error($con));


// echo"บันทึกเสร็จแล้ว";
mysqli_close($con);
?>


