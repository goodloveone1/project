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


<form class="p-2" name="tort2"> 
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
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[0]['exp_score'])?"0":$set[0]['exp_score'] ?>" name="exp[]" readonly ></td>	
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[0]['tort2_subtit'] ?>" name="stit0">	
				<div class="form-group">
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" >
					</div>
				 </td>		
			</tr>
			<tr>
				<td>บริการที่ดี </td>
				<td> <input type='text' size='3' class="borderNon form-control" value="<?php echo empty($set[1]['exp_score'])?"0":$set[1]['exp_score'] ?>" placeholder="ข้อมูล" name="exp[]" readonly ></td>	
					<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();"> 
					<input type='hidden' size='3' class="borderNon form-control" value="<?php echo $set[1]['tort2_subtit'] ?>" placeholder="ข้อมูล" name="stit1" readonly >
				</td>		
			</tr>
			<tr>
				<td>การสั่งสมความเชี่ยวชาญในงานอาชีพ </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[2]['exp_score'])?"0":$set[2]['exp_score'] ?>" name="exp[]" readonly> </td>	
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[2]['tort2_subtit'] ?>" name="stit2" readonly>
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" >  
				</td>		
			</tr>
			<tr>
				<td>การยึดมั่นในความถูกต้องชอบธรรม  และจริยธรรม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[3]['exp_score'])?"0":$set[3]['exp_score'] ?>" name="exp[]" readonly> </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[3]['tort2_subtit'] ?>" name="stit3" readonly> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();"> 
				</td>		
			</tr>
			<tr>
				<td>การทำงานเป็นทีม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[4]['exp_score'])?"0":$set[4]['exp_score'] ?>" name="exp[]" readonly> </td>	
				<td> 
				     <input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[4]['tort2_subtit'] ?> " name="stit4" readonly> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();"> 
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
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[5]['exp_score'])?"0":$set[5]['exp_score'] ?>" name="exp[]" readonly> </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[5]['tort2_subtit'] ?> " name="stit5" readonly>
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();"> 
				</td>		
			</tr>
			<tr>
				<td>ทักษะด้านบริการวิชาการ การวิจัยและนวัตกรรม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[6]['exp_score'])?"0":$set[6]['exp_score'] ?>" name="exp[]" readonly > </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[6]['tort2_subtit'] ?> " name="stit6" readonly >
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" > 
				</td>		
			</tr>
			<tr>
				<td>ทักษะด้านบริการวิชาการ การวิจัยและนวัตกรรม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[7]['exp_score'])?"0":$set[7]['exp_score'] ?>" name="exp[]" readonly > </td>	
				<td> 
					<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value=" <?php echo $set[7]['tort2_subtit'] ?>" name="stit7" readonly >
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();"> 
				</td>		
			</tr>
			<tr>
				<td>ความกระตือรือร้นและการเป็นแบบอย่างที่ดี </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[8]['exp_score'])?"0":$set[8]['exp_score'] ?>" name="exp[]" readonly > </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[8]['tort2_subtit'] ?>" name="stit8" readonly >
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();"> 
				</td>		
			</tr>
			<tr>
				<td>ทำนุบำรุงศิลปวัฒนธรรม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[9]['exp_score'])?"0":$set[9]['exp_score'] ?>" name="exp[]" readonly>  </td>	
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[9]['tort2_subtit'] ?>" name="stit9" readonly> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" >  
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
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[10]['exp_score'])?"0":$set[10]['exp_score'] ?>" name="exp[]" readonly>  </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[10]['tort2_subtit'] ?>" name="stit10" readonly> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();"> 
				</td>		
			</tr>
			<tr>
				<td>วิสัยทัศน์ </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[11]['exp_score'])?"0":$set[11]['exp_score'] ?>" name="exp[]" readonly >  </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[11]['tort2_subtit'] ?>" name="stit11" readonly >
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();"> 
				</td>		
			</tr>
			<tr>
				<td>ศักยภาพเพื่อนำการปรับเปลี่ยน </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[12]['exp_score'])?"0":$set[12]['exp_score'] ?>" name="exp[]" readonly> </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[12]['tort2_subtit'] ?>" name="stit12" readonly>
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();"> 
				</td>		
			</tr>
			<tr>
				<td>การสอนงานและการมอบหมายงาน </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[13]['exp_score'])?"0":$set[13]['exp_score'] ?>" name="exp[]" readonly>   </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo$set[13]['tort2_subtit'] ?>" name="stit13" readonly> 
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();"> 
				</td>		
			</tr>
			<tr>
				<td>การควบคุมตนเอง </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[14]['exp_score'])?"0":$set[14]['exp_score'] ?>" name="exp[]" readonly>  </td>	
				<td> 
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[14]['tort2_subtit'] ?>" name="$stit14" readonly>
					<input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();"> 
				</td>		
			</tr>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-md">
		<table class="table table-bordered" id="table_score">
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
			<td><input type='text' size='2' class="borderNon form-control sumgo" placeholder="ข้อมูล" name="sumgo1"  data-sumgo="1" id="sumgo" > </td>
			<td> <input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="x1" value="3" data-x="1"  > </td>
			<td><input type='text' size='5' class="borderNon form-control score" placeholder="ข้อมูล" name="score[]" onkeyup="fncSum();" data-score='1' id="score" ></td>	
			<td><input type='text' size='5' class="borderNon form-control score" placeholder="ข้อมูล" name="score1"  data-score='1' ></td>	

		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๑  ระดับ    × ๒ คะแนน</td>
			<td><input type='text' size='2' class="borderNon form-control sumgo" placeholder="ข้อมูล" name="sumgo2" data-sumgo="2" id="sumgo" ></td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="x2" value="2" data-x="2" ></td>
			<td><input type='text' size='5' class="borderNon form-control score" placeholder="ข้อมูล" name="score[]" onkeyup="fncSum();" data-score='2' id="score" ></td>	
		</tr>	
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๒  ระดับ  ×  ๑  คะแนน  </td>
			<td><input type='text' size='2' class="borderNon form-control sumgo" placeholder="ข้อมูล" name="sumgo3" data-sumgo="3" id="sumgo"   ></td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="x3" value="1" data-x="3"  ></td>
			<td><input type='text' size='5' class="borderNon form-control score" placeholder="ข้อมูล" name="score[]" onkeyup="fncSum();" data-score='3' id="score"></td>	
		</tr>	
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๓  ระดับ   ×  ๐  คะแนน</td>
			<td><input type='text' size='2' class="borderNon form-control sumgo" placeholder="ข้อมูล" name="sumgo4" data-sumgo="4" id="sumgo" ></td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="x4" value="0"  data-x="4" ></td>
			<td><input type='text' size='5' class="borderNon form-control score" placeholder="ข้อมูล" name="score[]" onkeyup="fncSum();" data-score='4' id="score"></td>	
		</tr>	
		<tr>
			<td colspan="3" class="text-right">ผลรวมคะแนน</td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="sumscore" ></td>	
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
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="sumAllscore" ></td>	
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

function fncSum(){
	var num = '';     
	var sum = 0;
	for(var i=0;i<document.tort2['score[]'].length;i++){
	num = document.tort2['score[]'][i].value;
	if(num!=""){
		sum += parseFloat(num);
		}
	}
	document.tort2.sumscore.value = sum; 
	var sumall =sum/(15*3);

	document.tort2.sumAllscore.value = sumall; 
}
	function fncNum(){
		var data1 = '';
		var data2 ='';
		var sum = 0;
		var n =0;var g=0; var h=0;
		sumd1=0;
		
		for(var i=0;i<document.tort2['go[]'].length;i++){
			var data2 = document.tort2['go[]'][i].value;
			var data1 = document.tort2['exp[]'][i].value;
			if(data2!=""){
				if(data2>=data1){
				 sum++;
				document.tort2.sumgo1.value = sum; 
				}
				else{
					document.tort2.sumgo1.value = sum; 
				}
				if(data2<data1){
					t2=parseFloat(data2);
					t1=parseFloat(data1);
					sumd1 = t2-t1;
					if(sumd1==-1){
						n++;
						document.tort2.sumgo1.value = sum; 
						document.tort2.sumgo2.value = n;
						document.tort2.sumgo3.value =g; 
						document.tort2.sumgo4.value =h; 
					}else if(sumd1==-2){
						g++;
						document.tort2.sumgo1.value = sum; 
						document.tort2.sumgo2.value = n;
						document.tort2.sumgo3.value =g; 
						document.tort2.sumgo4.value =h; 
					}else if(sumd1==-3){
						h++;
						document.tort2.sumgo4.value =h; 
					}
					else{
						document.tort2.sumgo1.value = sum; 
						document.tort2.sumgo2.value = n;
						document.tort2.sumgo3.value =g; 
						document.tort2.sumgo4.value =h; 	
					}
				}else{
					document.tort2.sumgo2.value = n; 
					document.tort2.sumgo3.value =g; 
					document.tort2.sumgo1.value = sum; 
					document.tort2.sumgo4.value =h; 
				}
			}else{
				document.tort2.sumgo1.value = sum; 
				document.tort2.sumgo2.value = n;
				document.tort2.sumgo3.value =g; 
				document.tort2.sumgo4.value =h; 
		
			}
			
			
			
		}
		
	}
	

 	$(document).ready(function() {
			$("a.next").click(function(){
				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				loadmain(module1,action)
			});
		$("#table_score").on( "keyup", ".sumgo", function() {
	   //alert($(this).val())
	   //alert($(this).data("sumgo"))
	   var gl = $(this).data("sumgo")-1;
	   //alert(gl)
	  	var x="x"+$(this).data("sumgo")
		var score= document.tort2['score[]'][gl].value;
		//alert(score)
		
	var pscore = ($("input[name='"+x+"']").val() * $(this).val() )
	document.tort2['score[]'][gl].value=pscore;
		//alert(pscore)
		//("#"+score).val(pscore);
		fncSum();

	});
});

</script>