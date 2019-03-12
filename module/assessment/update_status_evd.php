<?php
include("../../function/db_function.php");
$con=connect_db();

if(!empty($_POST['check'])){

    $sql = "UPDATE evidence SET  evd_status = '$_POST[check]' WHERE evd_id='$_POST[evdid]'";

    //echo $sql;
    
   mysqli_query($con,$sql) or die(mysqli_error($con));

   echo "ยืนยันข้อมูลหลักฐานเรียบร้อยแล้ว";
}else if(!empty($_POST['check2'])){

    if($_POST['check2']==3){

        $sql = "UPDATE evidence SET  evd_status = '$_POST[check2]',comman_id = '$_POST[stid]',com_date = '".date("Y-m-d")."' WHERE evd_id='$_POST[evdid]'";
        mysqli_query($con,$sql) or die(mysqli_error($con));


    }else{
        $sql = "UPDATE evidence SET  evd_status = '$_POST[check2]' WHERE evd_id='$_POST[evdid]'";
        mysqli_query($con,$sql) or die(mysqli_error($con));

    }
    echo "ยืนยันข้อมูลหลักฐานเรียบร้อยแล้ว";

}


?>