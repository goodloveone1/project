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
 echo $tor_id,"<br>";





echo $gen_id,"<br>";
echo $_POST['year'],"<br>";
echo $_POST['no'],"<br>";
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



//$sql = "INSERT INTO  tor (subject_name,branch_id) VALUES ('$subjectname','$branch_id')";
//$result=mysqli_query ($con,$sql) or die ("error".mysqli_error($con));
//$con->close();



?>