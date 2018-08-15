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
	$login=mysqli_query ($con,"SELECT gen_id,gen_user,gen_pass,permiss_id,gen_fname,gen_lname FROM  general WHERE gen_user='$user' AND gen_pass='$pw' " )or die ("erro=>".mysqli_error($con));
	list($gen_id,$username,$passwd,$level,$fname,$lname) = mysqli_fetch_row($login);
	
		if($user==$username && $pw==$passwd)
		{		
				$_SESSION['user_id'] = $gen_id;
				$_SESSION['valid_user']=$username;
				$_SESSION['user_level']=$level;
				$_SESSION['user_fnaem']=$fname;
				$_SESSION['user_lnaem']=$lname;
			
	
				if($_SESSION['user_level']=="1")
				{
					echo "<script>window.location='userlogin.php'</script>";
					
				}
				elseif($_SESSION['user_level']=="2")
				{
					echo "<script>window.location='userlogin.php'</script>";
					//echo"อาจารย์/บุคลากรทั้วไป";
				}
				elseif($_SESSION['user_level']=="3")
				{
					echo "<script>window.location='userlogin.php'</script>";
					//echo"หัวหน้าหลักสูตร์";
				}
				elseif($_SESSION['user_level']=="4")
				{
					//echo "<script>window.location='student.php'</script>";
					echo"หน้าน้าสาขา";
				}
				elseif($_SESSION['user_level']=="5")
				{
					//echo "<script>window.location='student.php'</script>";
					echo"หัวหน้าคณะ";
				}
		 }
		 else
			 {
			 echo"<script>alert('username หรือ passwd ไม่ถูกต้อง')</script>";
			 echo "<script>window.location='index.php?'</script>";
			 }
			 
	mysqli_free_result($login);
	mysqli_close($con);
?>
<?php

?>