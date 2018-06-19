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
	<div class="col-md-12 mt-2">
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th scope="col">ลำดับ</th>
					<th scope="col">รหัส</th>
					<th scope="col">ชื่อ – นามสกุล</th>
					<th scope="col">แก้ไข</th>
					<th scope="col">ลบ</th>
				</tr>
			</thead>
			<tbody>
			<?php
					$show= mysqli_query($con,"SELECT gen_id,gen_fname,gen_lname FROM general");
					while(list($gen_id,$gen_fname,$genlname)=mysqli_fetch_row($show)){
						echo"
							<tr>
								<td></td>
								<td>$gen_id</td>
								<td>$gen_fname</td>
								<td>$genlname</td>
								<td><a href=#>แก้ไข</a></td>
								<td><a href=#>ลบ</a></td>
							";
						
					}

			?>
				<tr>
					<th scope="row">1</th>
					<td>Mark</td>
					<td>Otto</td>
					<td><a href="#" class="mangadeluser" data-modules="personnel" data-action="edituser">cdhw-</a></td>
					<td>@mdo</td>
					
				</tr>
				<tr>
					<th scope="row">2</th>
					<td>Jacob</td>
					<td>Thornton</td>
					<td>@fat</td>
					<td>@mdo</td>
				</tr>
				<tr>
					<th scope="row">3</th>
					<td>Larry</td>
					<td>the Bird</td>
					<td>@twitter</td>
					<td>@mdo</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>	

<script type="text/javascript">
		$(document).ready(function() {

			$("a.mangadeluser").click(loadmain);
		});
</script>