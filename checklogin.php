<?php
	session_start();

	$user = $_POST['user'];
	$pw = $_POST['pwd'];

	if(empty($user)or empty($pw)){
		echo"<script>alert('ไม่ได้กรอก username หรือ passwd')</script>";
		echo "<script>window.location='index.php?page=home'</script>";
	}

	include("function/db_function.php");
	$con=connect_db();
	$login=mysqli_query ($con,"SELECT st_id,user,pwd,permiss_id,fname,lname,branch_id FROM  staffs WHERE user='$user' AND pwd='$pw' " )or die ("erro=>".mysqli_error($con));
	list($st_id,$username,$passwd,$level,$fname,$lname,$branch_id) = mysqli_fetch_row($login);

	$re_dept = mysqli_query($con,"SELECT dept_id FROM branchs WHERE br_id='$branch_id'")or die("dept_sqlError".mysqli_error($con));
	list($dept_id)=mysqli_fetch_row($re_dept);

	$permiss=mysqli_query ($con,"SELECT permiss_decs FROM  permissions WHERE permiss_id='$level'" )or die (" permissions erro=> ".mysqli_error($con));
	list($permiss_decs) = mysqli_fetch_row($permiss);

		if($user==$username && $pw==$passwd){
				$_SESSION['user_id'] = $st_id;
				$_SESSION['valid_user']=$username;
				$_SESSION['user_level']=$level;
				$_SESSION['user_fnaem']=$fname;
				$_SESSION['user_lnaem']=$lname;
				$_SESSION['permiss_decs']=$permiss_decs;
				$_SESSION['branch']=$branch_id;
				$_SESSION['department']=$dept_id;

				
				// if($_SESSION['user_level']=="1")
				// {
				// 	// echo "<script>window.location='userlogin'</script>";
				// 	echo"admin";
				// }
				// elseif($_SESSION['user_level']=="2")
				// {
				// 	// echo "<script>window.location='userlogin'</script>";
				// 	echo"อาจารย์/บุคลากรทั้วไป";
				// }
				// elseif($_SESSION['user_level']=="3")
				// {
				// 	// echo "<script>window.location='userlogin'</script>";
				// 	echo"หัวหน้าหลักสูตร์";
				// }
				// elseif($_SESSION['user_level']=="4")
				// {
				// 	// echo "<script>window.location='userlogin'</script>";
				// 	echo"หน้าน้าสาขา";
				// }
				// elseif($_SESSION['user_level']=="5")
				// {
				// 	// echo "<script>window.location='userlogin'</script>";
				// 	echo"หัวหน้าคณะ";
				// }
				echo "<script>window.location='userlogin'</script>";
		 }
		 else
			 {
			 echo"<script>alert('username หรือ passwd ไม่ถูกต้อง')</script>";
			 echo "<script>window.location='index.php?'</script>";
			 }

	mysqli_free_result($permiss);
	mysqli_free_result($login);
	mysqli_close($con);
?>
<?php

?>
