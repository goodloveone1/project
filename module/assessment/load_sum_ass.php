<?php
session_start();
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();

$year = $_POST['year'];

$se_ass=mysqli_query($con,"SELECT ass_id FROM assessments WHERE staff='$_SESSION[user_id]' AND year_id='$year' ") or die("ASS_SQLerror".mysqli_error($con));
list($ass_id)=mysqli_fetch_row($se_ass);
mysqli_free_result($se_ass);
if(!empty($ass_id)){
?>
<p>องค์ประกอบที่  ๑ : ผลสัมฤทธิ์ของงาน</p>
<table class="table table-border ">
<thead>
    <tr>
      <th>ภาระงาน/กิจกรรม/โครงการ/งาน</th>
      <th> ค่าคะแนนที่ได้ </th>
      <th> ค่าระดับเป้าหมาย </th>
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
echo "</tbody>";
   }
   echo "<tr>";
        echo"<td colspan='3' align='right' ><b>รวม</b></td>";
        echo"<td colspan='2' align='center'>$sum_asst1</td>";
   echo "</tr>";
    mysqli_free_result($se_a1);
    
}else{
   echo"<p style='color:red;' align='center'>***ยังไม่ผลการประเมิน***</p>";
}




?>