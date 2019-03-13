<?php
include("../../function/db_function.php");
$con=connect_db();
 $gen_id = $_POST['genid'];

 $degree = mysqli_query($con,"SELECT  ed_id,degree_id,ed_name,ed_loc FROM education WHERE staff_id='$gen_id'") or die ("error".mysqli_error($con));
						
?>

<div class="row " >
				<div class="col-md-12">
					<h4 class='h4'>วุฒิการศึกษา</h4>
				</div>	
				<div class="col-md">
				<div class="table-responsive">
					<table class="table col-md display setdt" id="Datatable">
					<thead>
					<tr>
							<th>วุฒิการศึกษา</th>
							<th>ชื่อวุฒิการศึกษา</th>
							<th>สถานที่จบการศึกษา</th>
							<th>แก้ไข</th>
							<th>ลบ</th>
					</tr>
					</thead>
					<tbody>
					<?php
						while(list($ed_id,$degree_id,$ed_name,$ed_loc)=mysqli_fetch_row($degree)){
							$deName = mysqli_query($con,"SELECT degree_name FROM degree WHERE degree_id='$degree_id'")or die("errorSQL".mysqli_error($con));
							list($degree_name)=mysqli_fetch_row($deName);

							echo "<tr>";
							echo "<td> $degree_name </td>";
							echo "<td> $ed_name </td>";
							echo "<td> $ed_loc </td>";
							echo "<td> <a href='javascript:void(0)'class='editbrn' data-iddegree='$ed_id' data-toggle='modal' ><i class='fas fa-edit fa-2x'></i></a> </td>";
							echo "<td> <a href='javascript:void(0)' class='delbrn' data-degreename='$degree_name' data-iddegree='$ed_id'><i class='fas fa-trash-alt fa-2x'></i></a> </td>";


							echo "</td>";
						}

					?>


					</tbody>
					</table>
					<button type='button' class='btn mx-auto bg-secondary text-white' id='adddegree' data-genid='<?php echo $gen_id;?>' >เพิ่มวุฒิการศึกษา</button>

				</div>
				</div>
			</div>
<script>
$(document).ready(function() {
$.getScript('js/mydatatable.js') // dataTable	

})
</script>			