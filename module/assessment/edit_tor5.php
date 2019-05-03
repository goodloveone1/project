<div class="row  p-2 headtitle">
	<h4 class="text-center col-md "> การประเมิน </h4>
</div>
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

 
    $select_tor=mysqli_query($con,"SELECT leader FROM assessments WHERE ass_id='$yearIdpost'") or die("SQL-error.SelectTor".mysqli_error($con));
    list($hleader)=mysqli_fetch_row($select_tor);
        //echo $hleader;
    mysqli_free_result($select_tor);
	$sql="SELECT  prefix,lname,fname,position FROM staffs WHERE st_id ='$genIdpost'";
	$genchk= mysqli_query($con,$sql) or die ("gen_chk".mysqli_error($con));
	list($tle_g,$g_lname,$g_fname,$g_pos)=mysqli_fetch_row($genchk);
	mysqli_free_result($genchk);
	//echo $gen_prefix,$gen_lname,$gen_fname,$gen_pos;
$date = date("Y/m/d");

$seAss5 =mysqli_query($con,
"SELECT asst5_id,accept,inform,date_accept,date_inform
FROM asessment_t5
WHERE ass_id='$yearIdpost' " )or die("SQL-error.asAss5".mysqli_error($con));
list($asst5_id,$accept,$inform,$date_accept,$date_inform)=mysqli_fetch_row($seAss5);

if($inform==1){
	$chk_inform = "checked";
}else{
	$chk_inform = "";
}
if($accept==1){
	$chk_accept = "checked";
}else{
	$chk_accept = "";
}
//echo $asst5_id,$accept,$inform,$date_accept,$date_inform;
?>

<form class="p-2" name="tort5" id="tort5"> 
<input type="hidden" name="tor_id" value="<?php echo $yearIdpost  ?>">
<input type="hidden" name="asst5_id" value="<?php echo $asst5_id  ?>">
<div class="row" id="link">
      <a href="javascript:void(0)" data-modules="assessment" data-action="edit_tor" class="menu"> <span class="step  step-normal ">ข้อตกลง</span></a> &nbsp;
      <a href="javascript:void(0)" data-modules="assessment" data-action="edit_tor1" class="menu"><span class="step step-normal ">ส่วนที่ 1</span></a>&nbsp; 
	  <a href="javascript:void(0)" data-modules="assessment" data-action="edit_tor2" class="menu"><span class="step step-normal">ส่วนที่ 2</span></a> &nbsp; 
	  <a href="javascript:void(0)" data-modules="assessment" data-action="edit_tor3" class="menu"><span class="step step-normal">ส่วนที่ 3</span></a> &nbsp; 
	  <a href="javascript:void(0)" data-modules="assessment" data-action="edit_tor4" class="menu"><span class="step step-normal">ส่วนที่ 4</span></a> &nbsp; 
	  <span class="step step-color">ส่วนที่ 5</span> &nbsp; 
	  <a href="javascript:void(0)" data-modules="assessment" data-action="edit_tor6" class="menu"><span class="step step-normal">ส่วนที่ 6</span></a> &nbsp;
		 <br>
</div>
<div class="row">
	<div class="col-md">&nbsp;
		<p><b><u>ส่วนที่ ๕ แจ้งผลการประเมิน</u></b></p>
	</div>
</div>

<div class="row">
	<div class="col-md-6 border border-dark p-3">
		<p>ผู้รับการประเมิน :</p>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="ac" disabled <?php echo $chk_accept?>>
			  <label class="form-check-label" for="defaultCheck1">
			    รับทราบผลการประเมินและแผนพัฒนา การปฏิบัติราชการรายบุคคลแล้ว

			  </label>
		</div>

	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $tle_g,$g_fname,"  ",$g_lname; ?>" name="uname" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<?php     
					$sqlspos ="SELECT pos_name FROM position WHERE pos_id='$g_pos'";
					$sespos=mysqli_query($con,$sqlspos) or die("sePos".mysqli_error($con));
					list($sname_pos)=mysqli_fetch_row($sespos);	
					mysqli_free_result($sespos);
				?>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $sname_pos?>" name="upos" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value=""  name="udate" readonly >
					<input type="hidden" name="usdate" value="">
				</div>				
		</div>
	</div>
	<!-- ผู้ประเมิน : -->
	<div class="col-md-6 border border-dark p-3">
	<p>ผู้ประเมิน :</p>
		<div class="custom-control custom-checkbox">
			  <input class="custom-control-input" type="checkbox" vlue="1" name="tappcetp" id="customCheck1" <?php echo $chk_inform?> required>
			  <label class="custom-control-label" for="customCheck1" >
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
		<?php  
				$sql="SELECT  prefix,lname,fname,position FROM staffs WHERE st_id ='$hleader'";
				$Lchk= mysqli_query($con,$sql) or die ("gen_chk".mysqli_error($con));
				list($Lprefix,$Llname,$Lfname,$Lposition)=mysqli_fetch_row($Lchk);
			
				mysqli_free_result($Lchk);
		?>
				<label  class="col-sm-2 col-form-label">ชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $Lprefix,$Lfname," ",$Llname ?>" name="sname" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<?php     
					$sqlLpos ="SELECT pos_name FROM position WHERE pos_id='$Lposition'";
					$sesLpos=mysqli_query($con,$sqlLpos) or die("sePos".mysqli_error($con));
					list($Lname_pos)=mysqli_fetch_row($sesLpos);	
					mysqli_free_result($sesLpos);
				?>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $Lname_pos;  ?>" name="t_pos" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
			
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo DateThai($date)?>" name="" readonly>
					<input type="hidden" value="<?php echo $date ?>" name="tdate">
				</div>				
		</div>
	</div>

</div>

<br>



<div class="row">
	<div class="col-md-12 text-center mb-2" >
		<!-- <p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t6"><input type="submit" class="next" value="ต่อไป"></a> </p> -->
		<button type="submit" class="btn updateuser bg-success text-white" data-modules="assessment" data-action="manage_asmIn"> ต่อไป </button>
	</div>
</div>
</form>	

<?php  mysqli_close($con); ?>

<script type="text/javascript">



 	$(document).ready(function() {
		$("#link").on('click',".menu",function(e){
					e.preventDefault();
					module1 = $(this).data('modules');
					action = $(this).data('action');
				
					loadingpage(module1,action); //code local functionjs.js

				});
			$("a.next").click(function(){
				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				loadmain(module1,action)
			});

	});
	

	
	$("#tort5").submit(function(e){
				e.preventDefault();
				$check = $("#tort5").valid();
				if($check == true){
				var formData = new FormData(this);
					    $.ajax({
					        url: "module/assessment/update_tor5.php",
					        type: 'POST',
					        data: formData,
					        success: function (data) {
					            alert(data);
								$.post( "module/assessment/edit_tor6.php", {gen_id: "<?php echo $genIdpost ?>", year_id: "<?php echo $yearIdpost  ?>"}).done(function( data ){
    							//alert( "Data Loaded: " + data );
								sessionStorage.setItem("module1","assessment");
								sessionStorage.setItem("action","edit_tor6");
								$("#detail").html(data);
  								});
					        },
					        cache: false,
					        contentType: false,
					        processData: false
					    });
				}
			})	

</script>