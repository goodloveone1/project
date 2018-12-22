<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

$gen_id=$_SESSION['user_id'];
$mm=date('m');  //เดือนปัจจุบัน
    $yearbudget=DATE('Y')+543;  //ปีปัจจุบัน
    $d=DATE('d');
    $min=DATE('i');
    $m="$mm";
    $y="$yearbudget";

if($m<=9 && $m>3){
    $loop=2;
}else{
    $loop=1;
}

if($loop==2){
    $y-=1;
}
$y_id = $y.$loop;
// echo "<p> id = $y_id </p>";

 $tor=substr($yearbudget,2,4);
 $g_id=substr($gen_id,7,10);

$tor_id=$tor.$loop.$min.$g_id;

$year=$_POST['year'];
$no=$_POST['a_no'];
$name=$_POST['name'];
$g_pos=$_POST['g_pos'];
$dept=$_POST['dept'];
$leader=$_POST['leader'];
$l_pos=$_POST['l_pos'];
$g_aca=$_POST['g_aca'];
$salary=$_POST['salary'];
$acd_no=$_POST['acd_no'];
$leves=$_POST['leves'];
$aff=$_POST['aff'];
$st_work=$_POST['st_work'];
$sum_work=$_POST['sum_work'];
$inspector=$_POST['inspector'];
$punishment=$_POST['punishment'];







echo $tor_id,"<br>";
echo $gen_id,"<br>";
echo $_POST['year'],"<br>";
echo "id Year",$_POST['a_no'],"<br>";
echo $_POST['name'],"<br>";
echo $_POST['g_pos'],"<br>";
echo $_POST['dept'],"<br>";
echo $_POST['leader'],"<br>";
echo $_POST['l_pos'],"<br>";
echo $_POST['g_aca'],"<br>";
echo $_POST['salary'],"<br>";
echo $_POST['acd_no'],"<br>";
echo $_POST['leves'],"<br>";
echo $_POST['aff'],"<br>";
echo $_POST['st_work'],"<br>";
echo $_POST['sum_work'],"<br>";
echo $_POST['inspector'],"<br>";
echo $_POST['punishment'],"<br>";



$sql = "INSERT INTO  tor (tor_id,gen_id,tor_year,tor_nameRe,tor_pos,tor_department,tor_leader,tor_leader_pos,tor_aca,tor_salary,tor_acdCode,tor_affiliation,tor_leves,tor_startWork,tor_sumWork,inspector,tor_punishment) 
VALUES ('$tor_id','$gen_id','$no','$name','$g_pos','$dept','$leader','$l_pos','$g_aca','$salary','$g_aca','$aff','$leves','$st_work','$sum_work','$inspector','$punishment')";
// echo $sql;
$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
$con->close();



?>