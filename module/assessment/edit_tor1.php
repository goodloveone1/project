<div class="row  p-2 headtitle">
	<h4 class="text-center col-md "> การประเมิน </h4>
</div>
<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();

	if(empty($_POST['genid']) && empty($_POST['year']) ){
		$genIdpost=$_SESSION['genIdpost'];
		$yearIdpost=$_SESSION['yearIdpost'];

	}else{
		$genIdpost = $_POST['genid'];
		$yearIdpost = $_POST['year'];
	}
	
//ผู้รับการประเมิน
	 $seaca=mysqli_query($con,"SELECT acadeic,fname,lname FROM staffs WHERE st_id='$genIdpost'")or die("SQL_ERROR".mysqli_error($con));
	 list($gen_acadeic,$fname,$lname)=mysqli_fetch_row($seaca);
	// $seacaName=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$gen_acadeic'")or die("SQL_ERROR".mysqli_error($con));
	// list($acaName)=mysqli_fetch_row($seacaName);
	mysqli_free_result($seaca);
	// mysqli_free_result($seacaName);
	
	
?>
<form method="POST" class="p-2" name="tor1" id="tor1">

<input type="hidden" value="<?php echo $yearIdpost; ?>" name="tor_id">
   <div class="row" id="link">
   <a href="javascript:void(0)" data-modules="assessment" data-action="edit_tor" class="menu"><span class="step  step-normal ">ข้อตกลง</span></a> &nbsp;
        <span class="step step-color ">ส่วนที่ 1</span>&nbsp;
		 <a href="javascript:void(0)" data-modules="assessment" data-action="edit_tor2" class="menu"><span class="step step-normal">ส่วนที่ 2</span></a> &nbsp;
		 <a href="javascript:void(0)" data-modules="assessment" data-action="edit_tor3" class="menu"><span class="step step-normal">ส่วนที่ 3</span></a> &nbsp;
		 <a href="javascript:void(0)" data-modules="assessment" data-action="edit_tor2" class="menu"><span class="step step-normal">ส่วนที่ 4</span></a> &nbsp;
		 <a href="javascript:void(0)" data-modules="assessment" data-action="edit_tor2" class="menu"><span class="step step-normal">ส่วนที่ 5</span></a> &nbsp;
		 <a href="javascript:void(0)" data-modules="assessment" data-action="edit_tor2" class="menu"><span class="step step-normal">ส่วนที่ 6</span></a> &nbsp;
		 
    </div>
<div class="row ">
	<div class="col-md">
	<br>
	<p><b><u>ส่วนที่  ๑  องค์ประกอบที่ ๑ ผลสัมฤทธิ์ของงาน</b></u></p>
	</div>
</div>
<div class="row ">
	<div class="col-md">
<p></p><?php  echo " ผู้รับการประเมิน : ",$fname," ",$lname;  ?></p>
	</div>
</div>
<div class="row ">
	<div class="col-md">
<table class="table table-bordered" id="table_score" >
<tr>
<th rowspan="2" width="20%">(๑) ภาระงาน/กิจกรรม / โครงการ / งาน</th>
<th rowspan="2">(๒) ตัวชี้วัด / เกณฑ์ประเมิน</th>
<th colspan="5">(๓) ระดับค่าเป้าหมาย</th>
<th rowspan="2">(๔) ค่าคะแนน ที่ได้ </th>
<th rowspan="2">(๕) น้ำหนัก (ความสำคัญ/ ยากง่ายของงาน)</th>
<th rowspan="2">(๖) ค่าคะแนน   ถ่วงน้ำหนัก (๔) × (๕) ๑๐๐ </th>
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
	$total = 0;
	while (list($tit,$weight)=mysqli_fetch_row($weights)) {
		$titcheck[] = $tit;
		$sql = "SELECT e_name FROM evaluation WHERE e_id='$tit'";
		$eval = mysqli_query($con,$sql) or die(mysqli_error($con));
		list($e_name)=mysqli_fetch_row($eval);
		$sum=mysqli_query($con,"SELECT SUM(weights) FROM weights WHERE aca_id='$gen_acadeic'")or die(mysqli_error($con));
		list($sumS)=mysqli_fetch_row($sum);

		$sqltor1=mysqli_query($con,"SELECT asst1_id,ass_id,title_name,goal,score FROM asessment_t1 WHERE  ass_id='$yearIdpost' AND title_name='$tit'") or die("".mysqli_error($con));
		 list($asst1_id,$tor_id,$title_name,$tort1_goal,$tort1_score)=mysqli_fetch_row($sqltor1);
		$re_hourmin=mysqli_query($con,"SELECT min_hour FROM work_hour WHERE aca_id='$gen_acadeic' AND e_id='$tit'")or die("SQL.Error-minhour".mysqli_error($con));
	   list($min_hour)=mysqli_fetch_row($re_hourmin);
	   mysqli_free_result($re_hourmin);
		echo "<tr id='$tit'>";
		echo "<td>";
			echo"<p>$e_name</p>";
			echo "<p style='color:red;'>&nbsp;&nbsp;&nbsp;$min_hour</p>";
			$re_sub_e=mysqli_query($con,"SELECT se_name FROM sub_evaluation WHERE e_id='$tit'")or die("SQL.Error-minhour".mysqli_error($con));
		while(list($se_name)=mysqli_fetch_row($re_sub_e)){
			echo "<p style='color:blue; '>&nbsp;&nbsp;&nbsp;$se_name</p>";
		}
		mysqli_free_result($re_sub_e);			
		echo "</td>";
		echo "<td>";
		echo "<input type='hidden' name='id[]' value='$asst1_id'>";
		$se_condition=mysqli_query($con,"SELECT con_ex FROM conditions WHERE aca_id='$gen_acadeic' AND e_name='$tit'")or die("SQL-error.Condition".mysqli_error($con));
		$num=1;
while(list($con_ex)=mysqli_fetch_row($se_condition)){
	   echo "<label for='customRadio$num$tit' style=' text-indent: 2.1em;'>$con_ex</label>";
	   $num++;
}
	   echo "</td>";
	
		$ch1= "" ;$ch2= "";$ch3= "";$ch4= "";$ch5 = "";
			switch($tort1_goal){
				case 1 :
						$ch1="checked";
				break;
				case 2 :
						$ch2="checked";
				break;
				case 3 :
						$ch3="checked";
				break;
				case 4 :
						$ch4="checked";
				break;
				case 5 :
						$ch5="checked";
				break;
			}
				echo "<td><input type='radio' id='customRadio1$tit' name='go$tit' value='1' required $ch1></td>";
				echo "<td><input type='radio' id='customRadio2$tit' name='go$tit' value='2' required $ch2></td>";
					echo "<td><input type='radio' id='customRadio3$tit' name='go$tit' value='3' required $ch3></td>";
					echo "<td><input type='radio' id='customRadio4$tit' name='go$tit' value='4' required $ch4></td>";
					echo "<td><input type='radio' id='customRadio5$tit' name='go$tit' value='5' required $ch5></td>";
				echo "<td class='text-center' ><input type='text' class='borderNon'  data-tit='$tit' name='score[]' id='score[]' class='score' value='$tort1_goal' size='2' readonly required></td>";
				echo "<td id='wei$tit' class='text-center' data-wei='$weight'><input type='text' class='borderNon' value='$weight' size='2' name='wei$tit' readonly ></td>";
				$sumA=($tort1_goal*$weight)/100;
				$total+=$sumA;
				$a=number_format($sumA,2,'.','');
				$t=number_format($total,2,'.','');
				echo "<td id='total$tit' class='text-center'><input type='text' class=' borderNon' id='scwie$tit' name='scwei[]' size='2' onkeyup='fncSum();' value='$a' readonly></td>";
		echo "</tr>";
	}

$se_sumAss1 = mysqli_query($con,
"SELECT sum_weighted FROM sum_score_assessment_t1 WHERE ass_id='$_SESSION[yearIdpost]'")or  die("SQL-error.sumAsst1".mysqli_error($con));
list($sum_weighted)=mysqli_fetch_row($se_sumAss1);
mysqli_free_result($se_sumAss1);
mysqli_close($con);

?>
	<tr>
		<td colspan="8" class="text-center"> ผลรวม </td>
		<td class="text-center"><input type="text" class=" borderNon" name="sumwei" value="<?php echo $sumS ?> " size="3" readonly></td>
		<td class="text-center"><input type="text" class=" borderNon" name="sumscwei"  size="2" value="<?php echo $t  ?>" readonly> </td>

	</tr>
	<tr>
		<td colspan="9" >
			<div class="row">
				<div class="col-sm text-right" >
					<br>
					สรุปคะแนนส่วนผลสัมฤทธิ์ของงาน  =
				</div>
				<div class="col-sm text-center">
					ผลรวมของค่าคะแนนถ่วงน้ำหนัก <input type="text" class="borderNon" size="3" name="sumscweid" value="<?php echo $t ?>" readonly> <hr style="border-width: 3px;"> จำนวนระดับค่าเป้าหมาย = 5
				</div>
			</div>
		</td>
		<td class="text-center"><input type="text" class="borderNon" name="sumall" size="3" value="<?php echo number_format($total/5,2,'.','') ; ?>"></td>
	</tr>

</table>
</div>
</div>


<div class="row">
	<div class="col-md-12 text-center mb-2" >

	<button type="submit" class="btn updateuser bg-success text-white " data-modules="assessment" data-action="adddata_tor"> ต่อไป </button>
	<!-- <p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t2"><input type="submit" class="next" value="ต่อไป"></a> </p> -->

	</div>
</div>
</form>


<script type="text/javascript">
function fncSum(){
	var num = '';
	var sum = 0;
	for(var i=0;i<document.tor1['scwei[]'].length;i++){
	num = document.tor1['scwei[]'][i].value;
	if(num!=""){
		sum += parseFloat(num);
		}
	}
	document.tor1.sumscwei.value = sum.toFixed(2);
	document.tor1.sumscweid.value = sum.toFixed(2);
	document.tor1.sumall.value = (sum/5).toFixed(2);
}
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
	var tit2="wei"+ (tit+1);
	var scwie="scwie"+(tit+1);

    var sumswei = (($("input[name='"+tit2+"']").val() *scsum)/100)
// alert(sumswei)
// $("#"+scwie).val(sumswei);
document.tor1['scwei[]'][tit].value =sumswei.toFixed(2); ;
fncSum();
// });
})

<?php  } ?>
 $(document).ready(function() {
	$("#link").on('click',".menu",function(e){
					e.preventDefault();
					module1 = $(this).data('modules');
					action = $(this).data('action');
				
					loadingpage(module1,action); //code local functionjs.js

				});

	$("#tor1").submit(function(e){
		      e.preventDefault();
				$check = $("#tor1").valid();
				if($check == true){
				var formData = new FormData(this);
					    $.ajax({
					        url: "module/assessment/update_tor1.php",
					        type: 'POST',
					        data: formData,
					        success: function (data) {
								//alert(data);
								swal("บันทึกสำเร็จ!", {
									icon: "success",
									buttons: false,
									timer: 1000,
								});   
								$.post( "module/assessment/edit_tor2.php", { gen_id: "<?php echo $genIdpost ?>", year_id: "<?php echo $yearIdpost  ?>" }).done(function( data ) 
							{
    							//alert( "Data Loaded: " + data );
								sessionStorage.setItem("module1","assessment");
								sessionStorage.setItem("action","edit_tor2");
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
