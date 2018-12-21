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

    $tor=mysqli_query($con,"SELECT tor_id FROM tor WHERE gen_id='$_SESSION[user_id]' AND tor_year='$y_id' ") or die("SQL_ERROR".mysqli_error($con));
    list($gen_id)=mysqli_fetch_row($tor);

    if(empty($gen_id)){
       echo "NO DATA";
        include("test_tor_stepBystep.php");
    }else{
        echo"<p>มีข้อมูล</p>";
    }
    
?>