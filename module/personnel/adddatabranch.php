<?php
include("../../function/db_function.php");
$con=connect_db();

$subjectname = empty($_POST['subject'])?'':$_POST['subject'];
$branch_id = empty($_POST['branch'])?'':$_POST['branch'];

$sql = "INSERT INTO  subjects (subject_name,branch_id) VALUES ('$subjectname','$branch_id')";

$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));

?>