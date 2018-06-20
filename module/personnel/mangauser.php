<?php
	session_start();
	include("../../function/db_function.php");
	$con=connect_db();
?>

<div class="row  p-2 headtitle">
	<div class="col-md text-center">
	
		<h2> จัดการบุคลากร </h2>
	</div>
	<div class="col-md-4">
		<form class="form-inline my-lg-1 row"> 
			<input class="form-control mr-md-2 col-md" type="search" placeholder="Search" aria-label="Search">
			<button class="btn bg-light my-2 my-md-0 col-md" type="submit"><i class="fas fa-search fa-sm"></i> Search</button>
		</form>
	</div>
</div>
<div class="row">
<div class="col-md-12 mt-2"><a href=#>เพิ่มบุคลากร</a></div>
	<div class="col-md-12 mt-2">
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th scope="col">ลำดับ</th>
					<th scope="col">รหัส</th>
					<th scope="col">ชื่อ </th>
					<th scope="col">นามสกุล</th>
					<th scope="col">แก้ไข</th>
					<th scope="col">ลบ</th>
				</tr>
			</thead>
			<tbody>
			<?php
					$show= mysqli_query($con,"SELECT gen_id,gen_fname,gen_lname FROM general");
					$i=1;
					while(list($gen_id,$gen_fname,$genlname)=mysqli_fetch_row($show)){
						echo"
							<tr>
								<td>$i</td>
								<td>$gen_id</td>
								<td>$gen_fname</td>
								<td>$genlname</td>
								<td><a href='#' class='managaedituser' data-modules='personnel' data-action='edituser'>แก้ไข</a></td>
								<td><a href=#>ลบ</a></td>
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
				loadmain(module1,action)
			});
		});
</script>