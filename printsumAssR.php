
<?php
session_start();

//if(!empty($_POST['year']) && !empty($_POST['stid'])){

include("function/db_function.php");
include("function/fc_time.php");
$con=connect_db();

$yearIdpost = "TOR62229399";
$genIdpost = "6202399";

// $year = $_POST['year'];
// $stid = $_POST['stid'];

$tor=mysqli_query($con,"SELECT ass_id,staff,year_id,leader,hleader,sleader,sumwork,punishment FROM assessments WHERE ass_id='$yearIdpost'AND staff='$genIdpost'")or die("SQL_ERROR".mysqli_error($con));
list($tor_id,$staff_id,$year_id,$leader_id,$hleader,$sleader,$sumwork,$punishment)=mysqli_fetch_row($tor);

$re_staff=mysqli_query($con,"SELECT fname,lname,branch_id,salary,aca_code,acadeic,leves,other,startdate,position FROM staffs WHERE st_id='$staff_id'") or die("Staff_SQL-error".mysqli_error($con));
list( $fname,$lname,$branch_id,$salary,$aca_code,$acadeie,$leves,$other,$startdate,$position)=mysqli_fetch_row($re_staff);

$re_leader = mysqli_query($con,"SELECT fname,lname,branch_id,salary,aca_code,acadeic,leves,other,startdate,position FROM staffs WHERE st_id='$leader_id'") or die("Leader_SQL-error".mysqli_error($con));
list( $l_fname,$l_lname,$l_branch_id,$l_salary,$l_aca_code,$l_acadeie,$l_leves,$l_other,$l_startdate,$l_position)=mysqli_fetch_row($re_leader);

$re_aca = mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$acadeie'") or die("ACA_SQL-error".mysqli_error($re_aca));
list($acaName)=mysqli_fetch_row($re_aca);

mysqli_free_result($tor);
mysqli_free_result($re_staff);
mysqli_free_result($re_leader);
mysqli_free_result($re_aca);




require_once __DIR__ . '/vendor/autoload.php';
 
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];
 
$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];
 
 
$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/font',
    ]),
    'fontdata' => $fontData + [
        // จุดสำคัญคือตรงชื่อ font ตรงนี้ต้องตัวเล็กหมดครับ
        'th_niramit' => [
						'R' => 'TH_Niramit_AS.ttf',
						'useOTL' => 0x00,
        ]
    ],
		'default_font' => 'th_niramit',
		['format' => 'utf-8',
		 [190, 236]]
    
]);


$mpdf->WriteHTML("

		<h3 align='center'>ข้อตกลงและแบบประเมินผลการปฏิบัติงานของข้าราชการพลเรือนในสถาบันอุดมศึกษา สายวิชาการ(ตำแหน่ง $acaName) สังกัดมหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</h3>

");


$mpdf->Output();




mysqli_close($con);


// } /// END IF TOP
// else{
// 	echo "<script> window.location = 'userlogin.php' </script>";
// }
?>