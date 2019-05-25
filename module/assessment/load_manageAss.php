<?php
    include("../../function/db_function.php");
    $con=connect_db();

    $year_id = $_POST["year"];
?>
    <div class="table-responsive">
  <table class="table table-border" id="Datatable">
    <thead>
      <tr>
        <th>รหัสการประเมิน</th>
        <th>แบบฟอร์ม</th>
        <th>ปีการประเมิน</th>
        <th>รอบที่</th>
        <th>ชื่อ-สกุล</th>
        <th>ตำแหน่งทางวิชาการ</th>
        <th>ตำแหน่งการบริหาร</th>
        <th class='text-center'>สถานะหลักฐาน</th>
        <th>ลบ</th>
      </tr>
    <thead>
    <tbody>
        
<?php
    $se_Ass=mysqli_query($con,
    "SELECT assessments.ass_id,years.y_no,years.y_year,staffs.prefix,staffs.fname,staffs.lname,staffs.acadeic,staffs.position,staffs.st_id
    FROM assessments
    INNER JOIN years
    ON years.y_id=assessments.year_id
    INNER JOIN staffs
    ON staffs.st_id=assessments.staff 
    WHERE year_id='$year_id'")or die("SQL.errorAss".mysqli_error($con));
    while(list($ass_id,$no,$year,$prefix,$fname,$lname,$aca,$position,$gen_id)=mysqli_fetch_row($se_Ass)){
      $type=substr($ass_id,0,3);
      if($type=="PRE"){
          $p_type="TOR";
          $class="showPRE";
      }
      if($type=="TOR"){
        $p_type="ข้อตกลง";
        $class="showTOR";
      }
        $se_aca=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$aca'")or die("SQL.errorACA".mysqli_error($con));
        list($aca_name)=mysqli_fetch_row($se_aca);
        mysqli_free_result($se_aca);

        $se_post=mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id='$position'")or die("SQL.errorACA".mysqli_error($con));
        list($pos_name)=mysqli_fetch_row($se_post);
        mysqli_free_result($se_post);

        $evs=mysqli_query($con,"SELECT evd_id,evd_status FROM evidence WHERE ass_id='$ass_id'")or die("SQL.errorACA".mysqli_error($con));
        list($evd_id,$evd_status)=mysqli_fetch_row($evs);
        mysqli_free_result($evs);

        $asst5=mysqli_query($con,"SELECT inform FROM asessment_t5 WHERE ass_id='$ass_id'")or die("SQL.errorACA".mysqli_error($con));
        list($inform)=mysqli_fetch_row($asst5);
        mysqli_free_result($asst5);

        $evd="";
        if($type=="PRE"){
          $evd = "<i class='fas fa-minus-circle fa-2x text-danger'></i>";
        }else if(empty($evd_id)){
          $evd = "<i class='fas fa-minus-circle fa-2x text-danger'></i>";
        }else if(!empty($evd_id) AND $evd_status==1){

          $evd = "
          <select class='form-control' id='selectsuj' name='suj'>
            <option value='1' selected>ตรวจสอบหลักฐานอีกครั้ง</option>
            <option value='2'>ยืนหลักฐานแล้ว</option>
          </select> 
          ";
        } else if(!empty($evd_id) AND $evd_status==2 AND $inform==0){

          $evd = "
          <select class='form-control' id='selectsuj' name='suj'>
            <option value='1'>ตรวจสอบหลักฐานอีกครั้ง</option>
            <option value='2' selected>ยืนหลักฐานแล้ว</option>
          </select> 
          ";
        }else if(!empty($evd_id) AND $evd_status==2 AND $inform==1){

          $evd = "<i class='fas fa-minus-circle fa-2x text-danger'></i><br>หัวหน้ารับทราบการประเมินแล้ว";
        }


    echo"<tr>";
        echo"<td><a href='javascript:void(0)' class='$class text-success'  data-genid='$gen_id' data-yearid='$year_id' data-torid='$ass_id' data-fullname='$prefix$fname $lname' title='คลิกเพื่อแสดงการประเมิน'>$ass_id</a></td> "; 
        echo"<td>$p_type</td>";
        echo"<td>",$year+543,"</td>";
        echo"<td>$no</td>";
        echo"<td>$prefix$fname $lname</td>";
        echo"<td>$aca_name</td>";
        echo"<td>$pos_name</td>";
        echo"<td class='text-center'>$evd</td>";

        echo"<td><a href='javascript:void(0)'  class='deluser' data-iduser='$ass_id' data-type='$p_type' data-nuser='$fname $lname' ><i class='fa fa-trash fa-2x'></i></a></td>";
    echo"</tr>";
    }
    mysqli_free_result($se_Ass);
    mysqli_close($con);
?>      
    </tbody>
</table>
</div>
<div id="loadmodel"></div>
<script>
    $.getScript('js/mydatatable.js')
  
  $(".deluser").click(function(){   /// ป่มลบข้อมูล user

  var iduser =$(this).data("iduser");
  var nuser =$(this).data("nuser");
  var type =$(this).data("type");
  var r = confirm("ต้องการลบ "+ type +" ของ"+nuser+" ใช่หรือไม่?");
  if (r == true) {
      $.post( "module/assessment/del_ass.php", {id : iduser,type:type,user:nuser}).done(function(data,txtstuta){
  alert(data);
          var module1 = sessionStorage.getItem("module1");
          var action = sessionStorage.getItem("action");
          loadmain(module1,action);
          })
    }
})
$(".showTOR").click(function(e) {
		e.preventDefault(); 
    //alert("TTEST");
		//alert($(this).data("evdidtext"));
    $.post("module/assessment/loaddetail_tor.php", { stid: $(this).data('genid') , year: $(this).data('yearid') , fullname: $(this).data('fullname') } ).done(function(data){
            $('#loadmodel').html(data);
                 $('#showmodelpre').modal('show');
        })
  });

  $(".showPRE").click(function(e) {
		e.preventDefault(); 
    //alert("TTEST");
		//alert($(this).data("evdidtext"));
        $.post("module/assessment/loaddetail_pretest.php", { stid: $(this).data('genid') , year: $(this).data('yearid'),fullname: $(this).data('fullname') } ).done(function(data){
            $('#loadmodel').html(data);
                 $('#showmodelpre').modal('show');
        })
  });
</script>