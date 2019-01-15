<?php
session_start();
include("../../function/db_function.php");
$con=connect_db();

$know= $_POST['know'];
$devp=$_POST['devp'];
$longtime = $_POST['lt'];
if(!empty($know[0])){
    for($i=0;$i<3;$i++){
        if(!empty($know[$i])){
        $sql="INSERT INTO tort4(tort4_id,tor_id,tort4_know,tort4_develop,tort4_longtime)
        VALUES('','$_POST[tor_id]','$know[$i]','$devp[$i]','$longtime[$i]')";
        //echo $sql;
        mysqli_query ($con,$sql) or die ("error1".mysqli_error($con));
        echo"บันทึกสำเร็จแล้ว";
        }
    }
}else{
    $sql2="INSERT INTO tort4(tort4_id,tor_id,tort4_know,tort4_develop,tort4_longtime)
    VALUES('','$_POST[tor_id]','-','-','-')";
    mysqli_query ($con,$sql2) or die ("error1".mysqli_error($con));
    echo"บันทึกสำเร็จแล้ว";
    //echo $sql2;

}
?>