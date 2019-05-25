<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();

	$st_id = $_SESSION['user_id'];

	$sumas= mysqli_query($con,"SELECT yr.y_year,yr.y_no,am.ass_id
	FROM assessments AS am  
	INNER JOIN years AS yr ON yr.y_id = am.year_id
	
	WHERE am.ass_id LIKE 'PRE%' AND am.staff ='$st_id'") or  die("SQL Error1==>1".mysqli_error($con));


?>
<div class="row  p-2 headtitle">
	<div class="col-md-2" style="display: block;">
		<!-- <button type="button" class="btn bg-white btn-block  menuuser"  data-modules="personnel" data-action="menumanage"><i class="fas fa-chevron-left"></i> ย้อนกลับ</button> -->
	</div>

<div class="col-md text-center">
	<h2> รายงานผลการปฏิบัติงาน (TOR – เอกสารหมายเลข 1)  </h2>
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
				<th scope='col'>พิมพ์</th>
				
				";

				?>
			</tr>
		</thead>
		<tbody>

			<?php
				while(list($y_year,$y_no,$ass_id)=mysqli_fetch_row($sumas)){

							echo "
								<tr>
									<td>  $y_no/".($y_year+543)."</td>
									<td>  <form action='printsumAssTOR.php' method='POST'  target='blank'>
									<input type='hidden' name='assid' value='$ass_id'>
									<button class='btn btn-success' type='submit'><i class='fas fa-print'></i> พิมพ์ </button>
								</form> </td>
								</tr>
							";
				
				
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
