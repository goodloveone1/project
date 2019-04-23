<?php
session_start();
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();

$year = $_POST['year'];
$year_now=chk_idtest();


if($year==$year_now){
?>
<div class="table-responsive">
<table class="table table-border col-md" id="Datatable">
  <thead>
    <tr>
  
      <th> รูปภาพ </th>
      <th> ชื่อ </th>
      <th> สกุล </th>
      <th> หลักสูตร </th>
      <th> สาขา </th>
      <th> ตำแหน่ง </th>
      <th> สถานะประเมิน</th>
      <th> สถานะข้อตกลง  </th>
      <th> สถานะหลักฐาน </th>
      <th> ประเมินบุคลากร </th>
    </tr>
  <thead>
    <tbody>
    <?php
    if($_SESSION['user_level'] == 3){ // หลักสูตร

      $show= mysqli_query($con,"SELECT st_id,prefix,fname,lname,branch_id,picture,position FROM staffs  WHERE branch_id='$_SESSION[branch]' AND permiss_id != 1 AND st_id != '$_SESSION[user_id]'AND permiss_id='2' ") or  die("SQL Error1==>1".mysqli_error($con));
    }
    else if($_SESSION['user_level'] == 4){ // สาขา

      $show= mysqli_query($con,"
SELECT  staffs.st_id,staffs.prefix,staffs.fname,staffs.lname,staffs.branch_id,staffs.picture,position
FROM staffs
INNER JOIN branchs ON staffs.branch_id = branchs.br_id
WHERE staffs.position = '2' AND branchs.dept_id ='$_SESSION[department]' AND staffs.st_id !='1' AND st_id != '$_SESSION[user_id]'") or  die("SQL Error1==>1".mysqli_error($con));

    }
    else //คณะ
    {
      $show= mysqli_query($con,"SELECT st_id,prefix,fname,lname,branch_id,picture,position FROM staffs WHERE  position='3' ") or  die("SQL Error1==>1".mysqli_error($con));
    }
    $i=1;
while(list($gen_id,$prefix,$gen_fname,$gen_lname,$branch_id,$gen_pict,$position)=mysqli_fetch_row($show)){
    echo "<tr>";
    if(!empty($gen_pict)){
        echo " <td><img src='img/$gen_pict' class='img-thumbnail' width='100px' height='100px'></td>";
    }else{
        echo " <td><img src='img/default/user_default.svg' width='100px' height='100px'></td>";
    }


    echo " <td>$gen_fname</td>";
    echo " <td>$gen_lname</td>";
    $fullname = $prefix." ".$gen_fname." ".$gen_lname;

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


    // ข้อตกลง
    $pre= mysqli_query($con,"SELECT ass_id FROM assessments WHERE staff='$gen_id' AND year_id='$year' AND ass_id LIKE 'PRE%' ") or  die("SQL Error1==>1".mysql_error($con));
    list($PRE_id)=mysqli_fetch_row($pre);
    mysqli_free_result($pre);

    // TOR
    $tor= mysqli_query($con,"SELECT ass_id FROM assessments WHERE staff='$gen_id' AND year_id='$year' AND ass_id LIKE 'TOR%' ") or  die("SQL Error1==>1".mysql_error($con));
    list($tor_id)=mysqli_fetch_row($tor);
    mysqli_free_result($tor);

     // เช็ค EVD
     $se_EVD=mysqli_query($con,"SELECT evd_id,evd_status FROM evidence WHERE st_id='$gen_id' AND ass_id='$tor_id'") or die("SQL-error".mysqli_error($con));
     list($evd_id,$evd_status)=mysqli_fetch_row($se_EVD);
     mysqli_free_result($se_EVD);

      // เช็ค assid 5
    
      $se_ass5=mysqli_query($con,"SELECT asst5_id,accept,date_accept,inform,date_inform FROM asessment_t5 WHERE ass_id='$tor_id'") or die("SQL-error".mysqli_error($con));
      list($asst5_id,$accept,$date_accept,$inform,$date_inform)=mysqli_fetch_row($se_ass5);
      mysqli_free_result($se_ass5);


    // $show3= mysqli_query($con,"SELECT ass_id FROM asessment_t1 WHERE ass_id='$tor_id' ") or  die("SQL Error1==>3".mysql_error($con));
    // list($tor_idc2)=mysqli_fetch_row($show3);
    // mysqli_free_result($show3);

    if(empty($PRE_id)){
      echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้ทำTORได้ </b></td>";
      echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้ทำข้อตกลง</b></td>";
      echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้อัปโหลดหลักฐาน</b></td>";
      echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่สามารถประเมินได้</b></td>";
    }else{
        if(empty($tor_id)){
          echo "<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>ทำTORแล้ว</b></b></td>";
          echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้ทำข้อตกลง</b></td>";
          echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้อัปโหลดหลักฐาน</b></td>";
          echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่สามารถประเมินได้</b></td>";
        }else{
          if(empty($evd_id)){
            echo "<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>ทำTORแล้ว</b></td>";
            echo "<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>ทำข้อตกลงแล้ว</b></td>";
            echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้อัปโหลดหลักฐาน</b></td>";
            echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่สามารถประเมินได้</b></td>";
          }else{
            if($evd_status ==1){
              echo "<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>ทำTORแล้ว</b></td>";
              echo "<td class='text-center'><b class='text-success'><i class='fas fa-check-circle fa-2x'></i><br>ทำข้อตกลงแล้ว</b></td>";
              echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>รอยืนยันอัปโหลดหลักฐาน</b></td>";
              echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่สามารถประเมินได้</b></td>";
            }else if($evd_status ==2){
              if($inform == 0 && $accept == 0){
                echo "<td class='text-center'><a href='javascript:void(0)' class='showpre text-success'   data-genid='$gen_id' data-yearid='$year' data-fullname='$fullname'  title='คลิกเพื่อแสดงข้อตกลง'><i class='fas fa-check-circle fa-2x'></i><br>แสดงการประเมิน</a></td>";
                echo "<td class='text-center'><a href='javascript:void(0)' class='showtor text-success'  data-genid='$gen_id' data-yearid='$year' data-fullname='$fullname' title='คลิกเพื่อแสดงการประเมิน'><i class='fas fa-check-circle fa-2x'></i><br>แสดงข้อตกลง</a></td>";
                echo "<td class='text-center'><a href='javascript:void(0)' class='showevd text-success'  data-evdid='$evd_id' data-fullname='$fullname' title='คลิกเพื่อแสดงการหลักฐาน'><i class='fas fa-check-circle fa-2x'></i><br>แสดงการหลักฐาน</a></td>";
                echo "<td class='text-center'> <b class='text-danger'><a href='javascript:void(0)' class='checktor' data-genid='$gen_id' data-year='$tor_id'  title='คลิกเพื่อตรวจสอบ'> <i class='fas fa-times-circle fa-2x '></i><br> ยังไม่ได้ตรวจสอบ </br></a></td>";
                }
              else if($inform == 1 && $accept == 0 || $inform == 1 && $accept == 1){
              echo "<td class='text-center'><a href='javascript:void(0)' class='showpre text-success'  data-genid='$gen_id' data-yearid='$year' data-fullname='$fullname'  title='คลิกเพื่อแสดงข้อตกลง'><i class='fas fa-check-circle fa-2x'></i><br>แสดงการประเมิน</a></td>";
              echo "<td class='text-center'><a href='javascript:void(0)' class='showtor text-success'  data-genid='$gen_id' data-yearid='$year' data-fullname='$fullname' title='คลิกเพื่อแสดงการประเมิน'><i class='fas fa-check-circle fa-2x'></i><br>แสดงข้อตกลง</a></td>";
              echo "<td class='text-center'><a href='javascript:void(0)' class='showevd text-success'  data-evdid='$evd_id' data-fullname='$fullname' title='คลิกเพื่อแสดงการหลักฐาน'><i class='fas fa-check-circle fa-2x'></i><br>แสดงการหลักฐาน</a></td>";
              echo "<td class='text-center'><b class='text-success'> <i class='fas fa-check-circle fa-2x'></i><br> ตรวจสอบเสร็จแล้ว </br></td>";
              }
             
            }

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
</div> 
<div id="loadmodel"></div>
<script>
$.getScript('js/mydatatable.js')
$(".checktor").click(function(){
  var gen_id = $(this).data("genid");
  var year_id = $(this).data("year");
  sessionStorage.setItem("module1","assessment")
	sessionStorage.setItem("action","edit_tor")

  $.ajax({
    url: "module/assessment/edit_tor.php",
    data:{genid:gen_id,year:year_id},
    type: "POST"
  }).done(function(data){
    $("#detail").html(data);
  })

})


$(".showpre").click(function(e) {
		e.preventDefault(); 
    //alert("TTEST");
		//alert($(this).data("evdidtext"));
        $.post("module/assessment/loaddetail_pretest.php", { stid: $(this).data('genid') , year: $(this).data('yearid') , fullname: $(this).data('fullname') } ).done(function(data){
            $('#loadmodel').html(data);
                 $('#showmodelpre').modal('show');
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

</script>

<?php 
    }else if($year<$year_now){
      echo "<p align='center' style='color:red;'>***หมดเวลาประเมินแล้ว กรุณาตรวจสอบปีการประเมิน</p>";
    }else{
      echo "<p align='center' style='color:blue;'>***ยังไม่ถึงเวลาประเมิน กรุณาตรวจสอบปีการประเมิน</p>";
    }
?>
