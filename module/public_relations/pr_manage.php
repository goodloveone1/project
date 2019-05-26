<?php
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();
?>
<div class=" headtitle text-center p-2 row mb-2 row">
    <div class="col-md-3">

    </div>
    <div class="col-md">
        <h2>จัดการข้อมูลประชาสัมพันธ์</h2>
    </div>
    <div class="col-md-3">
       <button type="button" class="btn btn-block btn-light" id="addrela" data-action='modeladdre.php'><i class="fas fa-plus"></i>&nbsp;เพื่มประชาสัมพันธ์</button>
    </div>
</div>

<div class="row">
	<div class="col-md-12 mt-2">
		<table class="table" id='Datatable'>
			<thead class="thead-light">
				<tr>
					<th scope="col">รหัส</th>
					<th scope="col">ชื่อเรื่อง</th>

					<th scope="col">วันที่อัปโหลด</th>
					<th scope="col">ผู้อัปโหลด</th>
					<th scope="col">แก้ไข</th>
					<th scope="col">ลบ</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$re = mysqli_query($con,"SELECT * FROM relations ORDER BY re_date DESC") or die("SQL >>".mysqli_error($con));

					while (list($re_id,$re_title,$re_detail,$re_date,$gen_id)=mysqli_fetch_row($re)) {

						$gen = mysqli_query($con,"SELECT fname,lname FROM staffs WHERE st_id = '$gen_id'") or die($con->error);
						list($name,$lname) = mysqli_fetch_row($gen);
						mysqli_free_result($gen);
						echo "<tr>";
						echo "<td>$re_id</td>";
						echo "<td><a href='javascript:void(0)' data-reid='$re_id' data-action='modelshowre.php' class='showdetail'> $re_title </a></td>";

						echo "<td>".DateThai($re_date)."</td>";
						echo "<td>$name $lname</td>";
						echo "<td><a href='javascript:void(0)' class='showre' data-reid='$re_id' data-action='editpr.php'><i class='fas fa-edit fa-2x '></i></a></td>";
						echo "<td><a href='javascript:void(0)'  class='delre' data-reid='$re_id' data-retit='$re_title' ><i class='fa fa-trash fa-2x'</i></a></td>";
						echo "</tr>";
					}
					mysqli_free_result($re);
					mysqli_close($con);
				?>
			</tbody>
		</table>
	</div>
</div>

<div id="loadmodel"> </div>

<script type="text/javascript">
	$( document ).ready(function(){


 $.getScript('js/mydatatable.js') // dataTable



		$("#addrela").click(function(event) {
			event.preventDefault()
			  $('#detail').load("module/public_relations/addpr.php");
		});

		$(".showre").click(function(event) {

			event.preventDefault()

			var re_id = $(this).data('reid')
			var action = $(this).data('action')
			$.post('module/public_relations/'+action, {reid: re_id}).done(function(data,txtstuta){

				
				$('#detail').html(data);
			
			});

		});

		$(".showdetail").click(function(event) {

		event.preventDefault()

		var re_id = $(this).data('reid')
		var action = $(this).data('action')
		$.post('module/public_relations/'+action, {reid: re_id}).done(function(data,txtstuta){

			$('#loadmodel').html(data);
			$('#modelre').modal('show');

		});

		});

		$(".delre").click(function(event) {
			event.preventDefault()
			var re_tit = $(this).data('retit')
			//var r = confirm("ต้องการลบข่าวประชาสัมพันธ์ "+re_tit+" ใช่หรือไม่?");
            swal({
				title: "ต้องการลบข่าวประชาสัมพันธ์ "+re_tit+" ใช่หรือไม่?",
				text: "หากลบไปแล้วจะไม่สามารถกู้คืนข้อมูลได้!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
				buttons:["ยกเลิก","ตกลง"],
				})
				.then((willDelete) => {
					if (willDelete) {
						var re_id = $(this).data('reid')
						$.post('module/public_relations/delre.php', {reid: re_id}).done(function(data,txtstuta){

							loadingpage("public_relations","pr_manage");
						});
						swal("บันทึกสำเร็จแล้ว!", {
						icon: "success",
						});
					} else {
						// swal("Your imaginary file is safe!");
					}
				});
			
			
		});

	})
</script>
