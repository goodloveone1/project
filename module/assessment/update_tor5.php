<?php
session_start();
include("../../function/db_function.php");
$con=connect_db();

if(empty($_POST['ac'])){
    $accept=0;
}else{
    $accept=1;
}

if(empty($_POST['tappcetp'])){
    $taccept=0;
}else{
    $taccept=1;
}

// $sql="INSERT INTO asessment_t5(asst5_id,ass_id,accept,inform,date_inform)
//         VALUES('','$_POST[tor_id]','$accept','$taccept','$_POST[tdate]')";
$sql="UPDATE asessment_t5 
SET  accept='$accept',inform='$taccept',date_accept='$_POST[udate]',date_inform='$_POST[tdate]'";
        //echo $sql;
      mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));




 

// unset($_SESSION['genIdpost']);
// unset($_SESSION['yearIdpost']);
echo"บันทึกสำเร็จแล้ว";
mysqli_close($con);
?>

