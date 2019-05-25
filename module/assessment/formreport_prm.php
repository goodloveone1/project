<?php
session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();

$gen=  mysqli_query($con,"SELECT (SELECT aca_name FROM academic WHERE aca_id=staffs.acadeic) FROM staffs  WHERE st_id='$_SESSION[user_id]' ") or  die("SQL Error1==>1".mysqli_error($con));
list($aca_name)=mysqli_fetch_row($gen);

$ass_id = empty($_POST['torid'])?"":$_POST['torid'];
if(empty($ass_id)){
	echo "<script> 
	    alert('!!!!!');
	loadmain('assessment','manage_Evidence') 
		</script>";
}

$tor=  mysqli_query($con,"SELECT year_id FROM assessments  WHERE ass_id='$ass_id' ") or  die("SQL Error1==>2".mysqli_error($con));
list($tor_year)=mysqli_fetch_row($tor);
?>

<form class="p-2" id='fmreport'  method="POST"  enctype="multipart/form-data">
<input type='hidden' name="ass_id" value='<?php echo $ass_id ?>'>
	<div class="row">
		<div class="col-sm-2"> <button type='button' class='btn  menuuser bg-secondary text-light' data-modules="assessment" data-action="manage_Evidence">ย้อนกลับ </button></div>
		<div class="col-sm pt-2 text-center">
			<h5>แบบรายงานผลการปฏิบัติงาน ของบุคลากรสายวิชาการ</h5>
		</div>
		<div class="col-sm-2 text-center pt-2" style="border:solid 1px;">
			<p>สายวิชาการ (ทุกราย)</p>
		</div>
	</div>
	<br>
	<div class="row text-center">
		<div class="col-md-2"></div>
		<div class="col-md">
			<div class="form-group row">
				<label  class="col-sm-1 col-form-label">ชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" name="name" value="<?php echo $_SESSION['user_fnaem']." ".$_SESSION['user_lnaem'] ?>" id="" placeholder="" readonly>
				</div>
				<label  class="col-sm-1 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<input type="text" class="form-control" value="<?php echo $aca_name ?>" id="" placeholder="" readonly>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm pt-2 text-center">
			<p>สังกัด คณะบริหารธุรกิจและศิลปศาสตร์ มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</p>
		</div>
		<div class="col-sm-2"></div>
	</div>

<?php

$sY_No=mysqli_query($con,"SELECT y_id,y_no,y_start,y_end FROM years WHERE y_id='$tor_year'")or die(mysqli_error($con));
list($y_id,$y_no,$y_s,$y_e)=mysqli_fetch_row($sY_No);
	$m=DATE('m');
	if($m<=9 && $m>3){
		$sy_no= 2;
	}else{
		$sy_no= 1;
	}

 $yeardatail = "รอบที่ ". $y_no ." (". DateThai($y_s)." - ".DateThai($y_e).")";
 ?>


	<div class="row">
		<div class="col-md-3"></div>
			<div class="form-group col-md">
					<input type="text" class="form-control text-center" name="name" value="<?php echo  $yeardatail ?>" id="" placeholder="" readonly>
			</div>
		<div class="col-md-3"></div>
	</div>

	<div class="row">
		<div class="col-md">
				<table class="table table-bordered">
					<thead class="thead-light">
						<tr class="text-center">
							<th rowspan='2'>ลำดับ <br><br></th>
							<th rowspan='2'class=''>องค์ประกอบที่ใช้ประเมิน <br><br></th>

							<th class='' colspan='2'>หลักฐาน  ร่อยรอย การปฏิบัติงาน</th>

						</tr>
						<tr class="text-center">
							<th class='w-25'>ข้อความ</th>
							<th class='w-25'>ไฟล์หลักฐาน</th>

						</tr>
					</thead>
					<tbody>
						<?php 
								$countfile=1;
								$ev=  mysqli_query($con,"SELECT e_id,e_name, (SELECT count(se_id) FROM sub_evaluation as sev where sev.e_id = ev.e_id ) FROM evaluation as ev ") or  die("SQL Error1==>1".mysqli_error($con));
								while(list($e_id,$e_name,$count)=mysqli_fetch_row($ev)){
						?>
						<tr>
							<td rowspan="<?php echo $count+1 ?>"> <?php echo $e_id ?> </td>
							<td ><?php echo $e_id.". ".$e_name ?>    </td>
							<td></td>

						</tr>
						<?php
									$sev=  mysqli_query($con,"SELECT se_id,se_name FROM sub_evaluation WHERE e_id='$e_id' ") or  die("SQL Error1==>1".mysqli_error($con));
									while(list($sub_id,$sub_name)=mysqli_fetch_row($sev)){					
										echo "<tr>";
										echo	"<td >  $sub_name </td>";
										echo "<td ><div class='form-group'>
										<textarea class='form-control' rows='3' name='text[]'></textarea>
									  </div></td >";
										echo	"<td class='text-center'> 
										<select class='custom-select selfile' data-countfile='$countfile' data-subid='$sub_id'>
											<option value='1' selected >อัปโหลดไฟล์แบบกลุ่ม</option>
											<option value='2' >อัปโหลดไฟล์ทีละไฟล์ </option>
										</select>
										<input type='hidden'  name='se_id[]' value='$sub_id'>
										<div id='fileupload$countfile'></div>		
										</td>";
										echo "</tr>";
										$countfile++;

									}
								}	
						?>
					</tbody>
				</table>
		</div>
	</div>
	<br>
	<!-- <div class="row">
		<div class="col-sm text-center">ข้าพเจ้าขอรับรองว่าได้ปฏิบัติงานตามที่รายงานผลการปฏิบัติงานจริง  หากต่อมาภายหลังตรวจสอบแล้วว่าไม่เป็นความจริง  ข้าพเจ้าจะเป็นผู้รับผิดชอบ
		ทุกประการ
		</div>
   	</div>
   	<br>
   	<div class="row">
		<div class="col-sm-6"></div>
		<div class="col-sm text-center">
			<p>ลงชื่อผู้รายงานผลปฏิบัติงาน</p>

			<p><?php echo $_SESSION['user_fnaem']." ".$_SESSION['user_lnaem'] ?></p>
			<p>(                                           )</p>
								

			<p>วันที่ <?php echo date("j") ?> เดือน <?php echo date("n") ?> พ.ศ. <?php echo (date("Y")+543) ?> </p>
		</div>
		<div class="col-sm-1"></div>
   	</div>

   	<div class="row">
   		<div class="col-sm text-center">
			<p>   ผู้บังคับบัญชาได้พิจารณาแล้วให้การรับรอง</p>
			<p>ลงชื่อ </p>
			<p>(              )</p>
			<p> ตำแหน่ง </p>
			<p>วันที่ เดือน  พ.ศ. </p>
		</div>
		<div class="col-sm-6"></div>
   	</div>
		  -->
<div class="row">
	<div class='col text-center'>
	<button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
	</div>
</div>

</form>

<script>
$( document ).ready(function() {

	
		$.validator.addMethod('filesize', function (value, element, param) {
			// alert( element.files.length)
			 var count = element.files.length;
			 var check;
			 if(count != 0){
				for(var i=0;i < count ;i++){
					if(this.optional(element) || (element.files[i].size <= param)){
						check = true;
					}else{
						check = false;
						break;
					}
				}
			 }else{
				check = true;
			 }	
			 return check
		}, jQuery.validator.format("ไฟล์เกินกำหนด 2 MB") );
		

	jQuery.validator.addClassRules("filecheck", {
		extension: "pdf|doc|png|jpg|docx|rar|zip|xlsx|xls",
		filesize : 2000000, // MAX 2 MB
	});

	//var filemuti = jQuery.trim("<div class='form-group'><small id='fileHelpInline' class='form-text text-muted '>**อัปโหลดเฉพาะไฟล์ PDF DOC DOCX PNG JPG เท่านั้น และ ขนาดไม่เกิน 2 MB</small><input type='file' class='form-control-file filecheck' name='fileimg".$countfile."[]'  multiple aria-describedby='fileHelpInline'></div><input type='hidden'  name='se_id[]' value='$sub_id'></div>");
	

	firthload()
 function firthload(){
	$(".selfile").each(function(){
		
		var filemuti = jQuery.trim("<div class='form-group'><small id='fileHelpInline' class='form-text text-muted '>**อัปโหลดเฉพาะไฟล์ PDF DOC DOCX PNG JPG RAR ZIP XLSX XLS เท่านั้น และ ขนาดไม่เกิน 2 MB</small><input type='file' class='form-control-file filecheck' name='fileimg"+ $(this,"option:selected").data("countfile") +"[]'  multiple aria-describedby='fileHelpInline'></div>");
		var fileupload = "#fileupload"+$(this,"option:selected").data("countfile")

		$(fileupload).html(filemuti);

	})

 }


	$(".selfile").change(function(){

	//	alert($(this,"option:selected").val())
	//	alert($(this,"option:selected").data("countfile"))
 
		if($(this,"option:selected").val()==1){
		
			var filemuti = jQuery.trim("<div class='form-group'><small id='fileHelpInline' class='form-text text-muted '>**อัปโหลดเฉพาะไฟล์ PDF DOC DOCX PNG JPG RAR ZIP XLSX XLS เท่านั้น และ ขนาดไม่เกิน 2 MB</small><input type='file' class='form-control-file filecheck' name='fileimg"+ $(this,"option:selected").data("countfile") +"[]'  multiple aria-describedby='fileHelpInline'></div>");
			var fileupload = "#fileupload"+$(this,"option:selected").data("countfile")
		//	alert(fileupload)
			$(fileupload).html(filemuti);

		}else{
			var filemuti = "<div class='form-group'><small id='fileHelpInline' class='form-text text-muted '>**อัปโหลดเฉพาะไฟล์ PDF DOC DOCX PNG JPG RAR ZIP XLSX XLS เท่านั้น และ ขนาดไม่เกิน 2 MB</small>"
			filemuti += "<input type='file' value='อัฟไฟล์' class='form-control-file filecheck' name='fileimg2"+$(this,"option:selected").data("subid")+"1'   aria-describedby='fileHelpInline'>"
			filemuti += "<input type='file'  class='form-control-file filecheck' name='fileimg2"+$(this,"option:selected").data("subid")+"2'   aria-describedby='fileHelpInline'>"
			filemuti += "<input type='file' class='form-control-file filecheck' name='fileimg2"+$(this,"option:selected").data("subid")+"3'   aria-describedby='fileHelpInline'>"
			filemuti += "<input type='file' class='form-control-file filecheck' name='fileimg2"+$(this,"option:selected").data("subid")+"4'   aria-describedby='fileHelpInline'>"
			filemuti += "<input type='file' class='form-control-file filecheck' name='fileimg2"+$(this,"option:selected").data("subid")+"5'   aria-describedby='fileHelpInline'>"
			var fileupload = "#fileupload"+$(this,"option:selected").data("countfile")
		//	alert(fileupload)
			$(fileupload).html(filemuti);
		}

	})


	$vform = $( "#fmreport");
	$vform.validate();

	$( "#fmreport" ).submit(function(e){
		e.preventDefault() 

			if($vform.valid()){
				$conf = confirm("คุณต้องการบันทึกข้อมูลใช่ไหม?");
				if($conf==true){
					var formData = new FormData(this);

						$.ajax({
							url: "module/assessment/addevidence.php",
							type: 'POST',
							data: formData,
							success: function (data) {
							},
							cache: false,
							contentType: false,
							processData: false
						}).done(function(data) {

							alert(data)
						loadingpage("assessment","manage_Evidence");
						//	$("#detail").html(data);

						})
		}
	}
	
	});

});
</script>


<?php
	mysqli_close($con);
?>
