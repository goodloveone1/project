<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();
	//$yeartest=chk_idtest();
	if(empty($_POST['tor']) || empty($_POST['year'])){
        $genIdpost =$_SESSION['user_id'];
        $yearIdpost=$_SESSION['yearIdpost'];
        $TOR_id = $_SESSION['pre_id'];
    
    }else{
        $genIdpost = $_SESSION['user_id'];
        $yearIdpost = $_POST['year'];
        $TOR_id = $_POST['tor'];
    
    }
    $ctor=substr($TOR_id,3,11);
    $Ass_id="TOR".$ctor;

	$sqlyesr="SELECT ass_id,hleader,sleader FROM assessments WHERE staff ='$genIdpost'AND year_id='$yearIdpost'";
	$reChk = mysqli_query($con,"$sqlyesr") or die("torChk".mysqli_error($con));
	list($tor_ID,$hleader,$sleader)=mysqli_fetch_row($reChk);

	$sql="SELECT  prefix,lname,fname,position FROM staffs WHERE st_id ='$genIdpost'";
	$genchk= mysqli_query($con,$sql) or die ("gen_chk".mysqli_error($con));
	list($tle_g,$g_lname,$g_fname,$g_pos)=mysqli_fetch_row($genchk);

	mysqli_free_result($genchk);
	?>
<form class="p-2" name="tort6" id="tort6"> 

<div class="row">
<input type="hidden" name="tor_id" value="<?php echo $Ass_id?>">
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
			  <input class="custom-control-input" type="radio" value="0" id="customRadio1" name="apc" disabled  >
			  <label class="custom-control-label" for="customRadio1">
			    เห็นด้วยผลการประเมิน

			  </label>
		</div>
		<div class="custom-control custom-radio">
			  <input class="custom-control-input" type="radio" value="1" id="customRadio2" name="apc" disabled>
			  <label class="custom-control-label" for="customRadio2">
			    มีความเห็นแตกต่าง  ดังนี้

			  </label>
		</div>
		<div class="form-group">
		    <textarea class="form-control" name="hcompt" id="text1" rows="3" disabled required></textarea>
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
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $hl_prefix,$hl_name," ",$hl_fname ?>" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
				<?php
						$se_hlpostion = mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id ='$hl_position'") or die("SQL.posHL_ERRor".mysqli_error($con));
						list($hl_posName)=mysqli_fetch_row($se_hlpostion);

				?>
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $hl_posName  ?>" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
				<?php $date= date("Y/m/d")  ?>
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value=" " readonly >
				</div>				
		</div>
	</div>
	<!-- ผู้ประเมิน : -->
	<div class="col-md-6 border border-dark p-3">
               <?php
                     $seSleader=mysqli_query($con,
                     "SELECT staffs.prefix,staffs.fname,staffs.lname,position.pos_name
                     FROM staffs
                     INNER JOIN position
                     ON staffs.position=position.pos_id
                     WHERE st_id='$sleader'")or die("SQL.hleaderError".mysqli_error($con));
					 list($Sl_prefix,$Sl_name,$Sl_fname,$Sl_position)=mysqli_fetch_row($seSleader);
					 mysqli_free_result($seSleader);
				?>

		<p>ผู้บังคับบัญชาเหนือขึ้นไปอีกชั้นหนึ่ง  (ถ้ามี)</p>
		<div class="custom-control custom-radio">
			  <input class="custom-control-input" type="radio" value="0" id="customRadio3" name="uagree" disabled >
			  <label class="custom-control-label" for="customRadio3">
			    เห็นด้วยผลการประเมิน

			  </label>
		</div>
		<div class="custom-control custom-radio">
			  <input class="custom-control-input" type="radio" value="1" id="customRadio4" name="uagree" disabled>
			  <label class="custom-control-label" for="customRadio4">
			    มีความเห็นแตกต่าง  ดังนี้
			  </label>
		</div>
		<div class="form-group">
		    <textarea class="form-control" name="scompt" id="text2" rows="3" disabled required></textarea>
		 </div>
	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ลงชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $Sl_prefix,$Sl_name," ",$Sl_fname ?>" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="<?php echo $Sl_position  ?>" readonly>
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="" value="" readonly>
				</div>				
		</div>
	</div>
</div>				

<br>
<div class="row">
	<div class="col-md-12 text-center mb-2" >
		<!-- <p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t6"><input type="submit" class="next" value="ต่อไป"></a> </p> -->
		<button type="submit" class="btn updateuser bg-success text-white" data-modules="assessment" data-action="tor_t6"> ต่อไป </button>
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
        
	$("#tort6").submit(function(e){
				e.preventDefault();
				$check = $("#tort6").valid();
				if($check == true){
				var formData = new FormData(this);
					    $.ajax({
					        url: "module/assessment/adddata_tor6.php",
					        type: 'POST',
					        data: formData,
					        success: function (data) {
					            alert(data);
								$.post( "module/assessment/manage_tor.php", {tor: "<?php echo $TOR_id ?>", year: "<?php echo $yearIdpost  ?>" }).done(function( data ){
    							//alert( "Data Loaded: " + data );
								sessionStorage.setItem("module1","assessment");
								sessionStorage.setItem("action","manage_tor");
								$("#detail").html(data);
  								});
					        },
					        cache: false,
					        contentType: false,
					        processData: false
					    });
				}
			})
	});
</script>
<?php
mysqli_close($con);
?>