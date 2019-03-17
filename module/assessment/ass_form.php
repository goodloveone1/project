<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();

  
	$seaca=mysqli_query($con,"SELECT st_id,acadeic,prefix,fname,lname,position,branch_id,salary,startdate,leves,aca_code,other FROM staffs WHERE st_id='$_SESSION[user_id]'")or die("SQL_ERROR".mysqli_error($con));
	list($staff_id,$gen_acadeic,$gen_prefix,$gen_fname,$gen_lname,$gen_pos,$branch_id,$gen_salary,$gen_startdate,$leves,$aca_code,$other)=mysqli_fetch_row($seaca);
	$seacaName=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$gen_acadeic'")or die("SQL_ERROR".mysqli_error($con));
	list($acaName)=mysqli_fetch_row($seacaName);
	
	$seBrench=mysqli_query($con,"SELECT br_name,dept_id FROM branchs WHERE br_id='$branch_id'")or die("SQL_ERROR".mysqli_error($con));
	list($branchName,$dept_id)=mysqli_fetch_row($seBrench);

	$seDept=mysqli_query($con,"SELECT dept_name FROM departments WHERE dept_id='$dept_id'")or die("DeptError".mysqli_error($con));
	list($dept_name)=mysqli_fetch_row($seDept);


	mysqli_free_result($seaca);
	mysqli_free_result($seacaName);
	mysqli_free_result($seBrench);

	$yearIdpost = $_POST['year'];
	$TOR_id = $_POST['tor'];
	$_SESSION['yearIdpost']=$yearIdpost;
	$_SESSION['pre_id']=$TOR_id;

	// echo $_SESSION['pre_id'];
  // echo	$_SESSION['yearIdpost'];
	// echo $yearIdpost,"--->",$TOR_id;
?>
<form method="POST" id="addtor"  class="p-2" >  
    <div class="row">
				<span class="step step-color">TOR</span> &nbsp;
						<a href="javascript:void(0)"><span class="step step-normal" data-modules="assessment" data-action="tor_t1">ส่วนที่ 1</span></a>&nbsp;
				<a href=#><span class="step step-normal">ส่วนที่ 2</span></a> &nbsp;
				<a href=#><span class="step step-normal">ส่วนที่ 3</span></a> &nbsp;
				<a href=#><span class="step step-normal">ส่วนที่ 4</span></a> &nbsp;
				<a href=#><span class="step step-normal">ส่วนที่ 5</span></a> &nbsp;
				<a href="#"><span class="step step-normal">ส่วนที่ 6</span></a> &nbsp;
				<br>
			</div>
	<div class="row" >
		<div class="col-md">
		<br>
			<h5 class="text-center">ข้อตกลงและแบบประเมินผลการปฏิบัติงานของข้าราชการพลเรือนในสถาบันอุดมศึกษา สายวิชาการ(ตำแหน่ง <?php echo $acaName ?>) สังกัดมหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</h5>
		</div>
		<div class="col-md-2 text-center p-2" style="border:solid 1px " >
			<u>ตัวชี้วัด – <?php echo $acaName ?></u><br>
			<u>เอกสารหมายเลข 2</u>
		</div>
    </div>
  
	<br><br>
	<div class="row text-center" >
		<div class="col-md "> <!--ประจำปี งบประมาณ -->
		
		<div class="form-group row">
			<label for="" class="col-sm-3 col-form-label">ประจำปี งบประมาณ</label>
			<div class="col-sm-3">
			<?php $se_year=mysqli_query($con,"SELECT y_year,y_no,y_start,y_end FROM years WHERE y_id='$_POST[year]'")or die("SQLerror.Year".mysqli_error($con));
					list($y_year,$y_no,$y_start,$y_end)=mysqli_fetch_row($se_year);
					// echo $y_year,$y_no,$y_start,$y_end;
					mysqli_free_result($se_year);
				?>
		
						<input type="text" name="YearB" value="<?php echo $y_year+543;  ?>" class="form-control" readonly>
			</div>
			<div class="col-sm-5">
			<input type="text" name="y_id" value="<?php  echo "รอบที่",$y_no," ( ",DateThai($y_start),"-",DateThai($y_end) ?>" class="form-control" readonly>
			<input type="hidden" name="a_no" value="<?php echo $_POST['year'] ?>">
			</div>
		</div>
	</div>
</div>

<div class="row text-center">
<div class="col-md">
	<div class="form-group row">
		<label  class="col-sm-2 col-form-label">ชื่อผู้รับการประเมิน</label>
		<div class="col-sm">
			<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo "$gen_prefix $gen_fname $gen_lname"; ?>" name="name" required readonly>
			
		</div>
		<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
		<div class="col-sm">
		<select class="form-control" name="g_pos" disabled>
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
			<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $branchName?>" name="dept" readonly>
		</div>
	</div>
</div>
</div>
<div class="row text-center">
<div class="col-md">
	<div class="form-group row">
	<?php  //ผู้บังคบบัญชา
						$led_name = "";
						if($gen_pos == 1){ 	//อาจารย์
							// ผู้บังคับบัญชา	(หัวหน้าหลักสูตร)
							$led_pos = "2";
							$re_leader = mysqli_query($con,"SELECT st_id,fname,lname,position FROM staffs WHERE position='$led_pos' AND branch_id='$branch_id'") or die("lead_nameERR".mysqli_error($con));
							
							//ผู้บังคับบัญชาเหนือขึ้นไป(หัวหน้าสาขา)
								$re_hleader = mysqli_query($con,
								"SELECT  staffs.st_id,staffs.fname,staffs.lname,staffs.branch_id,branchs.dept_id
								FROM staffs
								INNER JOIN branchs ON staffs.branch_id = branchs.br_id
								WHERE branchs.dept_id = '$_SESSION[department]' AND staffs.position='3'") 
								or die("lead_nameERR".mysqli_error($con));
								list($hleader_id,$htfname,$htlname,$htbranch_id,$htdept_id)=mysqli_fetch_row($re_hleader);
								mysqli_free_result($re_hleader);
									//ผู้บังคับบัญชาเหนือขึ้นไปอีก(หัวหน้าคณะ)
									$re_stleader = mysqli_query($con,
									"SELECT st_id,fname,lname,position 
									FROM staffs 
									WHERE position='4'") or die("stlead_nameERR".mysqli_error($con));
									list($stleader_id,$stfname,$stlname,$stposition )=mysqli_fetch_row($re_stleader);
									mysqli_free_result($re_stleader);
						}
						else if($gen_pos == 2){//หัวหน้าหลักสูตร
							// ผู้บังคับบัญชา	(หัวหน้าสาขา)
							$led_pos = "3";
							$re_leader = mysqli_query($con,
							"SELECT  staffs.st_id,staffs.fname,staffs.lname,branchs.dept_id,staffs.picture
							FROM staffs
							INNER JOIN branchs ON staffs.branch_id = branchs.br_id
							WHERE staffs.position = '$led_pos'AND  branchs.dept_id ='$dept_id'") or die("lead_nameERR".mysqli_error($con));
							//ผู้บังคับบัญชาเหนือขึ้นไป(หัวหน้าคณะ)

							$re_stleader = mysqli_query($con,
							"SELECT st_id,fname,lname,position 
							FROM staffs 
							WHERE position='4'") or die("stlead_nameERR".mysqli_error($con));
							list($hleader_id,$hlfname,$hllname,$hlposition )=mysqli_fetch_row($re_stleader);
							mysqli_free_result($re_stleader);
							//ผู้บังคับบัญชาเหนือขึ้นไปอีก(ไม่มี)
							$stleader_id="";
						}
						else if($gen_pos ==3){//หัวหน้าสาขา
								// ผู้บังคับบัญชา (หัวหน้าคณะ)
								$re_leader =mysqli_query($con,
								"SELECT st_id,fname,lname,position
								FROM staffs
								WHERE position = '4'
								") or die("SQLerror".mysqli_error($con));
							//ผู้บังคับบัญชาเหนือขึ้นไป
							$hleader_id="";
							//ผู้บังคับบัญชาเหนือขึ้นไปอีก
							$stleader_id="";
						}
						else {  //หัวหน้าคณะ
							// ผู้บังคับบัญชา	(หัวหน้าสาขา)

							$led_pos = "4";
							$re_leader = mysqli_query($con,"SELECT st_id,fname,lname,position FROM staffs WHERE position='$led_pos'") or die("lead_nameERR".mysqli_error($con));
							$hleader_id="";
							$stleader_id="";
						}
						
						list($leader_id,$led_fname,$led_lname,$led_post)=mysqli_fetch_row($re_leader);
						// list($hleader_id,$hled_fname,$hled_lname,$hled_post)=mysqli_fetch_row($re_hleader);
						// echo $hleader_id,$hled_fname,$hled_lname,$hled_post;

						
		?>
		<label  class="col-sm-3 col-form-label ">ชื่อผู้บังคับบัญชา /ผู้ประเมิน </label>
		
		<div class="col-sm">
			<input type="text" class="form-control" id="inputEmail3" placeholder="" name="" value="<?php echo $led_fname," ",$led_lname; ?>" required readonly>
			<input type="hidden" name="leader_id" value="<?php echo $leader_id ?>">
			<input type="hidden" name="hleader_id" value="<?php echo $hleader_id ?>">
			<input type="hidden" name="stleader_id" value="<?php echo $stleader_id?>">
			<input type="hidden" name="staff_id" value="<?php  echo $staff_id  ?>" >
			<input type="hidden" name="pre" value="<?php echo $TOR_id;?>" >
		</div>
		<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
		<div class="col-sm">
		<select class="form-control" name="l_pos" disabled >
		<?php 
			$seaPos=mysqli_query($con,"SELECT pos_id,pos_name FROM position")or die("SQL_ERROR".mysqli_error($con));
			while(list( $pos_id,$pos_name)=mysqli_fetch_row($seaPos)){
			$select=$pos_id==$led_post?"selected":"";
			echo "<option value=$pos_id $select>$pos_name</option>";
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
		      <input type="text" class="form-control" id="inputEmail3" value="คณะ<?php echo $dept_name   ?>" placeholder="" required readonly>
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
		      <input type="text" class="form-control" id="" placeholder="" value="<?php echo "$gen_prefix $gen_fname $gen_lname"; ?>" required readonly>
		    </div>
			<label  class="col-sm-2 col-form-label">ประเภทตำแหน่งวิชาการ </label>
		 	<div class="col-sm">
		      <!-- <input type="text" class="form-control" id="" placeholder=""> -->
			  <select class="form-control" name="g_aca" disabled>
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
			  <select class="form-control" name="" disabled>
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
		      <input type="text" class="form-control" id="" placeholder="" value="<?php echo $gen_salary  ?>" name="salary" required readonly>
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
		      <input type="text" class="form-control" id="" placeholder="" name="acd_no" value="<?php echo$aca_code ?>"  readonly>
		    </div>
			<label  class="col-sm-1 col-form-label">สังกัด </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="" value="<?php echo $branchName?>" readonly>
		    </div>    
	</div>
	</div>	
</div>
<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-3 col-form-label"> มาช่วยราชการจากที่ใด (ถ้ามี) </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="" name="leves" value="<?php echo $leves  ?>"  readonly>
		    </div>
			<label  class="col-sm-2 col-form-label">หน้าที่พิเศษ </label>
		 	<div class="col-sm">
		      <input type="text" class="form-control" id="" placeholder="" name="other" value="<?php echo $other?>" readonly>
		    </div>    
	</div>
	</div>	
</div>
<div class="row ">
	<div class="col-md">
	<div class="form-group row">
		 	<label  class="col-sm-3 col-form-label"> ๒. เริ่มรับราชการเมื่อวันที่ </label>
		 	<div class="col-sm">
		      <input type="text"   class="form-control" id="datethai" placeholder="" value="<?php echo DateThai($gen_startdate)?>" name="" readonly>
			  <input type="hidden"   class="form-control" id="datethai" placeholder="" value="<?php echo $gen_startdate?>" name="st_work" readonly>
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
<!-- <div class="row">
	<div class="col-md-2"></div>
	<div class="col-md">
		 <div class="form-group row">
		 	<label  class="col-sm-1 col-form-label"> ลงชื่อ</label>
		 	<div class="col-sm-5">
		      <input type="text" class="form-control" id="inputEmail3" placeholder="" name="inspector" required>
		    </div>
			<label  class="col-sm col-form-label">ผู้ปฏิบัติหน้าที่ตรวจสอบการมาปฏิบัติราชการของหน่วยงาน </label>
		</div>
	<div class="col-md-2"></div>
</div>
</div> -->

<div class="row ">
	<div class="col-md">
	<p>๔. การกระทำผิดวินัย/การถูกลงโทษ</p>
	</div>	
</div>

<div class="row ">
	<div class="col-md">
		<textarea class="form-control" rows=4 name="punishment" required></textarea>
	</div>	
</div>
<br>
<div class="row">
	<div class="col-md-12 text-center mb-2" >
	<button type="submit" class="btn updateuser bg-success text-white" data-modules="assessment" data-action="addtata_ass"> ต่อไป </button>
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

$("#addtor").submit(function(e){
		      e.preventDefault();
				$check = $("#addtor").valid();
				if($check == true){
				var formData = new FormData(this);
					    $.ajax({
					        url: "module/assessment/addtata_ass.php",
					        type: 'POST',
					        data: formData,
					        success: function (data) {
					            alert(data);
								$.post( "module/assessment/ass_t1.php", {tor: "<?php echo $TOR_id ?>", year: "<?php echo $yearIdpost  ?>"}).done(function( data ) 
							{
    							//alert( "Data Loaded: " + data );
								sessionStorage.setItem("module1","assessment");
								sessionStorage.setItem("action","ass_t1");
								$("#detail").html(data);
  							});
					        },
					        cache: false,
					        contentType: false,
					        processData: false
					    })
				}
				
			})

		});
</script>
