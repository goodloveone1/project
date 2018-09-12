<?php
include("../../function/db_function.php");
$con=connect_db();

$subjectname = empty($_POST['subject'])?'':$_POST['subject'];

$sql = "INSERT INTO  branch (branch_id,branch_name) VALUES ('','$subjectname')";

$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
$con->close();

?>