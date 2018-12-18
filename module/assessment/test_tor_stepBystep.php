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
<form method="POST" id="addtor"  class="p-2" >  
    <div class="row">
	    <span class="step step-color">ข้อตกลง</span> &nbsp;
         <a href="javascript:void(0)"><span class="step step-normal" data-modules="assessment" data-action="tor_t1">ส่วนที่ 1</span></a>&nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 2</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 3</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 4</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 5</span></a> &nbsp; 
		 <a href="#"><span class="step step-normal">ส่วนที่ 6</span></a> &nbsp;
    </div>
	<br>
    <p></p>
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
				<input type="hidden" name="gg" value="hidden" >
				<select id="inputState" class="form-control" name="year">
				<?php 
				$sYears=mysqli_query($con,"SELECT DISTINCT  y_year FROM years")or die(mysqli_error($con));
				while(list($y_year)=mysqli_fetch_row($sYears)){
					echo"<option value='$y_year'>$y_year</option>";
				}
				mysqli_free_result($sYears);
			?>
						
						
				</select>
			</div>
		</div>
	</div>
	<div class="col-md  ">
		<div class="col-md-12 row">
			<!-- <div class="form-check col-sm-1">
				<input type="checkbox"  class="form-check-input" id="" value="">
			</div> -->
			<div class="form-group  row">
				<!-- <label for="inputState" class="col-sm">รอบที่  ๑  (๑ ต.ค.</label> -->
				<div class="col-sm">
					<select id="inputNo" class="form-control" name="no">
					<?php 
						$yNow=date("Y");
						$sY_No=mysqli_query($con,"SELECT y_id,y_no,y_start,y_end FROM years WHERE y_year='$yNow'")or die(mysqli_error($con));
						while(list($y_id,$y_no,$y_s,$y_e)=mysqli_fetch_row($sY_No)){
							echo "<option value='$y_no ", DateThai($y_s)," - ",DateThai($y_e),"'>รอบที่ $y_no  (", DateThai($y_s)," - ",DateThai($y_e),")</option>";

						}
	
					?>
						
						
					</select>
				</div>
				
				<!-- <label for="inputState" class="col-sm"> - ๓๑ มี.ค.</label>
				<div class="col-sm">
					<select id="inputState" class="form-control">
						<option selected>2561</option>
						<option>2562</option>
					</select>
				</div> -->
				<!-- <label for="inputState" class="col-sm-1"> )</label> -->
				
			</div>
		</div>
		<div class="col-md-12 row"> <!-- รอบที่ -->
		<!-- <div class="form-check col-sm-1">
			<input type="checkbox"  class="form-check-input" id="" value="">
		</div> -->
		<div class="form-group  row">
			<!-- <label for="inputState" class="col-sm">รอบที่ ๒  (๑ เม.ย. </label> -->
			<!-- <div class="col-sm">
				<select id="inputState" class="form-control ">
					<option selected>2561</option>
					<option>2562</option>
				</select>
			</div> -->
			
			<!-- <label for="inputState" class="col-sm"> - ๓๐ ก.ย. </label> -->
			<!-- <div class="col-sm">
				<select id="inputState" class="form-control">
					<option selected>2561</option>
					<option>2562</option>
				</select>
			</div> -->
			<!-- <label for="inputState" class="col-sm-1"> )</label> -->
			
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
			<input type="text" class="form-control" id="inputEmail3" placeholder="ชื่อผู้รับการประเมิน" value="<?php echo "$gen_prefix $gen_fname $gen_lname"; ?>" name="name">
		</div>
		<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
		<div class="col-sm">
		<select class="form-control" name="g_pos">
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
			<input type="text" class="form-control" id="inputEmail3" placeholder="สังกัด" value="<?php echo $branchName?>" name="dept">
		</div>
	</div>
</div>
</div>
<div class="row text-center">
<div class="col-md">
	<div class="form-group row">
		<label  class="col-sm-3 col-form-label ">ชื่อผู้บังคับบัญชา /ผู้ประเมิน </label>
		<div class="col-sm">
			<input type="text" class="form-control" id="inputEmail3" placeholder="ชื่อผู้บังคับบัญชา" name="leader">
		</div>
		<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
		<div class="col-sm">
		<select class="form-control" name="l_pos">
		<?php 
			$seaPos=mysqli_query($con,"SELECT pos_id,pos_name FROM position")or die("SQL_ERROR".mysqli_error($con));
			while(list( $pos_id,$pos_name)=mysqli_fetch_row($seaPos)){
			// $select=$pos_id==$gen_pos?"selected":"";
			echo "<option value=$pos_id>$pos_name</option>";
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
<!-- <div class="form-check col-md-1">
	<input type="checkbox"  class="form-check-input" id="" value="">
</div> -->
<div class="form-group row">
	<!-- <label for="inputState" class="col-md">ครั้งที่  ๑ (๑ ต.ค. </label>
	<div class="col-md">
		<select id="inputState" class="form-control ">
			<option selected>2561</option>
			<option>2562</option>
		</select>
	</div> -->
	<div class="col-sm">
					
			<!-- <select id="No" class="form-control "> -->
					<?php 
						//  $yNow=date("Y");
						// $sY_No=mysqli_query($con,"SELECT y_id,y_no,y_start,y_end FROM years WHERE y_year='$yNow'")or die(mysqli_error($con));
						// while(list($y_id,$y_no,$y_s,$y_e)=mysqli_fetch_row($sY_No)){
						// 	echo "<option value='$y_id'>รอบที่ $y_no  (", DateThai($y_s)," - ",DateThai($y_e),")</option>";
						// }
					?>
					<!-- </select> -->
	</div>
</div>
<div class="form-group row col-md">
	<!-- <label for="inputState" class="col-md"> - ๓๑ มี.ค </label>
	<div class="col-md">
		<select id="inputState" class="form-control">
			<option selected>2561</option>
			<option>2562</option>
		</select>
	</div> -->
	<!-- <label for="inputState" class="col-md-1"> )</label> -->
</div>
</div>
<div class="col-md-2"></div>
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md row text-center">
<div class="form-check col-md-1">
<!-- <input type="checkbox"  class="form-check-input" id="" value=""> -->
</div>
<div class="form-group row col-md">
<!-- <label for="inputState" class="col-md">ครั้งที่  ๒  (๑ เม.ย. </label>
<div class="col-md">
	<select id="inputState" class="form-control ">
		<option selected>2561</option>
		<option>2562</option>
	</select> -->
</div>
</div>
<div class="form-group row col-md">
<!-- <label for="inputState" class="col-md"> - ๓๐ ก.ย.  </label> -->
<!-- <div class="col-md">
	<select id="inputState" class="form-control">
		<option selected>2561</option>
		<option>2562</option>
	</select>
</div> -->
<!-- <label for="inputState" class="col-md-1"> )</label> -->

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
			  <select class="form-control" name="g_aca">
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

		 	<label  class="col-sm-2 col-form-label">ตำแหน่งบริหาร</label>
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
		      <input type="text" class="form-control" id="" placeholder="เงินเดือน" value="<?php echo $gen_salary  ?>" name="salary">
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
		      <input type="text" class="form-control" id="" placeholder="เลขที่ประจำตำแหน่ง" name="acd_no" require>
		    </div>
			<label  class="col-sm-1 col-form-label">สังกัด </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="สังกัด" value="<?php echo $branchName?>">
		    </div>    
	</div>
	</div>	
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-3 col-form-label"> มาช่วยราชการจากที่ใด (ถ้ามี) </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="มาช่วยราชการจากที่ใด" name="aff">
		    </div>
			<label  class="col-sm-2 col-form-label">หน้าที่พิเศษ </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="หน้าที่พิเศษ" name="leves">
		    </div>    
	</div>
	</div>	
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-3 col-form-label"> ๒. เริ่มรับราชการเมื่อวันที่ </label>
		 	<div class="col-sm">
		      <input type="text"   class="form-control" id="datethai" placeholder="" value="<?php echo DateThai($gen_startdate)?>" name="st_work" readonly>
		    </div>
			<label  class="col-sm-2 col-form-label">รวมเวลารับราชการ </label>
		 	<div class="col-sm">
			 <?php
			 	// $birthdate = strtotime($gen_startdate);
				//  $today = time();
				
			 ?>
			 
		      <input type="text" class="form-control" id="" placeholder="" value="<?php echo dateDifference($gen_startdate,date("Y/m/d"),'%y ปี %m เดือน %d วัน'); ?>" name="sum_work" readonly>
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
		      <input type="text" class="form-control" id="inputEmail3" placeholder="ลงชื่อ" name="inspector" require>
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
		<textarea class="form-control" rows=4 name="punishment" require></textarea>
	</div>	
</div>
<br>

<div class="row">
	<div class="col-md-12 text-center mb-2" >
		
		<button type="submit" class="btn " data-modules="assessment" data-action="adddata_tor"> ต่อไป </button>
	</div>
</div>
</form>


<script type="text/javascript">
	
    $("#addbrn").click(function(e){
            e.preventDefault()
            $('#loadaddsub').load("module/assessment/ldl_insertform.php",function(){
                $('#addsub').modal('show');   
                
                });
             });

 $("#inputState").change(function(){
	 var years=$(this,"option:selected").val()
	//  alert(years)
	 $.post("module/assessment/loaddatayear.php",{year:years},
		 function (data, textStatus, jqXHR) {
			// alert(data) 
			$("#inputNo").html(data)
		 }
		
	 );
 })
	
$("#addtor").submit(function(){
				
				$check = $("#addtor").valid();

				if($check == true){
				var formData = new FormData(this);

					    $.ajax({
					        url: "module/assessment/adddata_tor.php",
					        type: 'POST',
					        data: formData,
					        success: function (data) {
					            alert(data);
					        },
					        cache: false,
					        contentType: false,
					        processData: false
					    });
				}

				loadmain("assessment","tor_t1")
				
			})	
			$(document).ready(function() {
			$("a.next").click(function(){
				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				//alert(module1+ " "+ action )
				//loadmain(module1,action)
			});
		});
</script>