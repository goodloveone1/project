<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();

	$st_id = $_SESSION['user_id'];

	$sumas= mysqli_query($con,"SELECT st.prefix,st.fname,st.lname,pos.pos_name,dp.dept_name,br.br_name,st.picture,sumt3.sum_score,st.permiss_id,amt5.accept,amt5.inform,amt6.leader_comt,amt6.supervisor_comt,yr.y_year,yr.y_no,am.ass_id
	FROM assessments AS am  
	INNER JOIN sum_score_assessment_t3 AS sumt3 ON am.ass_id = sumt3.ass_id 
	INNER JOIN staffs AS st ON st.st_id = am.staff 
	INNER JOIN branchs AS br ON br.br_id = st.branch_id
	INNER JOIN departments AS dp ON dp.dept_id = br.dept_id
	INNER JOIN position AS pos ON pos.pos_id = st.position
	INNER JOIN asessment_t5 AS amt5 ON am.ass_id = amt5.ass_id
	INNER JOIN asessment_t6 AS amt6 ON am.ass_id = amt6.ass_id
	INNER JOIN years AS yr ON yr.y_id = am.year_id
	WHERE am.ass_id LIKE  'TOR%' AND am.staff ='$st_id'") or  die("SQL Error1==>1".mysqli_error($con));


?>
<div class="row  p-2 headtitle">
	<div class="col-md-2" style="display: block;">
		<!-- <button type="button" class="btn bg-white btn-block  menuuser"  data-modules="personnel" data-action="menumanage"><i class="fas fa-chevron-left"></i> ย้อนกลับ</button> -->
	</div>

<div class="col-md text-center">
	<h2> รายงานผลการปฏิบัติงาน (ตัวชี้วัด – เอกสารหมายเลข 2)  </h2>
</div>
<div class="col-md-2" style="display: block;"></div>
</div>
<div class="row">
<div class="col-md-12 mt-2">

<div class="table-responsive">
	<table class="table text-center" id="Datatable">
		<thead class="">
			<tr>
				<?php
				
				echo"
				<th scope='col'>รอบปี</th>
				<th scope='col'>คะแนนการประเมินผลการปฏิบัติราชการ </th>
				<th scope='col'>ระดับผลการประเมิน</th>
				<th scope='col'>พิมพ์</th>
				
				";

				?>
			</tr>
		</thead>
		<tbody>

			<?php
				while(list($prefix,$fname,$lname,$pos_name,$dept_name,$br_name,$picture,$sum_score,$permiss_id,$accept,$inform,$leader_comt,$supervisor_comt,$y_year,$y_no,$ass_id)=mysqli_fetch_row($sumas)){

					$text="";
					if($sum_score >= 90){
						$text = "ดีเด่น";
					}
					else if($sum_score >= 80){
						$text = "ดีมาก";
					}
					else if($sum_score >= 70){
						$text = "ดี";
					}
					else if($sum_score >= 60){
						$text = "พอใช้";
					}else{
						$text = "ต้องปรับปรุง ";
					}
				
					if($permiss_id==2){
						if($accept==1 && $inform==1 && $leader_comt!=0 && $supervisor_comt!=0){
				
							echo "
								<tr>
									<td>  $y_no/".($y_year+543)."</td>
									<td>  $sum_score </td>
									<td>  $text </td>
									<td>
									<form action='printsumAssPRE.php' method='POST'  target='blank'>
										<input type='hidden' name='assid' value='$ass_id'>
										<button class='btn btn-success' type='submit'><i class='fas fa-print'></i> พิมพ์ </button>
									</form>

									</td>
								</tr>
							";
				
						}
					}else if($permiss_id==3){
						if($accept==1 && $inform==1 && $leader_comt!=0){
				
							echo "
								<tr>
									<td>  $y_no/$y_year</td>
									<td>  $sum_score </td>
									<td>  $text </td>
									<td>  <form action='printsumAssPRE.php' method='POST'  target='blank'>
									<input type='hidden' name='assid' value='$ass_id'>
									<button class='btn btn-success' type='submit'><i class='fas fa-print'></i> พิมพ์ </button>
								</form> </td>
								</tr>
							";
				
						}
					}else if($permiss_id==4){
						if($accept==1 && $inform==1){
				
							echo "
								<tr>
									<td>  $y_no/$y_year</td>
									<td>  $sum_score </td>
									<td>  $text </td>
									<td>  <form action='printsumAssPRE.php' method='POST'  target='blank'>
									<input type='hidden' name='assid' value='$ass_id'>
									<button class='btn btn-success' type='submit'><i class='fas fa-print'></i> พิมพ์ </button>
								</form></td>
								</tr>
							";
				
						}
					}	
					
				}
				
					
				?>
			</tbody>
		</table>
	</div>
	
	</div>
</div>
<script type="text/javascript">
		$(document).ready(function() {

			$.getScript('js/mydatatable.js') // dataTable	

		});	
</script> 			

<!-- aleat-->
