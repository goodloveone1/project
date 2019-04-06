<?php
session_start();
include("../../function/db_function.php");
$con=connect_db();
$y_id=$_POST['year'].$_POST['no'];
$year=$_POST['year']-543;
$sql=
"INSERT INTO years(y_id,y_year,y_no,y_start,y_end)
VALUES('$y_id','$year','$_POST[no]','$_POST[start]','$_POST[end]')";

mysqli_query($con,$sql)or die("SQL.error".mysqli_error($con));
//echo $sql;
mysqli_close($con);
?>