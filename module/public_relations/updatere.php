<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

$gen_id = $_SESSION['user_id'];

$sql = "UPDATE relations SET re_title='$_POST[title]',re_detail='$_POST[detail]',re_date = '$_POST[date]',	gen_id='$gen_id' WHERE re_id = '$_POST[re_id]'";
 mysqli_query($con,$sql) or die("SQL ERROR >>> ".mysqli_error($con));

mysqli_close($con);
?>	