
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
for($i=0;$i<14;$i++){
    $tit_sub=$st.$i;
    // echo $_POST[$tit_sub],"-";
    // echo $exp[$i],"-";
    $sql="INSERT INTO tort2(tort2_id,tor_id,tort2_sub_id,tort2_goal,tort2_score) 
    VALUES('','$_POST[tor_id]','$_POST[$tit_sub]','$exp[$i]','$scr[$i]')";
  // echo $sql;
  mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));
}
for($i=0;$i<4;$i++){
   
    $px=$x.($i+1);
    $sumgo=$sg.($i+1);
    // echo "|",$_POST[$px],"-",$_POST[$sumgo],"-";
    // echo $Pscore[$i];

    $sql2="INSERT INTO tort2_skil(tort2s_id,tort_id,tort2s_skil,tort2s_x,tort2s_score)
    VALUES('','$_POST[tor_id]','$_POST[$sumgo]','$_POST[$px]','$Pscore[$i]')";
    //echo $sql2;
     mysqli_query ($con,$sql2) or die ("error1".mysqli_error($con));
}

$sql3 = "INSERT INTO sum_tort2(sum_tor2id,tor_id,sum_tor2sum,sum_tor2asum)
VALUES('','$_POST[tor_id]','$_POST[sumscore]','$_POST[sumAllscore]')";
//echo $sql3;
mysqli_query ($con,$sql3) or die ("error3".mysqli_error($con));


// echo"บันทึกเสร็จแล้ว";
mysqli_close($con);
?>


