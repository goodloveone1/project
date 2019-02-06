<?php
include("../../function/db_function.php");
$con=connect_db();

$branch_id = $_POST['id'];

$sql = "DELETE FROM departments WHERE dept_id = $branch_id";
  
mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
$con->close();

echo "ลบสำเร็จแล้ว";

?>