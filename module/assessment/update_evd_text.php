<?php

include("../../function/db_function.php");
$con=connect_db();

if(empty($_POST['evd_id'])){

    $sql="UPDATE evidence_text SET  evd_text_name = '$_POST[evd_textname]' WHERE  evd_text_id = '$_POST[evdtextid]'";

    //echo $sql;
    $result=mysqli_query ($con,$sql) or die ("error sql1".mysqli_error($con));


}else{

    $sql="INSERT INTO evidence_text VALUES ('','$_POST[evd_id]','$_POST[se_id]','$_POST[evd_textname]')";

    //echo $sql;
    mysqli_query($con,$sql) or die("ERROR text ->".mysqli_error($con));
    
    $result=mysqli_query ($con,$sql) or die ("error sql1".mysqli_error($con));
}



$con->close();

?>
