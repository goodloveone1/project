
<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

// $tit_sub=$_POST['stit0'];
// echo $tit_sub;
$exp = $_POST['exp'];
$scr = $_POST['go'];
$st="stit";
for($i=0;$i<14;$i++){
    $tit_sub=$st.$i;
    // echo $_POST[$tit_sub],"-";
    // echo $exp[$i],"-";
    $sql="INSERT INTO tort2(tort2_id,tor_id,tort2_sub_id,tort2_goal,tort2_score) 
    VALUES('','$_POST[tor_id]','$_POST[$tit_sub]','$exp[$i]','$scr[$i]')";
   echo $sql;
   mysqli_query ($con,$sql) or die ("error2".mysqli_error($con));
}
mysqli_close($con);





?>


