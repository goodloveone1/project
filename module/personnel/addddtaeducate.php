<?php
include("../../function/db_function.php");
$con=connect_db();

$gen_id = empty($_POST['gen_id'])?'':$_POST['gen_id'];
$ed_id = empty($_POST['ed_id'])?'':$_POST['ed_id'];
$ed_name = empty($_POST['ed_name'])?'':$_POST['ed_name'];
$ed_loc = empty($_POST['ed_loc'])?'':$_POST['ed_loc'];
$degree_id=empty($_POST['degree_id'])?'':$_POST['degree_id'];


$sql = "INSERT INTO  education (ed_id,gen_id,degree_id,ed_name,ed_loc) VALUES ('','$gen_id','$degree_id','$ed_name','$ed_loc')";

echo $sql;
$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
?>