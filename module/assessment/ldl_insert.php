<?php
	include("../../function/db_function.php");
    $con=connect_db();
    
    $Ssum=mysqli_query($con,"SELECT COUNT(idl_type_id) FROM idlel_type")or die(mysqli_error($con));
    list($C)=mysqli_fetch_row($Ssum);
    for ($i=0;$i<$C;$i++){
        $name1="i_no";
        $name2="i_day";
        $s=$i+1;
        $N=$name1.$s;
        $D=$name2.$s;
        
        $test="INSERT INTO idlel VALUES('','$_POST[gen_id]','$_POST[Y]','$_POST[no]','$s','$_POST[$N]','$_POST[$D]')";
        mysqli_query($con,"INSERT INTO idlel VALUES('','$_POST[gen_id]','$_POST[Y]','$_POST[no]','$s','$_POST[$N]','$_POST[$D]');")or die (mysqli_error($con));
        echo $test;
    }
    
    

?>