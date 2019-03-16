<?php
	include("../../function/db_function.php");
    $con=connect_db();

    $Ssum=mysqli_query($con,"SELECT COUNT(abt_id) FROM absence_type")or die(mysqli_error($con));
    list($C)=mysqli_fetch_row($Ssum);
    for ($i=0;$i<$C;$i++){
        $name1="i_no";
        $name2="i_day";
        $name3="type";
				$name4="idl_id";
        $s=$i+1;
        $N=$name1.$s;
        $D=$name2.$s;
        $T=$name3.$s;
				$id=$name4.$s;

      //  $sql="INSERT INTO idlel(idl_id,gen_id,year_id,idl_type,idl_num,idl_day)VALUES('','$_POST[gen_id]','$_POST[a_no]','$_POST[$T]','$_POST[$N]','$_POST[$D]') ";

			    $sql="UPDATE absence SET ab_num = '$_POST[$N]',abl_day ='$_POST[$D]' WHERE abt_name='$_POST[$T]' AND staff='$_POST[gen_id]'";
        // $test="INSERT INTO idlel VALUES('','$_POST[gen_id]','$_POST[Y]','$_POST[no]','$s','$_POST[$N]','$_POST[$D]')";
        // mysqli_query($con,"INSERT INTO idlel VALUES('','$_POST[gen_id]','$_POST[Y]','$_POST[no]','$s','$_POST[$N]','$_POST[$D]');")or die (mysqli_error($con));

     mysqli_query($con,$sql) or die(mysqli_error($con));
      //  echo $sql;
    }

    mysqli_close($con);

?>
