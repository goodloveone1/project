<?php
session_start();
include("../../function/db_function.php");
$con=connect_db();

if(empty($_POST['ac'])){
    $accept=0;
    $date="";
}else{
    $accept=1;
    $date=DATE("Y-m-d");
}




// $sql="INSERT INTO asessment_t5(asst5_id,ass_id,accept,inform,date_inform)
//         VALUES('','$_POST[tor_id]','$accept','$taccept','$_POST[tdate]')";
$sql="UPDATE asessment_t5 
SET  accept='$accept',date_accept='$date'
WHERE asst5_id ='$_POST[tor_id]'";
       // echo $sql;
mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));


echo"บันทึกสำเร็จแล้ว";
mysqli_close($con);
?>