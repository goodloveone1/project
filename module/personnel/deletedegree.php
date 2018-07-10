<?php
include("../../function/db_function.php");
$con=connect_db();

$ed_id = $_POST['id'];


if(!empty($ed_id)){
$sql = "DELETE FROM education WHERE ed_id = $ed_id";
echo $sql;
<<<<<<< HEAD
mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
=======

mysqli_query($con,$sql) or die ("error".mysqli_error($con));
>>>>>>> b7c57adf2749352236a9a791a32480176bf19f8d
}
?>