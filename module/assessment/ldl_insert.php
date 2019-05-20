<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
    
    $Ssum=mysqli_query($con,"SELECT COUNT(abt_id) FROM absence_type")or die(mysqli_error($con));
    list($C)=mysqli_fetch_row($Ssum);
    for ($i=0;$i<$C;$i++){
        $name1="i_no";
        $name2="i_day";
        $name3="type";
        $s=$i+1;
        $N=$name1.$s;
        $D=$name2.$s;
        $T=$name3.$s;
        
        $sql="INSERT INTO absence(ab_id,staff,year_id,abt_name,ab_num,abl_day)VALUES('','$_POST[gen_id]','$_POST[a_no]','$_POST[$T]','$_POST[$N]','$_POST[$D]') ";
        // $test="INSERT INTO idlel VALUES('','$_POST[gen_id]','$_POST[Y]','$_POST[no]','$s','$_POST[$N]','$_POST[$D]')";
        // mysqli_query($con,"INSERT INTO idlel VALUES('','$_POST[gen_id]','$_POST[Y]','$_POST[no]','$s','$_POST[$N]','$_POST[$D]');")or die (mysqli_error($con));
       
    mysqli_query($con,$sql);
    //echo $sql;
    }
    $namechk=" $_SESSION[user_fnaem] $_SESSION[user_lnaem]";
    $sql2="INSERT INTO chk_absence(chk_id,chk,name,staff_id,year_id)
    VALUES('','$_POST[chk]','$namechk','$_POST[gen_id]','$_POST[a_no]')";
   mysqli_query($con,$sql2)or die("SQL-error".mysqli_error($con));
    //echo $sql2;

    mysqli_close($con);

?>