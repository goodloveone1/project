<?php
	session_start();
	include("../../function/db_function.php");
	$con=connect_db();
?>
<div class="row  p-2 headtitle">
	<div class="col-md-2" style="display: block;"><a href=# class="managaedituser" data-modules='personnel' data-action='menumanage'><button type="button" class="btn btn-block"><i class="fas fa-chevron-left"></i> ย้อนกลับ</button></a>
	
</div>
<div class="col-md-2" style="display: block;"><a href=# class="managaedituser" data-modules='personnel' data-action='menumanage'><button type="button" class="btn btn-block">เพิ่มบุคลากร</button></a>
	
</div>
<div class="col-md text-center">
	<h2> จัดการบุคลากร </h2>
</div>
<div class="col-md-4">
	<form class="form-inline my-lg-1 row" method="post">
		<input class="form-control mr-md-1 col" type="search" placeholder="Search" aria-label="Search" name="keyword">
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
					if(empty($_POST['keyword'])){//ถ้าไม่มีการส่งค่าค้นหามาจากไฟล์
						$keyword="";//กำหนดให้ตัวแปร $keyword ว่าง
						}
					else{
						$keyword = $_POST['keyword'];//รับคำค้นหามาจากฟอร์ม
						}
					$show1= mysqli_query($con,"SELECT gen_id,gen_fname,gen_lname,branch_id,subject_id FROM general WHERE gen_fname LIKE'%$keyword%'or gen_lname LIKE'%$keyword%' or branch_id 	
					=(SELECT branch_id FROM branch WHERE branch_name LIKE '%$keyword%' LIMIT 1) or subject_id 	
					=(SELECT subject_id FROM subjects WHERE subject_name LIKE '%$keyword%' LIMIT 1) ") or  die("SQL Error1==>1".mysql_error($con)); ;
					$i=1;

					$row = mysqli_num_rows($show1);//นับจำนวนแถว
					$rowpage=15;//กำหนดจำนวนแถวที่จะแสดงในแต่ละหน้า
					$page = ceil($row/$rowpage); //หน้า = ปัดเศษขึ้นcail (แถวทั้งหมด / จำนวนแถวแต่ละหน้า)
					//ตรวจสอบตัววแปร $_GET['page_id'] ว่างหรือไม่
			if(empty($_POST['page_id'])){ 
				//ถ้าว่าง
				$page_id=1;//กำหนดให้แสดงหน้า 1
				}
			else{
				//ถ้าไม่ว่าง
				$page_id = $_POST['page_id'];//รับค่าหมายเลขหน้ามาจากลิ้งค์ ด้วย GET
				}
				$start_row = ($page_id*$rowpage)-$rowpage; //แถวแรกที่จะแสดงแจ่ละหน้า=(หมายเลขหน้า*จำนวนแถวใน 1 หน้า )-จำนวนแถวใน 1 หน้า
					
					$show2= mysqli_query($con,"SELECT gen_id,gen_fname,gen_lname,branch_id,subject_id FROM general WHERE gen_fname LIKE'%$keyword%'or gen_lname LIKE'%$keyword%' or branch_id 	
					=(SELECT branch_id FROM branch WHERE branch_name LIKE '%$keyword%' LIMIT 1) or subject_id 	
					=(SELECT subject_id FROM subjects WHERE subject_name LIKE '%$keyword%' LIMIT 1) ") or  die("SQL Error1==>1".mysql_error($con)); ;

					if($row==0){//ถ้า จน แถวที่คิวรี่ ออกมาได้เท่ากับ 0 แสดงว่าไม่มีข้อมูล
						echo "<p>ไม่พบข้อมูลการค้นหา<b>$keyword</b></p>";
					}
					else{

						while(list($gen_id,$gen_fname,$genlname,$branch_id,$subject_id)=mysqli_fetch_row($show2)){
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
										<td><a href='#' class='managaedituser' data-modules='personnel' data-action='edituser'><i class='fas fa-edit fa-2x '></i></a></td>
										<td><a href=#  onclick='return confirm(\"ยืนยันการลบ\")'><i class='fa fa-trash fa-2x'</i></a></td>
									";
							$i++;
							}
				
					
				?>
				
			</tbody>
		</table>
		
	</div>
	
</div>
<?php
		echo"<hr>";
				//วนลูปแสดงเลขหน้าตามจำนวนหน้า 
				echo "หน้า :";
				
				//เเสดงก่อนหน้า
				$nextpg=$page_id+1;
				$backpg=$page_id-1;
					if($page_id>1){
							echo"&nbsp;
						<a href='#?page_id=$backpg&keyword=$keyword '>ก่อนหน้า </a>&nbsp;";	
						}
						
						
				for($id=1;$id<=$page;$id++)
				{
			
					if($id==$page_id){//ถ้าเป็นหน้าปัจจุบัน ให้แสดงตัวหนา สีแดงไม่มีลิ้งค์
						echo "<span style='font-weight:bold;color:red;border:solid 1px #444; background-color:#ccc;padding:5px'>$id</span>";
						}
					else{
						//ถ้าไม่ใช่หน้าปัจจุบันเเสดงปกติ
						echo"&nbsp;<span style='border:solid 1px #444; padding:5px '>
						<a href='list_student.php?page_id=$id&keyword=$keyword '>$id </a></span>&nbsp;";	
						}
					
				}
				
				//แสดงหน้าถัดไป
				if($page!=$page_id){
							echo"&nbsp;<a href='list_student.php?page_id=$nextpg&keyword=$keyword '>หน้าถัดไป </a>&nbsp;";	
											
					}
				
				echo"</center>";
					}
		?>
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
