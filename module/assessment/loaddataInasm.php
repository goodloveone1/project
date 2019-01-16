<?php
session_start();
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();

$year = $_POST['year'];
?>

<table class="table table-border col-md" id="Datatable">
  <thead>
    <tr>
      <th>ลำดับ </th>
      <th> รูปภาพ </th>
      <th> ชื่อ </th>
      <th> สกุล </th>
      <th> สาขา </th>
      <th> หลักสูตร </th>
      <th> สถานะการประเมิน </th>
      <th> ประเมินบุคลากร </th>
    </tr>
  <thead>
    <tbody>
    <?php
    if($_SESSION['user_level'] == 3){ // สาขา

      $show= mysqli_query($con,"SELECT gen_id,gen_fname,gen_lname,branch_id,subject_id,gen_pict FROM general  WHERE branch_id='$_SESSION[branch_id]' AND permiss_id != 1 AND gen_id != '$_SESSION[user_id]' ") or  die("SQL Error1==>1".mysqli_error($con));
    }
    else if($_SESSION['user_level'] == 4){ // สาขา หลักสูตร

      $show= mysqli_query($con,"SELECT gen_id,gen_fname,gen_lname,branch_id,subject_id,gen_pict FROM general WHERE subject_id='$_SESSION[subject_id]' AND permiss_id != 1 AND gen_id != '$_SESSION[user_id]'") or  die("SQL Error1==>1".mysqli_error($con));

    }
    $i=1;
while(list($gen_id,$gen_fname,$gen_lname,$branch_id,$subject_id,$gen_pict)=mysqli_fetch_row($show)){
    echo "<tr>";
    echo " <td>$i</td>";
    if(!empty($gen_pict)){
        echo " <td><img src='img/$gen_pict' class='img-thumbnail' width='100px' height='100px'></td>";
    }else{
        echo " <td><img src='img/default/user_default.svg' width='100px' height='100px'></td>";
    }


    echo " <td>$gen_fname</td>";
    echo " <td>$gen_lname</td>";

    $ba= mysqli_query($con,"SELECT branch_name FROM branch WHERE branch_id='$branch_id'  ") or  die("SQL Error1==>1".mysql_error($con));
    list($branch_name)=mysqli_fetch_row($ba);
    $sb= mysqli_query($con,"SELECT subject_name FROM subjects WHERE subject_id='$subject_id'  ") or  die("SQL Error1==>1".mysql_error($con));
    list($subject_id)=mysqli_fetch_row($sb);

    echo " <td>$branch_name</td>";
    echo " <td>$subject_id</td>";

    $show2= mysqli_query($con,"SELECT tor_id FROM tor WHERE gen_id='$gen_id' AND tor_year='$year'") or  die("SQL Error1==>1".mysql_error($con));
    list($tor_id)=mysqli_fetch_row($show2);

    $show3= mysqli_query($con,"SELECT tor_id FROM tort1 WHERE tor_id='$tor_id' ") or  die("SQL Error1==>3".mysql_error($con));
    list($tor_idc2)=mysqli_fetch_row($show3);
    if(!empty($tor_id)){
      echo " <td> <b class='text-success'><i class='fas fa-check-circle fa-2x'></i> ทำการประเมินแล้ว </b> </td>";
      if(empty($tor_idc2)){
        echo " <td></a> <b class='text-danger'><a href='javascript:void(0)' class='checktor' data-genid='$gen_id' data-year='$year'> <i class='fas fa-times-circle fa-2x '></i> ยังไม่สามารถตรวจสอบได้ </b></a></td>";
      }
      else{
        echo " <td> <b class='text-success'><i class='fas fa-check fa-2x'></i> ตรวจสอบแล้ว  <b></td>";

      }

    }else{
      echo " <td> <b class='text-danger'> <i class='fas fa-times-circle fa-2x '></i> ยังไม่ได้ทำการประเมิน </b></td>";
      echo " <td></a> <b class='text-danger'><i class='fas fa-times-circle fa-2x '></i> ยังไม่สามารถตรวจสอบได้ </b></a></td>";
    }





    echo "</tr>";
  $i++;
}

     ?>


  </tbody>
</table>
<script>
$.getScript('js/mydatatable.js')
$(".checktor").click(function(){
  var gen_id = $(this).data("genid");
  var year_id = $(this).data("year");

  $.ajax({
    url: "module/assessment/edit_tor.php",
    data:{genid:gen_id,year:year_id},
    type: "POST"
  }).done(function(data){
    $("#detail").html(data);
  })

})

</script>
