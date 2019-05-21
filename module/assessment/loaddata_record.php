<?php
  session_start();
  include("../../function/db_function.php");
  include("../../function/fc_time.php");
$con=connect_db();
$yearnow = chk_idtest();
$year = $_POST["year"]
 ?>
<div class="table-responsive">
  <table class="table table-border" id="Datatable">
    <thead>
      <tr>
        <th> รหัส</th>
        <th> ชื่อ-สกุล</th>
        <th> หลักสูตร</th>
        <th> สาขา</th>
        <th> ตำแหน่ง</th>
        <th class='text-center'> สถานะ </th>
        <th class='text-center'> จัดการ </th>
      </tr>
    <thead>
    <tbody>
      <?php

  $staff= mysqli_query($con,"SELECT st_id,prefix,fname,lname,br_name,dept_name,pos_name FROM staffs as st INNER JOIN branchs as br ON (st.branch_id = br.br_id) INNER JOIN departments as det ON (det.dept_id = br.dept_id) INNER JOIN position AS pt ON (pt.pos_id = st.position) WHERE st.permiss_id != 1") or  die("SQL Error1==>1".mysqli_error($con));
  echo "<tr>";
    while(list($st_id,$prefix,$fname,$lname,$br_name,$dept_name,$pos_name)=mysqli_fetch_row($staff)){
      echo "<td> $st_id</td>";
      echo "<td> $prefix $fname $lname</td>";
      echo "<td> $br_name</td>";
      echo "<td> $dept_name</td>";
      echo "<td> $pos_name</td>";

      $idl= mysqli_query($con,"SELECT year_id FROM absence WHERE staff='$st_id' AND year_id='$year' ") or  die("SQL Error1==>1".mysql_error($con));
      list($year_id1)=mysqli_fetch_row($idl);
      $se_chk=mysqli_query($con,
      "SELECT chk_id,chk,name
      FROM chk_absence WHERE staff_id='$st_id' AND year_id='$year'")or die("SQL-error".mysqli_error($con));
      list($chk_id,$chk,$name)=mysqli_fetch_row($se_chk);
      mysqli_free_result($se_chk);
      if($yearnow == $year){
        if(!empty($year_id1)){
          if($chk==0){
            echo " <td class='text-center'>  <b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br> กรอกข้อมูลแล้ว </br> </td>";
          }else{
            echo " <td class='text-center'>  <b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br> ตรวจสอบแล้ว </br> </td>";
          }
         
          if($yearnow == $year_id1){
            if($chk==0){
              echo " <td class='text-center'> <b class='text-secondary'><a href='javascript:void(0)' class='editbrn' data-id='$year_id1' data-staff='$st_id' data-s_name='$prefix $fname $lname' data-chk_id='$chk_id'><i class='fas fa-check fa-2x'></i><br> ตรวจสอบ <b></a></td>";
            }else{
              echo " <td class='text-center'> <b class='text-secondary'><a href='javascript:void(0)' class='editbrn' data-id='$year_id1' data-staff='$st_id' data-s_name='$prefix $fname $lname' data-chk_id='$chk_id' ><i class='far fa-edit fa-2x'></i><br> แก้ไข <b></a></td>";
            }
            
          }else{
              echo " <td class='text-center'> <b class='text-secondary'><a href='javascript:void(0)' class='showdata' data-id='$year_id1' data-staff='$st_id'><i class='fas fa-check fa-2x'></i><br> ตรวจสอบ <b></a></td>";
          }

        }else{
          echo " <td class='text-center'> <b class='text-danger '> <i class='fas fa-times-circle fa-2x '></i><br> ยังไม่ได้กรอกข้อมูล </br></td>";
          echo " <td class='text-center'> <b class='text-primary'><a href='javascript:void(0)' class='addbrn' data-id='$year_id1' data-staff='$st_id' data-s_name='$prefix $fname $lname'><i class='fas fa-plus fa-2x'></i>&nbsp;<br>กรอกข้อมูล</a></b></td>";
        }
      }else{
        echo " <td class='text-center'> <b class='text-danger'> <i class='fas fa-times-circle fa-2x '></i><br> อยู่นอกระยะทำการ </b></td>";
        echo " <td class='text-center'> <b class='text-secondary'><a href='javascript:void(0)' class='showdata' data-id='$year_id1' data-staff='$st_id'><i class='fas fa-check fa-2x'></i><br> ตรวจสอบ <b></a></td>";
      }  

      echo "</tr>";

  }
  mysqli_close($con);
      ?>

    <tbody>
    </tbody>
  </table>
</div>
<div id="loadaddsub"></div>
<script>

$(document).ready(function() {
  $.getScript('js/mydatatable.js')
  $(".addbrn").click(function(e){
          e.preventDefault()
          var id =$(this).data("id");
          $.post( "module/assessment/ldl_insertform2.php", { yearid: id, stid : $(this).data("staff"),name : $(this).data("s_name") } ).done(function(data){
              $("#loadaddsub").html(data);
              $('#addsub').modal('show');
          })
});

$(".editbrn").click(function(e){
        e.preventDefault()
        var id =$(this).data("id");
        $.post( "module/assessment/ldl_insertformedit2.php", { yearid: id , stid : $(this).data("staff"),name : $(this).data("s_name"),acp:$(this).data("chk_id") } ).done(function(data){
            $("#loadaddsub").html(data);
            $('#addsub').modal('show');
        })
});

});// ready
</script>
