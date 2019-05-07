<?php
    include("../../function/db_function.php");
    $con=connect_db();

    $year = $_POST["year"];
?>
    <div class="table-responsive">
  <table class="table table-border" id="Datatable">
    <thead>
      <tr>
        <th>รหัสการประเมิน</th>
        <th>ประภท</th>
        <th>ปีการประเมิน</th>
        <th>รอบที่</th>
        <th>ชื่อ-สกุล</th>
        <th>ตำแหน่งทางวิชาการ</th>
        <th>ตำแหน่งการบริหาร</th>
        <th>ลบ</th>
      </tr>
    <thead>
    <tbody>
        
<?php
    $se_Ass=mysqli_query($con,
    "SELECT assessments.ass_id,years.y_no,years.y_year,staffs.prefix,staffs.fname,staffs.lname,staffs.acadeic,staffs.position
    FROM assessments
    INNER JOIN years
    ON years.y_id=assessments.year_id
    INNER JOIN staffs
    ON staffs.st_id=assessments.staff 
    WHERE year_id='$year'")or die("SQL.errorAss".mysqli_error($con));
    while(list($ass_id,$no,$year,$prefix,$fname,$lname,$aca,$position)=mysqli_fetch_row($se_Ass)){
      $type=substr($ass_id,0,3);
      if($type=="PRE"){
          $p_type="TOR";
      }
      if($type=="TOR"){
        $p_type="ประเมิน";
      }
        $se_aca=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$aca'")or die("SQL.errorACA".mysqli_error($con));
        list($aca_name)=mysqli_fetch_row($se_aca);
        mysqli_free_result($se_aca);

        $se_post=mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id='$position'")or die("SQL.errorACA".mysqli_error($con));
        list($pos_name)=mysqli_fetch_row($se_post);
        mysqli_free_result($se_post);

    echo"<tr>";
        echo"<td>$ass_id</td> "; 
        echo"<td>$p_type</td>";
        echo"<td>",$year+543,"</td>";
        echo"<td>$no</td>";
        echo"<td>$prefix$fname $lname</td>";
        echo"<td>$aca_name</td>";
        echo"<td>$pos_name</td>";
        echo"<td><a href='javascript:void(0)'  class='deluser' data-iduser='$ass_id' data-type='$p_type' data-nuser='$fname $lname' ><i class='fa fa-trash fa-2x'></i></a></td>";
    echo"</tr>";
    }
    mysqli_free_result($se_Ass);
    mysqli_close($con);
?>      
    </tbody>
</table>
</div>

<script>
    $.getScript('js/mydatatable.js')
  
  $(".deluser").click(function(){   /// ป่มลบข้อมูล user

  var iduser =$(this).data("iduser");
  var nuser =$(this).data("nuser");
  var type =$(this).data("type");
  var r = confirm("ต้องการลบ "+ type +" ของ"+nuser+" ใช่หรือไม่?");
  if (r == true) {
      $.post( "module/assessment/del_ass.php", {id : iduser}).done(function(data,txtstuta){
  alert(data);
          var module1 = sessionStorage.getItem("module1");
          var action = sessionStorage.getItem("action");
          loadmain(module1,action);
          })
    }
})
</script>