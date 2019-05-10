<?php
session_start();
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();

$year = $_POST['year'];
$stid = $_POST['stid'];

$se_ass=mysqli_query($con,"SELECT ass_id FROM assessments WHERE staff='$stid' AND year_id='$year' AND ass_id LIKE 'TOR%' ") or die("ASS_SQLerror".mysqli_error($con));
list($ass_id)=mysqli_fetch_row($se_ass);
mysqli_free_result($se_ass);

// $se_ass1=mysqli_query($con,"SELECT asst1_id,ass_id,title_name,goal,score,weight,weighted FROM asessment_t1 WHERE ass_id='$ass_id'") or die("ASS_SQLerror".mysqli_error($con));
// list($asst1_id,$ass_id1,$title_name,$goal,$score,$weight,$weighted)=mysqli_fetch_row($se_ass1);
// mysqli_free_result($se_ass1);

$se_inform=mysqli_query($con,"SELECT inform FROM asessment_t5 WHERE ass_id ='$ass_id'")or die("SQL-se_informError".mysqli_error($con));
list($inform)=mysqli_fetch_row($se_inform);

mysqli_free_result($se_inform);
// echo $inform;

?>
<div class="row ">
  <div class="col-md">
<p><b>องค์ประกอบที่  ๑ : ผลสัมฤทธิ์ของงาน</b></p>
<table class="table table-bordered ">
<thead>
    <tr>
      <th>ภาระงาน/กิจกรรม/โครงการ/งาน</th>
      <th> ค่าระดับเป้าหมาย </th>
      <th> ค่าคะแนนที่ได้  </th>
      <th> น้ำหนัก(น้ำหนักความยากง่ายของงาน) </th>
      <th> ค่าคะแนนถ่วงน้ำหนัก </th>
    </tr>
  <thead>
  <tbody>
<?php
    $se_sumAss=mysqli_query($con,"SELECT sum_weight,sum_weighted,sum_asst1 FROM sum_score_assessment_t1 WHERE ass_id='$ass_id'")or die("sumAss-error".mysqli_error($con));
    list($sum_weight,$sum_weighted,$sum_asst1)=mysqli_fetch_row($se_sumAss);

    $se_a1=mysqli_query($con,"SELECT title_name,goal,score,weight,weighted FROM asessment_t1 WHERE ass_id='$ass_id' ") or die("ASS_SQLerror".mysqli_error($con));
   while(list($title_id,$goal,$score,$weight,$weighted)=mysqli_fetch_row($se_a1)){
       $se_tlt=mysqli_query($con,"SELECT e_name FROM evaluation WHERE e_id='$title_id'") or die("TLT-error".mysqli_error($con));
       list($tlt_name)=mysqli_fetch_row($se_tlt);
       mysqli_free_result($se_tlt);
    echo "<tr>";
        echo"<td>$tlt_name</td>";
        echo"<td>$goal</td>";
        echo"<td>$score</td>";
        echo"<td>$weight</td>";
        echo"<td>$weighted</td>";
    echo "</tr>";

   }
   echo "<tr>";
        echo"<td colspan='4' align='right' ><b>ผลรวมองค์ประกอบที่ ๑</b></td>";
        echo"<td>$sum_asst1</td>";
   echo "</tr>";
 echo "</tbody>";
    mysqli_free_result($se_a1);
?>
  </table>
  </div>
</div>
<div class="row ">
   <div class="col-md-9">
   <p><b>องค์ประกอบที่  ๒ :  พฤติกรรมการปฏิบัติงาน (สมรรถนะ)</b></p>
   <table class="table table-bordered ">
   <thead>
    <tr>
      <th>สมรรถนะ</th>
      <th>ระดับสมรรถนะที่คาดหวัง</th>
      <th> ระดับสมรรถนะที่แสดงออก</th>
    </tr>
  <thead>
  <tbody>
   <?php
    $se_sumAsst2=mysqli_query($con,"SELECT subcap_id,goal,score FROM asessment_t2 WHERE ass_id='$ass_id'")or die("sumAsst2-error".mysqli_error($con));
   while(list($subcap_id,$goal2,$score2)=mysqli_fetch_row($se_sumAsst2)){
     $se_subcapName=mysqli_query($con,"SELECT cap_id,sub_name FROM sub_capacity WHERE sub_id='$subcap_id'")or die("subcapNamSQL-error".mysqli_error($con));
     list($cap_id,$subcap_name)=mysqli_fetch_row($se_subcapName);
     mysqli_free_result($se_subcapName);

     $se_capName=mysqli_query($con,"SELECT cap_name FROM capacity WHERE cap_id='$cap_id'")or die("capNamSQL-error".mysqli_error($con));
     list($cap_name)=mysqli_fetch_row($se_capName);
     mysqli_free_result($se_capName);
     echo"<tr>";
          echo "<td >$subcap_name <a href='#' title='$cap_name'>( $cap_id )</a></td>";
          echo "<td align='center'>$goal2</td>";
          echo "<td align='center'>$score2</td>";
     echo"</tr>";
     
   }
   mysqli_free_result($se_sumAsst2);
   ?>
    </tbody>
   </table>
   </div>
</div>

<div class="row">
   <div class="col-md">
   <?php
       $se_skil=mysqli_query($con,"SELECT score_skil,score_x,score FROM assessment_t2_skill WHERE ass_id='$ass_id'")or die("SkilSQL-error".mysqli_error($con));
       for ($set = array (); $row = $se_skil->fetch_assoc(); $set[] = $row);
      // print_r($set);
       mysqli_free_result($se_skil);
      
       $se_sum2=mysqli_query($con,"SELECT sum_asst2 FROM sum_score_assessment_t2 WHERE ass_id='$ass_id'") or die("Sum2.SQL-error".mysqli_error($con));
       list($sum_asst2)=mysqli_fetch_row($se_sum2);
       mysqli_free_result($se_sum2);
?>
   <table class="table table-bordered" id="table_score">
		<tr class="text-justify text-center">
			<th rowspan="2" ><br> <h5>หลักเกณฑ์การประเมิน</h5></th>
			<th colspan="3">การประเมิน</th>
		</tr>
		<tr class="text-justify text-center">
			<th>จำนวนสมรรถนะ</th>
			<th>คูณ (×)</th>
			<th>คะแนน</th>
		</tr>
		<tr>
		
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  สูงกว่าหรือเท่ากับ ระดับสมรรถนะที่คาดหวัง  ×  ๓ คะแนน</td>
			<td align="center"><?php  echo empty($set[0]['score_skil'])?"-":$set[0]['score_skil'] ?></td>
			<td align="center"><?php  echo empty( $set[0]['score_x'])?"-": $set[0]['score_x']?></td>
			<td align="center"><?php  echo empty($set[0]['score'])?"-":$set[0]['score'] ?></td>

		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๑  ระดับ    × ๒ คะแนน</td>
			<td align="center"><?php  echo empty($set[1]['score_skil'])?"-":$set[1]['score_skil'] ?></td>
			<td align="center"><?php  echo empty( $set[1]['score_x'])?"-": $set[1]['score_x']?></td>
			<td align="center"><?php  echo empty($set[1]['score'])?"-":$set[1]['score'] ?></td>

		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๒  ระดับ  ×  ๑  คะแนน  </td>
			<td align="center"><?php  echo empty($set[2]['score_skil'])?"-":$set[2]['score_skil'] ?></td>
			<td align="center"><?php  echo empty( $set[2]['score_x'])?"-": $set[2]['score_x']?></td>
			<td align="center"><?php  echo empty($set[2]['score'])?"-":$set[2]['score'] ?></td>

		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๓  ระดับ   ×  ๐  คะแนน</td>
			<td align="center"><?php  echo empty($set[3]['score_skil'])?"-":$set[3]['score_skil'] ?></td>
			<td align="center"><?php  echo empty( $set[3]['score_x'])?"-": $set[3]['score_x']?></td>
			<td align="center"><?php  echo empty($set[3]['score'])?"-":$set[3]['score'] ?></td>

		</tr>
		<tr>
			<td colspan="3" class="text-right"><b>ผลรวมคะแนนองค์ประกอบที่ ๒</b></td>
			<td><?php echo $sum_asst2  ?></td>
		</tr>
    </table>
   </div>
</div>

<div class="row">
	<div class="col-md">
    <P>
      <?php   
            $se_All=mysqli_query($con,"SELECT name,score,weignt,sum FROM asessment_t3 WHERE ass_id='$ass_id'") or die("SumAll-SQL.error".mysqli_error($con));
            for ($sum = array (); $row = $se_All->fetch_assoc(); $sum[] = $row);

            $sumScore=mysqli_query($con,"SELECT sum_score FROM sum_score_assessment_t3 WHERE ass_id='$ass_id'") or die("AAA-SQL.error".mysqli_error($con));
            list($total)=mysqli_fetch_row($sumScore);
     //print_r($sum);
           // echo $total;
            mysqli_free_result($se_All);
      ?>
    </P>
    <p><b>ส่วนที่ ๓ สรุปการประเมินผลการปฏิบัติราชการ </b></p>
		<table class="table table-bordered text-center sa">
			<tr >
				<th>องค์ประกอบการประเมิน</th>
				<th>คะแนน (ก)</th>
				<th>น้ำหนัก (ข)</th>
				<th>รวมคะแนน (ก)X(ข)</th>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบที่  1 : ผลสัมฤทธิ์ของงาน</td>
				<td><?php  echo empty($sum[0]['score'])?"-":$sum[0]['score']?></td>
				<td><?php  echo empty($sum[0]['weignt'])?"-":$sum[0]['weignt']?></td>
				<td><?php  echo empty($sum[0]['sum'])?"-":$sum[0]['sum']?></td>
			</tr>
			<tr>
      <td class="text-left">องค์ประกอบที่  2 : พฤติกรรมการปฏิบัติราชการ (สมรรถนะ)</td>
				<td><?php  echo empty($sum[1]['score'])?"-":$sum[1]['score']?></td>
				<td><?php  echo empty($sum[1]['weignt'])?"-":$sum[1]['weignt']?></td>
        <td><?php  echo empty($sum[1]['sum'])?"-":$sum[1]['sum']?></td>
			</tr>
			<tr>
			<td class="text-left">องค์ประกอบอื่น (ถ้ามี)</td>
				<td><?php  echo empty($sum[2]['score'])?"-":$sum[2]['score']?></td>
				<td><?php  echo empty($sum[2]['weignt'])?"-":$sum[2]['weignt']?></td>
        <td><?php  echo empty($sum[2]['sum'])?"-":$sum[2]['sum']?></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right"><b>รวม</b></td>
				<td>100</td>
				<td style="color:blue;"><?php echo $total; ?></td>
			</tr>	
		</table>
	</div>
</div>	

<div class="row">
   <div class="col-md">
   <p><b>ระดับผลการประเมิน</b></p>
      <?php
          if($total>90 && $total<=100){
            echo"<p style='color:blue'>ดีเด่น (90-100)</p>";
          }
          else if($total>80 && $total<90){
            echo"<p style='color:green'>ดีมาก (80-89)</p>";
          }
          else if($total>70 && $total<80){
          echo"<p style='color:DarkOrange '>ดี (70-79) </p>";
          }
          else if($total>60 && $total<70){
            echo"<p style='colre:orange'>พอใช้(60-69)</p>";
          }
          else{
           echo"<p style='color:red'>***ต้องปรับปรุง (ต่ำกว่า 60)</p>";
          }
      ?>

   </div>
</div>

<div class="row">
  <div class="col-md">
  <p><b>ส่วนที่ ๔ แผนพัฒนาการปฏิบัติราชการรายบุคคล</b></p>
  <table class="table table-bordered">
				<tr>
					<th>ความรู้/ทักษะ/สมรรถนะ ที่ต้องได้รับการพัฒนา </th>
					<th>วิธีการพัฒนา</th>
					<th>ช่วงเวลาที่ต้องการพัฒนา</th>
				</tr>
			
					<?php $se_Asst4 = mysqli_query($con,
						 "SELECT knowledge,develop,longtime FROM asessment_t4 WHERE  ass_id='$ass_id'")or die("SQL-error.asst4".mysqli_error($con)); 
						 while(list($knowledge,$develop,$longtime)=mysqli_fetch_row($se_Asst4)){
						 ?>
					<tr>
					<td><?php echo $knowledge ?></td>
					<td><?php echo $develop?></td>
					<td><?php echo $longtime ?></td>
				</tr>
						 <?php }?>
			</table>
  </div>
</div>

<div class="row">
  <div class="col-md">
  <p><b>ส่วนที่ ๕ แจ้งผลการประเมิน</b></p>
  <p>
      <?php
     
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
					$chk_inform = "checked";
					$ac="";
        }else{
					$chk_inform = "";
					$ac="ac";
        }
        if($accept==1){
          $chk_accept = "checked";
        }else{
          $chk_accept = "";
        }
        $date = date("Y/m/d");
      ?>
  </p>
  <div class="row">
	<div class="col-md-6 border border-dark p-3">
		<p>ผู้รับการประเมิน :</p>
		<div class="custom-control custom-checkbox">
			  <input class="custom-control-input" type="checkbox" value="1"  name="ac"  <?php echo $chk_accept?> readonly>
			  <label class="custom-control-label" for="ac">
			    รับทราบผลการประเมินและแผนพัฒนา การปฏิบัติราชการรายบุคคลแล้ว

			  </label>
		</div>

	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $tle_g,$g_fname,"  ",$g_lname; ?>" name="uname" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<?php     
					$sqlspos ="SELECT pos_name FROM position WHERE pos_id='$g_pos'";
					$sespos=mysqli_query($con,$sqlspos) or die("sePos".mysqli_error($con));
					list($sname_pos)=mysqli_fetch_row($sespos);	
					mysqli_free_result($sespos);
				?>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $sname_pos?>" name="upos" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php if($date_accept=="0000-00-00"){echo "";}else{echo DateThai($date_accept); }  ?>"  name="udate" readonly >
					<input type="hidden" name="usdate" value="">
				</div>				
		</div>
	</div>
	<!-- ผู้ประเมิน : -->
	<div class="col-md-6 border border-dark p-3">
	<p>ผู้ประเมิน :</p>
		<div class="custom-control custom-checkbox">
			  <input class="custom-control-input" type="checkbox" vlue="1" name="tappcetp" id="customCheck1" <?php echo $chk_inform?> readonly>
			  <label class="custom-control-label" for="" >
			   แจ้งผลการประเมิน
			  </label>
		</div>
		<!-- <div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			   ได้แจ้งผลการประเมินเมื่อวันที่.............................................
      			แต่ผู้รับการประเมินไม่ลงนามรับทราบผลการ
     			ประเมินโดยมี………………..........เป็นพยาน
			  </label>
		</div> -->


	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
		<?php  
				$sql="SELECT  prefix,lname,fname,position FROM staffs WHERE st_id ='$hleader'";
				$Lchk= mysqli_query($con,$sql) or die ("gen_chk".mysqli_error($con));
				list($Lprefix,$Llname,$Lfname,$Lposition)=mysqli_fetch_row($Lchk);
			
				mysqli_free_result($Lchk);
		?>
				<label  class="col-sm-2 col-form-label">ชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $Lprefix,$Lfname," ",$Llname ?>" name="sname" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<?php     
					$sqlLpos ="SELECT pos_name FROM position WHERE pos_id='$Lposition'";
					$sesLpos=mysqli_query($con,$sqlLpos) or die("sePos".mysqli_error($con));
					list($Lname_pos)=mysqli_fetch_row($sesLpos);	
					mysqli_free_result($sesLpos);
				?>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $Lname_pos;  ?>" name="t_pos" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
			
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo DateThai($date)?>" name="" readonly>
					<input type="hidden" value="<?php echo $date ?>" name="tdate">
				</div>				
		 </div>
	 </div>

   </div>
  </div>
</div>

<div class="row">
	 <div class="col-md">
				<br>
				<p><b>ส่วนที่ ๖ ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป</b></p>
				<p>
					<?php   
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
									$apc0="checked";
									$apc1="";
							}else if($leader_comt==2){
								$apc0="";
								$apc1="checked";
							}else{
								$apc0="";
								$apc1="";
							}

							
							if($supervisor_comt==1){
								$uagree0="checked";
								$uagree1="";
						}else if($supervisor_comt==2){
							$uagree0="";
							$uagree1="checked";
						}else{
							$uagree0="";
							$uagree1="";
						}
					?>
				</p>
	 </div>
</div>
<div class=row>
<div class="col-md-6 border border-dark p-3">
		<p>ผู้บังคับบัญชาเหนือขึ้นไป</p>
		<div class="custom-control custom-radio">
			  <input class="custom-control-input" type="radio" value="0" id="customRadio1" name="apc" <?php echo $apc0; ?> disabled  >
			  <label class="custom-control-label" for="customRadio1">
			    เห็นด้วยผลการประเมิน

			  </label>
		</div>
		<div class="custom-control custom-radio">
			  <input class="custom-control-input" type="radio" value="1" id="customRadio2" name="apc" <?php echo $apc1; ?>  disabled>
			  <label class="custom-control-label" for="customRadio2">
			    มีความเห็นแตกต่าง  ดังนี้

			  </label>
		</div>
		<div class="form-group">
		    <textarea class="form-control" name="hcompt" id="text1" rows="3"  disabled required><?php echo $leader_comt_disc ?></textarea>
		 </div>

	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ลงชื่อ</label>
			
				<div class="col-sm">
				<?php
					 $sehleader=mysqli_query($con,"SELECT prefix,fname,lname,position FROM staffs WHERE st_id='$hightL'")or die("SQL.hleaderError".mysqli_error($con));
					 list($hl_prefix,$hl_name,$hl_fname,$hl_position)=mysqli_fetch_row($sehleader);
					 mysqli_free_result($sehleader);
				?>
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $hl_prefix,$hl_name," ",$hl_fname ?>" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
				<?php
						$se_hlpostion = mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id ='$hl_position'") or die("SQL.posHL_ERRor".mysqli_error($con));
						list($hl_posName)=mysqli_fetch_row($se_hlpostion);

				?>
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $hl_posName  ?>" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
				<?php 
					$date= date("Y/m/d"); 
					$leader_compt_date = $leader_compt_date==0?"":DateThai($leader_compt_date);		
				?>
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $leader_compt_date  ?> " readonly >
				</div>				
		</div>
	</div>

	<div class="col-md-6 border border-dark p-3">
               <?php
                     $seSleader=mysqli_query($con,
                     "SELECT staffs.prefix,staffs.fname,staffs.lname,position.pos_name
                     FROM staffs
                     INNER JOIN position
                     ON staffs.position=position.pos_id
                     WHERE st_id='$supterL'")or die("SQL.hleaderError".mysqli_error($con));
					 list($Sl_prefix,$Sl_name,$Sl_fname,$Sl_position)=mysqli_fetch_row($seSleader);
					 mysqli_free_result($seSleader);
				?>

		<p>ผู้บังคับบัญชาเหนือขึ้นไปอีกชั้นหนึ่ง  (ถ้ามี)</p>
		<div class="custom-control custom-radio">
			  <input class="custom-control-input" type="radio" value="0" id="customRadio3" name="uagree" <?php echo $uagree0  ?> disabled >
			  <label class="custom-control-label" for="customRadio3">
			    เห็นด้วยผลการประเมิน

			  </label>
		</div>
		<div class="custom-control custom-radio">
			  <input class="custom-control-input" type="radio" value="1" id="customRadio4" name="uagree"<?php echo $uagree1  ?> disabled>
			  <label class="custom-control-label" for="customRadio4">
			    มีความเห็นแตกต่าง  ดังนี้
			  </label>
		</div>
		<div class="form-group">
		    <textarea class="form-control" name="scompt" id="text2" rows="3" disabled required><?php echo $supervisor_comtdisc ?></textarea>
		 </div>
	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ลงชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $Sl_prefix,$Sl_name," ",$Sl_fname ?>" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $Sl_position  ?>" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
				<?php $supervisor_comt_date = $supervisor_comt_date==0?"":DateThai($supervisor_comt_date);	 ?>
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $supervisor_comt_date ?>" readonly>
				</div>				
		</div>
	</div>
</div>

<?php 


mysqli_close($con);

?>

