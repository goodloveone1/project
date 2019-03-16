<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();
	//$yeartest=chk_idtest();
	if(empty($_POST['genid']) && empty($_POST['year']) ){
		$genIdpost=$_SESSION['genIdpost'];
		$yearIdpost=$_SESSION['yearIdpost'];

	}else{
		$genIdpost = $_POST['genid'];
		$yearIdpost = $_POST['year'];
	}
	$sqlyesr="SELECT ass_id,hleader,sleader FROM assessments WHERE staff ='$genIdpost'AND year_id='$yearIdpost'";
	$reChk = mysqli_query($con,"$sqlyesr") or die("torChk".mysqli_error($con));
	list($tor_ID,$hleader,$sleader)=mysqli_fetch_row($reChk);

	$sql="SELECT  prefix,lname,fname,position FROM staffs WHERE st_id ='$genIdpost'";
	$genchk= mysqli_query($con,$sql) or die ("gen_chk".mysqli_error($con));
	list($tle_g,$g_lname,$g_fname,$g_pos)=mysqli_fetch_row($genchk);

	mysqli_free_result($genchk);
	?>
<form class="p-2"> 
<div class="row">
	    <span class="step  step-normal ">ข้อตกลง</span> &nbsp;
      <a href="javascript:void(0)"><span class="step step-normal ">ส่วนที่ 1</span></a>&nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 2</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 3</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 4</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 5</span></a> &nbsp; 
		 <a href=#><span class="step step-color">ส่วนที่ 6</span></a> &nbsp;
		 <br>
</div>
<div class="row">
	<div class="col-md">&nbsp;
		<p><b><u>ส่วนที่ ๖  ความเห็นของผู้บังคับบัญชาเหนือขึ้นไป</u></b></p>
	</div>
</div>

<div class="row">
	<div class="col-md-6 border border-dark p-3">
		<p>ผู้บังคับบัญชาเหนือขึ้นไป</p>
		<div class="custom-control custom-radio">
			  <input class="custom-control-input" type="radio" value="0" id="customRadio1" name="customRadio" checked>
			  <label class="custom-control-label" for="customRadio1">
			    เห็นด้วยผลการประเมิน

			  </label>
		</div>
		<div class="custom-control custom-radio">
			  <input class="custom-control-input" type="radio" value="1" id="customRadio2" name="customRadio">
			  <label class="custom-control-label" for="customRadio2">
			    มีความเห็นแตกต่าง  ดังนี้

			  </label>
		</div>
		<div class="form-group">
		    <textarea class="form-control" id="text1" rows="3" disabled required></textarea>
		 </div>

	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ลงชื่อ</label>
			
				<div class="col-sm">
				<?php
					 $sehleader=mysqli_query($con,"SELECT prefix,fname,lname,position FROM staffs WHERE st_id='$hleader'")or die("SQL.hleaderError".mysqli_error($con));
					 list($hl_prefix,$hl_name,$hl_fname,$hl_position)=mysqli_fetch_row($sehleader);
					 mysqli_free_result($sehleader);
				?>
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $hl_prefix,$hl_name," ",$hl_fname   ?>">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
				<?php
						$se_hlpostion = mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id ='$hl_position'") or die("SQL.posHL_ERRor".mysqli_error($con));
						list($hl_posName)=mysqli_fetch_row($se_hlpostion);

				?>
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $hl_posName  ?>">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
				<?php $date= date("Y/m/d")  ?>
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php  echo  DateThai($date)    ?>" >
				</div>				
		</div>
	</div>
	<!-- ผู้ประเมิน : -->
	<div class="col-md-6 border border-dark p-3">
		<p>ผู้บังคับบัญชาเหนือขึ้นไปอีกชั้นหนึ่ง  (ถ้ามี)</p>
		<div class="custom-control custom-radio">
			  <input class="custom-control-input" type="radio" value="0" id="customRadio3" name="uagree" checked>
			  <label class="custom-control-label" for="customRadio3">
			    เห็นด้วยผลการประเมิน

			  </label>
		</div>
		<div class="custom-control custom-radio">
			  <input class="custom-control-input" type="radio" value="1" id="customRadio4" name="uagree">
			  <label class="custom-control-label" for="customRadio4">
			    มีความเห็นแตกต่าง  ดังนี้
			  </label>
		</div>
		<div class="form-group">
		    <textarea class="form-control" id="text2" rows="3" disabled required></textarea>
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
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="">
				</div>				
		</div>
	</div>
</div>				
</form>
<br>
<div class="row">
	<div class="col-md-12 text-center mb-2" >
		<!-- <p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t6"><input type="submit" class="next" value="ต่อไป"></a> </p> -->
		<button type="submit" class="btn " data-modules="assessment" data-action="tor_t6"> ต่อไป </button>
	</div>
</div>

<script type="text/javascript">
 	$(document).ready(function() {
			$("a.next").click(function(){
				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				loadmain(module1,action)
			});
			$('#customRadio1').click(function() {
					if ($(this).is(':checked')) {
						$("#text1").prop('disabled', true);
						$('#text1').val("");
					}
			});
			$('#customRadio2').click(function() {
				if ($(this).is(':checked')) {
					$("#text1").prop('disabled', false);
				}
			});

			$('#customRadio3').click(function() {
					if ($(this).is(':checked')) {
						$("#text2").prop('disabled', true);
						$('#text2').val("");
					}
			});
			$('#customRadio4').click(function() {
				if ($(this).is(':checked')) {
					$("#text2").prop('disabled', false);
				}
			});
  
	});
	


</script>

<?php
mysqli_close($con);
?>