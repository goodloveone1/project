<?php
session_start();

$ass_id = empty($_POST['torid'])?"":$_POST['torid'];
$evd_id = empty($_POST['evdid'])?"":$_POST['evdid'];

if(!empty($ass_id) AND  !empty($ass_id)){


	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();

$gen=  mysqli_query($con,"SELECT (SELECT aca_name FROM academic WHERE aca_id=staffs.acadeic) FROM staffs  WHERE st_id='$_SESSION[user_id]' ") or  die("SQL Error1==>1".mysqli_error($con));
list($aca_name)=mysqli_fetch_row($gen);

$tor=  mysqli_query($con,"SELECT year_id FROM assessments  WHERE ass_id='$ass_id' ") or  die("SQL Error1==>2".mysqli_error($con));
list($tor_year)=mysqli_fetch_row($tor);

$evd=  mysqli_query($con,"SELECT year_id FROM assessments  WHERE ass_id='$ass_id' ") or  die("SQL Error1==>2".mysqli_error($con));
list($tor_year)=mysqli_fetch_row($tor);
?>

<style>

.fileedit {
		border-style: hidden;
		color:#6c757F;
		transition: 0.2s; /* Animation */
}
.fileedit:hover {
	color:#6c757F;
	border-bottom: dotted 1px;
	
}
</style>
	<div class="row">
		<div class="col-sm-2"> <button type='button' class='btn  menuuser bg-secondary text-light' data-modules="assessment" data-action="manage_Evidence">ย้อนกลับ </button></div>
		<div class="col-sm pt-2 text-center">
			<h5>ตรวจสอบ แบบรายงานผลการปฏิบัติงาน ของบุคลากรสายวิชาการ</h5>
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
							<th rowspan='2'class=''>องค์ประกอบที่ใช้ประเมิน <br><b></th>

							<th class='' colspan='2'>หลักฐาน  ร่อยรอย การปฏิบัติงาน</th>

						</tr>
						<tr class="text-center">
							<th class=''>ข้อความ</th>
							<th class=''>ไฟล์หลักฐาน</th>

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
							<td colspan='3'><?php echo $e_id.". ".$e_name ?>    </td>
							
						

						</tr>
						<?php
									$sev=  mysqli_query($con,"SELECT se_id,se_name FROM sub_evaluation WHERE e_id='$e_id' ") or  die("SQL Error1==>1".mysqli_error($con));
									while(list($sub_id,$sub_name)=mysqli_fetch_row($sev)){
                                        
                                        $evd_text =  mysqli_query($con,"SELECT evd_text_id,evd_text_name FROM evidence_text WHERE se_id='$sub_id' AND evd_id='$evd_id' ") or  die("SQL Error1==>1".mysqli_error($con));
                                        list($evd_text_id,$evd_text_name)=mysqli_fetch_row($evd_text) ;   

										echo "<tr>";
										echo	"<td >  $sub_name  </td>";

										if (!empty($evd_text_id)){
										echo "<td class='text-center'>
										<div class='form-group textedit' data-evdidtext='$evd_text_id' data-evdtext='$evd_text_name'>
										<textarea class='form-control'  rows='3'  disabled>$evd_text_name </textarea>
									  	</div>

										</td >";
									}else{
										echo "<td class='text-center'>
											<div class='form-group textedit2' data-evdid='$evd_id' data-seid='$sub_id'>
											<textarea class='form-control'  rows='3'  disabled>$evd_text_name </textarea>
											</div>
										
										</td >";	
									}
										echo 	"<td class='text-center'> ";
										echo   		"<table class='table table-striped'>";
										
										// $evd_file =  mysqli_query($con,"SELECT evd_file_id,evd_file_name FROM evidence_file WHERE se_id='$sub_id' AND evd_id='$evd_id' ") or  die("SQL Error1==>1".mysqli_error($con));
										// $i=1;
										// while(list($evd_file_id,$evd_file_name)=mysqli_fetch_row($evd_file)){
										// 	echo  	"<tr><td> $i </td> <td><a href='file/$ass_id/$evd_file_name' target='_blank'>$evd_file_name</a></td></tr> ";
										// 	$i++;		
										// }
										echo   		"</table>";
										echo			"<b class='fileedit' data-seid='$sub_id'><i class='fas fa-file fa-lg'></i> จัดการไฟล์ </b>";
										echo	"</td>";
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
	<div class="row">
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
       <form class="p-2" id='fmreport'  method="POST"  enctype="multipart/form-data">
<div class="row">
	<div class='col text-center'>
	<button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
	</div>
<div>

</form>

<div id='loadedittext'></div>
<div id='loadeditfile'></div>

<script>
$( document ).ready(function() {

	$(".textedit").click(function(e) {
		e.preventDefault(); 
		alert($(this).data("evdidtext"));
        $.post("module/assessment/edit_text_evd.php", { evdidtext : $(this).data("evdidtext") ,evdtext : $(this).data("evdtext"), evdid : <?php echo $evd_id ?>,torid: <?php echo $ass_id ?> } ).done(function(data){
            $('#loadedittext').html(data);
                 $('#edittext').modal('show');
        })
	});
	

	$(".textedit2").click(function(e) {
		e.preventDefault(); 
		alert($(this).data("evdid"));
        $.post("module/assessment/edit_text_evd.php", { evdid2 : <?php echo $evd_id ?> ,seid : $(this).data("seid") ,torid: <?php echo $ass_id ?> }).done(function(data){
            $('#loadedittext').html(data);
                 $('#edittext').modal('show');
        })
	});


	$(".fileedit").click(function(e) {
		e.preventDefault(); 
        $.post("module/assessment/edit_file_evd.php", { evdid : <?php echo $evd_id ?> ,seid : $(this).data("seid") ,torid: <?php echo $ass_id ?> }).done(function(data){
            $('#loadeditfile').html(data);
                 $('#editfile').modal('show');
        })
	});

});
</script>


<?php
	mysqli_close($con);



	

}else{
	echo "<script> 
	    alert('!!!!!');
		loadmain('assessment','manage_Evidence') 
		</script>";
} ///END IF $ass_id
?>
