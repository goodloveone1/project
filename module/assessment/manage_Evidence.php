<?php
  session_start();
  include("../../function/db_function.php");
  include("../../function/fc_time.php");
$con=connect_db();
?>
<div class="row  p-2 headtitle">

	<h2 class="text-center col-xl "> จัดการหลักฐานของตนเอง </h2>

</div>
<br>
<div class="table-responsive">
  <table class="table" id="Datatable">
    <thead>
      <tr>
        <th> รหัสประเมิน </th>
        <th> ปีการประเมิน </th>
        <th> รอบที่ </th>
				<th class="text-center"> สถานะ </th>
        <th class="text-center"> จัดการหลักฐาน </th>
      </tr>
    </thead>
    <tbody>
			<?php
					$asm= mysqli_query($con,"SELECT ass_id,year_id FROM assessments WHERE staff='$_SESSION[user_id]' AND ass_id LIKE'TOR%' ORDER BY year_id DESC") or  die("SQL Error==>".mysqli_error($con));
					while(list($ass_id,$tor_year) = mysqli_fetch_row($asm)){

					echo "<tr>";
					echo " <td> $ass_id </td>";

							$year = substr($tor_year,0,4);
							$rond = substr($tor_year,4,4);
			    echo "<td> $year</td>";
			    echo "<td> $rond</td>";


					$evd= mysqli_query($con,"SELECT evd_id,evd_status FROM evidence WHERE st_id='$_SESSION[user_id]' AND ass_id='$ass_id'");
					list($evd_id,$evd_status) = mysqli_fetch_row($evd);
					
					if(chk_idtest() ==  $tor_year)	{

					if(empty($evd_status)){
							echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้อัปโหลดหลักฐาน</br></td>";
							echo "  <td class='text-center'> <b class='btn text-primary addevd' data-torid='$ass_id' ><i class='far fa-plus-square fa-2x'></i> </b></td>";
					}else if($evd_status == 1){
						echo "<td class='text-center'><b class='text-danger'><i class='far fa-clock fa-2x'></i><br>รอตรวจสอบหลักฐานอีกคร้ง </b></td>"; 
							echo "  <td class='text-center'> <b class='btn text-primary '> <a href='javascript:void(0)' class='editevd' data-torid='$ass_id' data-evdid='$evd_id' title='คลิกเพื่อตรวจสอบ'><i class='fas fa-check fa-2x'></i><br>ตรวจสอบหลักอีกครั้ง </b></a></td>";
					
					}else if($evd_status == 2){
						echo "<td class='text-center'><b class='text-success'> <i class='fas fa-check-circle fa-2x'></i><br> ยืนยันหลักฐานแล้ว </b></td>"; 
						echo "  <td class='text-center'> <a href='javascript:void(0)' class='checkevd text-success' data-evdid='$evd_id'><b><i class='fas fa-info fa-2x'></i><br>รายละเอียดหลักฐาน </b></a></td>";
					}
	
				}	else{
						if(empty($evd_status)){
							echo "<td class='text-center'><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i><br>ยังไม่ได้อัปโหลดหลักฐาน </br></td>";
							echo "  <td class='text-center text-danger'><b> <i class='fas fa-exclamation fa-2x'></i><br>อยู่นอกระยะการประเมิน </b> </td>";
					}else if($evd_status == 1){
						echo "<td class='text-center'><b class='text-danger'><i class='far fa-clock fa-2x'></i><br> รอยืนยันอีกครั้ง </b></td>"; 
						echo "  <td class='text-center text-danger'><b> <i class='fas fa-exclamation fa-2x'></i><br>อยู่นอกระยะการประเมิน </b> </td>";
					}else if($evd_status == 2){
						echo "<td class='text-center'><b class='text-success'><b class='text-success'> <i class='fas fa-check-circle fa-2x'></i><br> ยืนยันหลักฐานแล้ว </b></td>"; 
						echo "  <td class='text-center'> <a href='javascript:void(0)' class='btn checkevd text-success' data-evdid='$evd_id'><b class='' ><i class='fas fa-info fa-2x'></i><br>รายละเอียดหลักฐาน </b></a></td>";
					}
				}

					
					
			    echo " </tr>";
					mysqli_free_result($evd);
	 } // END WHILE

	 
	 mysqli_free_result($asm);
	 mysqli_close($con);
?>
    </tbody>
  </table>
</div>


<script>
$.getScript('js/mydatatable.js')
  $(".addevd").click(function(){
			var tor_id = $(this).data("torid");
			$("#detail").html("");
			$.post("module/assessment/formreport_prm.php",{ torid:tor_id}).done(function(data){
				sessionStorage.setItem("module1","assessment")
				sessionStorage.setItem("action","formreport_prm")
				$("#detail").html(data);
			})
	})

	$(".editevd").click(function(){
			var tor_id = $(this).data("torid");
			$("#detail").html("");
			$.post("module/assessment/editformreport_prm.php",{evdid: $(this).data("evdid") }).done(function(data){
				sessionStorage.setItem("module1","assessment")
				sessionStorage.setItem("action","editformreport_prm")
				$("#detail").html(data);
			})
	})

	$(".checkevd").click(function(){
			var tor_id = $(this).data("torid");
			$("#detail").html("");
			$.post("module/assessment/editformreport_prm_check.php",{evdid: $(this).data("evdid") }).done(function(data){
				sessionStorage.setItem("module1","assessment")
				sessionStorage.setItem("action","manage_Evidence")
				$("#detail").html(data);
			})
	})
</script>
