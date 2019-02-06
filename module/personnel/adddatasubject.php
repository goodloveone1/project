<?php
include("../../function/db_function.php");
$con=connect_db();

$subjectname = empty($_POST['subject'])?'':$_POST['subject'];

    $re=mysqli_query($con,"SELECT COUNT(dept_id) FROM departments") or die("sumdept".mysqli_error($con));
    list($count)=mysqli_fetch_row($re);
    $dept_id=$count+1;
    mysqli_free_result($re);


$sql = "INSERT INTO  departments (dept_id,dept_name) VALUES ('$dept_id','$subjectname')";
$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
$con->close();

?>