<?php
	session_start();
	include("../../function/db_function.php");
	$con=connect_db();
	

	$seaca=mysqli_query($con,"SELECT gen_acadeic,gen_prefix,gen_fname,gen_lname,gen_pos,branch_id FROM general WHERE gen_id='$_SESSION[user_id]'")or die("SQL_ERROR".mysqli_error($con));
	list($acaID,$gen_prefix,$gen_fname,$gen_lname,$gen_pos,$branch_id)=mysqli_fetch_row($seaca);
	$seacaName=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$acaID'")or die("SQL_ERROR".mysqli_error($con));
	list($acaName)=mysqli_fetch_row($seacaName);
	$seaPos=mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id='$gen_pos'")or die("SQL_ERROR".mysqli_error($con));
	list($position)=mysqli_fetch_row($seaPos);
	$seBrench=mysqli_query($con,"SELECT branch_name FROM branch WHERE branch_id='$branch_id'")or die("SQL_ERROR".mysqli_error($con));
	list($branchName)=mysqli_fetch_row($seBrench);
	
	mysqli_free_result($seaca);
	mysqli_free_result($seacaName);
	mysqli_free_result($seaPos);
?>
<form class="p-2">
	<div class="row" >
		<div class="col-md">
			<h4 class="text-center">ข้อตกลงและแบบประเมินผลการปฏิบัติงานของข้าราชการพลเรือนในสถาบันอุดมศึกษา สายวิชาการ (ตำแหน่ง อาจารย์) สังกัดมหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</h4>
		</div>
		<div class="col-md-2 text-center p-2" style="border:solid 1px " >
			<u>ตัวชี้วัด – <?php echo $acaName ?></u><br>
			<u>เอกสารหมายเลข 2</u>
		</div>
	</div>
	<div class="row ">
		<div class="col-md">
			<p class="text-center"> ...................................................... </p>
		</div>
	</div>
	<div class="row text-center" >
		<div class="col-md-5 "> <!--ประจำปี งบประมาณ -->
		
		<div class="form-group row">
			<label for="" class="col-sm col-form-label">ประจำปี งบประมาณ</label>
			<div class="col-sm-6">
				<input type="text"  class="form-control" id="" value="">
			</div>
		</div>
	</div>
	<div class="col-md  ">
		<div class="col-md-12 row">
			<div class="form-check col-sm-1">
				<input type="checkbox"  class="form-check-input" id="" value="">
			</div>
			<div class="form-group  row">
				<label for="inputState" class="col-sm">รอบที่  ๑  (๑ ต.ค.</label>
				<div class="col-sm">
					<select id="inputState" class="form-control ">
						<option selected>2561</option>
						<option>2562</option>
					</select>
				</div>
				
				<label for="inputState" class="col-sm"> - ๓๑ มี.ค.</label>
				<div class="col-sm">
					<select id="inputState" class="form-control">
						<option selected>2561</option>
						<option>2562</option>
					</select>
				</div>
				<label for="inputState" class="col-sm-1"> )</label>
				
			</div>
		</div>
		<div class="col-md-12 row"> <!-- รอบที่ -->
		<div class="form-check col-sm-1">
			<input type="checkbox"  class="form-check-input" id="" value="">
		</div>
		<div class="form-group  row">
			<label for="inputState" class="col-sm">รอบที่ ๒  (๑ เม.ย. </label>
			<div class="col-sm">
				<select id="inputState" class="form-control ">
					<option selected>2561</option>
					<option>2562</option>
				</select>
			</div>
			
			<label for="inputState" class="col-sm"> - ๓๐ ก.ย. </label>
			<div class="col-sm">
				<select id="inputState" class="form-control">
					<option selected>2561</option>
					<option>2562</option>
				</select>
			</div>
			<label for="inputState" class="col-sm-1"> )</label>
			
		</div>
	</div>
</div>
</div>
<br>
<div class="row text-center">
<div class="col-md">
	<div class="form-group row">
		<label  class="col-sm-2 col-form-label">ชื่อผู้รับการประเมิน</label>
		<div class="col-sm">
			<input type="text" class="form-control" id="inputEmail3" placeholder="Email" value="<?php echo "$gen_prefix $gen_fname $gen_lname"; ?>">
		</div>
		<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
		<div class="col-sm">
			<input type="text" class="form-control" id="inputEmail3" placeholder="Email"value="<?php echo $position?>">
		</div>
		<label  class="col-sm-1 col-form-label">สังกัด.</label>
		<div class="col-sm">
			<input type="text" class="form-control" id="inputEmail3" placeholder="Email" value="<?php echo $branchName?>">
		</div>
	</div>
</div>
</div>
<div class="row text-center">
<div class="col-md">
	<div class="form-group row">
		<label  class="col-sm-3 col-form-label ">ชื่อผู้บังคับบัญชา /ผู้ประเมิน </label>
		<div class="col-sm">
			<input type="email" class="form-control" id="inputEmail3" placeholder="Email">
		</div>
		<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
		<div class="col-sm">
			<input type="email" class="form-control" id="inputEmail3" placeholder="Email">
		</div>
		
	</div>
</div>
</div>
<div class="row">
<div class="col-md">
	<p><u><b>คำชี้แจง</b></u></p>
	<div class="ml-5">
		<p>๑. แบบข้อตกลงฯ นี้เป็นการกำหนดแผนการปฏิบัติงานของผู้ปฏิบัติงานในมหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา  ซึ่งเป็นข้อตกลงร่วมกับผู้บังคับบัญชาก่อนเริ่มปฏิบัติงาน </p>
		<p>๒. การกำหนดข้อตกลงร่วม ผู้ปฏิบัติงานจะต้องกรอกรายละเอียดภาระงานโดยสังเขปในส่วนของภาระงานตามหน้าที่ความรับผิดชอบของตำแหน่ง และ/หรือภาระงานด้านอื่นๆ
			พร้อมกำหนดตัวชี้วัดความสำเร็จของภาระงานแต่ละรายการ ตลอดจนค่าเป้าหมาย และน้ำหนักร้อยละ  สำหรับในส่วนของพฤติกรรมการปฏิบัติราชการ (สมรรถนะ)  ให้ระบุ
			เพิ่มเติมในส่วนของสมรรถนะประจำกลุ่มงาน พร้อมทั้งระบุระดับสมรรถนะค่ามาตรฐาน และการประเมินตนเอง ของสมรรถนะทุกด้าน
		</p>
		<p>๓. การจัดทำข้อตกลงภาระงานดังกล่าวนี้ เพื่อใช้เป็นกรอบในการประเมินผลการปฏิบัติราชการ เพื่อประกอบการเลื่อนเงินเดือนและค่าจ้างในแต่ละรอบการประเมิน</p>
	</div>
</div>
</div>
<br>
<div class="row">
<div class="col-md">
	<p class="text-center" style="font-size: 20px"><b>ข้อตกลงและแบบประเมินผลการปฏิบัติงานของข้าราชการพลเรือนในสถาบันอุดมศึกษา
		สายวิชาการ (ตำแหน่ง <?php echo $acaName ?>)
	</b></p>
</div>
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md row text-center"> <!-- รอบที่ -->
<div class="form-check col-md-1">
	<input type="checkbox"  class="form-check-input" id="" value="">
</div>
<div class="form-group row col-md">
	<label for="inputState" class="col-md">ครั้งที่  ๑ (๑ ต.ค. </label>
	<div class="col-md">
		<select id="inputState" class="form-control ">
			<option selected>2561</option>
			<option>2562</option>
		</select>
	</div>
</div>
<div class="form-group row col-md">
	<label for="inputState" class="col-md"> - ๓๑ มี.ค </label>
	<div class="col-md">
		<select id="inputState" class="form-control">
			<option selected>2561</option>
			<option>2562</option>
		</select>
	</div>
	<label for="inputState" class="col-md-1"> )</label>
</div>
</div>
<div class="col-md-2"></div>
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md row text-center">
<div class="form-check col-md-1">
<input type="checkbox"  class="form-check-input" id="" value="">
</div>
<div class="form-group row col-md">
<label for="inputState" class="col-md">ครั้งที่  ๒  (๑ เม.ย. </label>
<div class="col-md">
	<select id="inputState" class="form-control ">
		<option selected>2561</option>
		<option>2562</option>
	</select>
</div>
</div>
<div class="form-group row col-md">
<label for="inputState" class="col-md"> - ๓๐ ก.ย.  </label>
<div class="col-md">
	<select id="inputState" class="form-control">
		<option selected>2561</option>
		<option>2562</option>
	</select>
</div>
<label for="inputState" class="col-md-1"> )</label>

</div>
</div>
<div class="col-md-2"></div>
</div>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md">
		 <div class="form-group row">
		 	<label  class="col-sm-2 col-form-label"> หน่วยงาน</label>
		 	<div class="col-sm-5">
		      <input type="text" class="form-control" id="inputEmail3" placeholder="">
		    </div>
			<label  class="col-sm col-form-label">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา </label>

		 
		</div>
	<div class="col-md-2"></div>

</div>
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">

		 	<label  class="col-sm-2 col-form-label">๑.  ชื่อ สกุล </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>
			<label  class="col-sm-2 col-form-label">ประเภทตำแหน่งวิชาการ </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>  
	</div>
	</div>	
</div>
<div class="row ">
	<div class="col-md">
	<div class="form-group row">

		 	<label  class="col-sm-2 col-form-label"> ตำแหน่งบริหาร </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>
			<label  class="col-sm-1 col-form-label">เงินเดือน </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div> 
		    <label  class="col-sm-1 col-form-label">บาท </label> 
	</div>
	</div>	
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-2 col-form-label"> เลขที่ประจำตำแหน่ง </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>
			<label  class="col-sm-1 col-form-label">สังกัด </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>    
	</div>
	</div>	
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-3 col-form-label"> มาช่วยราชการจากที่ใด (ถ้ามี) </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>
			<label  class="col-sm-2 col-form-label">หน้าที่พิเศษ </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>    
	</div>
	</div>	
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-3 col-form-label"> ๒. เริ่มรับราชการเมื่อวันที่ </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>
		    <label  class="col-sm-1 col-form-label"> เดือน </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>
		    <label  class="col-sm-1 col-form-label"> พ.ศ. </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>
			<label  class="col-sm-2 col-form-label">รวมเวลารับราชการ </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>    
	</div>
	</div>	
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">	 	
			<label  class="col-sm-2 col-form-label">รวมเวลารับราชการ </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>
		    <label  class="col-sm-1 col-form-label">ปี </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div> 
		    <label  class="col-sm-1 col-form-label">เดือน </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div> 
		    <label  class="col-sm-1 col-form-label">วัน </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="">
		    </div>     
	</div>
	</div>	
</div>

<div class="row ">
	<div class="col-md">
	<p>๓. บันทึกการมาปฏิบัติงาน</p>
	</div>	
</div>

<div class="row ">
	<div class="col-md">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="2" class="text-center">ประเภท</th>
				<th colspan="2">รอบที่ ๑</th>
				<th colspan="2">รอบที่ ๒</th>
				<th rowspan="2" class="text-center">ประเภท</th>
				<th colspan="2">รอบที่ ๑</th>
				<th colspan="2">รอบที่ ๒</th>
			</tr>
			<tr>
				<th>ครั้ง</th>
				<th>วัน</th>
				<th>ครั้ง</th>
				<th>วัน</th>
				<th>ครั้ง</th>
				<th>วัน</th>
				<th>ครั้ง</th>
				<th>วัน</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>ลาป่วย</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td rowspan="3">ลาป่วยจำเป็นต้องรักษาตัวเป็นเวลานาน<br>คราวเดียวหรือหลายคราวรวมกัน</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>ลากิจ</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				
			</tr>	
			<tr>
				<td>มาสาย</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				
			</tr>	
			<tr>
				<td>ลาคลอดบุตร</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>ลาคลอดบุตร</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>ลาอุปสมบท</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td colspan="5"></td>
				
			</tr>		
		</tbody>
	</table>
	</div>	
</div>

<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md">
		 <div class="form-group row">
		 	<label  class="col-sm-1 col-form-label"> ลงชื่อ</label>
		 	<div class="col-sm-5">
		      <input type="text" class="form-control" id="inputEmail3" placeholder="">
		    </div>
			<label  class="col-sm col-form-label">ผู้ปฏิบัติหน้าที่ตรวจสอบการมาปฏิบัติราชการของหน่วยงาน </label>

		 
		</div>
	<div class="col-md-2"></div>

</div>
</div>

<div class="row ">
	<div class="col-md">
	<p>๔. การกระทำผิดวินัย/การถูกลงโทษ</p>
	</div>	
</div>

<div class="row ">
	<div class="col-md">
		<textarea class="form-control"></textarea>
	</div>	
</div>
<br><br>
<div class="row ">
	<div class="col-md">
	<p><b><u>ส่วนที่  ๑  องค์ประกอบที่ ๑ ผลสัมฤทธิ์ของงาน</b></u></p>
	</div>	
</div>




<table class="table" >
<tr>
<th rowspan="2">(๑) ภาระงาน/กิจกรรม / โครงการ / งาน</th>
<th rowspan="2">(๒) ตัวชี้วัด / เกณฑ์ประเมิน</th>
<th colspan="5">(๓) ระดับค่าเป้าหมาย</th>
<th rowspan="2">(๔) ค่าคะแนน ที่ได้ </th>
<th rowspan="2">(๕) น้ำหนัก (ความสำคัญ/ ยากง่ายของงาน)</th>
<th rowspan="2">(๖) ค่าคะแนน   ถ่วงน้ำหนัก (๔) × (๕) ๑๐๐ </th>
</tr>
<tr>
<th >๑</th>
<th >๒</th>
<th >๓</th>
<th >๔</th>
<th >๕</th>
</tr>
<?php
	


	$sql = "SELECT tit,weights FROM weights WHERE aca_id='$acaID'";
	$weights = mysqli_query($con,$sql) or die(mysqli_error($con));
	$titcheck;
	while (list($tit,$weight)=mysqli_fetch_row($weights)) {
		$titcheck[] = $tit;
		$sql = "SELECT e_name FROM evaluation WHERE e_id='$tit'";
		$eval = mysqli_query($con,$sql) or die(mysqli_error($con));
		list($e_name)=mysqli_fetch_row($eval);
		echo "<tr id='$tit'>";
									echo "<td>$e_name</td>";
									echo "<td></td>";
									echo "<td><input type='radio' name='$tit' value='10'></td>";
									echo "<td><input type='radio' name='$tit' value='20'></td>";
									echo "<td><input type='radio' name='$tit' value='30'></td>";
									echo "<td><input type='radio' name='$tit' value='40'></td>";
									echo "<td><input type='radio' name='$tit' value='50'></td>";
									echo "<td id='sco$tit'></td>";
									echo "<td id='wei$tit' data-wei='$weight'>$weight</td>";
									echo "<td id='total$tit'></td>";
		echo "</tr>";
	}
	mysqli_close($con);
?>
</form>
</table>
<script type="text/javascript">
<?php
	foreach ($titcheck as $tit) {
?>
$('#<?php echo $tit; ?>').on('click', 'input[name="<?php echo $tit; ?>"]:checked', function(event) {
var sco = $(this).val();
var wei = $("#wei<?php echo $tit; ?>").data('wei');
$("#sco<?php echo $tit; ?>").html(sco);
var total = (sco*wei/100);
$("#total<?php echo $tit; ?>").html(total);
})
<?php
	}
?>
</script>