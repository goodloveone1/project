<?php
include("../../function/db_function.php");
$con=connect_db();

echo $gen_id = $_POST['id'];
if(!empty($gen_id)){
$sql = "DELETE FROM general WHERE gen_id = $gen_id";
  // echo $sql;
mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
}
?>