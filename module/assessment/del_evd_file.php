<?php

include("../../function/db_function.php");
$con=connect_db();





    $sql="DELETE FROM evidence_file WHERE evd_file_id='$_POST[evdidfile]'";

    echo $sql;

    $url = $_POST['url'];

   $result=mysqli_query ($con,$sql) or die ("error sql1".mysqli_error($con));

    unlink("../../".$url);
    


$con->close();

?>
