<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();
	$yeartest=chk_idtest();

	$sqlyesr="SELECT tor_id FROM tor WHERE gen_id ='$_SESSION[user_id]'AND tor_year='$yeartest'";
	$reChk = mysqli_query($con,"$sqlyesr") or die("torChk".mysqli_error($con));
	list($tor_ID)=mysqli_fetch_row($reChk);


	$sql="SELECT  gen_prefix,gen_lname,gen_fname,gen_pos FROM general WHERE gen_id ='$_SESSION[user_id]'";
	$genchk= mysqli_query($con,$sql) or die ("gen_chk".mysqli_error($con));
	list($tle_g,$g_lname,$g_fname,$g_pos)=mysqli_fetch_row($genchk);
	//echo $gen_prefix,$gen_lname,$gen_fname,$gen_pos;
$date = date("Y/m/d");
?>

<form class="p-2" name="tort5" id="tort5"> 
<input type="hidden" name="tor_id" value="<?php echo $tor_ID  ?>">
<div class="row">
	    <span class="step  step-normal ">ข้อตกลง</span> &nbsp;
      <a href="javascript:void(0)"><span class="step step-normal ">ส่วนที่ 1</span></a>&nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 2</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 3</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 4</span></a> &nbsp; 
		 <a href=#><span class="step step-color">ส่วนที่ 5</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 6</span></a> &nbsp;
		 <br>
</div>
<div class="row">
	<div class="col-md">&nbsp;
		<p><b><u>ส่วนที่ ๕  การรับทราบผลการประเมิน</u></b></p>
	</div>
</div>

<div class="row">
	<div class="col-md-6 border border-dark p-3">
		<p>ผู้รับการประเมิน :</p>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="ac">
			  <label class="form-check-label" for="defaultCheck1">
			    รับทราบผลการประเมินและแผนพัฒนา การปฏิบัติราชการรายบุคคลแล้ว

			  </label>
		</div>

	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ลงชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="" name="uname">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="" name="upos">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value=""  name="udate" readonly >
					<input type="hidden" name="usdate" value="<?php  echo  $date; ?>">
				</div>				
		</div>
	</div>
	<!-- ผู้ประเมิน : -->
	<div class="col-md-6 border border-dark p-3">
		<p>ผู้ประเมิน : :</p>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" vlue="1" name="tappcetp" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			   แจ้งผลการประเมิน
			  </label>
		</div>
		<!-- <div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			   ได้แจ้งผลการประเมินเมื่อวันที่.............................................
      			แต่ผู้รับการประเมินไม่ลงนามรับทราบผลการ
     			ประเมินโดยมี………………..........เป็นพยาน


			  </label>
		</div> -->

	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ลงชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $tle_g,$g_lname,"  ",$g_fname; ?>" name="sname">
				</div>				
		</div>
		<div class="form-group row">
				<?php     
					$sqlspos ="SELECT pos_name FROM position WHERE pos_id='$g_pos'";
					$sespos=mysqli_query($con,$sqlspos) or die("sePos".mysqli_error($con));
					list($sname_pos)=mysqli_fetch_row($sespos);	
				?>
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>

				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $sname_pos?>" name="t_pos">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
			
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo DateThai($date)?>" name="" readonly>
					<input type="hidden" value="<?php echo $date;  ?>" name="tdate">
				</div>				
		</div>
	</div>

</div>

<br>



<div class="row">
	<div class="col-md-12 text-center mb-2" >
		<!-- <p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t6"><input type="submit" class="next" value="ต่อไป"></a> </p> -->
		<button type="submit" class="btn " data-modules="assessment" data-action="adddata_tor5"> ต่อไป </button>
	</div>
</div>
</form>	



<script type="text/javascript">



 	$(document).ready(function() {
			$("a.next").click(function(){
				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				loadmain(module1,action)
			});

	});
	$("#tort5").submit(function(){
				$check = $("#tort5").valid();
				if($check == true){
				var formData = new FormData(this);
					    $.ajax({
					        url: "module/assessment/adddata_tor5.php",
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
				loadmain("assessment","tor_t5")
			})	

</script>