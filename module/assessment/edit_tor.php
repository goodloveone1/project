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


	$genIdpost = $_POST['genid'];
	$yearIdpost = $_POST['year'];

	$_SESSION['genIdpost']=$genIdpost;
	$_SESSION['yearIdpost']=$yearIdpost;

	$tor=mysqli_query($con,"SELECT *FROM assessments WHERE year_id='$yearIdpost'AND staff='$genIdpost'")or die("SQL_ERROR".mysqli_error($con));
    list($tor_id,$staff_id,$year_id,$leader_id,$sumwork,$punishment)=mysqli_fetch_row($tor);
  
	$re_staff=mysqli_query($con,"SELECT fname,lname,branch_id,salary,aca_code,acadeic,leves,other,startdate,position FROM staffs WHERE st_id='$staff_id'") or die("Staff_SQL-error".mysqli_error($con));
		list( $fname,$lname,$branch_id,$salary,$aca_code,$acadeie,$leves,$other,$startdate,$position)=mysqli_fetch_row($re_staff);
	
	$re_leader = mysqli_query($con,"SELECT fname,lname,branch_id,salary,aca_code,acadeic,leves,other,startdate,position FROM staffs WHERE st_id='$leader_id'") or die("Leader_SQL-error".mysqli_error($con));
		list( $l_fname,$l_lname,$l_branch_id,$l_salary,$l_aca_code,$l_acadeie,$l_leves,$l_other,$l_startdate,$l_position)=mysqli_fetch_row($re_leader);
		
$re_aca = mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$acadeie'") or die("ACA_SQL-error".mysqli_error($re_aca));
		list($acaName)=mysqli_fetch_row($re_aca);



	mysqli_free_result($tor);
	mysqli_free_result($re_staff);
	mysqli_free_result($re_leader);
	mysqli_free_result($re_aca);
	
	
	// mysqli_free_result($seacaName);

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
			<label for="" class="col-sm col-form-label">ประจำปี งบประมาณ <?php echo $year_id  ?></label>
			<div class="col-sm-6">
				<input type="hidden"  name="tor_id" value="<?php echo $tor_id  ?>" >
				
				<select id="inputState" class="form-control" name="year" disabled>
				<?php
				$sYears=mysqli_query($con,"SELECT DISTINCT  y_id,y_year FROM years")or die(mysqli_error($con));
				while(list($y_id,$y_year)=mysqli_fetch_row($sYears)){
					$y_thai=$y_year+543;

					$select=$year_id==$y_id?"selected":"";
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
					<select id="inputNo" class="form-control" name="a_no" disabled>
					<?php
						$yNow=date("Y");
						$sY_No=mysqli_query($con,"SELECT y_id,y_no,y_start,y_end FROM years WHERE y_year='$yNow'")or die(mysqli_error($con));
						while(list($y_id,$y_no,$y_s,$y_e)=mysqli_fetch_row($sY_No)){

							$seNO=$year_id==$y_id?"selected":"";
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
			<input type="text" class="form-control" id="inputEmail3" placeholder="ชื่อผู้รับการประเมิน" value="<?php echo $fname," ",$lname; ?>" name="name" required readonly>
		</div>
		<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>

		<div class="col-sm">
		<select class="form-control" name="g_pos" disabled>
		<?php
			$seaPos=mysqli_query($con,"SELECT pos_id,pos_name FROM position")or die("SQL_ERROR".mysqli_error($con));
			while(list( $pos_id,$pos_name)=mysqli_fetch_row($seaPos)){
			$select=$pos_id==$position?"selected":"";
			echo "<option value=$pos_id $select>$pos_name</option>";
			}
			mysqli_free_result($seaPos);
		?>
		</select>
		
		</div>
		<label  class="col-sm-1 col-form-label">สังกัด.</label>
		<div class="col-sm">
		<?php 
			$re_branch=mysqli_query($con,"SELECT br_name,dept_id FROM branchs WHERE br_id='$branch_id'") or die("position-sqlError".mysqli_error($con));
			list($branch_name,$dept_id)=mysqli_fetch_row($re_branch);
				$re_dept=mysqli_query($con,"SELECT dept_name FROM departments	WHERE dept_id='$dept_id'") or die("dept-sqlError".mysqli_error($con));
				list($dept_name)=mysqli_fetch_row($re_dept);

			mysqli_free_result($re_branch)
		?>
			<input type="text" class="form-control" id="inputEmail3" placeholder="สังกัด" value="<?php echo $dept_name?>" name="dept" readonly>
		</div>
	</div>
</div>
</div>
<div class="row text-center">
<div class="col-md">
	<div class="form-group row">
		<label  class="col-sm-3 col-form-label ">ชื่อผู้บังคับบัญชา /ผู้ประเมิน </label>
		<div class="col-sm">
			<input type="text" class="form-control" id="inputEmail3" placeholder="ชื่อผู้บังคับบัญชา" name="leader" value="<?php echo $l_fname," ",$l_lname ?>" readonly>
		</div>
		<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
		<div class="col-sm">
		<select class="form-control" name="l_pos" disabled >
		<?php
			$seaPos=mysqli_query($con,"SELECT pos_id,pos_name FROM position")or die("SQL_ERROR".mysqli_error($con));
			while(list( $pos_id,$pos_name)=mysqli_fetch_row($seaPos)){
			  $select=$pos_id==$l_position?"selected":"";
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
		      <input type="text" class="form-control" id="inputEmail3" placeholder="หน่วยงาน" value="คณะ<?php echo $dept_name?>" readonly>
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
		      <input type="text" class="form-control" id="" placeholder="ชื่อ สกุล" value="<?php echo $fname," ",$lname; ?>" readonly>
		    </div>
			<label  class="col-sm-2 col-form-label">ประเภทตำแหน่งวิชาการ </label>
		 	<div class="col-sm">
		      <!-- <input type="text" class="form-control" id="" placeholder=""> -->
			  <select class="form-control" name="g_aca" disabled>
			  <?php
			  	$seaPos=mysqli_query($con,"SELECT aca_id,aca_name FROM academic")or die("SQL_ERROR".mysqli_error($con));
				  while(list( $aca_id,$aca_name)=mysqli_fetch_row($seaPos)){
				  $select=$aca_id==$acadeie?"selected":"";
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
			  <select class="form-control" name="" disabled>
				<?php
					$seaPos=mysqli_query($con,"SELECT pos_id,pos_name FROM position")or die("SQL_ERROR".mysqli_error($con));
					while(list( $pos_id,$pos_name)=mysqli_fetch_row($seaPos)){
					$select=$pos_id==$position?"selected":"";
					echo "<option value=$pos_id $select>$pos_name</option>";
					}

					mysqli_free_result($seaPos);
				?>
		</select>
		    </div>
			<label  class="col-sm-1 col-form-label">เงินเดือน </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="เงินเดือน" value="<?php echo $salary  ?>" name="salary" readonly>
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
		      <input type="text" class="form-control" id="" placeholder="เลขที่ประจำตำแหน่ง" name="acd_no" value="<?php echo $aca_code ?>" readonly >
		    </div>
			<label  class="col-sm-1 col-form-label">สังกัด </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="สังกัด" value="<?php echo $branch_name?>" readonly>
		    </div>
	</div>
	</div>
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-3 col-form-label"> มาช่วยราชการจากที่ใด (ถ้ามี) </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="มาช่วยราชการจากที่ใด" name="aff" value="<?php echo $other ?>" readonly>
		    </div>
			<label  class="col-sm-2 col-form-label">หน้าที่พิเศษ </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="หน้าที่พิเศษ" name="leves" value="<?php echo $leves   ?>" readonly>
		    </div>
	</div>
	</div>
</div>

<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-3 col-form-label"> ๒. เริ่มรับราชการเมื่อวันที่ </label>
		 	<div class="col-sm">
		      <input type="text"   class="form-control" id="datethai" placeholder="" value="<?php echo DateThai($startdate)?>" name="" readonly>
			  <input type="hidden"   class="form-control" id="datethai" placeholder="" value="<?php echo $startdate?>" name="st_work" readonly>

		    </div>
			<label  class="col-sm-2 col-form-label">รวมเวลารับราชการ </label>
		 	<div class="col-sm">
			 <?php
			 	// $birthdate = strtotime($gen_startdate);
				//  $today = time();

			 ?>

		      <input type="text" class="form-control" id="" placeholder="" value="<?php echo $sumwork ?>" name="sum_work" readonly>
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
		$year_id = $y.$loop;
			
			$reS=mysqli_query($con,"SELECT *FROM absence WHERE staff='$_SESSION[user_id]'  AND year_id='$year_id' ")or die(mysqli_error($con));
			$idl=mysqli_fetch_assoc($reS);

			// print_r($idl);
			// echo $y_id;
			if(empty($idl)){
				echo "<p style='color:red;' align='center'>เจ้าหน้าที่ยังไม่ได้กรอกข้อมูล</p>";
			// 	echo "<div align='center'><a href='javascript:void(0)'><button type='button' id='add' data-toggle='modal'>กรอกข้อมูล</button></a><div><br>";
			 ?>
			<!-- <div align='center'><a href="javascript:void(0)"><button type="button" class="btn" id="addbrn"  ><i class="fas fa-plus"></i>&nbsp;ขอข้อมูลจากเจ้าน้าที่</button></a></div><br> -->
			<?php	
			}else{
				include("idl.php");
			}
			
		?>
		<div id="loadaddsub"></div> 
	</div>
</div>

<div class="row ">
	<div class="col-md">
	<p>๔. การกระทำผิดวินัย/การถูกลงโทษ</p>
	</div>
</div>

<div class="row ">
	<div class="col-md">
		<textarea class="form-control" rows=4 name="punishment" required><?php echo  $punishment  ?></textarea>
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
