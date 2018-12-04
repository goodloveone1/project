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



<div class="row">
	<div class="col-md">
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
<div class="row">
	<div class="col-md">
		<b><u>ส่วนที่ ๓ สรุปการประเมินผลการปฏิบัติราชการ </u></b>
	</div>
</div>

<div class="row">
	<div class="col-md">
		<table class="table table-bordered text-center">
			<tr >
				<th>องค์ประกอบการประเมิน</th>
				<th>คะแนน (ก)</th>
				<th>น้ำหนัก (ข)</th>
				<th>รวมคะแนน (ก)X(ข)</th>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบที่  ๑ : ผลสัมฤทธิ์ของงาน</td>
				<td></td>
				<td>๗๐</td>
				<td></td>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบที่  ๒ : พฤติกรรมการปฏิบัติราชการ (สมรรถนะ)</td>
				<td></td>
				<td>๓๐</td>
				<td></td>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบอื่น (ถ้ามี)</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right">รวม</td>
				<td>๑๐๐</td>
				<td></td>
			</tr>	
		</table>
	</div>
</div>			

<div class="row">
	<div class="col-md">
		<b><u>ระดับผลการประเมิน</u></b>
		<div style="padding-left: 100px ">	
			<div class="form-check">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck1" name="score">
			  <label class="form-check-label" for="defaultCheck1">
			    ดีเด่น  (๙๐-๑๐๐)
			  </label>
			</div>
			<div class="form-check ">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck1" name="score">
			  <label class="form-check-label" for="defaultCheck1">
			    ดีมาก (๘๐-๘๙)
			  </label>
			</div>
			<div class="form-check ">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck1" name="score">
			  <label class="form-check-label" for="defaultCheck1">
			    ดี (๗๐-๗๙)
			  </label>
			</div>
			<div class="form-check ">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck1" name="score">
			  <label class="form-check-label" for="defaultCheck1">
			    พอใช้(๖๐-๖๙)
			  </label>
			</div>
			<div class="form-check ">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck1" name="score">
			  <label class="form-check-label" for="defaultCheck1">
			    ต้องปรับปรุง (ต่ำกว่า ๖๐)
			  </label>
			</div>
		</div>	
	</div>
</div>
<br>
<div class="row">
	<div class="col-md">
		<b><u>ส่วนที่ ๔  :  แผนพัฒนาการปฏิบัติราชการรายบุคคล</u></b>
	</div>
</div>

<div class="row">
	<div class="col-md">
		<table class="table table-bordered">
			<tr>
				<th>ความรู้/ทักษะ/สมรรถนะ ที่ต้องได้รับการพัฒนา </th>
				<th>วิธีการพัฒนา</th>
				<th>ช่วงเวลาที่ต้องการพัฒนา</th>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md">
		<b><u>ส่วนที่ ๕  การรับทราบผลการประเมิน</u></b>
	</div>
</div>

<div class="row">
	<div class="col-md-6 border border-dark p-3">
		<p>ผู้รับการประเมิน :</p>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			    ได้รับทราบผลการประเมินและแผนพัฒนา การปฏิบัติราชการรายบุคคลแล้ว

			  </label>
		</div>

	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ลงชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
	</div>
	<!-- ผู้ประเมิน : -->
	<div class="col-md-6 border border-dark p-3">
		<p>ผู้ประเมิน : :</p>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			   ได้แจ้งผลการประเมินและผู้รับการประเมินได้ลงนามรับทราบ
			  </label>
		</div>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			   ได้แจ้งผลการประเมินเมื่อวันที่.............................................
      			แต่ผู้รับการประเมินไม่ลงนามรับทราบผลการ
     			ประเมินโดยมี………………..........เป็นพยาน


			  </label>
		</div>

	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ลงชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
	</div>

</div>	
<br>
<br>
<div class="row">
	<div class="col-md">
		<b><u>ส่วนที่ ๖  ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป</u></b>
	</div>
</div>

<div class="row">
	<div class="col-md-6 border border-dark p-3">
		<p>ผู้บังคับบัญชาเหนือขึ้นไป</p>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			    เห็นด้วยผลการประเมิน

			  </label>
		</div>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			    มีความเห็นแตกต่าง  ดังนี้

			  </label>
		</div>
		<div class="form-group">
		    <textarea class="form-control" id="" rows="3" disabled="disabled"></textarea>
		 </div>

	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ลงชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
	</div>
	<!-- ผู้ประเมิน : -->
	<div class="col-md-6 border border-dark p-3">
		<p>ผู้บังคับบัญชาเหนือขึ้นไปอีกชั้นหนึ่ง  (ถ้ามี)</p>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			    เห็นด้วยผลการประเมิน

			  </label>
		</div>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			    มีความเห็นแตกต่าง  ดังนี้

			  </label>
		</div>
		<div class="form-group">
		    <textarea class="form-control" id="" rows="3" disabled="disabled"></textarea>
		 </div>

	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ลงชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
	</div>

</div>				

<script type="text/javascript">
<?php
	foreach ($titcheck as $tit) {
?>
$('#<?php echo $tit; ?>').on('click', 'input[name="<?php echo $tit; ?>"]:checked', function(event) {
var sco = $(this).val();
var wei = $("#wei<?php echo $tit; ?>").data('wei');
$("#sco<?php echo $tit; ?>").html(sco);
	if(wei==0){
		var total = (sco/100);
	}
	else{
		var total = (sco*wei/100);
	}
	
$("#total<?php echo $tit; ?>").html(total);
	var tot = total;
	$("#tot").html(total);
})

	<?php } ?>

</script>