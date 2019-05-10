<?php
session_start();
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();

$year = $_POST['year'];
if($_SESSION['user_level']==3){
  $com_s = "<!--";
  $com_e="-->";
}else{
  $com_s =" ";
  $com_e =" ";
}
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
      <th> การประเมิน </th>
      <th> หลักฐาน </th>
      <?php echo $com_s ?><th> แสดงความเห็น </th><?php echo $com_e?>
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
      $show= mysqli_query($con,"
      SELECT  staffs.st_id,staffs.fname,staffs.lname,staffs.branch_id,staffs.picture,position
      FROM staffs
      INNER JOIN branchs ON staffs.branch_id = branchs.br_id
      WHERE  branchs.dept_id ='$_SESSION[department]' AND staffs.permiss_id !='1' AND st_id != '$_SESSION[user_id]' ") or  die("SQL Error1==>1".mysqli_error($con));
      
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
    $fullname = $gen_fname." ".$gen_lname;
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
      echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้ทำการประเมิน</b></td>";
    }else{
      $seApp=mysqli_query($con,"SELECT inform FROM asessment_t5 WHERE ass_id='$tor_id'")or die("SQL error.asst5".mysqli_error($con));
      list($inform)=mysqli_fetch_row($seApp);
      if($inform==0){
        echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ผู้บังคับบัญชายังไม่ได้ตรวจสอบการประเมิน</b></td>";
      }else{
        echo "<td class='text-center'><b class='text-success'> <i class='fas fa-check-circle fa-2x'></i><br><a href='javascript:void(0)' class='showtor text-success'  data-genid='$gen_id' data-yearid='$year' data-fullname='$fullname' title='คลิกเพื่อแสดงการประเมิน'>ดูผลการประเมิน</a></b></td>";
      }
      
    }

    if(empty($evd_id)){
      echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้อัพโหลดหลักฐาน</b></td>";
    }else{
      echo "<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><a href='javascript:void(0)' class='showevd text-success'  data-evdid='$evd_id' data-fullname='$fullname' title='คลิกเพื่อแสดงการหลักฐาน'><br>ดูไฟล์หลักฐาน</b></a></td>";
    }

 
    
    if(empty($tor_id)){
      echo $com_s,"<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้ทำการประเมิน</b></td>",$com_e;
    }else{
      $comment=mysqli_query($con,"SELECT *FROM asessment_t6 WHERE ass_id='$tor_id'")or die("SQL.error".mysqli_error($con));
      list($ass6_id,$ass_id,$leader_comt,$leader_comt_disc,$leader_compt_date,$supervisor_comt,$supervisor_comtdisc,$supervisor_comt_date)=mysqli_fetch_row($comment);
      mysqli_free_result($comment);
      if($_SESSION['user_level']==4){
          if($position=='1'){
            if($leader_comt==0){
              echo $com_s,"<td class='text-center'><b class='text-danger'><a href='javascript:void(0)' class='comment' data-genid='$gen_id' data-year='$tor_id'  title='คลิกเพื่อตรวจสอบ'> <i class='fas fa-times-circle fa-2x '></i><br> แสดงความเห็น </br></a></b></td>",$com_e;
            }else{
              echo $com_s,"<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>แสดงความเห็นแล้ว</b></td>",$com_e; 
            }
        }else if($position=='2'){
          echo "<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>ประเมินแล้ว</b></td>"; 
        }
      }else if($_SESSION['user_level']==5){
          if($position=='1'){
            if($supervisor_comt==0){
              echo $com_s,"<td class='text-center'><b class='text-danger'><a href='javascript:void(0)' class='comment' data-genid='$gen_id' data-year='$tor_id'  title='คลิกเพื่อตรวจสอบ'> <i class='fas fa-times-circle fa-2x '></i><br> แสดงความเห็น </br></a></b></td>",$com_e;
            }else{
              echo $com_s,"<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>แสดงความเห็นแล้ว</b></td>",$com_e; 
            }
        }else if($position=='3'){
          echo "<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>ประเมินแล้ว</b></td>"; 
        }
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


  $(".comment").click(function(e) {
		e.preventDefault(); 
    //alert("TTEST");
		//alert($(this).data("evdidtext"));
        $.post("module/assessment/load_hleadcomment.php", { user_id: $(this).data('genid') , tor_id: $(this).data('year') , fullname: $(this).data('fullname') } ).done(function(data){
            $('#loadmodel').html(data);
                 $('#showmodelsum').modal('show');
        })
  });

  $(".showtor").click(function(e) {
		e.preventDefault(); 
    //alert("TTEST");
		//alert($(this).data("evdidtext"));
        $.post("module/assessment/loaddetail_tor.php", { stid: $(this).data('genid') , year: $(this).data('yearid') , fullname: $(this).data('fullname') } ).done(function(data){
            $('#loadmodel').html(data);
                 $('#showmodelpre').modal('show');
        })
  });

  $(".showevd").click(function(e) {
		e.preventDefault(); 
    //alert("TTEST");
		//alert($(this).data("evdidtext"));
        $.post("module/assessment/loaddetail_evd.php", { evdid: $(this).data("evdid") , checkshowfile: 1 , fullname: $(this).data('fullname')} ).done(function(data){
            $('#loadmodel').html(data);
                 $('#showmodelpre').modal('show');
        })
	});
  
}) // END document
</script>
