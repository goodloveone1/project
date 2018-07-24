<div class="row p-2 headtitle">
	<div class="col-md text-center">
		<h2> จัดการเกณฑ์การประเมิน </h2>
	</div>
</div>
<div class="row p-2">
	<div class="col-md-12 mt-2">
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th scope="col">ลำดับ</th>
					<th scope="col">เกณฑ์การประเมิน</th>
					<th scope="col">แก้ไข</th>

				</tr>
			</thead>
			<tbody>
				<tr>
					<th scope="row">1</th>
					<td>น้ำหนักความสำคัญของงาน</td>
					<td><a href='javascript:void(0)' class='editwid' data-modules='assessment' data-action='weight'><i class='fas fa-edit fa-2x '></i></a></td>
					
				</tr>
				<tr>
					<th scope="row">2</th>
					<td>ตัวชีวัดเกณฑ์การประเมิน</td>
					<td>แก้ไข</td>
					
				</tr>
				<tr>
					<th scope="row">3</th>
					<td>จัดการเกณฑ์ภาระงาน/กิจกรรม</td>
					<td>แก้ไข</td>
					
				</tr>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		
		$(".editwid").click(function(){ 

			var module1 = $(this).data('modules');
			var action = $(this).data('action');
			$.post('module/assessment/'+action+'.php',function(){
			}).done(function(data){
		 		$("#detail").html(data);
			})
		});
	});
</script>