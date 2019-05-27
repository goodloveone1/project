<!DOCTYPE html>
<html>
<head>
<title>PRING</title>
</head>
<body>
<?php
session_start();

if(!empty($_POST['assid'])){


include("function/db_function.php");
include("function/fc_time.php");
$con=connect_db();

//$yearIdpost = "TOR62251000";// TORID

// $yearIdpost = "PRE62226083";// TORID
// $genIdpost = "6201083";

$yearIdpost = $_POST['assid'];
// $year = $_POST['year'];
// $stid = $_POST['stid'];

$tor=mysqli_query($con,"SELECT ass_id,staff,year_id,leader,hleader,sleader,sumwork,punishment FROM assessments WHERE ass_id='$yearIdpost'")or die("tor SQL_ERROR ".mysqli_error($con));
list($tor_id,$staff_id,$year_id,$leader_id,$hleader,$sleader,$sumwork,$punishment)=mysqli_fetch_row($tor);

$year=mysqli_query($con,"SELECT y_year,y_no,y_start,y_end,YEAR(y_start),YEAR(y_end) FROM years WHERE y_id='$year_id'")or die("SQL_ERROR".mysqli_error($con));
list($y_year,$y_no,$y_start,$y_end,$yearst,$yearnd)=mysqli_fetch_row($year);

$re_staff=mysqli_query($con,"SELECT prefix,fname,lname,branch_id,salary,aca_code,acadeic,leves,other,startdate,position FROM staffs WHERE st_id='$staff_id'") or die("Staff_SQL-error".mysqli_error($con));
list($prefix, $fname,$lname,$branch_id,$salary,$aca_code,$acadeic,$leves,$other,$startdate,$position)=mysqli_fetch_row($re_staff);

$re_leader = mysqli_query($con,"SELECT prefix,fname,lname,branch_id,salary,aca_code,acadeic,leves,other,startdate,position FROM staffs WHERE st_id='$leader_id'") or die("Leader_SQL-error".mysqli_error($con));
list($l_prefix, $l_fname,$l_lname,$l_branch_id,$l_salary,$l_aca_code,$l_acadeie,$l_leves,$l_other,$l_startdate,$l_position)=mysqli_fetch_row($re_leader);

$re_aca = mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$acadeic'") or die("ACA_SQL-error".mysqli_error($re_aca));
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
 
$mpdf = new \Mpdf\Mpdf(
    [
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/font',
    ]),
    'fontdata' => $fontData + [
        // จุดสำคัญคือตรงชื่อ font ตรงนี้ต้องตัวเล็กหมดครับ
        'th_niramit' => [
                        'R' => 'THSarabunIT9.ttf',
                        'B' => 'THSarabunIT9_Bold.ttf',
                        'I' => 'THSarabunIT9_Italic.ttf',
 						'useOTL' => 0x00,
        ]
    ],
        'default_font' => 'th_niramit' ,
     'mode' => 'utf-8', 'format' => 'A4-L'    
]);

$mpdf->WriteHTML("

<style>
p,span,b{
    font-size:19px;
    word-wrap: break-word;
    
}

.addfontck{
    font-size:17px;
}

.addfontb{
    font-weight: bold;
    font-size:18px;
    word-wrap: break-word;
}

.addfontnb{
    font-weight: normal;
    font-size:18px;
    word-wrap: break-word;
}

.addunder2{
    text-decoration: underline;
    text-decoration-style:dotted;
}

.addunder{
    border-bottom:dotted;
    padding-bottom:0px;
    border-width:1px;
}

table, th, td ,tr{
	border: 1px solid black;
    font-size:18px;
    word-wrap: break-word;
}

.text-center{
    text-align:center;
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
<div style='float: left;width: 58%;'><h2 align='center'>ข้อตกลงและแบบประเมินผลการปฏิบัติงานของข้าราชการพลเรือนในสถาบัน อุดมศึกษา สายวิชาการ(ตำแหน่ง $acaName) สังกัดมหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</h2></div>

<div style='float: right; width: 20%;border:solid;text-align:center;'>
<span style='font-size:16px'>
ตัวชี้วัด – $acaName<br>
เอกสารหมายเลข 2 
<span>
</div>
        <div style='clear: both; margin: 0pt; padding: 0pt; '></div>
</div>
");

$mpdf->WriteHTML("<p align='center'>......................................................................................<p>");

$text = "<div>
<div style='float: left;width: 50%;text-align:center;'> 
<p class='addfontb'>ประจำปี งบประมาณ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='addunder'>&nbsp;&nbsp;&nbsp;".($y_year+543)."&nbsp;&nbsp;&nbsp;</span><p>
</div>
<div  style='float: left;width: 48%;text-align:left;'> 
";
if($y_no==1){
    $text .= " <p class='addfontb '> <input type='checkbox' class='addfontck' checked='checked'>&nbsp;&nbsp;&nbsp; รอบที่ &nbsp; ๑ &nbsp;&nbsp; (๑  ต.ค. <span class='addunder'>&nbsp;&nbsp; ".($yearst+543)."&nbsp;&nbsp;</span> -๓๑ มี.ค. <span class='addunder'>&nbsp;&nbsp; ".($yearnd+543)."&nbsp;&nbsp;</span>)</p>";
    $text .= " <p class='addfontb'> <input type='checkbox' class='addfontck'> &nbsp;&nbsp;&nbsp;รอบที่ &nbsp; ๒  &nbsp;&nbsp; (๑ เม.ย. ...............- ๓๐ ก.ย. ................)</p>";
}
else{
    $text .= " <p class='addfontb'> <input type='checkbox' class='addfontck'>&nbsp;&nbsp;&nbsp; รอบที่ &nbsp; ๑ &nbsp;&nbsp; (๑ ต.ค. ...............-๓๑ มี.ค. ...............)</p>";
    $text .= " <p class='addfontb'> <input type='checkbox' class='addfontck' checked='checked'>&nbsp;&nbsp;&nbsp; รอบที่ &nbsp; ๒ &nbsp;&nbsp; (๑  เม.ย. <span class='addunder'>&nbsp;&nbsp; ".($yearst+543)."&nbsp;&nbsp;</span> - ๓๐ ก.ย. <span class='addunder'> &nbsp;&nbsp;".($yearnd+543)."&nbsp;&nbsp;</span>)</p>";
}

    $text .= "    
</div>



<div style='clear: both; margin: 0pt; padding: 0pt; '></div>
</div>";

$mpdf->WriteHTML($text);


$seaPos=mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id='$position' ")or die("SQL_ERROR".mysqli_error($con));
list( $pos_name)=mysqli_fetch_row($seaPos);
mysqli_free_result($seaPos);

$seaPos=mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id='$l_position'")or die("SQL_ERROR".mysqli_error($con));
list( $lpos_name)=mysqli_fetch_row($seaPos);
mysqli_free_result($seaPos);

$mpdf->WriteHTML("
<div class='text-center'>
<p class='addfontb'>ชื่อผู้รับการประเมิน <span class='addunder addfontnb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $prefix $fname $lname &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>  
ตำแหน่ง <span class='addunder addfontnb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$pos_name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> </p>
<p class='addfontb'>สังกัด<span class='addunder addfontnb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; คณะบริหารธุรกิจและศิลปศาสตร์ มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>
<p class='addfontb'>ชื่อผู้บังคับบัญชา/ผู้ประเมิน <span class='addunder addfontnb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;$l_prefix $l_fname $l_lname&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>  
ตำแหน่ง <span class='addunder addfontnb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$lpos_name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> </p>
</div>
");




$mpdf->WriteHTML("
<br>
<span class='addfontb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;คำชี้แจง</span>
<div style='padding-left:100px;font-size:19px'>
<br>๑. แบบข้อตกลงฯ นี้เป็นการกำหนดแผนการปฏิบัติงานของผู้ปฏิบัติงานในมหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา  ซึ่งเป็นข้อตกลงร่วมกับผู้บังคับบัญชาก่อนเริ่มปฏิบัติงาน 
<br>๒. การกำหนดข้อตกลงร่วม ผู้ปฏิบัติงานจะต้องกรอกรายละเอียดภาระงานโดยสังเขปในส่วนของภาระงานตามหน้าที่ความรับผิดชอบของตำแหน่ง และ/หรือภาระงานด้านอื่นๆ
พร้อมกำหนดตัวชี้วัดความสำเร็จของภาระงานแต่ละรายการ ตลอดจนค่าเป้าหมาย และน้ำหนักร้อยละ  สำหรับในส่วนของพฤติกรรมการปฏิบัติราชการ (สมรรถนะ)  ให้ระบุ 
เพิ่มเติมในส่วนของสมรรถนะประจำกลุ่มงาน พร้อมทั้งระบุระดับสมรรถนะค่ามาตรฐาน และการประเมินตนเอง ของสมรรถนะทุกด้าน
<br> ๓. การจัดทำข้อตกลงภาระงานดังกล่าวนี้ เพื่อใช้เป็นกรอบในการประเมินผลการปฏิบัติราชการ เพื่อประกอบการเลื่อนเงินเดือนและค่าจ้างในแต่ละรอบการประเมิน
</div>
");

$mpdf->addpage();

$mpdf->WriteHTML("
<p class='addfontb' align='center'>
ข้อตกลงและแบบประเมินผลการปฏิบัติงานของข้าราชการพลเรือนในสถาบันอุดมศึกษา
สายวิชาการ (ตำแหน่ง $acaName)
</p>
");
$text="";
if($y_no==1){
    $text .= " <p class='addfontb' align='center'> <input type='checkbox' class='addfontck' checked='checked'>>&nbsp;&nbsp;&nbsp;&nbsp; รอบที่ &nbsp;&nbsp; ๑ &nbsp;&nbsp; (๑ ต.ค. <span class='addunder'>>&nbsp;&nbsp; ".($yearst+543).">&nbsp;&nbsp;</span> -๓๑ มี.ค. <span class='addunder'> >&nbsp;&nbsp;".($yearnd+543).">&nbsp;&nbsp;</span>)";
    $text .= " <br> <input type='checkbox' class='addfontck'> &nbsp;&nbsp;&nbsp;&nbsp; รอบที่ &nbsp;&nbsp; ๒ &nbsp;&nbsp; (๑ เม.ย. ...................- ๓๐ ก.ย. .....................)</p>";
}
else{
    $text .= " <p class='addfontb' align='center'> <input type='checkbox' class='addfontck'>&nbsp;&nbsp;&nbsp;&nbsp; รอบที่ &nbsp;&nbsp; ๑ &nbsp;&nbsp; (๑ ต.ค. ...................-๓๑ มี.ค. .....................)";
    $text .= " <br> <input type='checkbox' checked='checked' class='addfontck'>&nbsp;&nbsp;&nbsp;&nbsp; รอบที่ &nbsp;&nbsp; ๒ &nbsp;&nbsp; (๑ เม.ย. <span class='addunder'>&nbsp;&nbsp; ".($yearst+543)."&nbsp;&nbsp;</span> - ๓๐ ก.ย. <span class='addunder'>&nbsp;&nbsp; ".($yearnd+543)."&nbsp;&nbsp;</span>)</p>";
}

$mpdf->WriteHTML($text);


$mpdf->WriteHTML("<p class='addfontb' align='center'>หน่วยงาน <span class='addunder'>คณะบริหารธุรกิจและศิลปศาสตร์</span> มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</p>");


$seaPos=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$acadeic'")or die("SQL_ERROR".mysqli_error($con));
list( $aca_name)=mysqli_fetch_row($seaPos);
mysqli_free_result($seaPos);

$datest=DateThai($startdate);

$stdate = explode(" ",$datest);

$sumworkex = explode(" ",$sumwork);

$mpdf->WriteHTML("
<span>
๑. ชื่อ-สกุล  <span class='addunder'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  $prefix $fname $lname  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
ประเภทตำแหน่งวิชาการ <span class='addunder'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $aca_name  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
ตำแหน่งบริหาร <span class='addunder'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $pos_name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
<br>
เงินเดือน <span class='addunder'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".number_format($salary,2)." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>  บาท 
&nbsp;&nbsp;เลขที่ประจำตำแหน่ง <span class='addunder'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $aca_code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>  
&nbsp;&nbsp; สังกัด <span class='addunder'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $branch_name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
<br>
มาช่วยราชการจากที่ใด (ถ้ามี) <span class='addunder'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$other&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
&nbsp;&nbsp;หน้าที่พิเศษ <span class='addunder'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$leves&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
<br>
๒. เริ่มรับราชการเมื่อวันที่ <span class='addunder'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$stdate[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
&nbsp;&nbsp;เดือน <span class='addunder'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$stdate[1]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
&nbsp;&nbsp; พ.ศ. <span class='addunder'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$stdate[2]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
<br>
รวมเวลารับราชการ <span class='addunder'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sumworkex[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
&nbsp;&nbsp;ปี <span class='addunder'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sumworkex[2]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
&nbsp;&nbsp;เดือน <span class='addunder'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sumworkex[4]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> วัน
</span>");

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

	$seldlt=mysqli_query($con,"SELECT * FROM absence WHERE staff='$staff_id' AND year_id='$year_id'")or die(mysqli_error($con));
    for ($set1 = array (); $row = $seldlt->fetch_assoc(); $set1[] = $row);
    mysqli_free_result($seldlt);

   // print_r($set1);
 
$mpdf->WriteHTML("<span>๓. บันทึกการมาปฏิบัติงาน</span><br>");

if($y_no == 1){
$tableidl="
<table style='border-collapse: collapse;border:solid 1px ' width='100%'>
<thead>
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
</thead>
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
<span class='addunder'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $punishment &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>
</p>
");

$mpdf->addpage();
$mpdf->WriteHTML("<p > <span class='addfontb addunder2'>ส่วนที่  ๑  องค์ประกอบที่ ๑ ผลสัมฤทธิ์ของงาน </span></p>");

$table3="
<table style='border-collapse: collapse;border:solid 1px' width='100%' >
<thead>
<tr>
    <th rowspan='2' width='25%'>(๑) ภาระงาน/กิจกรรม / โครงการ / งาน</th>
    <th rowspan='2' width='40%'>(๒) ตัวชี้วัด / เกณฑ์ประเมิน</th>
    <th colspan='5' >(๓) ระดับค่าเป้าหมาย</th>
    <th rowspan='2' width='5%'>(๔) ค่าคะแนนที่ได้</th>
    <th rowspan='2' width='5%'>(๕) น้ำหนัก (ความสำคัญ/<br>ยากง่ายของงาน)</th>
    <th rowspan='2' width='5%'>(๖) ค่าคะแนนถ่วงน้ำหนัก<br> (๔) × (๕ )  / ๑๐๐ </th> 
</tr>
<tr>
    <th >๑</th>
    <th>๒</th>
    <th>๓</th>
    <th>๔</th>
    <th>๕</th>
</tr>
</thead>
";

$numthai = array("๑","๒","๓","๔","๕");
$countnumthai=0;
$ck1='';$ck2='';$ck3='';$ck4='';$ck5='';
$ev=mysqli_query($con,"SELECT e_id,e_name FROM evaluation")or die("tor SQL_ERROR ".mysqli_error($con));
while(list($e_id,$e_name)=mysqli_fetch_row($ev)){

    $asst1=mysqli_query($con,"SELECT goal,score,weight,weighted FROM asessment_t1 WHERE title_name='$e_id' AND ass_id='$yearIdpost'") or die("tor SQL_ERROR ".mysqli_error($con));
    list($goal,$score,$weight,$weighted)=mysqli_fetch_row($asst1);
    
    $ck1='';$ck2='';$ck3='';$ck4='';$ck5='';
    switch($goal){
        case '1':$ck1="<span class='addfontb'>&radic;</span>";
        break;
        case '2':$ck2="<span class='addfontb'>&radic;</span>";
        break;
        case '3':$ck3="<span class='addfontb'>&radic;</span>";
        break;
        case '4':$ck5="<span class='addfontb'>&radic;</span>";
        break;
        case '5':$ck5="<span class='addfontb'>&radic;</span>";
        break;
    }
    $work_hour=mysqli_query($con,"SELECT min_hour FROM work_hour WHERE e_id='$e_id' AND aca_id='$acadeic' ") or die("work_hour SQL_ERROR ".mysqli_error($con));
    list($min_hour)=mysqli_fetch_row($work_hour);

    $table3.= "
    <tr>
        <td style='vertical-align:top'> <span  class='addfontb addunder2'>".$numthai[$countnumthai]."  $e_name </span><br><span  class='addfontb'> $min_hour </span><br> <span>";
        
        $subev=mysqli_query($con,"SELECT se_name FROM sub_evaluation WHERE e_id='$e_id'") or die("tor SQL_ERROR ".mysqli_error($con));
        while(list($se_name)=mysqli_fetch_row($subev)){
            $table3.="&nbsp;&nbsp;&nbsp;$se_name<br>";
        };
           
        $table3.= "</span></td>
        <td > <p>";
        
        $cond=mysqli_query($con,"SELECT con_ex FROM conditions WHERE e_name='$e_id' AND aca_id='$acadeic' ORDER BY con_level DESC") or die("tor SQL_ERROR ".mysqli_error($con));
        while(list($con_ex)=mysqli_fetch_row($cond)){
            $table3.="&nbsp;&nbsp;&nbsp;$con_ex<br>";
        };
        
        $table3.= "</p></td>
        <td align='center'>$ck1</td>
        <td align='center'>$ck2</td>
        <td align='center'>$ck3</td>
        <td align='center'>$ck4</td>
        <td align='center'>$ck5</td>
        <td align='center'><p>$score</p></td>
        <td align='right'><p>$weight</p></td>
        <td align='right'><p>$weighted</p></td>
    </tr>

    ";
    $countnumthai++;
}
mysqli_free_result($asst1);
mysqli_free_result($work_hour);
$sumasst1=mysqli_query($con,"SELECT sum_weight,sum_weighted,sum_asst1 FROM sum_score_assessment_t1 WHERE ass_id='$yearIdpost'") or die("tor SQL_ERROR ".mysqli_error($con));
list($sum_weight,$sum_weighted,$sum_asst1)=mysqli_fetch_row($sumasst1);

$table3.="
<tr>
    <td colspan='8' align='right'> ผลรวม &nbsp&nbsp&nbsp&nbsp</td>
    <td align='right'><p> $sum_weight </p></td>
    <td align='right'><p> $sum_weighted </p></td>
</tr>
<tr>
    <td colspan='9' align='right'>
    สรุปคะแนนส่วนผลสัมฤทธิ์ของงาน  =  <span class='' style='border-bottom:solid 1mm' >ผลรวมของค่าคะแนนถ่วงน้ำหนัก</span>   = <br>
    จำนวนระดับค่าเป้าหมาย =  ๕  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
    <td align='right' class='addfontb'> <p>$sum_asst1 </p></td>
</tr>
</table>

";

mysqli_free_result($ev);

$mpdf->WriteHTML($table3);

$mpdf->addpage();

$mpdf->WriteHTML("<span class='addfontb addunder2'> ส่วนที่  ๒  องค์ประกอบที่ ๒ พฤติกรรมการปฏิบัติงาน (สมรรถนะ) </span>");

$seexp=mysqli_query($con,"SELECT goal,score FROM asessment_t2 WHERE ass_id='$tor_id' ORDER BY subcap_id ASC")or die(mysqli_error($con));
for ($set = array (); $row = $seexp->fetch_assoc(); $set[] = $row);
mysqli_free_result($seexp);

$n1 = empty($set[0]['score'])?"0":$set[0]['score'];
$n2 = empty($set[1]['score'])?"0":$set[1]['score'];
$n3 = empty($set[2]['score'])?"0":$set[2]['score'];
$n4 = empty($set[3]['score'])?"0":$set[3]['score'];
$n5 = empty($set[4]['score'])?"0":$set[4]['score'];
$n6 = empty($set[5]['score'])?"0":$set[5]['score'];
$n7 = empty($set[6]['score'])?"0":$set[6]['score'];
$n8 = empty($set[7]['score'])?"0":$set[7]['score'];
$n9 = empty($set[8]['score'])?"0":$set[8]['score'];
$n10 = empty($set[9]['score'])?"0":$set[9]['score'];
$n11 = empty($set[10]['score'])?" ":$set[10]['score'];
$n12 = empty($set[11]['score'])?" ":$set[11]['score'];
$n13 = empty($set[12]['score'])?" ":$set[12]['score'];
$n14 = empty($set[13]['score'])?" ":$set[13]['score'];
$n15 = empty($set[14]['score'])?" ":$set[14]['score'];

$g1 = empty($set[0]['goal'])?"0":$set[0]['goal'];
$g2 = empty($set[1]['goal'])?"0":$set[1]['goal'];
$g3 = empty($set[2]['goal'])?"0":$set[2]['goal'];
$g4 = empty($set[3]['goal'])?"0":$set[3]['goal'];
$g5 = empty($set[4]['goal'])?"0":$set[4]['goal'];
$g6 = empty($set[5]['goal'])?"0":$set[5]['goal'];
$g7 = empty($set[6]['goal'])?"0":$set[6]['goal'];
$g8 = empty($set[7]['goal'])?"0":$set[7]['goal'];
$g9 = empty($set[8]['goal'])?"0":$set[8]['goal'];
$g10 = empty($set[9]['goal'])?"0":$set[9]['goal'];
$g11 = empty($set[10]['goal'])?" ":$set[10]['goal'];
$g12 = empty($set[11]['goal'])?" ":$set[11]['goal'];
$g13 = empty($set[12]['goal'])?" ":$set[12]['goal'];
$g14 = empty($set[13]['goal'])?" ":$set[13]['goal'];
$g15 = empty($set[14]['goal'])?" ":$set[14]['goal'];

$t2 ="
<div>
    <div style='float: left; width: 32%;padding:5px'>
        <table style='border-collapse: collapse;border:solid 1px ' width='100%' align='center'>
        <tr>
            <th>สมรรถนะหลัก <br>(ที่สภามหาวิทยาลัยกำหนด) </th>
            <th>ระดับ<br>สมรรถนะ<br>ที่คาดหวัง  </th>
            <th>ระดับ<br>สมรรถนะ<br>ที่แสดงออก  </th>
        </tr>
        <tr>
            <td>การมุ่งผลสัมฤทธิ์ <br>&nbsp;</td>
            <td align='center'>$g1</td>
            <td align='center'>$n1</td>
        </tr>
        <tr>
            <td>บริการที่ดี <br>&nbsp;</td>
            <td align='center'>$g2</td>
            <td align='center'>$n2</td>
        </tr>
        <tr>
            <td>การสั่งสมความเชี่ยวชาญในงานอาชีพ </td>
            <td align='center'>$g3</td>
            <td align='center'>$n3</td>
        </tr>
        <tr>
            <td>การยึดมั่นในความถูกต้องชอบธรรม  และจริยธรรม</td>
            <td align='center'>$g4</td>
            <td align='center'>$n4</td>
        </tr>
        <tr>
            <td>การทำงานเป็นทีม</td>
            <td align='center'>$g5</td>
            <td align='center'>$n5</td>
        </tr>
        </table>
    </div>

    <div style='float: left; width: 32%;padding:5px'>
        <table style='border-collapse: collapse;border:solid 1px ' width='100%' >
        <tr>
            <th>สมรรถนะเฉพาะ<br>ตามลักษณะงานที่ปฏิบัติ <br> (ที่สภามหาวิทยาลัยกำหนด) </th>
            <th>ระดับ<br>สมรรถนะ<br>ที่คาดหวัง  </th>
            <th>ระดับ<br>สมรรถนะ<br>ที่แสดงออก  </th>
        </tr>
        <tr>
            <td>ทักษะการสอนและการ<br>ให้คำปรึกษาแก่นักศึกษา</td>
            <td align='center'>$g6</td>
            <td align='center'>$n6</td>
        </tr>
        <tr>
            <td>ทักษะด้านบริการวิชาการ<br>การวิจัยและนวัตกรรม</td>
            <td align='center'>$g7</td>
            <td align='center'>$n7</td>
        </tr>
        <tr>
            <td>ความรู้ความเชี่ยวชาญด้านวิชาการ</td>
            <td align='center'>$g8</td>
            <td align='center'>$n8</td>
        </tr>
        <tr>
            <td>ความกระตือรือร้นและ<br>การเป็นแบบอย่างที่ดี</td>
            <td align='center'>$g9</td>
            <td align='center'>$n9</td>
        </tr>
        <tr>
            <td>ทำนุบำรุงศิลปวัฒนธรรม</td>
            <td align='center'>$g10</td>
            <td align='center'>$n10</td>
        </tr>
        </table>
    </div>

    <div style='float: left; width: 32%;padding:5px'>
        <table style='border-collapse: collapse;border:solid 1px ' width='100%' >
        <tr>
            <th>สมรรถนะทางการบริหาร<br>(ที่สภามหาวิทยาลัยกำหนด)</th>
            <th>ระดับ<br>สมรรถนะ<br>ที่คาดหวัง  </th>
            <th>ระดับ<br>สมรรถนะ<br>ที่แสดงออก  </th>
        </tr>
        <tr>
            <td>สภาวะผู้นำ<br>&nbsp;</td>
            <td align='center'>$g11</td>
            <td align='center'>$n11</td>
        </tr>
        <tr>
            <td>วิสัยทัศน์<br>&nbsp;</td>
            <td align='center'>$g12</td>
            <td align='center'>$n12</td>
        </tr>
        <tr>
            <td>ศักยภาพเพื่อนำการปรับเปลี่ยน</td>
            <td align='center'>$g13</td>
            <td align='center'>$n13</td>
        </tr>
        <tr>
            <td>การสอนงานและ<br>การมอบหมายงาน</td>
            <td align='center'>$g14</td>
            <td align='center'>$n14</td>
        </tr>
        <tr>
            <td>การควบคุมตนเอง</td>
            <td align='center'>$g15</td>
            <td align='center'>$n15</td>
        </tr>
        </table>
    </div>

    <div style='clear: both; margin: 0pt; padding: 0pt; '></div>

</div>

";

$mpdf->WriteHTML($t2);

$t2_skill=mysqli_query($con,"SELECT score_skil,score_x,score FROM assessment_t2_skill WHERE ass_id='$tor_id' ORDER BY score_x DESC")or die(mysqli_error($con));
for ($setskill = array (); $row = $t2_skill->fetch_assoc(); $setskill[] = $row);
mysqli_free_result($t2_skill);

$sumt2=mysqli_query($con,"SELECT sum_asst2 FROM sum_score_assessment_t2 WHERE ass_id='$tor_id'")or die(mysqli_error($con));
list($sum_asst2)=mysqli_fetch_row($sumt2);
mysqli_free_result($sumt2);


$mpdf->WriteHTML("
<table style='border-collapse: collapse;border:solid 1px ' width='100%' >
<tr>
    <th rowspan='2'>หลักเกณฑ์การประเมิน</th>
    <th colspan='3'>การประเมิน</th>    
</tr>
<tr>
    <th>จำนวนสมรรถนะ</th>
    <th>คูณ (×)</th>   
    <th>&nbsp;&nbsp;คะแนน &nbsp;&nbsp;</th>   
</tr>
<tr>
    <td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  สูงกว่าหรือเท่ากับ ระดับสมรรถนะที่คาดหวัง  ×  ๓ คะแนน</td>
    <td align='right'>".$setskill['0']['score_skil']."</td>
    <td align='right'>".$setskill['0']['score_x']."</td>
    <td align='right'>".$setskill['0']['score']."</td>
</tr>
<tr>
    <td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๑  ระดับ    × ๒ คะแนน</td>
    <td align='right'>".$setskill['1']['score_skil']."</td>
    <td align='right'>".$setskill['1']['score_x']."</td>
    <td align='right'>".$setskill['1']['score']."</td>
</tr>
<tr>
    <td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๒  ระดับ  ×  ๑  คะแนน  </td>
    <td align='right'>".$setskill['2']['score_skil']."</td>
    <td align='right'>".$setskill['2']['score_x']."</td>
    <td align='right'>".$setskill['2']['score']."</td>
</tr>
<tr>
    <td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๓  ระดับ   ×  ๐  คะแนน</td>
    <td align='right'>".$setskill['3']['score_skil']."</td>
    <td align='right'>".$setskill['3']['score_x']."</td>
    <td align='right'>".$setskill['3']['score']."</td>
</tr>
<tr>
    <td colspan='3' align='right'>ผลรวมคะแนน&nbsp;&nbsp;&nbsp;</td>
    <td align='right'> $sum_asst2 </td>
</tr>
<tr>
    <td colspan='4' align='right' >
    
    สรุปคะแนนส่วนพฤติกรรม (สมรรถนะ) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  =  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='addunder'>&nbsp;&nbsp;&nbsp;  ผลรวมคะแนน  &nbsp;&nbsp;&nbsp;</span>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; =   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
    จำนวนสมรรถนะที่ใช้ในการประเมิน × ๓   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    </td>
</tr>
</table>
");
$mpdf->WriteHTML("
<br>
<div style='font-size:19px;border:solid;padding:5px' align='center'>
ผู้ประเมินและผู้รับการประเมินได้ตกลงร่วมกันและเห็นพ้องกันแล้ว (ระบุข้อมูลใน (๑) (๒) (๓) และ (๕) ให้ครบ) จึงลงลายมือชื่อไว้เป็นหลักฐาน (ลงนามเมื่อจัดทำข้อตกลง)<br>

<div style='float: left; width: 49%;' align='center'>
ลายมือชื่อ...............................................................(ผู้ประเมิน)
วันที่...............เดือน....................................พ.ศ.........................
</div>

<div style='float: left; width: 49%;' align='center'>
ลายมือชื่อ...............................................................(ผู้รับการประเมิน)
วันที่...............เดือน....................................พ.ศ........................
</div>

<div style='clear: both; margin: 0pt; padding: 0pt;'></div>
</div>
");

$mpdf->addpage();

$t3=mysqli_query($con,"SELECT score,weignt,sum FROM asessment_t3 WHERE ass_id='$tor_id' ORDER BY weignt DESC")or die(mysqli_error($con));
for ($sett3 = array (); $row = $t3->fetch_assoc(); $sett3[] = $row);
mysqli_free_result($t3);

$sumt3=mysqli_query($con,"SELECT sum_score FROM sum_score_assessment_t3 WHERE ass_id='$tor_id'")or die(mysqli_error($con));
list($sum_score)=mysqli_fetch_row($sumt3);
mysqli_free_result($sumt3);

$mpdf->WriteHTML("<span class='addfontb addunder2'> ส่วนที่ ๓ สรุปการประเมินผลการปฏิบัติราชการ </span>");

$mpdf->WriteHTML("
<br>
<table style='border-collapse: collapse;border:solid 1px ' width='100%'>
<tr>
    <th style='width:70%'>องค์ประกอบการประเมิน</th>
    <th>คะแนน(ก)</th>
    <th>น้ำหนัก(ข)</th>
    <th>รวมคะแนน (ก)×(ข) </th>
</tr>
<tr>
    <td>องค์ประกอบที่  ๑ : ผลสัมฤทธิ์ของงาน</td>
    <td align='right'>".$sett3['0']['score']."</td>
    <td align='right'>".$sett3['0']['weignt']."</td>
    <td align='right'>".$sett3['0']['sum']."</td>
</tr>
<tr>
    <td>องค์ประกอบที่  ๒ : พฤติกรรมการปฏิบัติราชการ (สมรรถนะ)</td>
    <td align='right'>".$sett3['1']['score']."</td>
    <td align='right'>".$sett3['1']['weignt']."</td>
    <td align='right'>".$sett3['1']['sum']."</td>
</tr>
<tr>
    <td>องค์ประกอบอื่น (ถ้ามี)</td>
    <td align='right'>".$sett3['2']['score']."</td>
    <td align='right'>".$sett3['2']['weignt']."</td>
    <td align='right'>".$sett3['2']['sum']."</td>
</tr>
<tr>
    <td colspan='2' align='right'>รวม&nbsp;</td>
    <td align='right'>".number_format(($sett3['0']['weignt']+$sett3['1']['weignt']+$sett3['2']['weignt']),2)."</td>
    <td align='right'> $sum_score</td>
</tr>
</table>
");

$ch1="";$ch2="";$ch3="";$ch4="";$ch5="";
if($sum_score >= 90){
    $ch1 = "checked='checked'";
}
else if($sum_score >= 80){
    $ch2 = "checked='checked'";
}
else if($sum_score >= 70){
    $ch3 = "checked='checked'";
}
else if($sum_score >= 60){
    $ch4 = "checked='checked'";
}else{
    $ch5 = "checked='checked'";
}

$mpdf->WriteHTML("
<span class='addfontb addunder2'> ระดับผลการประเมิน </span><br>
<span class='addfontb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='addfontck' type='checkbox' $ch1>&nbsp;&nbsp;ดีเด่น (๙๐-๑๐๐) </span><br>
<span class='addfontb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='addfontck' type='checkbox' $ch2>&nbsp;&nbsp;ดีมาก (๘๐-๘๙) </span><br>
<span class='addfontb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='addfontck' type='checkbox' $ch3>&nbsp;&nbsp;ดี (๗๐-๗๙) </span><br>
<span class='addfontb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='addfontck' type='checkbox' $ch4>&nbsp;&nbsp;พอใช้ (๖๐-๖๙) </span><br>
<span class='addfontb'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class='addfontck' type='checkbox' $ch5>&nbsp;&nbsp;ต้องปรับปรุง (ต่ำกว่า๖๐) </span><br>

");


$t4 ="<br>
<span class='addfontb addunder2'> ส่วนที่ ๔  :  แผนพัฒนาการปฏิบัติราชการรายบุคคล </span><br>
<table style='border-collapse: collapse;border:solid 1px ' width='100%'>
<tr>
    <th>ความรู้/ทักษะ/สมรรถนะ<br>ที่ต้องได้รับการพัฒนา</th>
    <th style='width:60%'>วิธีการพัฒนา</th>
    <th>ช่วงเวลาที่ต้องการพัฒนา</th>
</tr>";

$se_Asst4 = mysqli_query($con,"SELECT knowledge,develop,longtime FROM asessment_t4 WHERE  ass_id='$yearIdpost'")or die("SQL-error.asst4".mysqli_error($con)); 
						
if(mysqli_num_rows($se_Asst4)!=0){
    while(list($knowledge,$develop,$longtime)=mysqli_fetch_row($se_Asst4)){
        $t4 .= "
        <tr>
            <td align='center'>$knowledge</td>
            <td align='center'>$develop</td>
            <td align='center'>$longtime</td>
        </tr>";
    }
}else{
    $t4 .= "<tr>
    <td>&nbsp;<br>&nbsp;<br></td>
    <td>&nbsp;<br>&nbsp;<br></td>
    <td>&nbsp;<br>&nbsp;<br></td>
</tr>
<tr>
    <td>&nbsp;<br>&nbsp;<br></td>
    <td>&nbsp;<br>&nbsp;<br></td>
    <td>&nbsp;<br>&nbsp;<br></td>
</tr>
<tr>
    <td>&nbsp;<br>&nbsp;<br></td>
    <td>&nbsp;<br>&nbsp;<br></td>
    <td>&nbsp;<br>&nbsp;<br></td>
</tr>";
}

$t4.="</table>";

$mpdf->WriteHTML($t4);

$mpdf->addpage();

$mpdf->WriteHTML("
<br>
<span class='addfontb addunder2'> ส่วนที่ ๕  การรับทราบผลการประเมิน </span><br>
<div style='border:solid'>
    
    <div style='float: left; width: 49%;padding:4px;border-right:solid'>
        <p class='addfontb' >ผู้รับการประเมิน : </p>
        <p><input type='checkbox' class='addfontck'> ได้รับทราบผลการประเมินและแผนพัฒนา <br >การปฏิบัติราชการรายบุคคลแล้ว </p>
        <br>
    </div>

    <div style='float: left; width: 49%;padding:4px;'>
    <p>ลงชื่อ...........................................................</p>
    <p>ตำแหน่ง.......................................................</p>
    <p>วันที่.............................................................</p>
    </div>
    <div style='clear: both; margin: 0pt; padding: 0pt;'></div> 
</div>
<div style='border:solid'>

    <div style='float: left; width: 49%;padding:4px;border-right:solid'>
        <p class='addfontb' >ผู้ประเมิน : </p>
        <p><input type='checkbox' class='addfontck'> ได้แจ้งผลการประเมินและผู้รับการประเมินได้ลงนาม <br>รับทราบ </p>

        <p><input type='checkbox' class='addfontck'> ได้แจ้งผลการประเมินเมื่อวันที่.............................................
        แต่ผู้รับการประเมินไม่ลงนามรับทราบผลการ
       ประเมินโดยมี………………..........เป็นพยาน
   </p>
    </div>
    <div style='float: left; width: 49%;padding:4px;'>
    <br>
    <br>
    <p>ลงชื่อ...........................................................</p>
    <p>ตำแหน่ง.......................................................</p>
    <p>วันที่.............................................................</p>
    </div>
    <div style='clear: both; margin: 0pt; padding: 0pt; '></div>
</div>
");
$mpdf->addpage();
$mpdf->WriteHTML("
<br>
<span class='addfontb addunder2'>ส่วนที่ ๖  ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป</span><br>
<div style='border:solid'>
    <div style='float: left; width: 69%;padding:4px;border-right:solid'>
        <p class='addfontb' >ผู้บังคับบัญชาเหนือขึ้นไป </p>
        <p><input type='checkbox' class='addfontck'> เห็นด้วยผลการประเมิน </p>
        <p><input type='checkbox' class='addfontck'> มีความเห็นแตกต่าง  ดังนี้ <br>
        <p><dottab></p>
        <p><dottab></p>
        <p><dottab></p>
    </div>
    <div style='float: left; width: 29%;padding:4px;'>
        <br><br>
        <p>ลงชื่อ...........................................................</p>
        <p>ตำแหน่ง.......................................................</p>
        <p>วันที่.............................................................</p>
    </div>
    <div style='clear: both; margin: 0pt; padding: 0pt;'></div> 
</div>
<div style='border:solid'>

    <div style='float: left; width: 69%;padding:4px;border-right:solid'>
        <p class='addfontb' >ผู้บังคับบัญชาเหนือขึ้นไปอีกชั้นหนึ่ง  (ถ้ามี) </p>
        <p><input type='checkbox' class='addfontck'> เห็นด้วยผลการประเมิน </p>
        <p><input type='checkbox' class='addfontck'> มีความเห็นแตกต่าง  ดังนี้ </p>
        <p><dottab></p>
        <p><dottab></p>
        <p><dottab></p>
    </div>
    <div style='float: left; width: 29%;padding:4px;'>
        <br>
        <br>
        <p>ลงชื่อ...........................................................</p>
        <p>ตำแหน่ง.......................................................</p>
        <p>วันที่.............................................................</p>
    </div>
    <div style='clear: both; margin: 0pt; padding: 0pt; '></div>
</div>
</html>
");
$mpdf->Output();
mysqli_close($con);
} /// END IF TOP
else{
	echo "<script> window.location = 'userlogin.php' </script>";
}
?>
</body>
</html>