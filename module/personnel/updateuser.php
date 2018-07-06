<?php
include("../../function/db_function.php");
$con=connect_db();
$old_pic=$_POST['old_pic'];
echo "old img", $_POST['old_pic'];
if (empty($_FILES['pic_u']['name'])){
     $pic_user="";
     $updete_photo="";
    //echo"ไม่เปลี่ยนรูป";
}
else{
    $sum_name=date("dmyhis")."abcdefghirstuvwxyz";//เวลา+ตัวอักษร
    $char=substr(str_shuffle($sum_name),0,5);	//ตัดให้เหลือ 5 ตัว
   $pic_user=$char."_".$_FILES['pic_u']['name'];//ชื่อไฟล์
   $pic_usertemp=$_FILES['pic_u']['tmp_name'];
    copy($pic_usertemp,"../../img/$pic_user");
    unlink("../../img/$old_pic");
    $updete_photo=",gen_pict='$pic_user'";
 }

//เช็คค่า
echo $_POST['gen_id'],"/";
echo $_POST['titlename'],"/";
echo $_POST['name'],"/";
echo $_POST['lname'],"/";
echo $_POST['codeid'],"/";
echo $_POST['pos'],"/";
echo $_POST['ap'],"/";
echo $_POST['suj'],"/";
echo $_POST['brn'],"/";
echo $_POST['salary'],"/";
echo $_POST['gen_startdate'],"/";
echo $_POST['level_id'],"/";
echo $_POST['uname'],"/";
echo $_POST['passwd'],"/";
echo $_POST['permiss'],"/";

echo "รูปเดิม =", $_POST['old_pic'];
echo"รูปใหม่= $updete_photo";
$update="UPDATE general SET gen_id='',gen_user=' $_POST[uname]',gen_pass='$_POST[passwd]',branch_id='$_POST[brn]',subject_id='$_POST[suj]',gen_code='$_POST[codeid]',gen_prefix='$_POST[titlename]',gen_fname='$_POST[name]',gen_lname='$_POST[lname]',
gen_salary=' $_POST[salary]',gen_acadeic='$_POST[ap]',level_id='$_POST[level_id]',gen_startdate='$_POST[gen_startdate]',permiss_id='echo $_POST[permiss]',gen_pos='echo $_POST[pos]'$updete_photo WHERE  gen_id='$_POST[gen_id]'";

echo $update;
mysqli_query($con,$update)or die("SQL Error=>".mysqli_error($con));

mysqli_close($con);
?>