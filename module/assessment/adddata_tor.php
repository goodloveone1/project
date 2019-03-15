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

 $tor=substr($yearbudget,2,4);
 $g_id=substr($gen_id,4,7);
 $tor_id="TOR".$tor.$loop.$min.$g_id;
$sql = "INSERT INTO  assessments (ass_id,staff,year_id,leader,hleader,sleader,sumwork,punishment)
VALUES('$tor_id','$_SESSION[user_id]','$_POST[a_no]','$_POST[leader_id]','$_POST[hleader_id]','$_POST[stleader_id]','$_POST[sum_work]','$_POST[punishment]')";
//echo $sql;
$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
// $_SESSION['tor_id']=$tor_id;
$con->close();

?>