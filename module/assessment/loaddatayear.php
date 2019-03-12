<?php 
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();
	$sY_No=mysqli_query($con,"SELECT y_id,y_no,y_start,y_end FROM years WHERE y_id='$_POST[year]'")or die(mysqli_error($con));
	while(list($y_id,$y_no,$y_s,$y_e)=mysqli_fetch_row($sY_No)){
		echo "<option value='$y_id'>รอบที่ $y_no  (", DateThai($y_s)," - ",DateThai($y_e),")</option>";

	}
	
?>