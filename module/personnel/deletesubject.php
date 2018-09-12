<?php
include("../../function/db_function.php");
$con=connect_db();

echo $branch_id = $_POST['id'];
if(!empty($branch_id)){
$sql = "DELETE FROM branch WHERE branch_id = $branch_id";
 echo $sql;
mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
$con->close();
}
?>