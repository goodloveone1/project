<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();
	

	$seaca=mysqli_query($con,"SELECT acadeic,prefix,fname,lname,position,branch_id,salary,startdate FROM staffs WHERE st_id='$_SESSION[user_id]'")or die("SQL_ERROR".mysqli_error($con));
	list($gen_acadeic,$gen_prefix,$gen_fname,$gen_lname,$gen_pos,$branch_id,$gen_salary,$gen_startdate)=mysqli_fetch_row($seaca);
	$seacaName=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$gen_acadeic'")or die("SQL_ERROR".mysqli_error($con));
	list($acaName)=mysqli_fetch_row($seacaName);
	
	// $seBrench=mysqli_query($con,"SELECT branch_name FROM branch WHERE branch_id='$branch_id'")or die("SQL_ERROR".mysqli_error($con));
	// list($branchName)=mysqli_fetch_row($seBrench);


	// print_r($set);
	mysqli_free_result($seaca);
	mysqli_free_result($seacaName);
	// mysqli_free_result($seBrench);

?>
<form method="POST" class="p-2" name="tor1" id="tor1"> 
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
$y_id = $y.$loop;
		$sqlyesr="SELECT ass_id FROM assessments WHERE staff ='$_SESSION[user_id]'AND year_id='$y_id'";
		$reChk = mysqli_query($con,"$sqlyesr") or die("torChk".mysqli_error($con));
		list($tor_ID)=mysqli_fetch_row($reChk);
		//echo $tor_ID;
		mysqli_free_result($reChk);
		$_SESSION['yearIdpost']=$tor_ID;
?>
<input type="hidden" value="<?php echo $tor_ID; ?>" name="tor_id">
<input type="hidden" value="<?php echo $y_id ?>" name="y_id">
   <div class="row">
	    <span class="step  step-normal ">ข้อตกลง</span> &nbsp;
         <a href="javascript:void(0)"><span class="step step-color ">ผลสัมฤทธิ์ของงาน</span></a>&nbsp; 
	
		 <br>
    </div>
<p></p>
<br>

<div class="row ">
	<div class="col-md">
	<p><b><u>ส่วนที่  ๑  องค์ประกอบที่ ๑ ผลสัมฤทธิ์ของงาน</b></u></p>
	</div>	
</div>


<div class="row ">
	<div class="col-md">
<table class="table table-bordered" id="table_score" >
<tr>
<th rowspan="2" class="w-25">(๑) ภาระงาน/กิจกรรม / โครงการ / งาน</th>
<th rowspan="2" class="w-50">(๒) ตัวชี้วัด / เกณฑ์ประเมิน</th>
<th colspan="5">(๓) ระดับค่าเป้าหมาย</th>
<th rowspan="2">(๔) ค่าคะแนน ที่ได้ </th>

</tr>
<tr>
<th >๑</th>
<th >๒</th>
<th >๓</th>
<th >๔</th>
<th >๕</th>
</tr>
<?php
	$sql = "SELECT e_id,e_name FROM evaluation";
	$weights = mysqli_query($con,$sql) or die(mysqli_error($con));
	$titcheck;
	while (list($tit,$e_name)=mysqli_fetch_row($weights)) {
		$titcheck[] = $tit;
		$sql_con="SELECT e_name,con_level,con_con,con_ex FROM conditions WHERE aca_id='$gen_acadeic' AND e_name='$tit' ";
		$re_con=mysqli_query($con,$sql_con) or die("condintion-error".mysqli_error($con));
		echo "<tr id='$tit'>";
									echo "<td>$e_name</td>";
?>
									<td>
											<?php
												while(list($e_na,$con_level,$con_con,$con_ex )=mysqli_fetch_row($re_con)){
													echo "<P>",$con_ex,"</P>";
												}
											?>
									</td>
<?php
									echo "<td><input type='radio' name='go$tit' value='1' required></td>";
									echo "<td><input type='radio' name='go$tit' value='2' required></td>";
									echo "<td><input type='radio' name='go$tit' value='3' required></td>";
									echo "<td><input type='radio' name='go$tit' value='4' required></td>";
									echo "<td><input type='radio' name='go$tit' value='5' required></td>";
									echo "<td ><input type='text'  data-tit='$tit' name='score[]' id='score[]' class='score borderNon form-control'  value='' size='2' readonly required></td>";						
		echo "</tr>";
	}
	mysqli_close($con);
	
?>



</table>
</div>
</div>


<div class="row">
	<div class="col-md-12 text-center mb-2" >

	<button type="submit" class="btn " data-modules="assessment" data-action="adddata_tor1pretest"> ต่อไป </button>
	<!-- <p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t2"><input type="submit" class="next" value="ต่อไป"></a> </p> -->

	</div>
</div>
</form>


<script type="text/javascript">
// function fncSum(){
// 	var num = '';     
// 	var sum = 0;
// 	for(var i=0;i<document.tor1['scwei[]'].length;i++){
// 	num = document.tor1['scwei[]'][i].value;
// 	if(num!=""){
// 		sum += parseFloat(num);
// 		}
// 	}
// 	document.tor1.sumscwei.value = sum.toFixed(2); 
// 	document.tor1.sumscweid.value = sum.toFixed(2);    
// 	document.tor1.sumall.value = (sum/5).toFixed(2); 
// }
<?php
foreach ($titcheck as $tit) {
		$go="go";
?>
$('#table_score').on('click', 'input[name="<?php echo $go.$tit; ?>"]:checked', function(event){
	// alert($(this).val())
	var scsum = $(this).val()
	var tit = <?php echo $tit-1; ?>;
	//$("input[name='score[]")[tit].val(scsum)
	document.tor1['score[]'][tit].value =scsum; 

	// $("#table_score").on( "change", ".score", function() {

	// var tit="wei"+$(this).data("tit")
	// var scwie="scwie"+$(this).data("tit")
// 	var tit2="wei"+ (tit+1);
// 	var scwie="scwie"+(tit+1);

// var sumswei = (($("input[name='"+tit2+"']").val() *scsum)/100)
// alert(sumswei)
// $("#"+scwie).val(sumswei);
// document.tor1['scwei[]'][tit].value =sumswei.toFixed(2); ;
// fncSum();
// });
})

<?php  } ?>
 $(document).ready(function() {
	
	// $("#tor1").submit(function(){
	// 			$check = $("#tor1").valid();
	// 			if($check == true){
	// 			var formData = new FormData(this);
	// 				    $.ajax({
	// 				        url: "module/assessment/adddata_tor1pretest.php",
	// 				        type: 'POST',
	// 				        data: formData,
	// 				        success: function (data) {
	// 				            alert(data);
	// 				        },
	// 				        cache: false,
	// 				        contentType: false,
	// 				        processData: false
	// 				    });
	// 			}
	// 			loadmain("assessment","manage_tor")
	// 		})
			
			$("#tor1").submit(function(e){
		      e.preventDefault();
				$check = $("#tor1").valid();
				if($check == true){
				var formData = new FormData(this);
					    $.ajax({
					        url: "module/assessment/adddata_tor1pretest.php",
					        type: 'POST',
					        data: formData,
					        success: function (data) {
					            alert(data);
								$.post( "module/assessment/tor2_pretest.php", { year_id: "<?php echo $tor_ID  ?>" }).done(function( data ) 
							{
    							//alert( "Data Loaded: " + data );
								sessionStorage.setItem("module1","assessment");
								sessionStorage.setItem("action","tor2_pretest");
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
