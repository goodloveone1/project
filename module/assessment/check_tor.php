<?php
    session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();
    $mm=date('m');  //เดือนปัจจุบัน
    $yearbudget=DATE('Y')+543;  //ปีปัจจุบัน
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
    echo "<p> id = $y_id </p>";
    echo "$_SESSION[user_id]";
    $tor=mysqli_query($con,"SELECT ass_id,year_id,staff FROM assessments WHERE staff='$_SESSION[user_id]' AND year_id='$y_id'") or die("SQL_ERROR".mysqli_error($con));
        list($gen_id,$tor_year,$tor_nameRe)=mysqli_fetch_row($tor);
        echo $gen_id,$tor_nameRe,"<br>";
    if($tor_year==$y_id){
    //    echo "<p style='color:blue;'>มีข้อมูลแล้ว</p>";
       include("edit_tor.php");
    }else{
        // echo"<p style='color:red;'>ยังไม่มีข้อมูล</p>";
        include("test_tor_stepBystep.php");
        // unset($_SESSION['tor_id']);
    }
    mysqli_close($con);
?>
