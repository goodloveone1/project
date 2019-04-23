<?php
    include("../../function/db_function.php");
    $con=connect_db();
    if(empty($_POST['hcompt'])){
        $h_comt='';
    }else{
        $h_comt=$_POST['hcompt'];
    }
    $sql="UPDATE asessment_t6 SET  leader_comt = '$_POST[ap]',leader_comt_disc='$h_comt',leader_compt_date='$_POST[date]' WHERE  ass6_id = '$_POST[id]'";
    //echo $_POST['ap'];
    //echo $sql;
    //echo $_POST['id'];
    $result=mysqli_query ($con,$sql) or die ("error sql1".mysqli_error($con));


    $con->close();
    


?>