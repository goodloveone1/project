<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();
	

	$seaca=mysqli_query($con,"SELECT gen_acadeic,gen_prefix,gen_fname,gen_lname,gen_pos,branch_id,gen_salary,gen_startdate FROM general WHERE gen_id='$_SESSION[user_id]'")or die("SQL_ERROR".mysqli_error($con));
	list($gen_acadeic,$gen_prefix,$gen_fname,$gen_lname,$gen_pos,$branch_id,$gen_salary,$gen_startdate)=mysqli_fetch_row($seaca);
	$seacaName=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$gen_acadeic'")or die("SQL_ERROR".mysqli_error($con));
	list($acaName)=mysqli_fetch_row($seacaName);
	
	$seBrench=mysqli_query($con,"SELECT branch_name FROM branch WHERE branch_id='$branch_id'")or die("SQL_ERROR".mysqli_error($con));
	list($branchName)=mysqli_fetch_row($seBrench);

	$seexp=mysqli_query($con,"SELECT * FROM tort2_exp WHERE aca_id='$gen_acadeic'")or die(mysqli_error($con));
	for ($set = array (); $row = $seexp->fetch_assoc(); $set[] = $row);
	// print_r($set);
	mysqli_free_result($seaca);
	mysqli_free_result($seacaName);
	mysqli_free_result($seBrench);
	mysqli_free_result($seexp);
?>


<form class="p-2"> 
<div class="row">
	    <span class="step  step-normal ">ข้อตกลง</span> &nbsp;
         <a href="javascript:void(0)"><span class="step step-normal ">ส่วนที่ 1</span></a>&nbsp; 
		 <a href=#><span class="step step-color">ส่วนที่ 2</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 3</span></a> &nbsp; 
		 <span class="step step-normal">ส่วนที่ 4</span> &nbsp; 
		 <span class="step step-normal">ส่วนที่ 5</span> &nbsp; 
		 <span class="step step-normal">ส่วนที่ 6</span> &nbsp;
		 <br>
    </div>
<div class="row">
	<div class="col-md">
		<br>
		<b><u> ส่วนที่  ๒  องค์ประกอบที่ ๒ พฤติกรรมการปฏิบัติงาน (สมรรถนะ) </u></b>
	</div>
	
</div>

<div class="row">
	<div class="col-md">
	
		<table class="table table-bordered">
			<tr>
				<th>สมรรถนะหลัก (ที่สภามหาวิทยาลัยกำหนด) </th>
				<th>ระดับสมรรถนะ ที่คาดหวัง </th>
				<th>ระดับสมรรถนะ ที่แสดงออก </th>
			</tr>			
			<tr>
				<td> การมุ่งผลสัมฤทธิ์ </td>
				<td><?php echo empty($set[0]['exp_score'])?"-":$set[0]['exp_score'] ?></td>	
				
				<div class="form-group">
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="" >
					</div>
				 </td>		
			</tr>
			<tr>
				<td>บริการที่ดี </td>
				<td> <?php echo empty($set[1]['exp_score'])?"-":$set[1]['exp_score'] ?></td>	
					<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" > 
				</td>		
			</tr>
			<tr>
				<td>การสั่งสมความเชี่ยวชาญในงานอาชีพ </td>
				<td><?php echo empty($set[2]['exp_score'])?"-":$set[2]['exp_score'] ?> </td>	
				<td>
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" >  
				</td>		
			</tr>
			<tr>
				<td>การยึดมั่นในความถูกต้องชอบธรรม  และจริยธรรม </td>
				<td> <?php echo empty($set[3]['exp_score'])?"-":$set[3]['exp_score'] ?></td>	
				<td> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" > 
				</td>		
			</tr>
			<tr>
				<td>การทำงานเป็นทีม </td>
				<td><?php echo empty($set[4]['exp_score'])?"-":$set[4]['exp_score'] ?> </td>	
				<td> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" > 
				</td>		
			</tr>		
		</table>
	</div>
	<div class="col-md">
		<table class="table table-bordered">
			<tr>
				<th>สมรรถนะเฉพาะตามลักษณะงานที่ปฏิบัติ (ที่สภามหาวิทยาลัยกำหนด)  </th>
				<th>ระดับสมรรถนะ ที่คาดหวัง </th>
				<th>ระดับสมรรถนะ ที่แสดงออก </th>
			</tr>
			<tr>
				<td>ทักษะการสอนและการให้คำปรึกษาแก่นักศึกษา </td>
				<td><?php echo empty($set[5]['exp_score'])?"-":$set[5]['exp_score'] ?> </td>	
				<td> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" > 
				</td>		
			</tr>
			<tr>
				<td>ทักษะด้านบริการวิชาการ การวิจัยและนวัตกรรม </td>
				<td><?php echo empty($set[6]['exp_score'])?"-":$set[6]['exp_score'] ?> </td>	
				<td> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" > 
				</td>		
			</tr>
			<tr>
				<td>ทักษะด้านบริการวิชาการ การวิจัยและนวัตกรรม </td>
				<td><?php echo empty($set[7]['exp_score'])?"-":$set[7]['exp_score'] ?> </td>	
				<td> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" > 
				</td>		
			</tr>
			<tr>
				<td>ความกระตือรือร้นและการเป็นแบบอย่างที่ดี </td>
				<td> <?php echo empty($set[8]['exp_score'])?"-":$set[8]['exp_score'] ?></td>	
				<td> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" > 
				</td>		
			</tr>
			<tr>
				<td>ทำนุบำรุงศิลปวัฒนธรรม </td>
				<td> <?php echo empty($set[9]['exp_score'])?"-":$set[9]['exp_score'] ?></td>	
				<td>
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" >  
				</td>		
			</tr>	
		</table>
	</div>
	<div class="col-md">
		<table class="table table-bordered">

			<tr>
				<th>สมรรถนะทางการบริหาร (ที่สภามหาวิทยาลัยกำหนด) </th>
				<th>ระดับสมรรถนะ ที่คาดหวัง </th>
				<th>ระดับสมรรถนะ ที่แสดงออก </th>
			</tr>
			<tr>
				<td>สภาวะผู้นำ </td>
				<td><?php echo empty($set[10]['exp_score'])?"-":$set[10]['exp_score'] ?> </td>	
				<td> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" > 
				</td>		
			</tr>
			<tr>
				<td>วิสัยทัศน์ </td>
				<td><?php echo empty($set[11]['exp_score'])?"-":$set[11]['exp_score'] ?> </td>	
				<td> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" > 
				</td>		
			</tr>
			<tr>
				<td>ศักยภาพเพื่อนำการปรับเปลี่ยน </td>
				<td> <?php echo empty($set[12]['exp_score'])?"-":$set[12]['exp_score'] ?></td>	
				<td> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" > 
				</td>		
			</tr>
			<tr>
				<td>การสอนงานและการมอบหมายงาน </td>
				<td><?php echo empty($set[13]['exp_score'])?"-":$set[13]['exp_score'] ?> </td>	
				<td> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" > 
				</td>		
			</tr>
			<tr>
				<td>การควบคุมตนเอง </td>
				<td><?php echo empty($set[14]['exp_score'])?"-":$set[14]['exp_score'] ?> </td>	
				<td> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" > 
				</td>		
			</tr>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-md">
		<table class="table table-bordered">
		<tr class="text-justify text-center">
			<th rowspan="2" ><br> <h4>หลักเกณฑ์การประเมิน</h4></th>
			<th colspan="3">การประเมิน</th>		
		</tr>
		<tr class="text-justify text-center">
			<th>จำนวนสมรรถนะ</th>
			<th>คูณ (×)</th>
			<th>คะแนน</th>			
		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  สูงกว่าหรือเท่ากับ ระดับสมรรถนะที่คาดหวัง  ×  ๓ คะแนน</td>
			<td></td>
			<td></td>
			<td></td>	
		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๑  ระดับ    × ๒ คะแนน</td>
			<td></td>
			<td></td>
			<td></td>	
		</tr>	
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๒  ระดับ  ×  ๑  คะแนน  </td>
			<td></td>
			<td></td>
			<td></td>	
		</tr>	
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๓  ระดับ   ×  ๐  คะแนน</td>
			<td></td>
			<td></td>
			<td></td>	
		</tr>	
		<tr>
			<td colspan="3" class="text-right">ผลรวมคะแนน</td>
			<td></td>	
		</tr>	
		<tr>
			<td colspan="3">
				<div class="row">
					<div class="col text-right">
						<br>
						สรุปคะแนนส่วนพฤติกรรม (สมรรถนะ) =
					</div>
					<div class="col text-center">
						ผลรวมคะแนน <hr> จำนวนสมรรถนะที่ใช้ในการประเมิน × ๓
					</div>

				</div>	
			</td>
			<td></td>	
		</tr>
		<tr>
		
			<td colspan="4" class="text-right">
				<p class="text-center">ผู้ประเมินและผู้รับการประเมินได้ตกลงร่วมกันและเห็นพ้องกันแล้ว (ระบุข้อมูลใน (๑) (๒) (๓) และ (๕) ให้ครบ) จึงลงลายมือชื่อไว้เป็นหลักฐาน <br>(ลงนามเมื่อจัดทำข้อตกลง)</p>
				

				<div class="form-group row">
					<label  class="col-sm-2 col-form-label">ลายมือชื่อ</label>
						<div class="col-sm">
							<input type="email" class="form-control" id="inputEmail3" placeholder="">
						</div>
					<label  class="col-sm-2 col-form-label">(ผู้ประเมิน)</label>	
	
				</div>

				<div class="form-group row">
					<label  class="col-sm-2 col-form-label">วันที่</label>
						<div class="col-sm">
							<input type="email" class="form-control" id="inputEmail3" placeholder="">
						</div>
					<label  class="col-sm-1 col-form-label">เดือน</label>	
					<div class="col-sm">
							<input type="email" class="form-control" id="inputEmail3" placeholder="">
					</div>
					<label  class="col-sm-1 col-form-label">พ.ศ</label>	
					<div class="col-sm">
							<input type="email" class="form-control" id="inputEmail3" placeholder="">
					</div>
				</div>
				<div class="form-group row">
					<label  class="col-sm-2 col-form-label">ลายมือชื่อ</label>
						<div class="col-sm">
							<input type="email" class="form-control" id="inputEmail3" placeholder="">
						</div>
					<label  class="col-sm-2 col-form-label">(ผู้รับการประเมิน)</label>	
				</div>
					
			</td>
			
		</tr>			

		</table>		
	</div>
</div>
<br>
</form>
<div class="row">
	<div class="col-md-12 text-center mb-2" >
		<p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t3"><input type="submit" class="next" value="ต่อไป"></a> </p>
	</div>
</div>




<script type="text/javascript">
 	$(document).ready(function() {
			$("a.next").click(function(){
				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				loadmain(module1,action)
			});
	});

</script>