<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

//  echo $_POST["evdids"];
//  echo $_POST["status"];

$sql="UPDATE evidence SET  	evd_status = '$_POST[status]' WHERE  evd_id= '$_POST[evdids]'";

//echo $sql;
$result=mysqli_query ($con,$sql) or die ("error sql1".mysqli_error($con));

$con->close();

?>