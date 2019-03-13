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
      <th> หลักสูตร </th>
      <th> สาขา </th>
      <th> สถานะการประเมิน </th>
      <th> ประเมินบุคลากร </th>
      <th> ผลการประเมินบุคลากร </th>
    </tr>
  <thead>
    <tbody>
    <?php
    if($_SESSION['user_level'] == 3){ // หลักสูตร

      $show= mysqli_query($con,"SELECT st_id,fname,lname,branch_id,picture FROM staffs  WHERE branch_id='$_SESSION[branch]' AND permiss_id != 1 AND st_id != '$_SESSION[user_id]'AND position='1' ") or  die("SQL Error1==>1".mysqli_error($con));
    }
    else if($_SESSION['user_level'] == 4){ // สาขา

      $show= mysqli_query($con,"
SELECT  staffs.st_id,staffs.fname,staffs.lname,staffs.branch_id,staffs.picture
FROM staffs
INNER JOIN branchs ON staffs.branch_id = branchs.br_id
WHERE staffs.position = '2' AND branchs.dept_id ='$_SESSION[department]' AND staffs.st_id !='1' AND st_id != '$_SESSION[user_id]'") or  die("SQL Error1==>1".mysqli_error($con));

    }
    else //คณะ
    {
      $show= mysqli_query($con,"SELECT st_id,fname,lname,branch_id,picture FROM staffs WHERE  position='3' ") or  die("SQL Error1==>1".mysqli_error($con));
    }
    $i=1;
while(list($gen_id,$gen_fname,$gen_lname,$branch_id,$gen_pict)=mysqli_fetch_row($show)){
    echo "<tr>";
    echo " <td>$i</td>";
    if(!empty($gen_pict)){
        echo " <td><img src='img/$gen_pict' class='img-thumbnail' width='100px' height='100px'></td>";
    }else{
        echo " <td><img src='img/default/user_default.svg' width='100px' height='100px'></td>";
    }


    echo " <td>$gen_fname</td>";
    echo " <td>$gen_lname</td>";

    $ba= mysqli_query($con,"SELECT br_name,dept_id FROM branchs WHERE br_id='$branch_id'  ") or  die("SQL Error1==>1".mysql_error($con));
    list($branch_name,$dept_id)=mysqli_fetch_row($ba);
    $sb= mysqli_query($con,"SELECT dept_name FROM departments WHERE dept_id='$dept_id'  ") or  die("SQL Error1==>1".mysql_error($con));
    list($dept_name)=mysqli_fetch_row($sb);

    echo " <td>$branch_name</td>";
    echo " <td>$dept_name</td>";

    $show2= mysqli_query($con,"SELECT ass_id FROM assessments WHERE staff='$gen_id' AND year_id='$year'") or  die("SQL Error1==>1".mysql_error($con));
    list($tor_id)=mysqli_fetch_row($show2);

    $show3= mysqli_query($con,"SELECT ass_id FROM asessment_t1 WHERE ass_id='$tor_id' ") or  die("SQL Error1==>3".mysql_error($con));
    list($tor_idc2)=mysqli_fetch_row($show3);
    if(!empty($tor_id)){
      echo " <td> <b class='text-success'><i class='fas fa-check-circle fa-2x'></i> ทำการประเมินตนเองแล้ว </b> </td>";
      if(empty($tor_idc2)){
        echo " <td></a> <b class='text-danger'> <i class='fas fa-times-circle fa-2x '></i> ยังไม่ได้ประเมิน </b></a></td>";
        echo " <td> <b class='text-danger'> <i class='fas fa-times-circle fa-2x '></i> ยังไม่สามารถแสดงผลการประเมินได้   <b></td>";
      }
      else{
        echo " <td> <b class='text-success'><i class='fas fa-check-circle fa-2x'></i> ประเมินเรียบร้อยแล้ว  <b></td>";
        echo " <td> <b class='text-success'><a href='#loadsumass' class='showsumass' data-year='$year' data-stid='$gen_id'> <i class='fas fa-check-circle fa-2x'></i> แสดงผลการประเมินได้  </a> <b></td>";
      }

    }else{
      echo " <td> <b class='text-danger'> <i class='fas fa-times-circle fa-2x '></i> ยังไม่ได้ทำการประเมินตนเอง </b></td>";
      echo " <td></a> <b class='text-danger'><i class='fas fa-times-circle fa-2x '></i> ยังไม่สามารถประเมินได้ </b></a></td>";
      echo " <td> <b class='text-danger'><i class='fas fa-times-circle fa-2x'></i> ยังไม่สามารถแสดงผลการประเมินได้  <b></td>";
    }





    echo "</tr>";
  $i++;
}

     ?>


  </tbody>
</table>
<br><br><br>

<div id="loadsumass"></div>

<script>

$(document).ready(function() {

$.getScript('js/mydatatable.js')

$(".showsumass").click(function(){

  $("#loadsumass").html("")
      $("#loadging").css('display','')

      $.ajax({
        url: "module/assessment/load_sum_ass2.php",
        data:{year: $(this).data("year"),stid: $(this).data("stid") },
        type: "POST"
      }).done(function(data){

        setTimeout(function(){ 
          $("#loadging").css('display','none');
          $("#loadsumass").html(data)
        
        }, 2000);

      })

})


}) // END document
</script>
