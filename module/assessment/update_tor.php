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


$tor_id=$_POST['tor_id'];
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

$sql="UPDATE tor SET tor_id = '$tor_id' , gen_id = '$gen_id',tor_year='$no',tor_nameRe='$name',tor_pos='$g_pos',tor_department='$dept',tor_leader='$leader',tor_leader_pos='$l_pos',tor_aca='$g_aca',tor_salary='$salary',tor_acdCode='$acd_no',tor_affiliation='$aff',tor_leves='$leves',
tor_startWork='$st_work',tor_sumWork='sum_work',inspector='$inspector',tor_punishment='$punishment' WHERE  tor_id = '$tor_id'";
// $sql33 = "INSERT INTO  tor (tor_id,gen_id,tor_year,tor_nameRe,tor_pos,tor_department,tor_leader,tor_leader_pos,tor_aca,tor_salary,tor_acdCode,tor_affiliation,tor_leves,tor_startWork,tor_sumWork,inspector,tor_punishment) 
// VALUES ('$tor_id','$gen_id','$no','$name','$g_pos','$dept','$leader','$l_pos','$g_aca','$salary','$acd_no',
//'$aff','$leves','$st_work','$sum_work','$inspector','$punishment')";

$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
echo $sql;
$con->close();

?>