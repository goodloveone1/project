<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();

	if(empty($_POST['genid']) && empty($_POST['year']) ){
		$yearIdpost=$_SESSION['yearIdpost'];
		//echo "tor_id = $yearIdpost";
	}else{
		$yearIdpost = $_POST['year'];
		//echo "tor_id = $yearIdpost";
	}

	$tor=mysqli_query($con,"SELECT *FROM assessments WHERE year_id='$yearIdpost'AND staff='$_SESSION[user_id]'")or die("SQL_ERROR".mysqli_error($con));
	list($tor_id,$staff_id,$year_id,$leader_id,$sumwork,$punishment)=mysqli_fetch_row($tor);
	


	$seaca=mysqli_query($con,"SELECT acadeic,fname,lname FROM staffs WHERE st_id='$_SESSION[user_id]'")or die("SQL_ERROR".mysqli_error($con));
	list($gen_acadeic,$fname,$lname)=mysqli_fetch_row($seaca); 

	mysqli_free_result($seaca);
	//echo $gen_acadeic,$fname,$lname;

	// $seaca=mysqli_query($con,"SELECT gen_acadeic,gen_prefix,gen_fname,gen_lname,gen_pos,branch_id,gen_salary,gen_startdate FROM general WHERE gen_id='$_SESSION[user_id]'")or die("SQL_ERROR".mysqli_error($con));
	// list($gen_acadeic,$gen_prefix,$gen_fname,$gen_lname,$gen_pos,$branch_id,$gen_salary,$gen_startdate)=mysqli_fetch_row($seaca);
	// $seacaName=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$gen_acadeic'")or die("SQL_ERROR".mysqli_error($con));
	// list($acaName)=mysqli_fetch_row($seacaName);

	// $seBrench=mysqli_query($con,"SELECT branch_name FROM branch WHERE branch_id='$branch_id'")or die("SQL_ERROR".mysqli_error($con));
	// list($branchName)=mysqli_fetch_row($seBrench);

	$seexp=mysqli_query($con,"SELECT * FROM aptitudes WHERE aca_id='$gen_acadeic'")or die(mysqli_error($con));
	for ($set = array (); $row = $seexp->fetch_assoc(); $set[] = $row);
	
	//print_r($set);
	// mysqli_free_result($seaca);
	// mysqli_free_result($seacaName);
	// mysqli_free_result($seBrench);
	mysqli_free_result($seexp);

	$yeartest=chk_idtest();
?>


<form  method="post" class="p-2" name="tort2" id="tort2">
<div class="row">
	    <span class="step  step-normal ">ข้อตกลง</span> &nbsp;
         <a href="javascript:void(0)"><span class="step step-normal ">ผลสัมฤทธิ์ของงาน</span></a>&nbsp;
		 <a href=#><span class="step step-color">พฤติกรรมการปฏิบัติงาน (สมรรถนะ)</span></a> &nbsp;

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

		<table class="table table-bordered tscore" id="">
			<tr>
				<th>สมรรถนะหลัก (ที่สภามหาวิทยาลัยกำหนด) </th>
				<th>ระดับสมรรถนะ ที่คาดหวัง </th>
				<th>ระดับสมรรถนะ ที่แสดงออก </th>
			</tr>
			<tr>
				<td> การมุ่งผลสัมฤทธิ์ </td>
				<?php
					// $sqlyesr="SELECT ass_id FROM tor WHERE gen_id ='$genIdpost'AND tor_year='$yeartest'";
					// $reChk = mysqli_query($con,"$sqlyesr") or die("torChk".mysqli_error($con));
					// list($tor_ID)=mysqli_fetch_row($reChk);
					// //echo $tor_ID;
					// mysqli_free_result($reChk);

				?>
				<input type="hidden" value="<?php echo $yearIdpost?>" name="tor_id">
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[0]['score'])?"0":$set[0]['score'] ?>" name="exp[]" readonly ></td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[0]['subcap_id']?>" name="stit0">
				<div class="form-group">
				<td><input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]"  onkeyup="fncNum();" onchange="fncNum();" required  >
					</div>
				 </td>
			</tr>
			<tr>
				<td>บริการที่ดี </td>
				<td> <input type='text' size='3' class="borderNon form-control" value="<?php echo empty($set[1]['score'])?"0":$set[1]['score'] ?>" placeholder="ข้อมูล" name="exp[]" readonly ></td>
					<td><input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required>
					<input type='hidden' size='3' class="borderNon form-control" value="<?php echo $set[1]['subcap_id']?>" placeholder="ข้อมูล" name="stit1" readonly >
				</td>
			</tr>
			<tr>
				<td>การสั่งสมความเชี่ยวชาญในงานอาชีพ </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[2]['score'])?"0":$set[2]['score'] ?>" name="exp[]" readonly> </td>
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[2]['subcap_id']?>" name="stit2" readonly>
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required >
				</td>
			</tr>
			<tr>
				<td>การยึดมั่นในความถูกต้องชอบธรรม  และจริยธรรม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[3]['score'])?"0":$set[3]['score'] ?>" name="exp[]" readonly> </td>
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[3]['subcap_id']?>" name="stit3" readonly>
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required>
				</td>
			</tr>
			<tr>
				<td>การทำงานเป็นทีม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[4]['score'])?"0":$set[4]['score'] ?>" name="exp[]" readonly> </td>
				<td>
				     <input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[4]['subcap_id'] ?>" name="stit4" readonly>
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-md">
		<table class="table table-bordered tscore">
			<tr>
				<th>สมรรถนะเฉพาะตามลักษณะงานที่ปฏิบัติ (ที่สภามหาวิทยาลัยกำหนด)  </th>
				<th>ระดับสมรรถนะ ที่คาดหวัง </th>
				<th>ระดับสมรรถนะ ที่แสดงออก </th>
			</tr>
			<tr>
				<td>ทักษะการสอนและการให้คำปรึกษาแก่นักศึกษา </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[5]['score'])?"0":$set[5]['score'] ?>" name="exp[]" readonly> </td>
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[5]['subcap_id'] ?>" name="stit5" readonly>
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required>
				</td>
			</tr>
			<tr>
				<td>ทักษะด้านบริการวิชาการ การวิจัยและนวัตกรรม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[6]['score'])?"0":$set[6]['score'] ?>" name="exp[]" readonly > </td>
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[6]['subcap_id'] ?>" name="stit6" readonly >
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required >
				</td>
			</tr>
			<tr>
				<td>ทักษะด้านบริการวิชาการ การวิจัยและนวัตกรรม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[7]['score'])?"0":$set[7]['score'] ?>" name="exp[]" readonly > </td>
				<td>
					<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[7]['subcap_id']?>" name="stit7" readonly >
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required>
				</td>
			</tr>
			<tr>
				<td>ความกระตือรือร้นและการเป็นแบบอย่างที่ดี </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[8]['score'])?"0":$set[8]['score'] ?>" name="exp[]" readonly > </td>
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[8]['subcap_id'] ?>" name="stit8" readonly >
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required>
				</td>
			</tr>
			<tr>
				<td>ทำนุบำรุงศิลปวัฒนธรรม </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[9]['score'])?"0":$set[9]['score'] ?>" name="exp[]" readonly>  </td>
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[9]['subcap_id'] ?>" name="stit9" readonly>
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required >
				</td>
			</tr>
		</table>
	</div>
	<div class="col-md">
		<table class="table table-bordered tscore">

			<tr>
				<th>สมรรถนะทางการบริหาร (ที่สภามหาวิทยาลัยกำหนด) </th>
				<th>ระดับสมรรถนะ ที่คาดหวัง </th>
				<th>ระดับสมรรถนะ ที่แสดงออก </th>
			</tr>
			<tr>
				<td>สภาวะผู้นำ </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[10]['score'])?"0":$set[10]['score'] ?>" name="exp[]" readonly>  </td>
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[10]['subcap_id'] ?>" name="stit10" readonly>
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required>
				</td>
			</tr>
			<tr>
				<td>วิสัยทัศน์ </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[11]['score'])?"0":$set[11]['score'] ?>" name="exp[]" readonly >  </td>
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[11]['subcap_id'] ?>" name="stit11" readonly >
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required>
				</td>
			</tr>
			<tr>
				<td>ศักยภาพเพื่อนำการปรับเปลี่ยน </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[12]['score'])?"0":$set[12]['score'] ?>" name="exp[]" readonly> </td>
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[12]['subcap_id'] ?>" name="stit12" readonly>
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required>
				</td>
			</tr>
			<tr>
				<td>การสอนงานและการมอบหมายงาน </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[13]['score'])?"0":$set[13]['score'] ?>" name="exp[]" readonly>   </td>
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo$set[13]['subcap_id'] ?>" name="stit13" readonly>
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required>
				</td>
			</tr>
			<tr>
				<td>การควบคุมตนเอง </td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo empty($set[14]['score'])?"0":$set[14]['score'] ?>" name="exp[]" readonly>  </td>
				<td>
				<input type='hidden' size='3' class="borderNon form-control" placeholder="ข้อมูล" value="<?php echo $set[14]['subcap_id'] ?>" name="stit14" readonly>
					<input type='number' min='0' max='5' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="go[]" onkeyup="fncNum();" onchange="fncNum();" required>
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
			<td><input type='text' size='2' class="borderNon form-control sumgo" placeholder="0" name="sumgo1"  data-sumgo="1" id="sumgo" readonly > </td>
			<td> <input type='text' size='5' class="borderNon form-control" placeholder="0" name="x1" value="3" data-x="1" readonly  > </td>
			<td><input type='text' size='5' class="borderNon form-control score" placeholder="0" name="score[]" onkeyup="fncSum();" onchange="fncNum();" data-score='1' id="score" readonly ></td>


		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๑  ระดับ    × ๒ คะแนน</td>
			<td><input type='text' size='2' class="borderNon form-control sumgo" placeholder="0" name="sumgo2" data-sumgo="2" id="sumgo" readonly ></td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="0" name="x2" value="2" data-x="2" readonly ></td>
			<td><input type='text' size='5' class="borderNon form-control score" placeholder="0" name="score[]" onkeyup="fncSum();"  onchange="fncNum();" data-score='2' id="score" readonly></td>
		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๒  ระดับ  ×  ๑  คะแนน  </td>
			<td><input type='text' size='2' class="borderNon form-control sumgo" placeholder="0" name="sumgo3" data-sumgo="3" id="sumgo" readonly  ></td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="0" name="x3" value="1" data-x="3" readonly ></td>
			<td><input type='text' size='5' class="borderNon form-control score" placeholder="0" name="score[]" onkeyup="fncSum();" onchange="fncNum();" data-score='3' id="score" readonly></td>
		</tr>
		<tr>
			<td>จำนวนสมรรถนะหลัก/สมรรถนะเฉพาะ/สมรรถนะทางการบริหาร  ที่มีระดับสมรรถนะที่แสดงออก  ต่ำกว่า ระดับสมรรถนะที่คาดหวัง   ๓  ระดับ   ×  ๐  คะแนน</td>
			<td><input type='text' size='2' class="borderNon form-control sumgo" placeholder="0" name="sumgo4" data-sumgo="4" id="sumgo" readonly ></td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="0" name="x4" value="0"  data-x="4" readonly ></td>
			<td><input type='text' size='5' class="borderNon form-control score" placeholder="0" name="score[]" onkeyup="fncSum();" onchange="fncNum();" data-score='4' id="score" readonly></td>
		</tr>
		<tr>
			<td colspan="3" class="text-right">ผลรวมคะแนน</td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="sumscore" readonly ></td>
		</tr>
		<tr>
			<td colspan="3">
				<div class="row">
					<div class="col text-right">
						<br>
						สรุปคะแนนส่วนพฤติกรรม (สมรรถนะ) =
					</div>
					<div class="col text-center">
						ผลรวมคะแนน <hr> จำนวนสมรรถนะที่ใช้ในการประเมิน <input type='hidden' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="numx" readonly > × 3
					</div>

				</div>
			</td>
			<td><input type='text' size='5' class="borderNon form-control" placeholder="ข้อมูล" name="sumAllscore" readonly>
			</td>

		</tr>
		<!-- <tr>

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

		</tr>			 -->

		</table>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-12 text-center mb-2" >
	<button type="submit" class="btn " data-modules="assessment" data-action="adddata_tor2"> ต่อไป </button>
		<!-- <p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t3"><input type="submit" class="next" value="ต่อไป"></a> </p> -->
	</div>
</div>
</form>
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
	document.tort2.sumscore.value = sum.toFixed(2);
	var lis = document.tort2.numx.value;
	var sumall =sum/(lis*3);
	document.tort2.sumAllscore.value = sumall.toFixed(2);
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
				document.tort2.sumgo2.value = n;
				document.tort2.sumgo3.value =g;
				document.tort2.sumgo4.value =h;
				}
				else{
					document.tort2.sumgo1.value = sum;
					document.tort2.sumgo2.value = n;
						document.tort2.sumgo3.value =g;
						document.tort2.sumgo4.value =h;
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
						document.tort2.sumgo1.value = sum;
						document.tort2.sumgo2.value = n;
						document.tort2.sumgo3.value =g;
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
			// $("a.next").click(function(){
			// 	var module1 = $(this).data('modules');
			// 	var action = $(this).data('action');
			// 	loadmain(module1,action)
			// });
		$(".tscore").on( "keyup change", "input[name='go[]']", function() {
	  // alert($(this).val())
	 // alert($("input[name='sumgo2']").val()+ $("input[name='sumgo1']").val())
	 //alert($("input[name='x1']").val()+ $("input[name='x2']").val())
		var sumgo1 = $("input[name='sumgo1']").val() * $("input[name='x1']").val()
		var sumgo2 = $("input[name='sumgo2']").val() * $("input[name='x2']").val()
		var sumgo3 = $("input[name='sumgo3']").val() * $("input[name='x3']").val()
		var sumgo4 = $("input[name='sumgo4']").val() * $("input[name='x4']").val()
		var arr = [sumgo1,sumgo2,sumgo3,sumgo4];
			//alert(sumgo1)
		var sumago1 = $("input[name='sumgo1']").val()
		var sumago2 = $("input[name='sumgo2']").val()
		var sumago3 = $("input[name='sumgo3']").val()
		var sumago4 = $("input[name='sumgo4']").val()
		var s1 = parseFloat(sumago1);
		var s2 = parseFloat(sumago2);
		var s3 = parseFloat(sumago3);
		var s4 = parseFloat(sumago4);
		var tot = s1+s2+s3+s4;

		$("input[name='numx']").val(tot);
		$("input[name='score[]']").each(function($i){
			$(this).val(arr[$i])
		})
		fncSum();

	});
	

	$("#tort2").submit(function(e){
				e.preventDefault();
				$check = $("#tort2").valid();
				if($check == true){
				var formData = new FormData(this);
					    $.ajax({
					        url: "module/assessment/adddata_tor2.php",
					        type: 'POST',
					        data: formData,
					        success: function (data) {
					            alert(data);
								
								loadmain("assessment","manage_tor");
  							
					        },
					        cache: false,
					        contentType: false,
					        processData: false
					    });
				}
			})

	

});

</script>
