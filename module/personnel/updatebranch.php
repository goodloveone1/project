<?php
include("../../function/db_function.php");
$con=connect_db();

echo $subject_id = $_POST['subject_id'];
echo $subjectname = $_POST['subject'];
echo $branch_id = $_POST['branch'];

$sql = "UPDATE branchs SET br_name = '$subjectname' , dept_id = '$branch_id'  WHERE  br_id = '$subject_id'";
echo $sql;
 $result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
 $con->close();

?>