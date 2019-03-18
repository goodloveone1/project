<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

$gen_id = $_SESSION['user_id'];


$sql = "INSERT INTO relations VALUES ('','$_POST[title]','$_POST[detail]','$_POST[date]','$gen_id')";

//echo $sql;
mysqli_query($con,$sql) or die("SQL ERROR >>> ".mysqli_error($con));

mysqli_close($con);
?>	