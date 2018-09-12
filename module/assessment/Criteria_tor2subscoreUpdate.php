<?php
include("../../function/db_function.php");
$con=connect_db();

//print_r($_POST['exp_score']);
//print_r($_POST['exp_id']);
$exp_score=empty($_POST['exp_score'])?'':$_POST['exp_score'];
$exp_id=empty($_POST['exp_id'])?'':$_POST['exp_id'];

$count = count($exp_id);

for ($i=0; $i < $count; $i++) { 
	$sql = "UPDATE tort2_exp SET exp_score = '$exp_score[$i]' WHERE exp_id=$exp_id[$i]";	
	mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
}
$con->close()

?>