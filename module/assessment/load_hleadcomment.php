<?php
    include("../../function/db_function.php");
    include("../../function/fc_time.php");
    $con=connect_db();

    $ass_id = $_POST['tor_id'];
    $staff_id=$_POST['user_id'];

   
?>

<<!-- Modal -->
<div class="modal fade bd-example-modal-xl" id="showmodelpre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ผลการประเมิน <?php echo $ass_id?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>