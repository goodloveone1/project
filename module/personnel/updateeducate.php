<?php
include("../../function/db_function.php");
$con=connect_db();

echo $id_degree = $_POST['degree_id'];
echo $ed_id = $_POST['ed_id'];
echo $ed_name = $_POST['ed_name'];
echo $ed_loc = $_POST['ed_loc'];
echo"<hr>";
$sql = "UPDATE education SET  ed_name = '$ed_name',ed_loc = '$ed_loc',degree_id='$id_degree'  WHERE  ed_id = '$ed_id'";

//echo $sql;
$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));

$con->close();

?>