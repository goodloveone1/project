<?php
session_start();



$evdid = empty($_POST['evdid'])?"":$_POST['evdid'];

$checkshowfile = empty($_POST['checkshowfile'])?0:$_POST['checkshowfile']; // ส่งมาจาก loaddataInasm.php เพื่อดูไฟล์

if($checkshowfile == 1){
	$com = "<!--";
	$come = "-->";
	$tab = "<div class='col-sm-2'></div>";
}else{
	$com= "";
	$come= "";
	$tab = "";
}


if(!empty($evdid)){


	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();



$evd =  mysqli_query($con,"SELECT ass_id,st_id,st_date,comman_id,com_date,evd_status FROM evidence  WHERE evd_id='$evdid' ") or  die("SQL Error evd ==>2".mysqli_error($con));
list($ass_id,$st_id,$st_date,$comman_id,$com_date,$evd_status)=mysqli_fetch_row($evd);

$gen=  mysqli_query($con,"SELECT (SELECT aca_name FROM academic WHERE aca_id=staffs.acadeic),prefix,fname,lname FROM staffs WHERE st_id='$st_id' ") or  die("SQL Error gen==>1".mysqli_error($con));
list($aca_name,$prefix,$fname,$lname)=mysqli_fetch_row($gen);

if(!empty($comman_id)){
	$com=  mysqli_query($con,"SELECT prefix,fname,lname,(SELECT pos_name FROM position WHERE pos_id=staffs.position) FROM staffs WHERE st_id='$comman_id' ") or  die("SQL Error gen==>1".mysqli_error($con));
	list($prefixc,$fnamec,$lnamec,$pos_namec)=mysqli_fetch_row($com);
	mysqli_free_result($com);
}


$tor=  mysqli_query($con,"SELECT year_id FROM assessments  WHERE ass_id='$ass_id' ") or  die("SQL Error1==>tor".mysqli_error($con));
list($tor_year)=mysqli_fetch_row($tor);

mysqli_free_result($evd);
mysqli_free_result($gen);
mysqli_free_result($tor);

?>
	<div class="row pt-2">
	<?php
		echo $tab;
		echo $com;
		if($_SESSION['user_level']==2){
			echo	"<div class='col-sm-2'> <button type='button' class='btn  menuuser bg-secondary text-light' data-modules='assessment' data-action='manage_Evidence'>ย้อนกลับ </button></div>";
		}else if($_SESSION['user_level']==3){
			echo	"<div class='col-sm-2'> <button type='button' class='btn  menuuser bg-secondary text-light' data-modules='assessment' data-action='manage_Evidence_course'>ย้อนกลับ </button></div>";
		}else if($_SESSION['user_level']==4){
			echo	"<div class='col-sm-2'> <button type='button' class='btn  menuuser bg-secondary text-light' data-modules='assessment' data-action='manage_Evidence_course'>ย้อนกลับ </button></div>";
		}
		echo $come;
		
	?>
		<div class="col-sm pt-2 text-center">
			<h5>แสดงแบบรายงานผลการปฏิบัติงาน ของบุคลากรสายวิชาการ</h5>
		</div>
		<div class="col-sm-2 text-center" >
			<div class="text-wrap btn border border-dark">
				สายวิชาการ <br>(ทุกราย)
			</div>
		</div>
	</div>
	<br>
	<div class="row text-center">
		<div class="col-md-2"></div>
		<div class="col-md">
			<div class="form-group row">
				<label  class="col-sm-1 col-form-label">ชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" name="name" value="<?php echo $fname." ".$lname ?>" id="" placeholder="" readonly>
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
							<th rowspan='2'class='w-50'>องค์ประกอบที่ใช้ประเมิน <br><b></th>

							<th class='' colspan='2'>หลักฐาน  ร่อยรอย การปฏิบัติงาน</th>

						</tr>
						<tr class="text-center">
							<th class='w-25'>ข้อความ</th>
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
                                        
                                        $evd_text =  mysqli_query($con,"SELECT evd_text_id,evd_text_name FROM evidence_text WHERE se_id='$sub_id' AND evd_id='$evdid' ") or  die("SQL Error1==>1".mysqli_error($con));
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
											<div class='form-group textedit2' data-evdid='$evdid' data-seid='$sub_id'>
											<textarea class='form-control'  rows='3'  disabled>$evd_text_name </textarea>
											</div>
										
										</td >";	
									}
										echo 	"<td class='text-center'> ";
											if($checkshowfile == 1){
												echo   		"<table class='table table-striped'>";
												$evd_file =  mysqli_query($con,"SELECT evd_file_id,evd_file_name,evd_name_thai FROM evidence_file WHERE se_id='$sub_id' AND evd_id='$evdid' ") or  die("SQL Error1==>1".mysqli_error($con));
												$i=1;
												if($evd_file->num_rows != 0){
													while(list($evd_file_id,$evd_file_name,$evd_name_thai)=mysqli_fetch_row($evd_file)){
														echo  	"<tr><td> $i </td> <td><a href='file/$ass_id/$evd_file_name' target='_blank'>$evd_name_thai</a></td></tr> ";
														$i++;		
													}
												}else{
													echo  	"<tr><td class='text-center text-danger'> ไม่พบไฟล์หลักฐาน </td></tr> ";
												}	
												echo   "</table>";
												//echo			"<b class='fileedit' data-seid='$sub_id'><i class='fas fa-file fa-lg'></i> แสดงไฟล์ </b>";	
											}else{
												$evd_file =  mysqli_query($con,"SELECT count(evd_file_id) FROM evidence_file WHERE se_id='$sub_id' AND evd_id='$evdid' ") or  die("SQL Error1==>1".mysqli_error($con));
												list($countfileevd)=mysqli_fetch_row($evd_file);
												mysqli_free_result($evd_file);
												$countfileevd = empty($countfileevd)?"0":$countfileevd;
											   ?>
											   <button type="button" class="btn btn-info mt-4 fileedit" data-seid='<?php echo $sub_id ?>'>
											   <i class='fas fa-file fa-lg'></i> แสดงไฟล์ <span class="badge badge-pill badge-secondary"> <?php echo $countfileevd ?></span>
											   </button>
											   <?php
											   echo	"</td>";
											   echo "</tr>";
											   $countfile++;
											}									
									}
								}

						
						?>

					</tbody>
				</table>
		</div>
	</div>
	<br>
<?php 
	if ($evd_status != 3)
{
?>
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

			<p><?php echo "$prefix $fname $lname" ?></p>
			<p>( <?php echo "$fname $lname "?> )</p>
								

			<p>วันที่ <?php 
				$datethai = DateThai($st_date);
				$datethai = explode(" ",$datethai);

				echo $datethai[0]." เดือน ".$datethai[1]." พ.ศ ".$datethai[2];
			
			
				?> 
			</p>
		</div>
		<div class="col-sm-1"></div>
   	</div>
<!-- <form class="p-2" id='formstatus'  method="POST" >
	<div class="row">
	<div class='col-4'> </div>
		<div class='col'>
		<input type="hidden"  name='evdid' value='<?php echo $evdid ?>'>
		<input type="hidden"  name='stid' value='<?php echo $_SESSION['user_id'] ?>'>							
			<div class="custom-control custom-radio">
				<input type="radio" value='3' name="check2" class="custom-control-input" id="customRadio1" checked>
				<label class="custom-control-label" for="customRadio1" > ยืนยันหลักฐานถูกต้อง </label>
			</div>
			<div class="custom-control custom-radio">
				<input type="radio"  value='4' id="customRadio2" name="check2" class="custom-control-input">
				<label class="custom-control-label" for="customRadio2"> หลักฐานไม่ถูกต้อง </label>
			</div>
			<br>
			<button type="submit" class="btn btn-primary text-center" id="btnsubmit">ยืนยัน</button>		
		</div>
		<div class='col-3'> </div>
	<div>

</form> -->
<?php
} // END IF
else{
	//$prefixc,$fnamec,$lnamec 

	//$st_date,$comman_id,$com_date

	$stdate = explode(" ",DateThai($st_date));
	$comdate = explode(" ",DateThai($com_date));

	

?>
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

			<p><?php echo $prefix." ".$fname." ".$lname ?></p>
			<p>(  <?php echo  $fname." ".$lname ?>    )</p>
								
			<p>วันที่ <?php echo $stdate[0] ?> เดือน <?php echo $stdate[1] ?> พ.ศ. <?php echo $stdate[2] ?> </p>
		</div>
		<div class="col-sm-1"></div>
   	</div>

   	<div class="row">
   		<div class="col-sm text-center">
			<p>   ผู้บังคับบัญชาได้พิจารณาแล้วให้การรับรอง</p>
			<p>ลงชื่อ <?php echo $prefixc." ".$fnamec." ".$lnamec ?></p>
			<p>(   <?php echo $fnamec." ".$lnamec ?>   )</p>
			<p> ตำแหน่ง <?php echo $pos_namec ?></p>
			<p>วันที่ <?php echo $comdate[0] ?> เดือน <?php echo $comdate[1] ?> พ.ศ. <?php echo $comdate[2] ?> </p>
		</div>
		<div class="col-sm-6"></div>
   	</div>
		
<?php
} // END ELSE 
?>

<div id='loadedittext'></div>
<div id='loadeditfile'></div>

<script>
$( document ).ready(function() {

	


	$(".fileedit").click(function(e) {
		e.preventDefault(); 
        $.post("module/assessment/show_file_evd.php", { evdid : '<?php echo $evdid ?>' ,seid : $(this).data("seid") ,torid: "<?php echo $ass_id ?>" }).done(function(data){
            $('#loadeditfile').html(data);
                 $('#editfile').modal('show');
        })
	});


		
		$( "#formstatus" ).submit(function(e){
		e.preventDefault() 

				$conf = confirm("คุณต้องการยืนยันข้อมูลใช่ไหม?");
				if($conf==true){
					var formData = new FormData(this);

						$.ajax({
							url: "module/assessment/update_status_evd.php",
							type: 'POST',
							data: formData,
							success: function (data) {

                            alert(data)

							},
							cache: false,
							contentType: false,
							processData: false
						}).done(function(data) {

                           loadingpage("assessment","manage_Evidence_course");

						})
		}
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
