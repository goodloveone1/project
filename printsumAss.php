
<?php
session_start();

if(!empty($_POST['year']) && !empty($_POST['stid'])){

include("function/db_function.php");
include("function/fc_time.php");
$con=connect_db();

//$year = "25612";
///$stid = "6201083";

$year = $_POST['year'];
$stid = $_POST['stid'];

$staff=mysqli_query($con,"SELECT prefix,fname,lname,ac.aca_name FROM staffs as st INNER JOIN academic AS ac ON st.acadeic = ac.aca_id WHERE st_id='$stid'"  ) or die("staff_SQLerror".mysqli_error($con));
list($prefix,$fname,$lname,$aca_name)=mysqli_fetch_row($staff);
mysqli_free_result($staff);


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

$fullname = "<h2 align='center'> แบบรายงานผลการปฏิบัติงาน ของบุคลากรสายวิชาการ </h2>";
$fullname .= "<h3 align='center'> ชื่อ  $prefix $fname $lname ";
$fullname .= " ตำแหน่ง $aca_name </h3>";
$fullname .= "<h3 align='center'> สังกัด คณะบริหารธุรกิจและศิลปศาสตร์ มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา </h3>";




	 $se_year=mysqli_query($con,"SELECT y_year,y_no,y_start,y_end FROM years WHERE y_id='$year'")or die("SQLerror.Year".mysqli_error($con));
					list($y_year,$y_no,$y_start,$y_end)=mysqli_fetch_row($se_year);
					// echo $y_year,$y_no,$y_start,$y_end;
					mysqli_free_result($se_year);


 $daten =  "<h3 align='center'> รอบที่ $y_no (". DateThai($y_start)." - ".DateThai($y_end).")</h3>";
 $fullname .= $daten;
$mpdf->WriteHTML($fullname);


$mpdf->WriteHTML("<h3><b>องค์ประกอบที่  ๑ : ผลสัมฤทธิ์ของงาน</b></h3>");


$se_ass=mysqli_query($con,"SELECT ass_id FROM assessments WHERE staff='$stid' AND year_id='$year' AND ass_id LIKE 'TOR%' ") or die("ASS_SQLerror".mysqli_error($con));
list($ass_id)=mysqli_fetch_row($se_ass);
mysqli_free_result($se_ass);



$se_inform=mysqli_query($con,"SELECT inform FROM asessment_t5 WHERE ass_id ='$ass_id'")or die("SQL-se_informError".mysqli_error($con));
list($inform)=mysqli_fetch_row($se_inform);

$se_sumAss=mysqli_query($con,"SELECT sum_weight,sum_weighted,sum_asst1 FROM sum_score_assessment_t1 WHERE ass_id='$ass_id'")or die("sumAss-error".mysqli_error($con));
list($sum_weight,$sum_weighted,$sum_asst1)=mysqli_fetch_row($se_sumAss);

$se_a1=mysqli_query($con,"SELECT title_name,goal,score,weight,weighted FROM asessment_t1 WHERE ass_id='$ass_id' ") or die("ASS_SQLerror".mysqli_error($con));



$tableh1 ='
<style>
table, th, td {
	border: 1px solid black;
	font-size:18px;
}
@page {
	size: 8.5in 11in; 
	margin: 10%; 
	            
	margin-header: 5mm; 
	margin-footer: 5mm; 
	
}
p{
	font-size:18px;
}
</style>
<table style="border-collapse: collapse;border:1px solid" width="100%">

    <tr style="border:1px solid">
      <th>ภาระงาน/กิจกรรม/โครงการ/งาน</th>
      <th> ค่าระดับเป้าหมาย </th>
      <th> ค่าคะแนนที่ได้  </th>
      <th>  น้ำหนัก<br>(น้ำหนักความยากง่ายของงาน) </th>
      <th> ค่าคะแนนถ่วงน้ำหนัก </th>
    </tr>

	';

	while(list($title_id,$goal,$score,$weight,$weighted)=mysqli_fetch_row($se_a1)){
		$se_tlt=mysqli_query($con,"SELECT e_name FROM evaluation WHERE e_id='$title_id'") or die("TLT-error".mysqli_error($con));
		list($tlt_name)=mysqli_fetch_row($se_tlt);
		mysqli_free_result($se_tlt);
$tableh1 .="
	<tr>
		<td>$tlt_name</td>
			<td align='center'>$goal</td>
			<td align='center'>$score</td>
			<td align='center'>$weight</td>
			<td align='center'>$weighted</td>
</tr>
";
 }

 $tableh1 .="
<tr>
			<td colspan='4' align='right' ><b>ผลรวมองค์ประกอบที่ ๑ </b></td>
			<td align='center'>$sum_asst1</td>
</tr>

</table>
";
	mysqli_free_result($se_a1);
	
$mpdf->WriteHTML($tableh1);

$mpdf->WriteHTML("<h3><b>องค์ประกอบที่  ๒ :  พฤติกรรมการปฏิบัติงาน (สมรรถนะ)</b></h3>");

$tableh2 ='
<table style="border-collapse: collapse;border:1px solid" width="100%">
   <thead>
    <tr>
      <th>สมรรถนะ</th>
      <th>ระดับสมรรถนะที่คาดหวัง</th>
      <th> ระดับสมรรถนะที่แสดงออก</th>
    </tr>
  <thead>
	<tbody>
';	
  
    $se_sumAsst2=mysqli_query($con,"SELECT subcap_id,goal,score FROM asessment_t2 WHERE ass_id='$ass_id'")or die("sumAsst2-error".mysqli_error($con));
   while(list($subcap_id,$goal2,$score2)=mysqli_fetch_row($se_sumAsst2)){
     $se_subcapName=mysqli_query($con,"SELECT cap_id,sub_name FROM sub_capacity WHERE sub_id='$subcap_id'")or die("subcapNamSQL-error".mysqli_error($con));
     list($cap_id,$subcap_name)=mysqli_fetch_row($se_subcapName);
     mysqli_free_result($se_subcapName);

     $se_capName=mysqli_query($con,"SELECT cap_name FROM capacity WHERE cap_id='$cap_id'")or die("capNamSQL-error".mysqli_error($con));
     list($cap_name)=mysqli_fetch_row($se_capName);
		 mysqli_free_result($se_capName);
		 $tableh2 .="
     <tr>
         <td >$subcap_name <a href='#' title='$cap_name'>( $cap_id )</a></td>
          <td align='center'>$goal2</td>
          <td align='center'>$score2</td>
     </tr>;
     ";
   }
   mysqli_free_result($se_sumAsst2);
	 $tableh2 .="
    </tbody>
   </table>
	 ";

	 $mpdf->WriteHTML($tableh2);

       $se_skil=mysqli_query($con,"SELECT score_skil,score_x,score FROM assessment_t2_skill WHERE ass_id='$ass_id'")or die("SkilSQL-error".mysqli_error($con));
       for ($set = array (); $row = $se_skil->fetch_assoc(); $set[] = $row);
      // print_r($set);
       mysqli_free_result($se_skil);
      
       $se_sum2=mysqli_query($con,"SELECT sum_asst2 FROM sum_score_assessment_t2 WHERE ass_id='$ass_id'") or die("Sum2.SQL-error".mysqli_error($con));
       list($sum_asst2)=mysqli_fetch_row($se_sum2);
       mysqli_free_result($se_sum2);



$se_All=mysqli_query($con,"SELECT name,score,weignt,sum FROM asessment_t3 WHERE ass_id='$ass_id'") or die("SumAll-SQL.error".mysqli_error($con));
for ($sum = array (); $row = $se_All->fetch_assoc(); $sum[] = $row);

$sumScore=mysqli_query($con,"SELECT sum_score FROM sum_score_assessment_t3 WHERE ass_id='$ass_id'") or die("AAA-SQL.error".mysqli_error($con));
list($total)=mysqli_fetch_row($sumScore);

mysqli_free_result($se_All);

$tableh3 ="
<table style='border-collapse: collapse;border:1px solid' width='100%'>
		<tr class='text-justify text-center'>
			<th rowspan='2' ><br> <h5>หลักเกณฑ์การประเมิน</h5></th>
			<th colspan='3'>การประเมิน</th>
		</tr>
		<tr class='text-justify text-center'>
			<th>จำนวนสมรรถนะ</th>
			<th>คูณ (×)</th>
			<th>คะแนน</th>
		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  สูงกว่าหรือเท่ากับ ระดับสมรรถนะที่คาดหวัง  ×  ๓ คะแนน</td>
			<td align='center'>".$set[0]['score_skil']."</td>
			<td align='center'>".$set[0]['score_x']."</td>
			<td align='center'>".$set[0]['score']."</td>
		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๑  ระดับ    × ๒ คะแนน</td>
			<td align='center'>".$set[1]['score_skil']."</td>
			<td align='center'>".$set[1]['score_x']."</td>
			<td align='center'>".$set[1]['score']."</td>

		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๒  ระดับ  ×  ๑  คะแนน  </td>
			<td align='center'>".$set[2]['score_skil']."</td>
			<td align='center'>".$set[2]['score_x']."</td>
			<td align='center'>".$set[2]['score']."</td>
		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๓  ระดับ   ×  ๐  คะแนน</td>
			<td align='center'>".$set[3]['score_skil']."</td>
			<td align='center'>".$set[3]['score_x']."</td>
			<td align='center'>".$set[3]['score']."</td>
		</tr>
		<tr>
			<td colspan='3' class='text-right'><b>ผลรวมคะแนนองค์ประกอบที่ ๒</b></td>
			<td>$sum_asst2</td>
		</tr>
    </table>
";
$mpdf->AddPage();
$mpdf->WriteHTML($tableh3);



$mpdf->WriteHTML("<h3>ส่วนที่ ๓ สรุปการประเมินผลการปฏิบัติราชการ </h3>");

$table3_1="
<table style='border-collapse: collapse;border:1px solid' width='100%'>
<tr >
	<th>องค์ประกอบการประเมิน</th>
	<th>คะแนน (ก)</th>
	<th>น้ำหนัก (ข)</th>
	<th>รวมคะแนน (ก)X(ข)</th>
</tr>
<tr>
	<td class='text-left'>องค์ประกอบที่  1 : ผลสัมฤทธิ์ของงาน</td>
	<td align='center'>".$sum[0]['score']."</td>
	<td align='center'>".$sum[0]['weignt']."</td>
	<td align='center'>".$sum[0]['sum']."</td>
</tr>
<tr>
<td class='text-left'>องค์ประกอบที่  2 : พฤติกรรมการปฏิบัติราชการ (สมรรถนะ)</td>
	<td align='center'>".$sum[1]['score']."</td>
	<td align='center'>".$sum[1]['weignt']."</td>
	<td align='center'>".$sum[1]['sum']."</td>
</tr>
<tr>
<td class='text-left'>องค์ประกอบอื่น (ถ้ามี)</td>
	<td align='center'>".$sum[2]['score']."</td>
	<td align='center'>".$sum[2]['weignt']."</td>
	<td align='center'>".$sum[2]['sum']."</td>
</tr>
<tr>
	<td colspan='2' class='text-right'><b>รวม</b></td>
	<td align='center'>100</td>
	<td style='color:blue;' align='center'>$total</td>
</tr>	
</table>
";
$mpdf->WriteHTML($table3_1);

if($total>90 && $total<=100){
	$sumsc = "<p style='color:blue'>ดีเด่น (90-100)</p>";
}
else if($total>80 && $total<90){
	$sumsc ="<p style='color:green'>ดีมาก (80-89)</p>";
}
else if($total>70 && $total<80){
	$sumsc ="<p style='color:DarkOrange '>ดี (70-79) </p>";
}
else if($total>60 && $total<70){
	$sumsc ="<p style='colre:orange'>พอใช้(60-69)</p>";
}
else{
	$sumsc ="<p style='color:red'>***ต้องปรับปรุง (ต่ำกว่า 60)</p>";
}

$mpdf->WriteHTML("<h3>ระดับผลการประเมิน</h3>".$sumsc." ");


$mpdf->WriteHTML("<h3>ส่วนที่ ๔ แผนพัฒนาการปฏิบัติราชการรายบุคคล</h3>");


$tableh4 ="
  <table style='border-collapse: collapse;border:1px solid' width='100%'>
				<tr>
					<th>ความรู้/ทักษะ/สมรรถนะ ที่ต้องได้รับการพัฒนา </th>
					<th>วิธีการพัฒนา</th>
					<th>ช่วงเวลาที่ต้องการพัฒนา</th>
				</tr>
";			
 $se_Asst4 = mysqli_query($con,
						 "SELECT knowledge,develop,longtime FROM asessment_t4 WHERE  ass_id='$ass_id'")or die("SQL-error.asst4".mysqli_error($con)); 
						 while(list($knowledge,$develop,$longtime)=mysqli_fetch_row($se_Asst4)){
			$tableh4 .="
					<tr>
					<td align='center'>$knowledge</td>
					<td align='center'>$develop</td>
					<td align='center'>$longtime</td>
				</tr>";
							}
	$tableh4 .="						
			</table>
";

$mpdf->WriteHTML($tableh4);

$mpdf->AddPage();
$mpdf->WriteHTML("<h3>ส่วนที่ ๕ แจ้งผลการประเมิน</h3>");

//$mpdf->Output();

     
 $select_tor=mysqli_query($con,"SELECT leader FROM assessments WHERE ass_id='$ass_id'") or die("SQL-error.SelectTor".mysqli_error($con));
    list($hleader)=mysqli_fetch_row($select_tor);
        //echo $hleader;
    mysqli_free_result($select_tor);
	$sql="SELECT  prefix,lname,fname,position FROM staffs WHERE st_id ='$stid'";
	$genchk= mysqli_query($con,$sql) or die ("gen_chk".mysqli_error($con));
	list($tle_g,$g_lname,$g_fname,$g_pos)=mysqli_fetch_row($genchk);
	mysqli_free_result($genchk);
  
    $seAss5 =mysqli_query($con,
    "SELECT asst5_id,accept,inform,date_accept,date_inform
    FROM asessment_t5
    WHERE ass_id='$ass_id' " )or die("SQL-error.asAss5".mysqli_error($con));
    list($asst5_id,$accept,$inform,$date_accept,$date_inform)=mysqli_fetch_row($seAss5);
		
        if($inform==1){
					$chk_inform = "checked=checked";
					$ac="";
        }else{
					$chk_inform = "";
					$ac="ac";
        }
        if($accept==1){
          $chk_accept = "checked=checked";
        }else{
          $chk_accept = "";
        }
        $date = date("Y/m/d");
   
$tableh5 ="
<table style='border-collapse: collapse;border:1px solid' width='100%'>
	<tr>
		<td>
			<p>ผู้รับการประเมิน :</p>
			<p><input  type='checkbox' value='1'  name='ac' $chk_accept disabled> รับทราบผลการประเมินและแผนพัฒนา การปฏิบัติราชการรายบุคคลแล้ว <p> 
		</td>
		<td>
			<p>ชื่อ $tle_g $g_fname $g_lname'	</p>
			<p>ตำแหน่ง 
		";	
					$sqlspos ="SELECT pos_name FROM position WHERE pos_id='$g_pos'";
					$sespos=mysqli_query($con,$sqlspos) or die("sePos".mysqli_error($con));
					list($sname_pos)=mysqli_fetch_row($sespos);	
					mysqli_free_result($sespos);

					if($date_accept=='0000-00-00'){$date_accept2="";}else{echo $date_accept2=DateThai($date_accept); }

$tableh5 .="
			$sname_pos' 	</p>
			<p>วันที่ $date_accept2' 	</p>
		</td>
	</tr>
	<tr>
		<td>
			<p>ผู้ประเมิน :</p>
			<p><input  type='checkbox' vlue='1' name='tappcetp' id='customCheck1' $chk_inform disabled>  แจ้งผลการประเมิน <p> 
		</td>
		<td>
		";

				$sql="SELECT  prefix,lname,fname,position FROM staffs WHERE st_id ='$hleader'";
				$Lchk= mysqli_query($con,$sql) or die ("gen_chk".mysqli_error($con));
				list($Lprefix,$Llname,$Lfname,$Lposition)=mysqli_fetch_row($Lchk);
				mysqli_free_result($Lchk);
$tableh5 .="
			<p>ชื่อ $Lprefix $Lfname $Llname	</p>
			<p>ตำแหน่ง 
			";    
					$sqlLpos ="SELECT pos_name FROM position WHERE pos_id='$Lposition'";
					$sesLpos=mysqli_query($con,$sqlLpos) or die("sePos".mysqli_error($con));
					list($Lname_pos)=mysqli_fetch_row($sesLpos);	
					mysqli_free_result($sesLpos);
$tableh5 .="
				$Lname_pos</p>
			<p>วันที่ ".DateThai($date_inform)."	</p>			
		</td>
	</tr>
</table>
";

$mpdf->WriteHTML($tableh5);



$sqlyesr="SELECT ass_id,hleader,sleader FROM assessments WHERE  ass_id='$ass_id'";
							$reChk = mysqli_query($con,"$sqlyesr") or die("torChk".mysqli_error($con));
							list($tor_ID,$hightL,$supterL)=mysqli_fetch_row($reChk);
							mysqli_free_result($reChk);

							$sqlA6="SELECT leader_comt,leader_comt_disc,leader_compt_date,supervisor_comt,supervisor_comtdisc,supervisor_comt_date FROM asessment_t6 WHERE  ass_id='$ass_id'";
							$seAss6 = mysqli_query($con,"$sqlA6") or die("seAss6".mysqli_error($con));
							list($leader_comt,$leader_comt_disc,$leader_compt_date,$supervisor_comt,$supervisor_comtdisc,$supervisor_comt_date)=mysqli_fetch_row($seAss6);
							mysqli_free_result($seAss6);
						//echo $leader_comt,">>",$leader_comt_disc,"<<<",$leader_compt_date,$supervisor_comt,$supervisor_comtdisc,$supervisor_comt_date;
							if($leader_comt==1){
									$apc0="checked=checked";
									$apc1="";
							}else if($leader_comt==2){
								$apc0="";
								$apc1="checked=checked";
							}else{
								$apc0="";
								$apc1="";
							}

							if($supervisor_comt==1){
								$uagree0="checked=checked";
								$uagree1="";
						}else if($supervisor_comt==2){
							$uagree0="";
							$uagree1="checked=checked";
						}else{
							$uagree0="";
							$uagree1="";
						}

if($hightL != 0){


$mpdf->WriteHTML("<h3>ส่วนที่ ๖ ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป</h3>");


$tableh6 ="
	<table style='border-collapse: collapse;border:1px solid' width='100%'>
			<tr>
				<td>
				<p>ผู้บังคับบัญชาเหนือขึ้นไป</p>

				<p><input  type='radio'  name='apc'  $apc0  >  เห็นด้วยผลการประเมิน	</p>

				<p>	<input  type='radio'   name='apc' $apc1 > มีความเห็นแตกต่าง  ดังนี้  </p>
			 
				<p><textarea  name='hcompt'  cols='20' rows='3'>$leader_comt_disc</textarea>	</p>
		  		   
				</td>
				<td>
";
				$sehleader=mysqli_query($con,"SELECT prefix,fname,lname,position FROM staffs WHERE st_id='$hightL'")or die("SQL.hleaderError".mysqli_error($con));
				 list($hl_prefix,$hl_name,$hl_fname,$hl_position)=mysqli_fetch_row($sehleader);
				mysqli_free_result($sehleader);

$tableh6 .="			
				<p>	ลงชื่อ   $hl_prefix $hl_name $hl_fname </p>
";			

$se_hlpostion = mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id ='$hl_position'") or die("SQL.posHL_ERRor".mysqli_error($con));
list($hl_posName)=mysqli_fetch_row($se_hlpostion);


$tableh6 .="	 <p>ตำแหน่ง  $hl_posName</p> ";

$date= date("Y/m/d"); 

$leader_compt_date = $leader_compt_date==0?"":DateThai($leader_compt_date);		


$tableh6 .="	 <p>วันที่ $leader_compt_date</p> </td></tr>";

$seSleader=mysqli_query($con,
"SELECT staffs.prefix,staffs.fname,staffs.lname,position.pos_name
FROM staffs
INNER JOIN position
ON staffs.position=position.pos_id
WHERE st_id='$supterL'")or die("SQL.hleaderError".mysqli_error($con));
list($Sl_prefix,$Sl_name,$Sl_fname,$Sl_position)=mysqli_fetch_row($seSleader);
mysqli_free_result($seSleader);

$supervisor_comt_date = $supervisor_comt_date==0?"":DateThai($supervisor_comt_date);

if($Sl_name!=""){

$tableh6 .="<tr><td>	 <p>ผู้บังคับบัญชาเหนือขึ้นไปอีกชั้นหนึ่ง  (ถ้ามี)</p> 

<p> <input  type='radio'  $uagree0>  เห็นด้วยผลการประเมิน  ดังนี้  </p>

<p> <input  type='radio'  $uagree1>  มีความเห็นแตกต่าง  ดังนี้  </p>

<p><textarea    cols='20' rows='3'>$supervisor_comtdisc</textarea>	</p>

</td>
<td>
<p>	ลงชื่อ   $Sl_prefix $Sl_name $Sl_fname  </p>
<p>ตำแหน่ง  $Sl_position</p>
<p>วันที่ $supervisor_comt_date</p>
</td>
</tr>
</table>
";
}else{
	$tableh6 .="</table>";
}

$mpdf->WriteHTML($tableh6);

}// END IF


$mpdf->Output();




mysqli_close($con);


} /// END IF TOP
else{
	echo "<script> window.location = 'userlogin.php' </script>";
}
?>