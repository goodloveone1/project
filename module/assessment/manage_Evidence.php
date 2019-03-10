<?php
  session_start();
  include("../../function/db_function.php");
  include("../../function/fc_time.php");
$con=connect_db();
?>
<div class="row  p-2 headtitle">

	<h2 class="text-center col-xl "> จัดการหลักฐาน </h2>

</div>
<br>
<div class="table-responsive">
  <table class="table" id="Datatable">
    <thead>
      <tr>
        <th> รหัสประเมิน </th>
        <th> ปีการประเมิน </th>
        <th> รอบที่ </th>
				<th> สถานะ </th>
        <th class="text-center"> จัดการหลักฐาน </th>
      </tr>
    </thead>
    <tbody>
			<?php
					  $asm= mysqli_query($con,"SELECT ass_id,year_id FROM assessments ORDER BY year_id DESC") or  die("SQL Error==>".mysqli_error($con));
						while(list($ass_id,$tor_year) = mysqli_fetch_row($asm)){

					echo "<tr>";
					echo " <td> $ass_id </td>";

							$year = substr($tor_year,0,4);
							$rond = substr($tor_year,4,4);
			    echo "<td> $year</td>";
			    echo "<td> $rond</td>";


					$evd= mysqli_query($con,"SELECT evd_id,evd_status FROM evidence");
					list($evd_id,$evd_status) = mysqli_fetch_row($evd);
					

					if(empty($evd_status)){
							echo "<td><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i> ยังไม่ได้อัปโหลดหลักฐาน</b></td>";
							echo "  <td class='text-center'> <b class='btn text-primary addevd' data-torid='$ass_id' ><i class='far fa-plus-square fa-2x'></i> </b></td>";
					}else if($evd_status == 1){
						echo "<td><b class='text-danger'><i class='far fa-clock fa-2x'></i> รอยืนยันอีกครั้ง </b></td>"; 
							echo "  <td class='text-center'> <b class='btn text-primary editevd' data-torid='$ass_id' data-evdid='$evd_id'><i class='fas fa-check fa-2x'></i>ตรวจสอบหลักอีกครั้ง </b></i></td>";
					}else if($evd_status == 2){
						echo "<td><b class='text-danger'><i class='far fa-clock fa-2x'></i> รอผู้บังคับบัญชาได้พิจารณา </b></td>"; 
							echo "  <td class='text-center'> <i class='fas fa-clock fa-2x'></i></i></td>";
					}				   
			    echo " </tr>";

	 } // END WHILE

	 mysqli_free_result($evd);
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
</script>
