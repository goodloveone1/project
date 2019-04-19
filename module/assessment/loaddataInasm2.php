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
      <!-- <th>ลำดับ </th> -->
      <th> รูปภาพ </th>
      <th> ชื่อ </th>
      <th> สกุล </th>
      <th> หลักสูตร </th>
      <th> สาขา </th>
      <th> ตำแหน่ง </th>
      <th> TOR </th>
      <th> หลักฐาน </th>
      <th> แสดงความเห็น </th>
    </tr>
  <thead>
    <tbody>
    <?php
    if($_SESSION['user_level'] == 3){ // หลักสูตร

      $show= mysqli_query($con,"SELECT st_id,fname,lname,branch_id,picture,position FROM staffs  WHERE branch_id='$_SESSION[branch]' AND permiss_id != 1 AND st_id != '$_SESSION[user_id]'AND position='1' ") or  die("SQL Error1==>1".mysqli_error($con));
    }
    else if($_SESSION['user_level'] == 4){ // สาขา

      $show= mysqli_query($con,"
SELECT  staffs.st_id,staffs.fname,staffs.lname,staffs.branch_id,staffs.picture,position
FROM staffs
INNER JOIN branchs ON staffs.branch_id = branchs.br_id
WHERE  branchs.dept_id ='$_SESSION[department]' AND staffs.permiss_id !='1' AND st_id != '$_SESSION[user_id]' AND staffs.permiss_id !='5'") or  die("SQL Error1==>1".mysqli_error($con));

    }
    else //คณะ
    {
      $show= mysqli_query($con,"SELECT st_id,fname,lname,branch_id,picture,position FROM staffs WHERE  position='3' ") or  die("SQL Error1==>1".mysqli_error($con));
    }
    $i=1;
while(list($gen_id,$gen_fname,$gen_lname,$branch_id,$gen_pict,$position)=mysqli_fetch_row($show)){
    echo "<tr>";
    // echo " <td>$i</td>";
    if(!empty($gen_pict)){
        echo " <td><img src='img/$gen_pict' class='img-thumbnail' width='100px' height='100px'></td>";
    }else{
        echo " <td><img src='img/default/user_default.svg' width='100px' height='100px'></td>";
    }


    echo " <td>$gen_fname</td>";
    echo " <td>$gen_lname</td>";

    $ba= mysqli_query($con,"SELECT br_name,dept_id FROM branchs WHERE br_id='$branch_id'  ") or  die("SQL Error1==>1".mysql_error($con));
    list($branch_name,$dept_id)=mysqli_fetch_row($ba);
    mysqli_free_result($ba);
    $sb= mysqli_query($con,"SELECT dept_name FROM departments WHERE dept_id='$dept_id'  ") or  die("SQL Error1==>1".mysql_error($con));
    list($dept_name)=mysqli_fetch_row($sb);
    mysqli_free_result($sb);

    echo " <td>$branch_name</td>";
    echo " <td>$dept_name</td>";

    $pos= mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id='$position'  ") or  die("SQL Error1==>1".mysql_error($con));
    list($pos_name)=mysqli_fetch_row($pos);
    mysqli_free_result($pos);

    echo "<td>$pos_name</td>";

   
    // TOR
    $tor= mysqli_query($con,"SELECT ass_id FROM assessments WHERE staff='$gen_id' AND year_id='$year' AND ass_id LIKE 'TOR%' ") or  die("SQL Error1==>1".mysql_error($con));
    list($tor_id)=mysqli_fetch_row($tor);
    mysqli_free_result($tor);

    $evd= mysqli_query($con,"SELECT evd_id FROM evidence WHERE ass_id='$tor_id'") or  die("SQL Error1==>1".mysql_error($con));
    list($evd_id)=mysqli_fetch_row($evd);
    mysqli_free_result($evd);
    // echo $PRE_id;
    

    if(empty($tor_id)){
      echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้ทำTORได้</b></td>";
    }else{
      echo "<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>ทำTORแล้ว</b></td>"; 
    }

    if(empty($evd_id)){
      echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้อัพโหลดหลักฐาน</b></td>";
    }else{
      echo "<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>อัพโหลดหลักฐานแล้ว</b></td>";
    }

 
    
    if(empty($tor_id)){
      echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้ทำTOR</b></td>";
    }else{
      $comment=mysqli_query($con,"SELECT *FROM asessment_t6 WHERE ass_id='$tor_id'")or die("SQL.error".mysqli_error($con));
      list($ass6_id,$ass_id,$leader_comt,$leader_comt_disc,$leader_compt_date,$supervisor_comt,$supervisor_comtdisc,$supervisor_comt_date)=mysqli_fetch_row($comment);
      mysqli_free_result($comment);
      if($position=='1'){
          if($leader_comt==0){
            echo "<td class='text-center'></a> <b class='text-danger'><a href='javascript:void(0)' class='checktor' data-genid='$gen_id' data-year='$tor_id'  title='คลิกเพื่อตรวจสอบ'> <i class='fas fa-times-circle fa-2x '></i><br> ยังไม่ได้แสดงความเห็น </br></a></td>";
          }else{
            echo "<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>ทำTORแล้ว</b></td>"; 
          }
      }else if($position=='2'){
        echo "<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>ประเมินแล้ว</b></td>"; 
      }
    }
    




    echo "</tr>";
  $i++;
}
mysqli_free_result($show);
mysqli_close($con);
     ?>


  </tbody>
</table>
<br><br><br>

<div id="loadmodel"></div>

<script>

$(document).ready(function() {

$.getScript('js/mydatatable.js')

$(".showsumass").click(function(e){
  e.preventDefault();

  $.post("module/assessment/modelsumass.php", { year: $(this).data("year"),stid: $(this).data("stid") }).done(function(data){
                $('#loadmodel').html(data);
                $('#showsumass').modal('show');
            })

  // $("#loadsumass").html("")
  //     $("#loadging").css('display','')

  //     $.ajax({
  //       url: "module/assessment/load_sum_ass2.php",
  //       data:{year: $(this).data("year"),stid: $(this).data("stid") },
  //       type: "POST"
  //     }).done(function(data){

  //       setTimeout(function(){ 
  //         $("#loadging").css('display','none');
  //         $("#loadsumass").html(data)
        
  //       }, 2000);

  //     })

})


}) // END document
</script>
