<?php
	 session_start();
	 include("../../function/db_function.php");
	 include("../../function/fc_time.php");
	 $con=connect_db();
	$yearbudget=DATE('Y')+543;  //ปีปัจจุบัน

    $m=DATE('m');
	$y=$yearbudget;
	$Y=DATE('Y');

	if($m<=9 && $m>3){
    	$loop=2;
	}else{
    	$loop=1;
	}

    if($loop==2){
		$y-=1;
		$Y-=1;

    }
    $y_id = $y.$loop;


	echo	$genIdpost = $_POST['genid'];
	echo	$yearIdpost = $_POST['year'];

	$tor=mysqli_query($con,"SELECT *FROM tor WHERE tor_year='$yearIdpost'AND gen_id='$genIdpost'")or die("SQL_ERROR".mysqli_error($con));
    list($tor_id,$gen_id,$tor_year,$tor_nameRe,$tor_pos,$tor_department,$tor_leader,$tor_leader_pos,$tor_aca,$tor_salary,$tor_acdCode,$tor_affiliation,$tor_leves,$tor_startWork,$tor_sumWork,$inspector,$tor_punishment)=mysqli_fetch_row($tor);
    // echo "<br>",$tor_id,$gen_id,$tor_year,$tor_nameRe,$tor_pos,$tor_department,$tor_leader,$tor_leader_pos,$tor_aca,$tor_salary,$tor_acdCode,$tor_affiliation,$tor_leves,$tor_startWork,$tor_sumWork,$inspector,$tor_punishment;


	$seacaName=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$tor_aca'")or die("SQL_ERROR".mysqli_error($con));
	list($acaName)=mysqli_fetch_row($seacaName);



	// $seexp=mysqli_query($con,"SELECT * FROM tort2_exp WHERE aca_id='$gen_acadeic'")or die(mysqli_error($con));
	// for ($set = array (); $row = $seexp->fetch_assoc(); $set[] = $row);
	// print_r($set);
	mysqli_free_result($tor);
	mysqli_free_result($seacaName);

	// mysqli_free_result($seexp);
?>
<form method="POST" id="addtor"  class="p-2" action="javascript:void(0)" >

	<input type="hidden" name="genid" value="<?php echo $genIdpost ?>">
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
				<input type="hidden"  name="tor_id" value="<?php echo $tor_id  ?>" >
				<?php
					$re_year=   mysqli_query($con,"SELECT y_year FROM years WHERE y_id='$tor_year'")or die("error".mysqli_error($con));
					list($YY)=mysqli_fetch_row($re_year);
					mysqli_free_result($re_year);
				?>
				<select id="inputState" class="form-control" name="year">
				<?php
				$sYears=mysqli_query($con,"SELECT DISTINCT  y_year FROM years")or die(mysqli_error($con));
				while(list($y_year)=mysqli_fetch_row($sYears)){
					$y_thai=$y_year+543;

					$select=$YY==$y_year?"selected":"";
					echo"<option value='$y_year' $select>$y_thai</option>";
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
					<select id="inputNo" class="form-control" name="a_no">
					<?php
						$yNow=date("Y");
						$sY_No=mysqli_query($con,"SELECT y_id,y_no,y_start,y_end FROM years WHERE y_year='$yNow'")or die(mysqli_error($con));
						while(list($y_id,$y_no,$y_s,$y_e)=mysqli_fetch_row($sY_No)){

							$seNO=$tor_year==$y_no?"selected":"";
							echo "<option value='$y_id' $seNO>รอบที่ $y_no  (", DateThai($y_s)," - ",DateThai($y_e),")</option>";
						}
					?>
					</select>
				</div>
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
			<input type="text" class="form-control" id="inputEmail3" placeholder="ชื่อผู้รับการประเมิน" value="<?php echo $tor_nameRe; ?>" name="name" required>
		</div>
		<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
		<div class="col-sm">
		<select class="form-control" name="g_pos">
		<?php
			$seaPos=mysqli_query($con,"SELECT pos_id,pos_name FROM position")or die("SQL_ERROR".mysqli_error($con));
			while(list( $pos_id,$pos_name)=mysqli_fetch_row($seaPos)){
			$select=$pos_id==$tor_pos?"selected":"";
			echo "<option value=$pos_id $select>$pos_name</option>";
			}
			mysqli_free_result($seaPos);
		?>
		</select>
			<!-- <input type="text" class="form-control" id="inputEmail3" placeholder="Email"value="<?php echo $position?>"> -->
		</div>
		<label  class="col-sm-1 col-form-label">สังกัด.</label>
		<div class="col-sm">
			<input type="text" class="form-control" id="inputEmail3" placeholder="สังกัด" value="<?php echo $tor_department?>" name="dept">
		</div>
	</div>
</div>
</div>
<div class="row text-center">
<div class="col-md">
	<div class="form-group row">
		<label  class="col-sm-3 col-form-label ">ชื่อผู้บังคับบัญชา /ผู้ประเมิน </label>
		<div class="col-sm">
			<input type="text" class="form-control" id="inputEmail3" placeholder="ชื่อผู้บังคับบัญชา" name="leader" value="<?php echo $tor_leader ?>" required>
		</div>
		<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
		<div class="col-sm">
		<select class="form-control" name="l_pos">
		<?php
			$seaPos=mysqli_query($con,"SELECT pos_id,pos_name FROM position")or die("SQL_ERROR".mysqli_error($con));
			while(list( $pos_id,$pos_name)=mysqli_fetch_row($seaPos)){
			  $select=$pos_id==$tor_leader_pos?"selected":"";
			echo "<option value='$pos_id' $select>$pos_name</option>";
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
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md row text-center">
<div class="form-check col-md-1">
<!-- <input type="checkbox"  class="form-check-input" id="" value=""> -->
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
		      <input type="text" class="form-control" id="inputEmail3" placeholder="หน่วยงาน" value="<?php echo $tor_department?>" required>
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
		      <input type="text" class="form-control" id="" placeholder="ชื่อ สกุล" value="<?php echo $tor_nameRe; ?>" required>
		    </div>
			<label  class="col-sm-2 col-form-label">ประเภทตำแหน่งวิชาการ </label>
		 	<div class="col-sm">
		      <!-- <input type="text" class="form-control" id="" placeholder=""> -->
			  <select class="form-control" name="g_aca">
			  <?php
			  	$seaPos=mysqli_query($con,"SELECT aca_id,aca_name FROM academic")or die("SQL_ERROR".mysqli_error($con));
				  while(list( $aca_id,$aca_name)=mysqli_fetch_row($seaPos)){
				  $select=$aca_id==$tor_aca?"selected":"";
				  echo "<option value='$aca_id' $select>$aca_name</option>";
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
					$select=$pos_id==$tor_pos?"selected":"";
					echo "<option value=$pos_id $select>$pos_name</option>";
					}

					mysqli_free_result($seaPos);
				?>
		</select>
		    </div>
			<label  class="col-sm-1 col-form-label">เงินเดือน </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="เงินเดือน" value="<?php echo $tor_salary  ?>" name="salary" required>
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
		      <input type="text" class="form-control" id="" placeholder="เลขที่ประจำตำแหน่ง" name="acd_no" value="<?php echo $tor_acdCode ?>" required >
		    </div>
			<label  class="col-sm-1 col-form-label">สังกัด </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="สังกัด" value="<?php echo $tor_department?>">
		    </div>
	</div>
	</div>
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-3 col-form-label"> มาช่วยราชการจากที่ใด (ถ้ามี) </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="มาช่วยราชการจากที่ใด" name="aff" value="<?php echo $tor_affiliation ?>" required>
		    </div>
			<label  class="col-sm-2 col-form-label">หน้าที่พิเศษ </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="หน้าที่พิเศษ" name="leves" value="<?php echo $tor_leves   ?>" required>
		    </div>
	</div>
	</div>
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-3 col-form-label"> ๒. เริ่มรับราชการเมื่อวันที่ </label>
		 	<div class="col-sm">
		      <input type="text"   class="form-control" id="datethai" placeholder="" value="<?php echo DateThai($tor_startWork)?>" name="" readonly>
			  <input type="hidden"   class="form-control" id="datethai" placeholder="" value="<?php echo $tor_startWork?>" name="st_work" readonly>

		    </div>
			<label  class="col-sm-2 col-form-label">รวมเวลารับราชการ </label>
		 	<div class="col-sm">
			 <?php
			 	// $birthdate = strtotime($gen_startdate);
				//  $today = time();

			 ?>

		      <input type="text" class="form-control" id="" placeholder="" value="<?php echo dateDifference($tor_startWork,date("Y/m/d"),'%y ปี %m เดือน %d วัน'); ?>" name="sum_work" readonly>
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
			$mm=date('m');  //เดือนปัจจุบัน
			$yearbudget=DATE('Y')+543;  //ปีปัจจุบัน
			$m="$mm";
			$y="$yearbudget";
			if($m<=9 && $m>3){
				$loop=2;
			}else{
				$loop=1;
			}
			if($loop==2){
				$y-=1;
			}
			$y_id = $y.$loop;
				$reS=mysqli_query($con,"SELECT *FROM idlel WHERE gen_id='$genIdpost'  AND year_id='$y_id' ")or die(mysqli_error($con));
				$idl=mysqli_fetch_assoc($reS);

			if(empty($idl)){
				echo "<p style='color:red;' align='center'>ยังไม่ได้กรอกข้อมูล</p>";
			// 	echo "<div align='center'><a href='javascript:void(0)'><button type='button' id='add' data-toggle='modal'>กรอกข้อมูล</button></a><div><br>";
			 ?>
			<div align='center'><a href="javascript:void(0)"><button type="button" class="btn" id="addbrn"  ><i class="fas fa-plus"></i>&nbsp;กรอกข้อมูล</button></a></div><br>
			<?php
			}else{
				include("idl2.php");
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
		      <input type="text" class="form-control" id="inputEmail3" placeholder="ลงชื่อ" name="inspector" value="<?php echo $inspector  ?>" required>
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
		<textarea class="form-control" rows=4 name="punishment" required><?php echo  $tor_punishment  ?></textarea>
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
$(document).ready(function() {
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
					        url: "module/assessment/update_tor.php",
					        type: 'POST',
					        data: formData,
					        success: function (data) {
					            alert(data);
					        },
					        cache: false,
					        contentType: false,
					        processData: false
					    }).done(function(){
								$.post("module/assessment/tor_t1.php",{genid:'<?php echo $genIdpost ?>',year:'<?php echo $yearIdpost ?>'}).done(function(data){
									sessionStorage.setItem("module1","assessment");
									sessionStorage.setItem("action","tor_t1");
										$("#detail").html(data);
								})
							});

				}

			})

		});
</script>
