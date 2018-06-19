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
					$no=1;
					while(list($gen_id,$gen_fname,$genlname)=mysqli_fetch_row($show)){
						echo"
							<tr>
								<td>$no</td>
								<td>$gen_id</td>
								<td><a href=#>$gen_fname &nbsp;&nbsp;$genlname</a></td>
								<td><a href=#>แก้ไข</a></td>
								<td><a href=#>ลบ</a></td>
							";
						$no++;
					}

			?>
				
			</tbody>
		</table>
	</div>
</div>	

<script type="text/javascript">
		$(document).ready(function() {

			$("a.mangadeluser").click(loadmain);
		});
</script>