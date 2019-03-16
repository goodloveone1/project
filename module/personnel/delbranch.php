<?php
include("../../function/db_function.php");
$con=connect_db();

echo $subject_id = $_POST['id'];
if(!empty($subject_id)){
$sql = "DELETE FROM subjects WHERE subject_id = $subject_id";
// echo $sql;
mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
}
mysqli_close($con);
?>