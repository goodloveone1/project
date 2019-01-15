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
	$login=mysqli_query ($con,"SELECT gen_id,gen_user,gen_pass,permiss_id,gen_fname,gen_lname,branch_id,subject_id FROM  general WHERE gen_user='$user' AND gen_pass='$pw' " )or die ("erro=>".mysqli_error($con));
	list($gen_id,$username,$passwd,$level,$fname,$lname,$branch_id,$subject_id) = mysqli_fetch_row($login);

	$permiss=mysqli_query ($con,"SELECT permiss_decs FROM  permissions WHERE permiss_id='$level'" )or die (" permissions erro=> ".mysqli_error($con));
	list($permiss_decs) = mysqli_fetch_row($permiss);

	// $branch=mysqli_query ($con,"SELECT 	branch_name FROM  branch WHERE 	branch_id='$branch_id'" )or die (" permissions erro=> ".mysqli_error($con));
	// list($branch_name) = mysqli_fetch_row($branch);
	//
	// $subject=mysqli_query ($con,"SELECT subject_name FROM  subjects WHERE subject_id='$subject_id'" )or die (" permissions erro=> ".mysqli_error($con));
	// list($subject_name) = mysqli_fetch_row($subject);

		if($user==$username && $pw==$passwd)
		{
				$_SESSION['user_id'] = $gen_id;
				$_SESSION['valid_user']=$username;
				$_SESSION['user_level']=$level;
				$_SESSION['user_fnaem']=$fname;
				$_SESSION['user_lnaem']=$lname;
				$_SESSION['permiss_decs']=$permiss_decs;
				$_SESSION['branch_id']=$branch_id;
				$_SESSION['subject_id']=$subject_id;


				if($_SESSION['user_level']=="1")
				{
					echo "<script>window.location='userlogin'</script>";
					//echo"admin";

				}
				elseif($_SESSION['user_level']=="2")
				{
					echo "<script>window.location='userlogin'</script>";
					//echo"อาจารย์/บุคลากรทั้วไป";
				}
				elseif($_SESSION['user_level']=="3")
				{
					echo "<script>window.location='userlogin'</script>";
					//echo"หัวหน้าหลักสูตร์";
				}
				elseif($_SESSION['user_level']=="4")
				{
					echo "<script>window.location='userlogin'</script>";
					//echo"หน้าน้าสาขา";
				}
				elseif($_SESSION['user_level']=="5")
				{
					echo "<script>window.location='userlogin'</script>";
				//	echo"หัวหน้าคณะ";
				}
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
