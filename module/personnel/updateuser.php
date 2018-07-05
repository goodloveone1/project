<?php
include("../../function/db_function.php");
$con=connect_db();
echo $_FILES['userphoto']['name'];

if (empty($_FILES['userphoto']['name'])){
	$user_photo="";
	$updete_photo="";
	}
	else{
   $sum_name=date("dmyhis")."abcdefghirstuvwxyz";//เวลา+ตัวอักษร
   $char=substr(str_shuffle($sum_name),0,10);	//ตัดให้เหลือ 10 ตัว
   $user_photo=$char."_".$_FILES['userphoto']['name'];//ชื่อไฟล์
   $user_phototemp=$_FILES['userphoto']['tmp_name'];
   copy($user_phototemp,"../../img/$user_photo");
   $updete_photo=",user_photo='$user_photo'";
	}

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


$update="UPDATE general SET gen_id='',gen_user=' $_POST[uname]',gen_pass='$_POST[passwd]',branch_id='$_POST[brn]',subject_id='$_POST[suj]',gen_code=' $_POST[codeid]',gen_prefix=' $_POST[titlename]',gen_fname='$_POST[name]',gen_lname='$_POST[lname]',
gen_salary=' $_POST[salary]',gen_acadeic='$_POST[ap]',level_id='$_POST[level_id]',gen_startdate='$_POST[gen_startdate]',permiss_id='echo $_POST[permiss]',gen_pos='echo $_POST[pos]',$updete_photo WHERE  gen_id='$_POST[gen_id]'";

echo $update;
//mysqli_query($con,$update)or die("SQL Error=>".mysqli_error($con));

mysqli_close($con);
?>