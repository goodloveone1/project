<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

// echo $_POST['genid'];
// echo $_POST['tor_id'];
// echo $_POST['punishment'];


$sql="UPDATE assessments SET  punishment = '$_POST[punishment]' WHERE  ass_id = '$_POST[tor_id]'";

//echo $sql;
$result=mysqli_query ($con,$sql) or die ("error sql1".mysqli_error($con));


if(!$result){
    echo  mysqli_error($con);
}else{
    echo  "บันทึกสำเร็จ";
}

$con->close();

?>
