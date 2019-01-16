<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();
	

	$seaca=mysqli_query($con,"SELECT gen_acadeic,gen_prefix,gen_fname,gen_lname,gen_pos,branch_id,gen_salary,gen_startdate FROM general WHERE gen_id='$_SESSION[user_id]'")or die("SQL_ERROR".mysqli_error($con));
	list($gen_acadeic,$gen_prefix,$gen_fname,$gen_lname,$gen_pos,$branch_id,$gen_salary,$gen_startdate)=mysqli_fetch_row($seaca);
	$seacaName=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$gen_acadeic'")or die("SQL_ERROR".mysqli_error($con));
	list($acaName)=mysqli_fetch_row($seacaName);
	
	$seBrench=mysqli_query($con,"SELECT branch_name FROM branch WHERE branch_id='$branch_id'")or die("SQL_ERROR".mysqli_error($con));
	list($branchName)=mysqli_fetch_row($seBrench);

	$seexp=mysqli_query($con,"SELECT * FROM tort2_exp WHERE aca_id='$gen_acadeic'")or die(mysqli_error($con));
	for ($set = array (); $row = $seexp->fetch_assoc(); $set[] = $row);
	// print_r($set);
	mysqli_free_result($seaca);
	mysqli_free_result($seacaName);
	mysqli_free_result($seBrench);
	mysqli_free_result($seexp);
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
		$sqlyesr="SELECT tor_id FROM tor WHERE gen_id ='$_SESSION[user_id]'AND tor_year='$y_id'";
		$reChk = mysqli_query($con,"$sqlyesr") or die("torChk".mysqli_error($con));
		list($tor_ID)=mysqli_fetch_row($reChk);
		//echo $tor_ID;
		mysqli_free_result($reChk);
?>
<input type="hidden" value="<?php echo $tor_ID; ?>" name="tor_id">
<input type="hidden" value="<?php echo $y_id ?>" name="y_id">
   <div class="row">
	    <span class="step  step-normal ">ข้อตกลง</span> &nbsp;
         <a href="javascript:void(0)"><span class="step step-color ">ส่วนที่ 1</span></a>&nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 2</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 3</span></a> &nbsp; 
		 <span class="step step-normal">ส่วนที่ 4</span> &nbsp; 
		 <span class="step step-normal">ส่วนที่ 5</span> &nbsp; 
		 <span class="step step-normal">ส่วนที่ 6</span> &nbsp;
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
<th rowspan="2">(๑) ภาระงาน/กิจกรรม / โครงการ / งาน</th>
<th rowspan="2">(๒) ตัวชี้วัด / เกณฑ์ประเมิน</th>
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
	$sql = "SELECT tit,weights FROM weights WHERE aca_id='$gen_acadeic'";
	$weights = mysqli_query($con,$sql) or die(mysqli_error($con));
	$titcheck;
	
	while (list($tit,$weight)=mysqli_fetch_row($weights)) {
		$titcheck[] = $tit;
		$sql = "SELECT e_name FROM evaluation WHERE e_id='$tit'";
		$eval = mysqli_query($con,$sql) or die(mysqli_error($con));
		list($e_name)=mysqli_fetch_row($eval);
		$sum=mysqli_query($con,"SELECT SUM(weights) FROM weights WHERE aca_id='$gen_acadeic'")or die(mysqli_error($con));
		list($sumS)=mysqli_fetch_row($sum);

		echo "<tr id='$tit'>";
									echo "<td>$e_name</td>";
									echo "<td></td>";
									echo "<td><input type='radio' name='go$tit' value='1' required></td>";
									echo "<td><input type='radio' name='go$tit' value='2' required></td>";
									echo "<td><input type='radio' name='go$tit' value='3' required></td>";
									echo "<td><input type='radio' name='go$tit' value='4' required></td>";
									echo "<td><input type='radio' name='go$tit' value='5' required></td>";
									echo "<td ><input type='text'  data-tit='$tit' name='score[]' id='score[]' class='score' value='' size='2' readonly required></td>";						
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
	
	$("#tor1").submit(function(){
				$check = $("#tor1").valid();
				if($check == true){
				var formData = new FormData(this);
					    $.ajax({
					        url: "module/assessment/adddata_tor1pretest.php",
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
				loadmain("assessment","menuassm")
			})	
});
</script>