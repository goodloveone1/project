<div class="row  p-2 headtitle">
	<h4 class="text-center col-md "> การประเมิน </h4>
</div>
<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();
	$yeartest=chk_idtest();
?>
<form class="p-2" name="tort3" id="tort3"> 
<?php

if(empty($_POST['tor']) || empty($_POST['year'])){
    $genIdpost = $_SESSION['user_id'];
    $yearIdpost=$_SESSION['yearIdpost'];
    $TOR_id = $_SESSION['pre_id'];

}else{
    $genIdpost = $_SESSION['user_id'];
    $yearIdpost = $_POST['year'];
    $TOR_id = $_POST['tor'];

}

					$sqlyesr="SELECT ass_id FROM assessments WHERE staff ='$genIdpost'AND year_id='$yearIdpost' AND ass_id LIKE 'TOR%'";
					$reChk = mysqli_query($con,"$sqlyesr") or die("torChk".mysqli_error($con));
					list($tor_ID)=mysqli_fetch_row($reChk);
					//echo $tor_ID;
					$reSum1=mysqli_query($con,"SELECT sum_asst1 FROM sum_score_assessment_t1 WHERE ass_id='$tor_ID'") or die("SQL_sum1Error".mysqli_error($con));
					list($sum1)=mysqli_fetch_row($reSum1);

				 $reSum2=mysqli_query($con,"SELECT sum_asst2 FROM sum_score_assessment_t2 WHERE ass_id='$tor_ID'") or die("SQL_sum2Error".mysqli_error($con)) ;
				 list($sum2)=mysqli_fetch_row($reSum2);
				
					mysqli_free_result($reChk);
					mysqli_free_result($reSum2);
					mysqli_free_result($reSum1);

					$ctor=substr($TOR_id,3,11);
					$Ass_id="TOR".$ctor;
				?>

<input type="hidden" value="<?php echo $Ass_id?>" name="tor_id">
<div class="row">
	    <span class="step  step-normal ">ข้อตกลง</span> &nbsp;
      <a href="javascript:void(0)"><span class="step step-normal ">ส่วนที่ 1</span></a>&nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 2</span></a> &nbsp; 
		 <a href=#><span class="step step-color">ส่วนที่ 3</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 4</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 5</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 6</span></a> &nbsp;
		 <br>
</div>
		<br>
<div class="row">
	<div class="col-md">
		<b><u>ส่วนที่ ๓ สรุปการประเมินผลการปฏิบัติราชการ </u></b>
	</div>
</div>

<div class="row">
	<div class="col-md">
		<table class="table table-bordered text-center sa">
			<tr >
				<th>องค์ประกอบการประเมิน</th>
				<th>คะแนน (ก)</th>
				<th>น้ำหนัก (ข)</th>
				<th>รวมคะแนน (ก)X(ข)</th>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบที่  1 : ผลสัมฤทธิ์ของงาน</td>
				<input type="hidden" name="name1" value="1">
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="sum1" value="<?php echo $sum1  ?>" readonly></td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="wei1" value="70" readonly></td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="" name="sa[]" onclick="fncSum();"   readonly></td>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบที่  2 : พฤติกรรมการปฏิบัติราชการ (สมรรถนะ)</td>
				<input type="hidden" name="name2" value="2">
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="sum2" value="<?php  echo $sum2 ?>" readonly></td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="wei2" value="30" readonly></td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="" name="sa[]"   readonly></td>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบอื่น (ถ้ามี)</td>
				<input type="hidden" name="name3" value="3">
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="sum3" value="0"></td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="wei3" value="0"></td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder=" " name="sa[]"  readonly ></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right">รวม</td>
				<td>100</td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="" name="sumall" onkeyup="fncSum();chk();" readonly></td>
			</tr>	
		</table>
	</div>
</div>			

<div class="row">
	<div class="col-md">
		<b><u>ระดับผลการประเมิน</u></b>
		<div style="padding-left: 100px ">	
			<div class="form-check">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck1" name="score" disabled="disabled">
			  <label class="form-check-label" for="defaultCheck1">
			    ดีเด่น  (90-100)
			  </label>
			</div>
			<div class="form-check ">
				
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck2" name="score"? disabled="disabled">
			  <label class="form-check-label" for="defaultCheck1">
			    ดีมาก (80-89)
			  </label>
			</div>
			<div class="form-check ">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck3" name="score" disabled="disabled">
			  <label class="form-check-label" for="defaultCheck1">
			    ดี (70-79)
			  </label>
			</div>
			<div class="form-check ">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck4" name="score" disabled="disabled">
			  <label class="form-check-label" for="defaultCheck1">
			    พอใช้(60-69)
			  </label>
			</div>
			<div class="form-check ">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck5" name="score" disabled="disabled">
			  <label class="form-check-label" for="defaultCheck1">
			    ต้องปรับปรุง (ต่ำกว่า 60)
			  </label>
			</div>
		</div>	
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-12 text-center mb-2" >
	 <button type="submit" class="btn updateuser bg-success text-white" data-modules="assessment" data-action=""> ต่อไป </button>
		<!-- <p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t4"><input type="submit" class="next" value="ต่อไป"></a> </p> -->
	</div>
</div>
</form>



<script type="text/javascript">
function fncSum(){
	var num = '';     
	var sum = 0;
	for(var i=0;i<document.tort3['sa[]'].length;i++){
	num = document.tort3['sa[]'][i].value;
	if(num!=""){
		sum += parseFloat(num);

		document.tort3.sumall.value = sum.toFixed(2); 
		}
	}
	chk()
}
function chk(){
		ptt = document.tort3['sumall'].value;
		var pt = parseFloat(ptt);
		if(pt>90 && pt<=100){
			// alert("ดีเด่น (90-100)");
			$("#defaultCheck1").prop('checked',true);
		}
		else if(pt>80 && pt<90){
			// alert("ดีมาก (80-89)")
			$("#defaultCheck2").prop('checked',true);
		}
		else if(pt>70 && pt<80){
		//	alert("ดี (70-79)");
			$("#defaultCheck3").prop('checked',true);
		}
		else if(pt>60 && pt<70){
			// alert("พอใช้(60-69)");
			$("#defaultCheck4").prop('checked',true);

		}
		else{
			// alert("ต้องปรับปรุง (ต่ำกว่า 60)")
			$("#defaultCheck5").prop('checked',true);
		}
	}

 	$(document).ready(function() {
			$("a.next").click(function(){
				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				loadmain(module1,action)
			});
cal()
chk()
			function cal() { 
			//$(".sa").on( "click", "input[name='sa[]']", function() {
				//alert($(this).val())
				//alert($("input[name='wei1']").val())
			var s1=$("input[name='sum1']").val() * $("input[name='wei1']").val();
			var s2=$("input[name='sum2']").val() * $("input[name='wei2']").val();
			var s3=$("input[name='sum3']").val() * $("input[name='wei3']").val();
			var arr = [s1.toFixed(2),s2.toFixed(2),s3.toFixed(2)];
			$("input[name='sa[]']").each(function($i){
			$(this).val(arr[$i])
			})
			fncSum()
	}
	

	$(".sa").on( "keyup", "input[name='sum3']", function() {
		   var wei3=$("input[name='wei3']").val()*$(this).val()
			 $("input[name='sa[]']").each(function($i){
				 if($i=="2"){
					$(this).val(wei3)
				 }
			})
			fncSum()	
	})
	$(".sa").on( "keyup", "input[name='wei3']", function() {
		   var sum3=$("input[name='sum3']").val()*$(this).val()
			 $("input[name='sa[]']").each(function($i){
				 if($i=="2"){
					$(this).val(sum3.toFixed(2))
				 }
			})
			fncSum()
	})
			$("#tort3").submit(function(e){
				e.preventDefault();
				$check = $("#tort3").valid();
				if($check == true){
				var formData = new FormData(this);
					    $.ajax({
					        url: "module/assessment/adddata_tor3.php",
					        type: 'POST',
					        data: formData,
					        success: function (data) {
											//alert(data);
											swal("บันทึกสำเร็จ!", {
									icon: "success",
									buttons: false,
									timer: 1000,
								});   
								$.post( "module/assessment/ass_t4.php", { tor: "<?php echo $TOR_id ?>", year: "<?php echo $yearIdpost  ?>" }).done(function( data ){
    							//alert( "Data Loaded: " + data );
								sessionStorage.setItem("module1","assessment");
								sessionStorage.setItem("action","ass_t4");
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