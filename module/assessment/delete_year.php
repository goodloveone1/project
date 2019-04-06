<?php

include("../../function/db_function.php");
$con=connect_db();

$sql="DELETE FROM years WHERE y_id='$_POST[id]'";

mysqli_query($con,$sql)or die("SQL.error".mysqli_error($con));

echo "สำเร็จ";
?>