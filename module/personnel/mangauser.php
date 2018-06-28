<?php
	session_start();
	include("../../function/db_function.php");
	$con=connect_db();
?>
<div class="row  p-2 headtitle">
	<div class="col-md-2" style="display: block;"><a href=# class="managaedituser" data-modules='personnel' data-action='menumanage'><button type="button" class="btn btn-block"><i class="fas fa-chevron-left"></i> ย้อนกลับ</button></a>
	
</div>
<div class="col-md-2" style="display: block;"><a href=# class="managaedituser" data-modules='personnel' data-action='formuser'><button type="button" class="btn btn-block">เพิ่มบุคลากร</button></a>
	
</div>
<div class="col-md text-center">
	<h2> จัดการบุคลากร </h2>
</div>
<div class="col-md-4">
	<form class="form-inline my-lg-1 row">
		<input class="form-control mr-md-1 col" type="search" placeholder="Search" aria-label="Search">
		<button class="btn bg-light my-2 my-md-0 col" type="submit"><i class="fas fa-search fa-sm"></i> Search</button>
	</form>
</div>
</div>
<div class="row">
<div class="col-md-12 mt-2">
	<table class="table">
		<thead class="thead-light">
			<tr>
				<th scope="col">ลำดับ</th>
				<th scope="col">รหัส</th>
				<th scope="col">ชื่อ </th>
				<th scope="col">นามสกุล</th>
				<th scope="col">สาขา</th>
				<th scope="col">หลักสูตร</th>
				<th scope="col">แก้ไข</th>
				<th scope="col">ลบ</th>
			</tr>
		</thead>
		<tbody>
			<?php
					$show= mysqli_query($con,"SELECT gen_id,gen_fname,gen_lname,branch_id,subject_id FROM general");
					$i=1;
					while(list($gen_id,$gen_fname,$genlname,$branch_id,$subject_id)=mysqli_fetch_row($show)){
							$Sbrach=mysqli_query($con,"SELECT branch_id,branch_name FROM branch WHERE branch_id='$branch_id'") or die ("mysql error=>>".mysql_error($con));
								list($Sbranch_id,$branch_name)=mysqli_fetch_row($Sbrach);
							$subjects=mysqli_query($con,"SELECT subject_id,subject_name,branch_id FROM subjects WHERE subject_id='$subject_id'") or die ("mysql error=>>".mysql_error($con));
							list($Ssubject_id,$subject_name,$branch_id)=mysqli_fetch_row($subjects);
						echo"
							<tr>
										<td>$i</td>
										<td>$gen_id</td>
										<td>$gen_fname</td>
										<td>$genlname</td>
										<td>$branch_name</td>
										<td>$subject_name</td>
										<td><a href='#' class='managaedituser' data-modules='personnel' data-action='edituser' data-iduser='$gen_id'><i class='fas fa-edit fa-2x '></i></a></td>
										<td><a href=#  onclick='return confirm(\"ยืนยันการลบ\")'><i class='fa fa-trash fa-2x'</i></a></td>
									";
							$i++;
							}
				?>
				
			</tbody>
		</table>
	</div>
</div>

<!-- <a href="#" class="mangadeluser" data-modules="personnel" data-action="edituser">cdhw-</a> LINK TO EDIT -->
<script type="text/javascript">
		$(document).ready(function() {
			$("a.managaedituser").click(function(){

				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				loadmain(module1,action);
			});
		});
</script>
<!-- aleat-->
