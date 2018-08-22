<?php
include("../../function/db_function.php");
	$con=connect_db();
?>
<div class=" headtitle text-center p-2 row mb-2 row">
    <div class="col-md-2">
     
    </div>
    <div class="col-md">
        <h2>จัดการข้อมูลประชาสัมพันธ์</h2>
    </div>
    <div class="col-md-2">
        <a href='javascript:void(0)'><button type="button" class="btn btn-block" id="addrela" data-toggle='modal'><i class="fas fa-plus"></i>&nbsp;เพื่มประชาสัมพันธ์</button></a>
    </div>
</div>

<div class="row">
	<div class="col-md-12 mt-2">
		<table class="table" id='relation'>
			<thead class="thead-light">
				<tr>
					<th scope="col">รหัส</th>
					<th scope="col">ชื่เรื่อง</th>
					<th scope="col">รายละเอียด</th>
					<th scope="col">วันที่อัปโหลด</th>
					<th scope="col">แก้ไข</th>
					<th scope="col">ลบ</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$re = mysqli_query($con,"SELECT * FROM relations ORDER BY re_date DESC") or die("SQL >>".mysqli_error($con));

					while (list($re_id,$re_title,$re_detail,$re_date)=mysqli_fetch_row($re)) {
						echo "<tr>";
						echo "<td>$re_id<td>";
						echo "<td>$re_title<td>";
						echo "<td>$re_detail<td>";
						echo "<td>$re_date<td>";
						echo "<td><td>";
						echo "<td><td>";
						echo "</tr>";
					}
					mysqli_free_result($re);
					mysqli_close($con);
				?>
			</tbody>
		</table>
	</div>
</div>

<div id="loadmodeladd"> </div>

<script type="text/javascript">
	$( document ).ready(function(){

		$("#relation").DataTable();


		$("#addrela").click(function(event) {


			 $('#loadmodeladd').load("module/public_relations/modeladdre.php",function(){
            $('#addre').modal('show');     
            });

		});
	})
</script>	