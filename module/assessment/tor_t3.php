
<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();
	$yeartest=chk_idtest();
?>
<form class="p-2"> 
<?php
					$sqlyesr="SELECT tor_id FROM tor WHERE gen_id ='$_SESSION[user_id]'AND tor_year='$yeartest'";
					$reChk = mysqli_query($con,"$sqlyesr") or die("torChk".mysqli_error($con));
					list($tor_ID)=mysqli_fetch_row($reChk);
					//echo $tor_ID;
					$reSum1=mysqli_query($con,"SELECT sum_tort1 FROM sum_tort1 WHERE tor_id='$tor_ID'");
					list($sum1)=mysqli_fetch_row($reSum1);

				 $reSum2=mysqli_query($con,"SELECT sum_tor2asum FROM sum_tort2 WHERE tor_id='$tor_ID'");
				 list($sum2)=mysqli_fetch_row($reSum2);
				


					mysqli_free_result($reChk);
					mysqli_free_result($reSum2);
					mysqli_free_result($reSum1);
				?>
<input type="hidden" value="<?php echo $tor_ID?>" name="tor_id">
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
				<td class="text-left">องค์ประกอบที่  ๑ : ผลสัมฤทธิ์ของงาน</td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="sum1" value="<?php echo $sum1  ?>" readonly></td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="wei1" value="70" readonly></td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="คลิกเพื่อคำนวณ" name="sa[]"  readonly></td>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบที่  ๒ : พฤติกรรมการปฏิบัติราชการ (สมรรถนะ)</td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="sum2" value="<?php  echo $sum2 ?>" readonly></td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="wei2" value="30" readonly></td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="คลิกเพื่อคำนวณ" name="sa[]" readonly></td>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบอื่น (ถ้ามี)</td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="sum3" ></td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="wei3"></td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="คลิกเพื่อคำนวณ" name="sa[]"></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right">รวม</td>
				<td>๑๐๐</td>
				<td><input type='text' size='3' class="borderNon form-control" placeholder="ข้อมูล" name="" readonly></td>
			</tr>	
		</table>
	</div>
</div>			

<div class="row">
	<div class="col-md">
		<b><u>ระดับผลการประเมิน</u></b>
		<div style="padding-left: 100px ">	
			<div class="form-check">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck1" name="score">
			  <label class="form-check-label" for="defaultCheck1">
			    ดีเด่น  (๙๐-๑๐๐)
			  </label>
			</div>
			<div class="form-check ">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck1" name="score">
			  <label class="form-check-label" for="defaultCheck1">
			    ดีมาก (๘๐-๘๙)
			  </label>
			</div>
			<div class="form-check ">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck1" name="score">
			  <label class="form-check-label" for="defaultCheck1">
			    ดี (๗๐-๗๙)
			  </label>
			</div>
			<div class="form-check ">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck1" name="score">
			  <label class="form-check-label" for="defaultCheck1">
			    พอใช้(๖๐-๖๙)
			  </label>
			</div>
			<div class="form-check ">
			  <input class="form-check-input" type="radio" value="1" id="defaultCheck1" name="score">
			  <label class="form-check-label" for="defaultCheck1">
			    ต้องปรับปรุง (ต่ำกว่า ๖๐)
			  </label>
			</div>
		</div>	
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-12 text-center mb-2" >
	<!-- <button type="submit" class="btn " data-modules="assessment" data-action="adddata_tor2"> ต่อไป </button> -->
		<p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t4"><input type="submit" class="next" value="ต่อไป"></a> </p>
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

			$(".sa").on( "click", "input[name='sa[]']", function() {
				//alert($(this).val())
				//alert($("input[name='wei1']").val())
			var s1=$("input[name='sum1']").val() * $("input[name='wei1']").val();
			var s2=$("input[name='sum2']").val() * $("input[name='wei2']").val();
			var s3=$("input[name='sum3']").val() * $("input[name='wei3']").val();
      
			var arr = [s1,s2,s3];
			$("input[name='sa[]']").each(function($i){
			$(this).val(arr[$i])
		})
			
			})

	});

</script>