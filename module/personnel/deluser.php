<?php
include("../../function/db_function.php");
$con=connect_db();

$msg = "";

if(!empty($_POST['id']))
{

   $gen_id = $_POST['id'];
    
    $selecUser=mysqli_query($con,"SELECT st_id,fname,lname,picture FROM staffs WHERE st_id='$gen_id'") or die("sqlError".mysqli_error($con));
    list($gen_id,$gen_fname,$gen_lname,$gen_pict)=mysqli_fetch_row($selecUser);
    $msg="ลบข้อมูลบุคลากรชือ $gen_fname $gen_lname เรียบร้อยแล้ว";

  if(!empty($gen_pict)){
		if(file_exists("../../img/$gen_pict"))//ถ้าไม่ว่างให่ใช้คำสั่ง unlink("ตำแหน่งของไฟล์รูป"); ทำการลบ
			{
				 unlink("../../img/$gen_pict"); //คำสั่ง unlink("ตำแหน่งของไฟล์รูป");
			}
		
		}

  $sqldel = "DELETE FROM staffs WHERE st_id = $gen_id";
  
  mysqli_query ($con,$sqldel) or die ("error".mysqli_error($con));
  echo $msg;
  mysqli_fetch_row($selecUser);
}
else if(empty($_POST['delid'])){
 echo "กรุณาเลือกข้อมูลที่ต้องการลบ";


}
else{
  $del_id=$_POST['delid'];
  //print_r($del_id);
  foreach($del_id as $id ){
    $selecUser=mysqli_query($con,"SELECT st_id,fname,lname,picture FROM staffs WHERE st_id='$id'") or die("sqlError".mysqli_error($con));
    list($gen_id,$gen_fname,$gen_lname,$gen_pict)=mysqli_fetch_row($selecUser);
    
    if(!empty($gen_pict)){
      if(file_exists("../../img/$gen_pict"))//ถ้าไม่ว่างให่ใช้คำสั่ง unlink("ตำแหน่งของไฟล์รูป"); ทำการลบ
        {
           unlink("../../img/$gen_pict"); //คำสั่ง unlink("ตำแหน่งของไฟล์รูป");
        }
      
      }
  
      
          $sql="DELETE FROM staffs WHERE st_id='$id'";
          mysqli_query($con,$sql)or die ("erroe=>".mysqli_error($con));
          $msg="ลบข้อมูลบุคลากรชือ $gen_fname $gen_lname เรียบร้อยแล้ว\n";
          echo $msg;
      }
         // echo "<script>alert('ลบเสรจแล้ว')</script>";
         // echo "<script>window.location='manage_student.php'</script>";
  
}


  mysqli_close($con);
?>