<?php
include("../../function/db_function.php");
$con=connect_db();



    $gen_id = $_POST['id'];
    
    $selecUser=mysqli_query($con,"SELECT gen_id,gen_fname,gen_lname,gen_pict FROM general WHERE gen_id='$gen_id'") or die("sqlError".mysqli_error($con));
    list($gen_id,$gen_fname,$gen_lname,$gen_pict)=mysqli_fetch_row($selecUser);
    $msg="ลบข้อมูลบุคลากรชือ $gen_fname $gen_lname เรียบร้อยแล้ว";

  if(!empty($gen_pict)){
		if(file_exists("../../img/$gen_pict"))//ถ้าไม่ว่างให่ใช้คำสั่ง unlink("ตำแหน่งของไฟล์รูป"); ทำการลบ
			{
				 unlink("../../img/$gen_pict"); //คำสั่ง unlink("ตำแหน่งของไฟล์รูป");
			}
		
		}

  $sqldel = "DELETE FROM general WHERE gen_id = $gen_id";
  
  mysqli_query ($con,$sqldel) or die ("error".mysqli_error($con));
  echo $msg;

  mysqli_fetch_row($selecUser);
  mysqli_close($con);
?>