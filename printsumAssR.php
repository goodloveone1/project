
<?php
session_start();

//if(!empty($_POST['year']) && !empty($_POST['stid'])){

include("function/db_function.php");
include("function/fc_time.php");
$con=connect_db();

$yearIdpost = "TOR62229399";// TORID
$genIdpost = "6202399";

// $year = $_POST['year'];
// $stid = $_POST['stid'];

$tor=mysqli_query($con,"SELECT ass_id,staff,year_id,leader,hleader,sleader,sumwork,punishment FROM assessments WHERE ass_id='$yearIdpost'AND staff='$genIdpost'")or die("tor SQL_ERROR ".mysqli_error($con));
list($tor_id,$staff_id,$year_id,$leader_id,$hleader,$sleader,$sumwork,$punishment)=mysqli_fetch_row($tor);

$year=mysqli_query($con,"SELECT y_year,y_no,y_start,y_end,YEAR(y_start),YEAR(y_end) FROM years WHERE y_id='$year_id'")or die("SQL_ERROR".mysqli_error($con));
list($y_year,$y_no,$y_start,$y_end,$yearst,$yearnd)=mysqli_fetch_row($year);

$re_staff=mysqli_query($con,"SELECT prefix,fname,lname,branch_id,salary,aca_code,acadeic,leves,other,startdate,position FROM staffs WHERE st_id='$staff_id'") or die("Staff_SQL-error".mysqli_error($con));
list($prefix, $fname,$lname,$branch_id,$salary,$aca_code,$acadeie,$leves,$other,$startdate,$position)=mysqli_fetch_row($re_staff);

$re_leader = mysqli_query($con,"SELECT prefix,fname,lname,branch_id,salary,aca_code,acadeic,leves,other,startdate,position FROM staffs WHERE st_id='$leader_id'") or die("Leader_SQL-error".mysqli_error($con));
list($l_prefix, $l_fname,$l_lname,$l_branch_id,$l_salary,$l_aca_code,$l_acadeie,$l_leves,$l_other,$l_startdate,$l_position)=mysqli_fetch_row($re_leader);

$re_aca = mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$acadeie'") or die("ACA_SQL-error".mysqli_error($re_aca));
list($acaName)=mysqli_fetch_row($re_aca);

$re_branch=mysqli_query($con,"SELECT br_name,dept_id FROM branchs WHERE br_id='$branch_id'") or die("position-sqlError".mysqli_error($con));
list($branch_name,$dept_id)=mysqli_fetch_row($re_branch);
$re_dept=mysqli_query($con,"SELECT dept_name FROM departments	WHERE dept_id='$dept_id'") or die("dept-sqlError".mysqli_error($con));
list($dept_name)=mysqli_fetch_row($re_dept);

mysqli_free_result($re_branch);
mysqli_free_result($re_dept);

mysqli_free_result($tor);
mysqli_free_result($year);
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
<style>
p,span,b{
    font-size:19px;
}

.addfontb{
    font-weight: bold;
    font-size:18px;
}

.addunder{
    text-decoration: underline;
    text-decoration-style:dotted;
}

table, th, td {
	border: 1px solid black;
	font-size:18px;
}

p {
    display: block;
    margin-top: 1em;
    margin-bottom: 1em;
    margin-left: 0;
    margin-right: 0;
  }
</style>

<div>
<div style='float: left;width: 20%;color:white'> 1</div>
<div style='float: left;width: 58%;'><h3 align='center'>ข้อตกลงและแบบประเมินผลการปฏิบัติงานของข้าราชการพลเรือนในสถาบัน อุดมศึกษา สายวิชาการ(ตำแหน่ง $acaName) สังกัดมหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</h3></div>

<div style='float: right; width: 20%;border:solid;text-align:center;'>
<span style='font-size:16px'>
TOR– $acaName<br>
เอกสารหมายเลข 1 
<span>
</div>
		
        <div style='clear: both; margin: 0pt; padding: 0pt; '></div>
</div>
");

$mpdf->WriteHTML("<p align='center'>......................................................................................<p>");

$text = "<div>
<div style='float: left;width: 50%;text-align:center;'> 
<p class='addfontb'>ประจำปี งบประมาณ <span class='addunder'>".($y_year+543)."</span><p>
</div>
<div  style='float: left;width: 48%;text-align:left;'> 
";
if($y_no==1){
    $text .= " <p class='addfontb '> <input type='checkbox' checked='checked'> รอบที่  ๑  (๑ ต.ค. <span class='addunder'> ".($yearst+543)."</span> -๓๑ มี.ค. <span class='addunder'> ".($yearnd+543)."</span>)</p>";
    $text .= " <p class='addfontb'> <input type='checkbox'> รอบที่ ๒  (๑ เม.ย. ...............- ๓๐ ก.ย. ................)</p>";
}
else{
    $text .= " <p class='addfontb'> <input type='checkbox' > รอบที่  ๑  (๑ ต.ค. ...............-๓๑ มี.ค. ...............)</p>";
    $text .= " <p class='addfontb'> <input type='checkbox' checked='checked'> รอบที่ ๒  (๑ เม.ย. <span class='addunder'> ".($yearst+543)."</span> - ๓๐ ก.ย. <span class='addunder'> ".($yearnd+543)."</span>)</p>";
}
   
    


    $text .= "    
</div>



<div style='clear: both; margin: 0pt; padding: 0pt; '></div>
</div>";

$mpdf->WriteHTML($text);


$seaPos=mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id='$position' ")or die("SQL_ERROR".mysqli_error($con));
list( $pos_name)=mysqli_fetch_row($seaPos);
mysqli_free_result($seaPos);

$mpdf->WriteHTML("<p class='addfontb'>ชื่อผู้รับการประเมิน  <span class='addunder'>$prefix $fname $lname</span>  ตำแหน่ง <span class='addunder'>$pos_name</span> </p>
<p class='addfontb'>สังกัด <span class='addunder'>คณะบริหารธุรกิจและศิลปศาสตร์ มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</span></p>
");

$seaPos=mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id='$l_position'")or die("SQL_ERROR".mysqli_error($con));
list( $lpos_name)=mysqli_fetch_row($seaPos);
mysqli_free_result($seaPos);

$mpdf->WriteHTML("<p class='addfontb'>ชื่อผู้บังคับบัญชา/ผู้ประเมิน  <span class='addunder'>$l_prefix $l_fname $l_lname</span>  ตำแหน่ง <span class='addunder'>$lpos_name</span> </p>
");


$mpdf->WriteHTML("<br><br><p class='addfontb'>คำชี้แจง</p>
<p>๑. แบบข้อตกลงฯ นี้เป็นการกำหนดแผนการปฏิบัติงานของผู้ปฏิบัติงานในมหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา  ซึ่งเป็นข้อตกลงร่วมกับผู้บังคับบัญชาก่อนเริ่มปฏิบัติงาน </p>
<p>๒. การกำหนดข้อตกลงร่วม ผู้ปฏิบัติงานจะต้องกรอกรายละเอียดภาระงานโดยสังเขปในส่วนของภาระงานตามหน้าที่ความรับผิดชอบของตำแหน่ง และ/หรือภาระงานด้านอื่นๆ
พร้อมกำหนดตัวชี้วัดความสำเร็จของภาระงานแต่ละรายการ ตลอดจนค่าเป้าหมาย และน้ำหนักร้อยละ  สำหรับในส่วนของพฤติกรรมการปฏิบัติราชการ (สมรรถนะ)  ให้ระบุ 
เพิ่มเติมในส่วนของสมรรถนะประจำกลุ่มงาน พร้อมทั้งระบุระดับสมรรถนะค่ามาตรฐาน และการประเมินตนเอง ของสมรรถนะทุกด้าน
</p>
<p> ๓. การจัดทำข้อตกลงภาระงานดังกล่าวนี้ เพื่อใช้เป็นกรอบในการประเมินผลการปฏิบัติราชการ เพื่อประกอบการเลื่อนเงินเดือนและค่าจ้างในแต่ละรอบการประเมิน</p>
");

$mpdf->addpage();

$mpdf->WriteHTML("
<p class='addfontb'>
ข้อตกลงและแบบประเมินผลการปฏิบัติงานของข้าราชการพลเรือนในสถาบันอุดมศึกษา
สายวิชาการ (ตำแหน่ง $acaName)
</p>
");
$text="";
if($y_no==1){
    $text .= " <p class='addfontb' align='center'> <input type='checkbox' checked='checked'> รอบที่  ๑  (๑ ต.ค. <span class='addunder'> ".($yearst+543)."</span> -๓๑ มี.ค. <span class='addunder'> ".($yearnd+543)."</span>)</p>";
    $text .= " <p class='addfontb' align='center'> <input type='checkbox'> รอบที่ ๒  (๑ เม.ย. ..........- ๓๐ ก.ย. ...........)</p>";
}
else{
    $text .= " <p class='addfontb' align='center'> <input type='checkbox' > รอบที่  ๑  (๑ ต.ค. ..........-๓๑ มี.ค. ..........)</p>";
    $text .= " <p class='addfontb' align='center'> <input type='checkbox' checked='checked'> รอบที่ ๒  (๑ เม.ย. <span class='addunder'> ".($yearst+543)."</span> - ๓๐ ก.ย. <span class='addunder'> ".($yearnd+543)."</span>)</p>";
}

$mpdf->WriteHTML($text);


$mpdf->WriteHTML("<p class='addfontb' align='center'>หน่วยงาน <span class='addunder'>คณะบริหารธุรกิจและศิลปศาสตร์</span> มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา<p>");


$seaPos=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$acadeie'")or die("SQL_ERROR".mysqli_error($con));
list( $aca_name)=mysqli_fetch_row($seaPos);
mysqli_free_result($seaPos);

$datest=DateThai($startdate);

$stdate = explode(" ",$datest);

$sumworkex = explode(" ",$sumwork);



$mpdf->WriteHTML("
<p>
๑. ชื่อ-สกุล <span class='addunder'>$prefix $fname $lname</span>     ประเภทตำแหน่งวิชาการ <span class='addunder'>$aca_name</span> ตำแหน่งบริหาร  <span class='addunder'>$pos_name</span>
</p>
<p>
เงินเดือน <span class='addunder'>$salary</span> บาท  เลขที่ประจำตำแหน่ง <span class='addunder'>$aca_code</span> สังกัด <span class='addunder'>$branch_name</span>
</p>
<p>
มาช่วยราชการจากที่ใด (ถ้ามี) <span class='addunder'>$other</span> หน้าที่พิเศษ <span class='addunder'>$leves</span>
</p>
<p>
๒. เริ่มรับราชการเมื่อวันที่ <span class='addunder'>".$stdate[0]."</span> เดือน <span class='addunder'>".$stdate[1]."</span> พ.ศ. <span class='addunder'>".$stdate[2]."</span>

รวมเวลารับราชการ <span class='addunder'>".$sumworkex[0]."</span> ปี <span class='addunder'>".$sumworkex[2]."</span> เดือน <span class='addunder'>".$sumworkex[4]."</span> วัน
</p>");

$mm=date('m');  //เดือนปัจจุบัน
	$yearbudget=DATE('Y')+543;  //ปีปัจจุบัน
	$m="$mm";
	$y="$yearbudget";
	if($m<=9 && $m>3){
			$loop=2;
			$y-=1;
	}else{
			$loop=1;
	}
	
	$y_id = $y.$loop;
	//echo $y_id;

	$seldlt=mysqli_query($con,"SELECT * FROM absence WHERE staff='$genIdpost' AND year_id='$year_id'")or die(mysqli_error($con));
	for ($set1 = array (); $row = $seldlt->fetch_assoc(); $set1[] = $row);

   // print_r($set1);
 
$mpdf->WriteHTML("<p>๓. บันทึกการมาปฏิบัติงาน</p>");

if($y_no == 1){
$tableidl="
<table style='border-collapse: collapse;border:solid 1px ' width='100%'>
<tr>
    <th rowspan='2' >ประเภท</th>
    <th colspan='2'>รอบที่ 1 </th>
    <th colspan='2'>รอบที่ 2 </th>

    <th rowspan='2' >ประเภท</th>
    <th colspan='2'>รอบที่ 1 </th>
    <th colspan='2'>รอบที่ 2 </th>
</tr>
<tr>
<th>ครั้ง</th>
<th>วัน</th>
<th>ครั้ง</th>
<th>วัน</th>
<th>ครั้ง</th>
<th>วัน</th>
<th>ครั้ง</th>
<th>วัน</th>
</tr>
                <tr>
                <td>ลาป่วย</td>
                    <td align='center'>".$set1[0]['ab_num']."</td> 
                    <td align='center'>".$set1[0]['abl_day']."</td>
                    <td > </td>
                    <td></td>
                    <td rowspan='3'>ลาป่วยจำเป็นต้องรักษาตัวเป็นเวลานาน<br>คราวเดียวหรือหลายคราวรวมกัน</td>
                    <td rowspan='3' align='center'>".$set1[5]['abl_day']." </td>
                    <td rowspan='3' align='center'>".$set1[5]['abl_day']."</td>
                    <td rowspan='3'></td>
                    <td rowspan='3'></td>
                </tr>     
                <tr>
                    <td>ลากิจ</td>
                    <td></td>
                    <td></td>
                    <td align='center'>".$set1[1]['ab_num']."</td> 
                    <td align='center'>".$set1[1]['abl_day']."</td>
                </tr>

                <tr>
                    <td>มาสาย</td>
                    <td align='center'>".$set1[2]['ab_num']."</td> 
                    <td align='center'>".$set1[2]['abl_day']."</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>ลาคลอดบุตร</td>
                    <td align='center'>".$set1[3]['ab_num']."</td> 
                    <td align='center'>".$set1[3]['abl_day']."</td>
                    <td></td>
                    <td></td>
                    <td>ขาดราชการ</td>
                    <td align='center'>".$set1[6]['ab_num']."</td> 
                    <td align='center'>".$set1[6]['abl_day']."</td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>ลาอุปสมบท</td>
                    <td align='center'>".$set1[4]['ab_num']."</td> 
                    <td align='center'>".$set1[4]['abl_day']."</td>
                    <td></td>
                    <td></td>
                    <td colspan='5'></td>                
                </tr>
</table>
";    

}else{
    $tableidl="
    <table style='border-collapse: collapse;border:solid 1px ' width='100%'>
    <tr>
        <th rowspan='2' >ประเภท</th>
        <th colspan='2'>รอบที่ 1 </th>
        <th colspan='2'>รอบที่ 2 </th>
    
        <th rowspan='2' >ประเภท</th>
        <th colspan='2'>รอบที่ 1 </th>
        <th colspan='2'>รอบที่ 2 </th>
    </tr>
    <tr>
    <th>ครั้ง</th>
    <th>วัน</th>
    <th>ครั้ง</th>
    <th>วัน</th>
    <th>ครั้ง</th>
    <th>วัน</th>
    <th>ครั้ง</th>
    <th>วัน</th>
    </tr>
                    <tr>
                    <td>ลาป่วย</td>
                        <td > </td>
                        <td></td>
                        <td align='center'>".$set1[0]['ab_num']."</td> 
                        <td align='center'>".$set1[0]['abl_day']."</td>
                        <td rowspan='3'>ลาป่วยจำเป็นต้องรักษาตัวเป็นเวลานาน<br>คราวเดียวหรือหลายคราวรวมกัน</td>
                        <td rowspan='3'></td>
                        <td rowspan='3'></td>
                        <td rowspan='3' align='center'>".$set1[5]['abl_day']." </td>
                        <td rowspan='3' align='center'>".$set1[5]['abl_day']."</td>
                    </tr>
    
                    
                    <tr>
                        <td>ลากิจ</td>
                        <td></td>
                        <td></td>
                        <td align='center'>".$set1[1]['ab_num']."</td> 
                        <td align='center'>".$set1[1]['abl_day']."</td>
                    </tr>
    
                    <tr>
                        <td>มาสาย</td>
                        <td></td>
                        <td></td>
                        <td align='center'>".$set1[2]['ab_num']."</td> 
                        <td align='center'>".$set1[2]['abl_day']."</td>
                    </tr>
    
                    <tr>
                        <td>ลาคลอดบุตร</td>
                        <td></td>
                        <td></td>
                        <td align='center'>".$set1[3]['ab_num']."</td> 
                        <td align='center'>".$set1[3]['abl_day']."</td>
                        <td>ขาดราชการ</td>
                        <td></td>
                        <td></td>
                        <td align='center'>".$set1[6]['ab_num']."</td> 
                        <td align='center'>".$set1[6]['abl_day']."</td>
                    </tr>
    
                    <tr>
                        <td>ลาอุปสมบท</td>
                        <td></td>
                        <td></td>
                        <td align='center'>".$set1[4]['ab_num']."</td> 
                        <td align='center'>".$set1[4]['abl_day']."</td>
                        <td colspan='5'></td>                
                    </tr>
    </table>
    ";    
    

}

$mpdf->WriteHTML($tableidl);

$mpdf->WriteHTML("<p align='center'>ลงชื่อ..............................................................ผู้ปฏิบัติหน้าที่ตรวจสอบการมาปฏิบัติราชการของหน่วยงาน</p>
");

$mpdf->WriteHTML("<p>๔. การกระทำผิดวินัย/การถูกลงโทษ<br>
<span class='addunder'> $punishment <span>
</p>
");


$mpdf->addpage();


$mpdf->WriteHTML("<p class='addfontb addunder'> ส่วนที่  ๑  องค์ประกอบที่ ๑ ผลสัมฤทธิ์ของงาน </p>");

$table3="
<table style='border-collapse: collapse;border:solid 1px ' width='100%'>
<tr>
    <th rowspan='2'>(๑) ภาระงาน/กิจกรรม / โครงการ / งาน</th>
    <th rowspan='2'>(๒) ตัวชี้วัด / เกณฑ์ประเมิน</th>
    <th colspan='5'>(๓) ระดับค่าเป้าหมาย</th>
    <th rowspan='2'>(๔) ค่าคะแนนที่ได้</th>
    <th rowspan='2'>(๕) น้ำหนัก (ความสำคัญ/ยากง่ายของงาน)</th>
    <th rowspan='2'>(๖) ค่าคะแนนถ่วงน้ำหนัก<br> (๔) × (๕ )  / ๑๐๐ </th>
    
  
</tr>
<tr>
    <th>๑</th>
    <th>๒</th>
    <th>๓</th>
    <th>๔</th>
    <th>๕</th>
  
</tr>

";



$mpdf->WriteHTML($table3);


$mpdf->Output();




mysqli_close($con);


?>