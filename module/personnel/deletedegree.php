<?php
include("../../function/db_function.php");
$con=connect_db();

$ed_id = $_POST['id'];


if(!empty($ed_id)){
$sql = "DELETE FROM degree WHERE degree_id = $ed_id";
echo $sql;

mysqli_query($con,$sql) or die ("error".mysqli_error($con));
}
?>