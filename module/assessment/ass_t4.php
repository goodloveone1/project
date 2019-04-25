<div class="row  p-2 headtitle">
	<h4 class="text-center col-md "> การประเมิน </h4>
</div>
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
?>

<form class="p-2" name="tort4" id="tort4"> 
<input type="hidden" name="tor_id" value="<?php echo $Ass_id  ?>">
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
					<td><textarea   class="borderNon form-control" placeholder="ข้อมูล" name="know[]" value="" required></textarea></td>
					<td><textarea  class="borderNon form-control" placeholder="ข้อมูล" name="devp[]" value="" required></textarea></td>
					<td><textarea class="borderNon form-control" placeholder="ข้อมูล" name="lt[]" value="" required></textarea></td>
				</tr>

				<tr>
					<td><textarea  class="borderNon form-control" placeholder="ข้อมูล" name="know[]" value=""></textarea></td>
					<td><textarea   class="borderNon form-control" placeholder="ข้อมูล" name="devp[]" value=""></textarea></td>
					<td><textarea   class="borderNon form-control" placeholder="ข้อมูล" name="lt[]" value=""></textarea></td>
				</tr>
				<tr>
					<td><textarea  class="borderNon form-control" placeholder="ข้อมูล" name="know[]" value=""></textarea></td>
					<td><textarea  class="borderNon form-control" placeholder="ข้อมูล" name="devp[]" value=""></textarea></td>
					<td><textarea class="borderNon form-control" placeholder="ข้อมูล" name="lt[]" value=""></textarea></td>
				</tr>

			</table>
		</div>
	</div>

<br>
<div class="row">
	<div class="col-md-12 text-center mb-2" >
		<!-- <p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t5"><input type="submit" class="next" value="ต่อไป"></a> </p> -->
		<button type="submit" class="btn updateuser bg-success text-white" data-modules="assessment" data-action="adddata_tor4"> ต่อไป </button>
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
								$.post( "module/assessment/ass_t5.php", {tor: "<?php echo $TOR_id ?>", year: "<?php echo $yearIdpost  ?>" }).done(function( data ){
    							//alert( "Data Loaded: " + data );
								sessionStorage.setItem("module1","assessment");
								sessionStorage.setItem("action","ass_t5");
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