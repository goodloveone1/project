<?php
	include("../../function/db_function.php");
    $con=connect_db();
    
    $Ssum=mysqli_query($con,"SELECT COUNT(idl_id) FROM idlel")or die(mysqli_error($con));
    list($C)=mysqli_fetch_row($Ssum);
    for ($i=0;$i<$C;$i++){
        $name1="i_no";
        $name2="i_day";
        $s=$i+1;
        $N=$name1.$s;
        $D=$name2.$s;
        
        $test="INSERT INTO tablea VALUES('','$_POST[no]','$_POST[$N]','$_POST[$D]'";
        //$InData=mysqli_query($con,)")or die(mysqli_error($con));
        echo $test;
      
   

        // echo "$name$i<br>";

    }
    

?>