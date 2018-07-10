<?php
include("../../function/db_function.php");
$con=connect_db();

echo $id_degree = $_POST['degree_id'];
echo $ed_id = $_POST['ed_id'];
echo $ed_name = $_POST['ed_name'];
echo $ed_loc = $_POST['ed_loc'];

$sql = "UPDATE education SET ed_id = '$ed_id' , ed_name = '$ed_name',ed_loc = '$ed_loc'  WHERE  ed_id = '$ed_id'";
echo $sql;


// $result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
?>