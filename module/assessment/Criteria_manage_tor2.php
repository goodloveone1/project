<?php
	include("../../function/db_function.php");
	$con=connect_db();

	$re = $con->query("SELECT * FROM tort2_title");

?>

<div class="row p-2 headtitle">
	 <div class="col-md-2" >
       <a href='javascript:void(0)'> <button type="button" class="btn re btn-block menuuser"  data-modules="assessment" data-action="main_assess"><i class="fas fa-chevron-left"></i>&nbsp;ย้อนกลับ</button></a>
    </div>
	<div class="col-md text-center">
		<h3> จัดการเกณฑ์การประเมิน ส่วนที่ 2 พฤติกรรมการปฏิบัติงาน  </h3>
	</div>
	 <div class="col-md-2" >
       <a href='javascript:void(0)'> <button type="button" class="btn re btn-block" ><i class="fas fa-plus"></i>&nbsp;เพื่มหัวข้อ</button></a>
    </div>
</div>
<div class="row p-2">
	<div class="col-md-12 mt-2">
		<table class="table table-bordered datatables">
			<thead class="thead-light">
				<tr>
					<th scope="col">รหัส</th>
					<th scope="col">เกณฑ์การประเมิน</th>
					<th scope="col" class="text-center">เพิ่มหัวข้อย่อย</th>
					<th scope="col" class="text-center">แก้ไข</th>
					<th scope="col" class="text-center">ลบ</th>

				</tr>
			</thead>
			<tbody>
				<?php 
						while(list($id,$name) = $re->fetch_row()){

				?>
				<tr>
					<th scope="row"><?php echo $id ?></th>
					<td><?php echo $name ?></td>
					<td class="text-center"><a href='javascript:void(0)' class='addtor2tit'  data-tor2id='<?php echo $id ?>'><i class='fas fa-plus fa-2x '></i></a></td>
					<td class="text-center"><a href='javascript:void(0)' class='editwid' data-modules='assessment' data-action='weight'><i class='fas fa-edit fa-2x '></i></a></td>
					<td class="text-center"><a href='javascript:void(0)' class='editwid' data-modules='assessment' data-action='weight'><i class='fas fa-trash fa-2x '></i></a></td>
					
				</tr>
				<?php
					} // END WHILE

					$re->free_result();
					$con->close();

				?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(".datatables").DataTable();

	$('.addtor2tit').click(function(event) {
		/* Act on the event */

		var id = $(this).data('tor2id');
		loadingpagepost("assessment","Criteria_manage_tor2sub",id);
	});
</script>

