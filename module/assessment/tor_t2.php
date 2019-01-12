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
		 <a href=#><span class="step step-normal">ส่วนที่ 4</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 5</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 6</span></a> &nbsp;
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
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[0]['exp_score'])?"-":$set[0]['exp_score'] ?>" name="exp0" readonly ></td>	
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[0]['tort2_subtit'] ?>" name="stit0">	
				<div class="form-group">
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go0" >
					</div>
				 </td>		
			</tr>
			<tr>
				<td>บริการที่ดี </td>
				<td> <input type='text' size='3' class="borderNon form-control" value="<?php echo empty($set[1]['exp_score'])?"-":$set[1]['exp_score'] ?>" placeholder="ข้อมูล" name="exp1" readonly ></td>	
					<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go1"> 
					<input type='hidden' size='3' class="borderNon form-control" value="<?php echo $set[1]['tort2_subtit'] ?>" placeholder="ข้อมูล" name="stit1" readonly >
				</td>		
			</tr>
			<tr>
				<td>การสั่งสมความเชี่ยวชาญในงานอาชีพ </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[2]['exp_score'])?"-":$set[2]['exp_score'] ?>" name="exp2" readonly> </td>	
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[2]['tort2_subtit'] ?>" name="stit2" readonly>
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go2" >  
				</td>		
			</tr>
			<tr>
				<td>การยึดมั่นในความถูกต้องชอบธรรม  และจริยธรรม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[3]['exp_score'])?"-":$set[3]['exp_score'] ?>" name="exp3" readonly> </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[3]['tort2_subtit'] ?>" name="stit3" readonly> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go3" > 
				</td>		
			</tr>
			<tr>
				<td>การทำงานเป็นทีม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[4]['exp_score'])?"-":$set[4]['exp_score'] ?> " name="exp4" readonly> </td>	
				<td> 
				     <input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[4]['tort2_subtit'] ?> " name="stit4" readonly> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go4" > 
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
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[5]['exp_score'])?"-":$set[5]['exp_score'] ?> " name="exp5" readonly> </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[5]['tort2_subtit'] ?> " name="stit5" readonly>
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go5" > 
				</td>		
			</tr>
			<tr>
				<td>ทักษะด้านบริการวิชาการ การวิจัยและนวัตกรรม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[6]['exp_score'])?"-":$set[6]['exp_score'] ?> " name="exp6" readonly > </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[6]['tort2_subtit'] ?> " name="stit6" readonly >
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go6" > 
				</td>		
			</tr>
			<tr>
				<td>ทักษะด้านบริการวิชาการ การวิจัยและนวัตกรรม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value=" <?php echo empty($set[7]['exp_score'])?"-":$set[7]['exp_score'] ?>" name="exp7" readonly > </td>	
				<td> 
					<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value=" <?php echo $set[7]['tort2_subtit'] ?>" name="stit7" readonly >
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" nsme="go7"> 
				</td>		
			</tr>
			<tr>
				<td>ความกระตือรือร้นและการเป็นแบบอย่างที่ดี </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value=" <?php echo empty($set[8]['exp_score'])?"-":$set[8]['exp_score'] ?>" name="exp8" readonly > </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value=" <?php echo $set[8]['tort2_subtit'] ?>" name="stit8" readonly >
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go8"> 
				</td>		
			</tr>
			<tr>
				<td>ทำนุบำรุงศิลปวัฒนธรรม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[9]['exp_score'])?"-":$set[9]['exp_score'] ?>" name="exp9" readonly>  </td>	
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[9]['tort2_subtit'] ?>" name="stit9" readonly> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go9" >  
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
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[10]['exp_score'])?"-":$set[10]['exp_score'] ?>" name="exp10" readonly>  </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[10]['tort2_subtit'] ?>" name="stit10" readonly> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go10" > 
				</td>		
			</tr>
			<tr>
				<td>วิสัยทัศน์ </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[11]['exp_score'])?"-":$set[11]['exp_score'] ?>" name="exp11" readonly >  </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[11]['tort2_subtit'] ?>" name="stit11" readonly >
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go11" > 
				</td>		
			</tr>
			<tr>
				<td>ศักยภาพเพื่อนำการปรับเปลี่ยน </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[12]['exp_score'])?"-":$set[12]['exp_score'] ?>" name="exp12" readonly> </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[12]['tort2_subtit'] ?>" name="stit12" readonly>
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go12" > 
				</td>		
			</tr>
			<tr>
				<td>การสอนงานและการมอบหมายงาน </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[13]['exp_score'])?"-":$set[13]['exp_score'] ?>" name="exp13" readonly>   </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo$set[13]['tort2_subtit'] ?>" name="stit13" readonly> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go13" > 
				</td>		
			</tr>
			<tr>
				<td>การควบคุมตนเอง </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[14]['exp_score'])?"-":$set[14]['exp_score'] ?>" name="exp14" readonly>  </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[14]['tort2_subtit'] ?>" name="$stit14" readonly>
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go14" > 
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
			<td><input type='text' size='2' class="borderNon form-control" placeholder="ข้อมูล" name="sumgo1" > </td>
			<td> <input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="x1" value="3" readonly> </td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="score[]" ></td>	
		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๑  ระดับ    × ๒ คะแนน</td>
			<td><input type='text' size='2' class="borderNon form-control" placeholder="ข้อมูล" name="sumgo2" ></td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="x2" value="2" readonly></td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="score[]" ></td>	
		</tr>	
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๒  ระดับ  ×  ๑  คะแนน  </td>
			<td><input type='text' size='2' class="borderNon form-control" placeholder="ข้อมูล" name="sumgo3" ></td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="x3" value="1" readonly ></td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="score[]" ></td>	
		</tr>	
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๓  ระดับ   ×  ๐  คะแนน</td>
			<td><input type='text' size='2' class="borderNon form-control" placeholder="ข้อมูล" name="sumgo4" ></td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="x3" value="0" readonly ></td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="score[]" ></td>	
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