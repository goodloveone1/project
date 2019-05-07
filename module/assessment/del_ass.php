<?php
include("../../function/db_function.php");
$con=connect_db();
$sql="DELETE FROM assessments WHERE ass_id = '$_POST[id]'";
//echo $sql;



if($_POST['type']=="ประเมิน"){
   $ass_id = $_POST['id'];
   $e=substr($ass_id,3,11);
   $evd_id="EVD".$e;
   $se_file=mysqli_query($con,"SELECT evd_file_name FROM evidence_file WHERE evd_id='$evd_id'")or die("SQL.error".mysqli_error($con));
    while(list($evd_name)=mysqli_fetch_row($se_file)){
       // echo $evd_name;
        unlink("../../file/$ass_id/$evd_name");
    }
    mysqli_free_result($se_file);

    echo "ลบ $_POST[type] ของ $_POST[user]เสร็จแล้ว";
    rmdir("../../file/$ass_id");
}
mysqli_query($con,$sql)or die("SQL.error".mysqli_error($con));
mysqli_close($con);
?>