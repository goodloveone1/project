<?php
include("../../function/db_function.php");
$con=connect_db();


//echo "old img", $_POST['old_pic'];
if (empty($_FILES['pic_u']['name'])){
     $pic_user="";
     $updete_photo="";
    //echo"ไม่เปลี่ยนรูป";
}
else{
    $sum_name=date("dmyhis")."abcdefghirstuvwxyz";//เวลา+ตัวอักษร
    $char=substr(str_shuffle($sum_name),0,10);	//ตัดให้เหลือ 10 ตัว
   $pic_user=$char."_".$_FILES['pic_u']['name'];//ชื่อไฟล์
   $pic_usertemp=$_FILES['pic_u']['tmp_name'];
    copy($pic_usertemp,"../../img/$pic_user");
   if(!empty($_POST['old_pic'])){
        unlink("../../img/$old_pic");
        //echo "รูปเก่า".$_POST['old_pic'];
    //echo"มีรูปเก่า";
   }else{
       echo "ไม่มีรูปเก่า";
   }
   
    $updete_photo=",picture='$pic_user'";
 }

//เช็คค่า
// echo $_POST['gen_id'],"/";
// echo $_POST['titlename'],"/";
// echo $_POST['name'],"/";
// echo $_POST['lname'],"/";
// echo $_POST['codeid'],"/";
// echo $_POST['pos'],"/";
// echo $_POST['ap'],"/";
// echo $_POST['suj'],"/";
// echo $_POST['brn'],"/";
// echo $_POST['salary'],"/";
// echo $_POST['gen_startdate'],"/";
// echo $_POST['level_id'],"/";
// echo $_POST['uname'],"/";
// echo $_POST['passwd'],"/";
// echo $_POST['permiss'],"/";

//echo "รูปเดิม =", $_POST['old_pic'];
//echo"รูปใหม่= $updete_photo";
$update="UPDATE staffs SET st_id='$_POST[gen_id]',user='$_POST[uname]',pwd='$_POST[passwd]',branch_id='$_POST[suj]',code='$_POST[codeid]',prefix='$_POST[titlename]',fname='$_POST[name]',lname='$_POST[lname]',
salary=' $_POST[salary]',acadeic='$_POST[ap]',leves='$_POST[level_id]',startdate='$_POST[gen_startdate]',permiss_id='$_POST[permiss]',position='$_POST[pos]',aca_code='$_POST[aca_code]',other='$_POST[other]'$updete_photo WHERE  st_id='$_POST[gen_id]'";

echo $update;
mysqli_query($con,$update)or die("SQL Error=>".mysqli_error($con));

mysqli_close($con);
?>