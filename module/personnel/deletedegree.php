<?php
include("../../function/db_function.php");
$con=connect_db();

echo $ed_id = $_POST['id'];
if(!empty($ed_id)){
$sql = "DELETE FROM education WHERE ed_id = $ed_id";
echo $sql;
mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
}
?>