<?php
  session_start();
  include("../../function/db_function.php");
  include("../../function/fc_time.php");
$con=connect_db();
$yearnow = chk_idtest();
$year = $_POST["year"]
 ?>

<table class="table table-border" id="Datatable">
  <thead>
    <tr>
      <th> ชื่อ-สกุล</th>
      <th> หลักสูตร</th>
      <th> สาขา</th>
      <th> สถานะ </th>
      <th> จัดการ </th>
    </tr>
  <thead>
  <tbody>
    <?php

$staff= mysqli_query($con,"SELECT st_id,prefix,fname,lname,br_name,dept_name FROM staffs as st INNER JOIN branchs as br ON (st.branch_id = br.br_id) INNER JOIN departments as det ON (det.dept_id = br.dept_id)") or  die("SQL Error1==>1".mysqli_error($con));
echo "<tr>";
  while(list($st_id,$prefix,$fname,$lname,$br_name,$dept_name)=mysqli_fetch_row($staff)){
    echo "<td> $prefix $fname $lname</td>";
    echo "<td> $br_name</td>";
    echo "<td> $dept_name</td>";

    $idl= mysqli_query($con,"SELECT year_id FROM absence WHERE staff='$st_id' AND year_id='$year' ") or  die("SQL Error1==>1".mysql_error($con));
    list($year_id1)=mysqli_fetch_row($idl);
    
 
      if(!empty($year_id1)){
        echo " <td> <b class='text-success'><i class='fas fa-check-circle fa-2x'></i> บันทึกการมาปฏิบัติงานแล้ว </b> </td>";
        if($yearnow == $year_id1){
          echo " <td> <b class='text-secondary'><a href='javascript:void(0)' class='editbrn' data-id='$year_id1'><i class='far fa-edit fa-2x'></i> แก้ไข <b></a></td>";
        }else{
            echo " <td> <b class='text-secondary'><a href='javascript:void(0)' class='showdata' data-id='$year_id1'><i class='fas fa-check fa-2x'></i> ตรวจสอบ <b></a></td>";
        }

      }else{
        echo " <td> <b class='text-danger'> <i class='fas fa-times-circle fa-2x '></i> ยังไม่ได้ทำการบันทึกการมาปฏิบัติงาน </b></td>";
        echo " <td> <b class='text-primary'><a href='javascript:void(0)' class='addbrn' data-id='$year_id1'><i class='fas fa-plus fa-2x'></i>&nbsp;กรอกข้อมูล</a></b></td>";
      }

    echo "</tr>";

}
mysqli_close($con);
    ?>

  <tbody>
  </tbody>
</table>
<div id="loadaddsub"></div>
<script>

$(document).ready(function() {
  $.getScript('js/mydatatable.js')
  $(".addbrn").click(function(e){
          e.preventDefault()
          var id =$(this).data("id");
          $.post( "module/assessment/ldl_insertform.php", { yearid: id  } ).done(function(data){
              $("#loadaddsub").html(data);
              $('#addsub').modal('show');
          })
});

$(".editbrn").click(function(e){
        e.preventDefault()
        var id =$(this).data("id");
        $.post( "module/assessment/ldl_insertformedit.php", { yearid: id  } ).done(function(data){
            $("#loadaddsub").html(data);
            $('#addsub').modal('show');
        })
});

});// ready
</script>
