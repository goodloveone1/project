<?php
session_start();
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();

$year = $_POST['year'];

$se_ass=mysqli_query($con,"SELECT ass_id FROM assessments WHERE staff='$_SESSION[user_id]' AND year_id='$year' ") or die("ASS_SQLerror".mysqli_error($con));
list($ass_id)=mysqli_fetch_row($se_ass);
mysqli_free_result($se_ass);

$se_ass1=mysqli_query($con,"SELECT asst1_id,ass_id,title_name,goal,score,weight,weighted FROM asessment_t1 WHERE ass_id='$ass_id'") or die("ASS_SQLerror".mysqli_error($con));
list($asst1_id,$ass_id1,$title_name,$goal,$score,$weight,$weighted)=mysqli_fetch_row($se_ass1);
mysqli_free_result($se_ass1);

if(!empty($asst1_id)){
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
			<td align="center"><?php  echo $set[0]['score_skil']?></td>
			<td align="center"><?php  echo $set[0]['score_x']?></td>
			<td align="center"><?php  echo $set[0]['score']?></td>


		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๑  ระดับ    × ๒ คะแนน</td>
			<td align="center"><?php  echo $set[1]['score_skil']?></td>
			<td align="center"><?php  echo $set[1]['score_x']?></td>
			<td align="center"><?php  echo $set[1]['score']?></td>

		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๒  ระดับ  ×  ๑  คะแนน  </td>
			<td align="center"><?php  echo $set[2]['score_skil']?></td>
			<td align="center"><?php  echo $set[2]['score_x']?></td>
			<td align="center"><?php  echo $set[2]['score']?></td>

		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๓  ระดับ   ×  ๐  คะแนน</td>
			<td align="center"><?php  echo $set[3]['score_skil']?></td>
			<td align="center"><?php  echo $set[3]['score_x']?></td>
			<td align="center"><?php  echo $set[3]['score']?></td>

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
    <p><b>สรุปการประเมินผลการปฏิบัติราชการ</b></p>
		<table class="table table-bordered text-center sa">
			<tr >
				<th>องค์ประกอบการประเมิน</th>
				<th>คะแนน (ก)</th>
				<th>น้ำหนัก (ข)</th>
				<th>รวมคะแนน (ก)X(ข)</th>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบที่  1 : ผลสัมฤทธิ์ของงาน</td>
				<td><?php  echo $sum[0]['score']?></td>
				<td><?php  echo $sum[0]['weignt']?></td>
				<td><?php  echo $sum[0]['sum']?></td>
			</tr>
			<tr>
      <td class="text-left">องค์ประกอบที่  2 : พฤติกรรมการปฏิบัติราชการ (สมรรถนะ)</td>
				<td><?php  echo $sum[1]['score']?></td>
				<td><?php  echo $sum[1]['weignt']?></td>
        <td><?php  echo $sum[1]['sum']?></td>
			</tr>
			<tr>
			<td class="text-left">องค์ประกอบอื่น (ถ้ามี)</td>
				<td><?php  echo $sum[2]['score']?></td>
				<td><?php  echo $sum[2]['weignt']?></td>
        <td><?php  echo $sum[2]['sum']?></td>
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




<?php 
}else{
   echo"<p style='color:red;' align='center'>***ไม่มีผลการประเมิน***</p>";
}

mysqli_close($con);


?>