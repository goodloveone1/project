<?php
include("../../function/db_function.php");
$con=connect_db();
$sql="DELETE FROM assessments WHERE ass_id = '$_POST[id]'";
//echo $sql;

mysqli_query($con,$sql)or die("SQL.error".mysqli_error($con));

echo "ลบ $_POST[type] ของ $_POST[user]เสร็จแล้ว";
mysqli_close($con);
?>