<?php
session_start();
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();
$mm=date('m');  //เดือนปัจจุบัน
$yearbudget=DATE('Y')+543;  //ปีปัจจุบัน
$m="$mm";
$y="$yearbudget";
if($m<=9 && $m>3){
    $loop=2;
}else{
    $loop=1;
}
if($loop==2){
    $y-=1;
}
 $y_id = $y.$loop;
// echo "<p> id = $y_id </p>";
// echo "$_SESSION[user_id]";
// $tor=mysqli_query($con,"SELECT tor_id,tor_year,tor_nameRe FROM tor WHERE gen_id='$_SESSION[user_id]' AND tor_year='$y_id'") or die("SQL_ERROR".mysqli_error($con));
//     list($tor_id,$tor_year,$tor_nameRe)=mysqli_fetch_row($tor);
//     echo $tor_id,$tor_nameRe,"<br>";
// if($tor_year==$y_id){
//    echo "<p style='color:blue;'>มีข้อมูลแล้ว</p>";
//    //include("edit_tor.php");
// }else{
//     echo"<p style='color:red;'>ยังไม่มีข้อมูล</p>";
//    include("test_tor_stepBystep.php");
  //  unset($_SESSION['tor_id']);
//}

?>

<div class="row  p-2 headtitle">
  <div class="col-xl-2">
      <a href='javascript:void(0)'><button type="button" class="btn btn-block menuuser" id="backpage" data-modules="assessment" data-action="menuassm"><i class="fas fa-chevron-left"></i>&nbsp;ย้อนกลับ</button></a>
  </div>
	<h2 class="text-center col-xl "> จัดการ TOR </h2>
  <div class="col-xl-2 ">
      <a href='javascript:void(0)'><button type="button" class="btn btn-block btn-light" id="addbrn" data-toggle='modal'><i class="fas fa-plus"></i>&nbsp;การประเมิน</button></a>
  </div>
</div>

<div class="table-responsive">
  <table class="table">
    <thead>
      <th> รหัส TOR </th>
      <th> ปีการประเมิน </th>
      <th> รอบที่ </th>
      <th> แก้ไข </th>

    </thead>
    <tbody>
      <?php
$tor=mysqli_query($con,"SELECT tor_id,tor_year,tor_nameRe FROM tor WHERE gen_id='$_SESSION[user_id]' AND tor_year='$y_id'");
        while(list($tor_id,$tor_year,$tor_nameRe)=mysqli_fetch_row($tor)){
              echo "<td> $tor_id</td>";
              $tor=mysqli_query($con,"SELECT y_year,y_no FROM years WHERE y_id='$tor_year'");
              list( $y_year,$y_no)=mysqli_fetch_row($tor);

              echo "<td> $y_year</td>";
              echo "<td> $y_no</td>";
                echo "<td><a href='javascript:void(0)'class='editbrn' data-tor_id='$tor_id'><i class='fas fa-edit fa-2x'></i></a></td>";
        }
       ?>
      <td></td>
    <tbody>
  </table>
</div>
<script type="text/javascript">
  <?php
$tor=mysqli_query($con,"SELECT tor_id FROM tor WHERE gen_id='$_SESSION[user_id]' AND tor_year='$y_id'");
 list($tors) =mysqli_fetch_row($tor);
 if(!empty($tors)){
   $x=0;
 }else{
   $x=1;
 }

?>

$(document).ready(function() {
  $("#addbrn").click(function( ){
    var x = "<?php echo $x ?>"
    if(x == "0"){
      alert("คุณได้ทำการประเมินแล้ว");
    }else{
        loadmain("assessment","check_tor");
    }
  })

  $("#editbrn").click(function(){
        loadmain("assessment","check_tor");
      })
})

</script>
