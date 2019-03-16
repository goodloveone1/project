
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

	$sqlyesr="SELECT ass_id FROM assessments WHERE staff ='$genIdpost'AND year_id='$yearIdpost'";
	$reChk = mysqli_query($con,"$sqlyesr") or die("torChk".mysqli_error($con));
	list($tor_ID)=mysqli_fetch_row($reChk);
?>
<form class="p-2" name="tort4" id="tort4"> 
<input type="hidden" name="tor_id" value="<?php echo $tor_ID  ?>">
<div class="row">
	    <span class="step  step-normal ">ข้อตกลง</span> &nbsp;
      <a href="javascript:void(0)"><span class="step step-normal ">ส่วนที่ 1</span></a>&nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 2</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 3</span></a> &nbsp; 
		 <a href=#><span class="step step-color">ส่วนที่ 4</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 5</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 6</span></a> &nbsp;
		 <br>
</div>
	<div class="row">
		<div class="col-md">&nbsp;
			
			<p><b><u>ส่วนที่ ๔  :  แผนพัฒนาการปฏิบัติราชการรายบุคคล</u></b></p>
		</div>
	</div>

	<div class="row">
		<div class="col-md">
			<table class="table table-bordered">
				<tr>
					<th>ความรู้/ทักษะ/สมรรถนะ ที่ต้องได้รับการพัฒนา </th>
					<th>วิธีการพัฒนา</th>
					<th>ช่วงเวลาที่ต้องการพัฒนา</th>
				</tr>
				<tr>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="know[]" value="" required></td>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="devp[]" value="" required></td>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="lt[]" value="" required></td>
				</tr>

				<tr>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="know[]" value=""></td>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="devp[]" value=""></td>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="lt[]" value=""></td>
				</tr>
				<tr>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="know[]" value=""></td>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="devp[]" value=""></td>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="lt[]" value=""></td>
				</tr>

			</table>
		</div>
	</div>

<br>
<div class="row">
	<div class="col-md-12 text-center mb-2" >
		<!-- <p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t5"><input type="submit" class="next" value="ต่อไป"></a> </p> -->
		<button type="submit" class="btn " data-modules="assessment" data-action="adddata_tor4"> ต่อไป </button>
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
			
			$("#tort4").submit(function(e){
				e.preventDefault();
				$check = $("#tort4").valid();
				if($check == true){
				var formData = new FormData(this);
					    $.ajax({
					        url: "module/assessment/adddata_tor4.php",
					        type: 'POST',
					        data: formData,
					        success: function (data) {
					            alert(data);
								$.post( "module/assessment/tor_t5.php", { gen_id: "<?php echo $genIdpost ?>", year_id: "<?php echo $yearIdpost  ?>" }).done(function( data ){
    							//alert( "Data Loaded: " + data );
								sessionStorage.setItem("module1","assessment");
								sessionStorage.setItem("action","tor_t5");
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