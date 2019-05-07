
<?php
session_start();

//$evdid = empty($_POST['evdid'])?"":$_POST['evdid'];

$evdid = "EVD62224380";

if(!empty($evdid)){

include("function/db_function.php");
include("function/fc_time.php");
$con=connect_db();


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

$evd =  mysqli_query($con,"SELECT ass_id,st_id,st_date,comman_id,com_date,evd_status FROM evidence  WHERE evd_id='$evdid' ") or  die("SQL Error evd ==>2".mysqli_error($con));
list($ass_id,$st_id,$st_date,$comman_id,$com_date,$evd_status)=mysqli_fetch_row($evd);

$gen=  mysqli_query($con,"SELECT (SELECT aca_name FROM academic WHERE aca_id=staffs.acadeic),prefix,fname,lname FROM staffs WHERE st_id='$st_id' ") or  die("SQL Error gen==>1".mysqli_error($con));
list($aca_name,$prefix,$fname,$lname)=mysqli_fetch_row($gen);

$tor=  mysqli_query($con,"SELECT year_id FROM assessments  WHERE ass_id='$ass_id' ") or  die("SQL Error1==>tor".mysqli_error($con));
list($tor_year)=mysqli_fetch_row($tor);

$sY_No=mysqli_query($con,"SELECT y_id,y_no,y_start,y_end FROM years WHERE y_id='$tor_year'")or die(mysqli_error($con));
list($y_id,$y_no,$y_s,$y_e)=mysqli_fetch_row($sY_No);
	$m=DATE('m');
	if($m<=9 && $m>3){
		$sy_no= 2;
	}else{
		$sy_no= 1;

	}

$yeardatail = "รอบที่ ". $y_no ." (". DateThai($y_s)." - ".DateThai($y_e).")";

$head1 = "<h2 align='center'>แสดงแบบรายงานผลการปฏิบัติงาน ของบุคลากรสายวิชาการ</h2>";
$head1 .= "<h3 align='center'>ชื่อ $fname $lname ตำแหน่ง $aca_name</h3>";
$head1 .= "<h3 align='center'>สังกัด คณะบริหารธุรกิจและศิลปศาสตร์ มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</h3>";
$head1 .= "<h3 align='center'>$yeardatail</h3>";

$mpdf->WriteHTML($head1);

$table = "
<style>
table, th, td {
	border: 1px solid black;
	font-size:18px;
}
p{
	font-size:18px;
	margin:1px;
}
</style>

<table style='border-collapse: collapse;border:1px solid' width='100%'>
<thead >
	<tr >
		<th rowspan='2'>ลำดับ</th>
		<th rowspan='2'>องค์ประกอบที่ใช้ประเมิน </th>

		<th colspan='2'>หลักฐาน  ร่อยรอย การปฏิบัติงาน</th>

	</tr>
	<tr >
		<th >ข้อความ</th>
		<th >ไฟล์หลักฐาน</th>

	</tr>
</thead>
<tbody>
";
$countfile=1;
	$ev=  mysqli_query($con,"SELECT e_id,e_name, (SELECT count(se_id) FROM sub_evaluation as sev where sev.e_id = ev.e_id ) FROM evaluation as ev ") or  die("SQL Error1==>1".mysqli_error($con));
while(list($e_id,$e_name,$count)=mysqli_fetch_row($ev)){
	$table .="<tr>
	<td rowspan=".($count+1)."> $e_id </td>
	<td colspan='3'> $e_id $e_name </td>
</tr>";

$sev=  mysqli_query($con,"SELECT se_id,se_name FROM sub_evaluation WHERE e_id='$e_id' ") or  die("SQL Error1==>1".mysqli_error($con));
									while(list($sub_id,$sub_name)=mysqli_fetch_row($sev)){
                                        
                   $evd_text =  mysqli_query($con,"SELECT evd_text_id,evd_text_name FROM evidence_text WHERE se_id='$sub_id' AND evd_id='$evdid' ") or  die("SQL Error1==>1".mysqli_error($con));
                   list($evd_text_id,$evd_text_name)=mysqli_fetch_row($evd_text) ;   

									 $table .="<tr>
															<td >  $sub_name  </td>
														<td style=''>
														$evd_text_name 
													</td >";	
									
									$table .= "<td class='text-center'> 
									<table style='border-collapse: collapse;border:1px solid' width='100%'>";
												$evd_file =  mysqli_query($con,"SELECT evd_file_id,evd_file_name,evd_name_thai FROM evidence_file WHERE se_id='$sub_id' AND evd_id='$evdid' ") or  die("SQL Error1==>1".mysqli_error($con));
												$i=1;
												if($evd_file->num_rows != 0){
													while(list($evd_file_id,$evd_file_name,$evd_name_thai)=mysqli_fetch_row($evd_file)){
														$table .="<tr><td> $i </td> <td align='center'> $evd_name_thai</td></tr> ";
														$i++;		
													}
												}else{
													$table .="<tr ><td align='center'> ไม่พบไฟล์หลักฐาน </td></tr> ";
												}	
												$table .="</table>";
					
									}	
			}									

$table .="</table>";

$table;

$mpdf->WriteHTML($table);

$datethai = DateThai($st_date);
$datethai = explode(" ",$datethai);

$foot = "<div style='width:50%;float:right;text-align:center'>
	<p>ลงชื่อผู้รายงานผลปฏิบัติงาน</p>
	<p>$prefix $fname $lname</p>
	<p>($prefix $fname $lname)</p>
	<p> วันที่ ".$datethai[0]." เดือน ".$datethai[1]." พ.ศ ".$datethai[2]."</p>

</div>
";

$mpdf->WriteHTML("<h3 align='center' style=''>ข้าพเจ้าขอรับรองว่าได้ปฏิบัติงานตามที่รายงานผลการปฏิบัติงานจริง หากต่อมาภายหลังตรวจสอบแล้วว่าไม่เป็นความจริง ข้าพเจ้าจะเป็นผู้รับผิดชอบ ทุกประการ<h3>");
$mpdf->WriteHTML($foot);


$mpdf->Output();


mysqli_close($con);


} /// END IF TOP
else{
	echo "<script> window.location = 'userlogin.php' </script>";
}
?>


