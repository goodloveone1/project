
<html>

<head>
<title>opendir()</title>
</head>


<?php
//     $dir = "../../img";
//     mkdir("../../img/gg");
//     // Open a directory, and read its contents
//     if (is_dir($dir)){
//       if ($dh = opendir($dir)){
//         while (($file = readdir($dh)) !== false){
//           echo "ไฟล์ :" . $file . "<br>";
//         }
//         closedir($dh);
//       }
//     }

//     if( file_exists("../../img/e810zihfvd_2344.jpg") )
// {
// echo "<p style='color:red;'>มีไฟล์แล้ว<p>";
// }
// else
// { 
// echo "ไม่มีไฟล์";
// }


// echo dateDifference($gen_startdate,date("Y/m/d"),'%y Year %m Month %d Day'

function timespan($seconds = 1, $time = '')
{
	if ( ! is_numeric($seconds))
	{
		$seconds = 1;
	}
 
	if ( ! is_numeric($time))
	{
		$time = time();
	}
 
	if ($time <= $seconds)
	{
		$seconds = 1;
	}
	else
	{
		$seconds = $time - $seconds;
	}
 
	$str = '';
	$years = floor($seconds / 31536000);
 
	if ($years > 0)
	{	
		$str .= $years.' ปี, ';
	}	
 
	$seconds -= $years * 31536000;
	$months = floor($seconds / 2628000);
 
	if ($years > 0 OR $months > 0)
	{
		if ($months > 0)
		{	
			$str .= $months.' เดือน, ';
		}	
 
		$seconds -= $months * 2628000;
	}
 
	// $weeks = floor($seconds / 604800);
 
	// if ($years > 0 OR $months > 0 OR $weeks > 0)
	// {
	// 	if ($weeks > 0)
	// 	{	
	// 		$str .= $weeks.' สัปดาห์, ';
	// 	}
 
	// 	$seconds -= $weeks * 604800;
	// }			
 
	$days = floor($seconds / 86400);
 
	if ($months > 0 OR $weeks > 0 OR $days > 0)
	{
		if ($days > 0)
		{	
			$str .= $days.' วัน, ';
		}
 
		$seconds -= $days * 86400;
	}
 
	// $hours = floor($seconds / 3600);
 
	// if ($days > 0 OR $hours > 0)
	// {
	// 	if ($hours > 0)
	// 	{
	// 		$str .= $hours.' ชั่วโมง, ';
	// 	}
 
	// 	$seconds -= $hours * 3600;
	// }
 
	// $minutes = floor($seconds / 60);
 
	// if ($days > 0 OR $hours > 0 OR $minutes > 0)
	// {
	// 	if ($minutes > 0)
	// 	{	
	// 		$str .= $minutes.' นาที, ';
	// 	}
 
	// 	$seconds -= $minutes * 60;
	// }
 
	// if ($str == '')
	// {
	// 	$str .= $seconds.' วินาที';
	// }
 
	return substr(trim($str), 0, 100);
}
 
 
// ตัวอย่างการใช้งาน
// $birthdate = strtotime( '2018-07-19' );
// $today = time();
 
// echo timespan( $birthdate , $today );
// //36 ปี, 2 เดือน, 3 สัปดาห์, 2 วัน, 4 ชั่วโมง, 51 นาที



    ?>


</body>
</html>