<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
?>

<?php
    $Sbranch=mysqli_query($con,"SELECT *FROM branch") or die("errorSQLselect".mysqli_error($con));
    
?>

<form>










</form>