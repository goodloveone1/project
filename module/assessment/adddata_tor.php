<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

$gen_id=$_SESSION['user_id'];

echo $gen_id,"<br>";

echo $_POST["year"];




?>