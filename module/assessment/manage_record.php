<?php
  session_start();
  include("../../function/db_function.php");
  include("../../function/fc_time.php");
$con=connect_db();
$yearnow = chk_idtest();
 ?>
<div class="row  p-2 headtitle">
	<h2 class="text-center col-md "> จัดการการปฏิบัติงาน </h2>
</div>
<br>
<table class="table table-border col-auto" id="Datatable">
  <thead>
    <tr>
      <th> ปี </th>
      <th> รอบที่ </th>
      <th> วันที่ </th>
      <th> สถานะ </th>
      <th> จัดการ </th>

    </tr>
  <thead>
  <tbody>
    <?php

    $selectyear= mysqli_query($con,"SELECT y_id,y_year,y_no,y_start,y_end FROM years ORDER BY y_year DESC") or  die("SQL Error1==>1".mysql_error($con));
    
$i=1;
while(list($y_id,$y_year,$y_no,$y_start,$y_end)=mysqli_fetch_row($selectyear)){
    echo "<tr>";
    echo " <td>".($y_year+543)."</td>";
    echo " <td>$y_no</td>";
    $m=DATE('m');
    if($m<=9 && $m>3){
      $sy_no= 2;
    }else{
      $sy_no= 1;
    }
    echo " <td>", DateThai($y_start)," - ",DateThai($y_end),"</td>";

    $idl= mysqli_query($con,"SELECT year_id FROM absence WHERE staff='$_SESSION[user_id]' AND year_id='$y_id' ") or  die("SQL Error1==>1".mysql_error($con));
    list($year_id1)=mysqli_fetch_row($idl);

    $se_chk=mysqli_query($con,
      "SELECT chk_id,chk,name
      FROM chk_absence WHERE staff_id='$_SESSION[user_id]' AND year_id='$year_id1'")or die("SQL-error".mysqli_error($con));
      list($chk_id,$chk,$name)=mysqli_fetch_row($se_chk);
      mysqli_free_result($se_chk);
    
    if($yearnow==$y_id){
        if(!empty($year_id1)){
          echo " <td> <b class='text-success'><i class='fas fa-check-circle fa-2x'></i> กรอกข้อมูลแล้ว </b> </td>";
          if($yearnow == $year_id1){
            // echo " <td> <b class='text-secondary'><a href='javascript:void(0)' class='editbrn' data-id='$y_id'><i class='far fa-edit fa-2x'></i> แก้ไข <b></a></td>";
            echo " <td> <b class='text-secondary'><a href='javascript:void(0)' class='modelshowidl'  date-stid='$_SESSION[user_id]' data-id='$y_id' data-ck='$chk_id'> <i class='fas fa-info-circle fa-2x'></i> รายละเอียด <b></a></td>";
          }else{
              echo " <td> <b class='text-secondary'><a href='javascript:void(0)' class='modelshowidl' date-stid='$_SESSION[user_id]' data-id='$y_id' data-ck='$chk_id'> <i class='fas fa-info-circle fa-2x'></i> รายละเอียด <b></a></td>";
          }

        }else{
          echo " <td> <b class='text-danger'> <i class='fas fa-times-circle fa-2x '></i> ยังไม่ได้กรอกข้อมูล </b></td>";
          echo " <td> <b class='text-primary'><a href='javascript:void(0)' class='addbrn' data-id='$y_id'><i class='fas fa-plus fa-2x'></i>&nbsp;กรอกข้อมูล</a></b></td>";
        }
      }else{
      echo " <td> <b class='text-danger'> <i class='fas fa-times-circle fa-2x '></i> อยู่นอกระยะทำการ </b></td>";
      echo " <td> <b class='text-danger'><i class='fas fa-times-circle fa-2x '></i> อยู่นอกระยะทำการ</td>";
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

$(".modelshowidl").click(function(e){
        e.preventDefault()
        var id =$(this).data("id");
        var idst =$(this).data("stid");
        var cks =$(this).data("ck");
        $.post( "module/assessment/ldl_modelform.php", { yearid: id, stid : idst , acp:cks } ).done(function(data){
            $("#loadaddsub").html(data);
            $('#checksub').modal('show');
        })
});

});// ready
</script>
