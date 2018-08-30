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
	
	mysqli_free_result($seaca);
	mysqli_free_result($seacaName);
	mysqli_free_result($seBrench);
?>
<form class="p-2">
	<div class="row" >
		<div class="col-md">
			<h5 class="text-center">ข้อตกลงและแบบประเมินผลการปฏิบัติงานของข้าราชการพลเรือนในสถาบันอุดมศึกษา สายวิชาการ(ตำแหน่ง <?php echo $acaName ?>) สังกัดมหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</h5>
		</div>
		<div class="col-md-2 text-center p-2" style="border:solid 1px " >
			<u>ตัวชี้วัด – <?php echo $acaName ?></u><br>
			<u>เอกสารหมายเลข 1</u>
		</div>
	</div>
	<br><br>
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
			<input type="text" class="form-control" id="inputEmail3" placeholder="ชื่อผู้รับการประเมิน" value="<?php echo "$gen_prefix $gen_fname $gen_lname"; ?>">
		</div>
		<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
		<div class="col-sm">
		<select class="form-control" name="">
		<?php 
			$seaPos=mysqli_query($con,"SELECT pos_id,pos_name FROM position")or die("SQL_ERROR".mysqli_error($con));
			while(list( $pos_id,$pos_name)=mysqli_fetch_row($seaPos)){
			$select=$pos_id==$gen_pos?"selected":"";
			echo "<option value=$pos_id $select>$pos_name</option>";
			}

			mysqli_free_result($seaPos);
		?>
		</select>
			<!-- <input type="text" class="form-control" id="inputEmail3" placeholder="Email"value="<?php echo $position?>"> -->
		</div>
		<label  class="col-sm-1 col-form-label">สังกัด.</label>
		<div class="col-sm">
			<input type="text" class="form-control" id="inputEmail3" placeholder="สังกัด" value="<?php echo $branchName?>">
		</div>
	</div>
</div>
</div>
<div class="row text-center">
<div class="col-md">
	<div class="form-group row">
		<label  class="col-sm-3 col-form-label ">ชื่อผู้บังคับบัญชา /ผู้ประเมิน </label>
		<div class="col-sm">
			<input type="text" class="form-control" id="inputEmail3" placeholder="ชื่อผู้บังคับบัญชา">
		</div>
		<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
		<div class="col-sm">
		<select class="form-control" name="">
		<?php 
			$seaPos=mysqli_query($con,"SELECT pos_id,pos_name FROM position")or die("SQL_ERROR".mysqli_error($con));
			while(list( $pos_id,$pos_name)=mysqli_fetch_row($seaPos)){
			// $select=$pos_id==$gen_pos?"selected":"";
			echo "<option value=$pos_id >$pos_name</option>";
			}
		?>
		</select>
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
		      <input type="text" class="form-control" id="inputEmail3" placeholder="หน่วยงาน">
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
		      <input type="text" class="form-control" id="" placeholder="ชื่อ สกุล" value="<?php echo "$gen_prefix $gen_fname $gen_lname"; ?>">
		    </div>
			<label  class="col-sm-2 col-form-label">ประเภทตำแหน่งวิชาการ </label>
		 	<div class="col-sm">
		      <!-- <input type="text" class="form-control" id="" placeholder=""> -->
			  <select class="form-control" name="">
			  <?php   
			  	$seaPos=mysqli_query($con,"SELECT aca_id,aca_name FROM academic")or die("SQL_ERROR".mysqli_error($con));
				  while(list( $aca_id,$aca_name)=mysqli_fetch_row($seaPos)){
				  // $select=$aca_id==$gen_pos?"selected":"";
				  echo "<option value=$aca_id>$aca_name</option>";
				  }
				  mysqli_free_result($seaPos);
			  ?>
			  </select>
		    </div>  
	</div>
	</div>	
</div>
<div class="row ">
	<div class="col-md">
	<div class="form-group row">

		 	<label  class="col-sm-2 col-form-label"> ตำแหน่งบริหาร </label>
		 	<div class="col-sm">
		      <!-- <input type="text" class="form-control" id="" placeholder=""> -->
			  <select class="form-control" name="">
				<?php 
					$seaPos=mysqli_query($con,"SELECT pos_id,pos_name FROM position")or die("SQL_ERROR".mysqli_error($con));
					while(list( $pos_id,$pos_name)=mysqli_fetch_row($seaPos)){
					$select=$pos_id==$gen_pos?"selected":"";
					echo "<option value=$pos_id $select>$pos_name</option>";
					}

					mysqli_free_result($seaPos);
				?>
		</select>
		    </div>
			<label  class="col-sm-1 col-form-label">เงินเดือน </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="เงินเดือน" value="<?php echo $gen_salary  ?>">
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
		      <input type="text" class="form-control" id="" placeholder="เลขที่ประจำตำแหน่ง">
		    </div>
			<label  class="col-sm-1 col-form-label">สังกัด </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="สังกัด">
		    </div>    
	</div>
	</div>	
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-3 col-form-label"> มาช่วยราชการจากที่ใด (ถ้ามี) </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="มาช่วยราชการจากที่ใด">
		    </div>
			<label  class="col-sm-2 col-form-label">หน้าที่พิเศษ </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="หน้าที่พิเศษ">
		    </div>    
	</div>
	</div>	
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-3 col-form-label"> ๒. เริ่มรับราชการเมื่อวันที่ </label>
		 	<div class="col-sm">
		      <input type="text"   class="form-control" id="datethai" placeholder="" value="<?php echo DateThai($gen_startdate)   ?>" readonly>
		    </div>
			<label  class="col-sm-2 col-form-label">รวมเวลารับราชการ </label>
		 	<div class="col-sm">
			 <?php
			 	// $birthdate = strtotime($gen_startdate);
				//  $today = time();
				
			 ?>
			 
		      <input type="text" class="form-control" id="" placeholder="" value="<?php echo dateDifference($gen_startdate,date("Y/m/d"),'%y ปี %m เดือน %d วัน'); ?>">
		    </div>    
	</div>
	</div>	
</div>



<div class="row ">
	<div class="col-md">
	<p>๓. บันทึกการมาปฏิบัติงาน</p>
	</div>	
</div>
<div class="row">
	<div class="col-md">	
		<?php
			$reS=mysqli_query($con,"SELECT *FROM idlel WHERE gen_id='$_SESSION[user_id]' AND idl_no='1' AND idl_year='2018' ")or die(mysqli_error($con));
			$idl=mysqli_fetch_assoc($reS);
			
			if(empty($idl)){
				echo "<p style='color:red;' align='center'>ยังไม่ได้กรอกข้อมูล</p>";
			// 	echo "<div align='center'><a href='javascript:void(0)'><button type='button' id='add' data-toggle='modal'>กรอกข้อมูล</button></a><div><br>";
			 ?>
			<div align='center'><a href="javascript:void(0)"><button type="button" class="btn" id="addbrn"  ><i class="fas fa-plus"></i>&nbsp;กรอกข้อมูล</button></a></div><br>
			<?php	
			}else{
				include("idl.php");
			}
			
		?>
		<div id="loadaddsub"></div> 
	</div>
</div>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md">
		 <div class="form-group row">
		 	<label  class="col-sm-1 col-form-label"> ลงชื่อ</label>
		 	<div class="col-sm-5">
		      <input type="text" class="form-control" id="inputEmail3" placeholder="ลงชื่อ">
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
		<textarea class="form-control" rows=4></textarea>
	</div>	
</div>
<br><br>
<div class="row ">
	<div class="col-md">
	<p><b><u>ส่วนที่  ๑  องค์ประกอบที่ ๑ ผลสัมฤทธิ์ของงาน</b></u></p>
	</div>	
</div>


<div class="row ">
	<div class="col-md">
<table class="table table-bordered" >
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
	


	$sql = "SELECT tit,weights FROM weights WHERE aca_id='$gen_acadeic'";
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
	<tr> 
		<td colspan="8" class="text-center"> ผลรวม </td>
		<td class="text-center"> 100 </td>
		<td class="text-center">  </td>
	</tr>
	<tr> 
		<td colspan="9" >
			<div class="row">
				<div class="col-sm text-right" >
					<br> 
					สรุปคะแนนส่วนผลสัมฤทธิ์ของงาน  = 
				</div>		
				<div class="col-sm text-center">	
					ผลรวมของค่าคะแนนถ่วงน้ำหนัก <hr style="border-width: 3px;"> จำนวนระดับค่าเป้าหมาย = ๕  
				</div>
			</div>	
		</td>
		<td class="text-center">  </td>
	</tr>
</form>
</table>
</div>
</div>

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
				<td> </td>	
				<td> </td>		
			</tr>
			<tr>
				<td>บริการที่ดี </td>
				<td> </td>	
				<td> </td>		
			</tr>
			<tr>
				<td>การสั่งสมความเชี่ยวชาญในงานอาชีพ </td>
				<td> </td>	
				<td> </td>		
			</tr>
			<tr>
				<td>การยึดมั่นในความถูกต้องชอบธรรม  และจริยธรรม </td>
				<td> </td>	
				<td> </td>		
			</tr>
			<tr>
				<td>การทำงานเป็นทีม </td>
				<td> </td>	
				<td> </td>		
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
				<td> </td>	
				<td> </td>		
			</tr>
			<tr>
				<td>ทักษะด้านบริการวิชาการ การวิจัยและนวัตกรรม </td>
				<td> </td>	
				<td> </td>		
			</tr>
			<tr>
				<td>ทักษะด้านบริการวิชาการ การวิจัยและนวัตกรรม </td>
				<td> </td>	
				<td> </td>		
			</tr>
			<tr>
				<td>ความกระตือรือร้นและการเป็นแบบอย่างที่ดี </td>
				<td> </td>	
				<td> </td>		
			</tr>
			<tr>
				<td>ทำนุบำรุงศิลปวัฒนธรรม </td>
				<td> </td>	
				<td> </td>		
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
				<td> </td>	
				<td> </td>		
			</tr>
			<tr>
				<td>วิสัยทัศน์ </td>
				<td> </td>	
				<td> </td>		
			</tr>
			<tr>
				<td>ศักยภาพเพื่อนำการปรับเปลี่ยน </td>
				<td> </td>	
				<td> </td>		
			</tr>
			<tr>
				<td>การสอนงานและการมอบหมายงาน </td>
				<td> </td>	
				<td> </td>		
			</tr>
			<tr>
				<td>การควบคุมตนเอง </td>
				<td> </td>	
				<td> </td>		
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
var total = (sco*wei/100);
$("#total<?php echo $tit; ?>").html(total);
})
<?php
	}
?>


    $("#addbrn").click(function(e){
            e.preventDefault()
            $('#loadaddsub').load("module/assessment/ldl_insertform.php",function(){
                $('#addsub').modal('show');   
                
                });
             });
</script>