

<form class="p-2"> 
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
		<table class="table table-bordered text-center">
			<tr >
				<th>องค์ประกอบการประเมิน</th>
				<th>คะแนน (ก)</th>
				<th>น้ำหนัก (ข)</th>
				<th>รวมคะแนน (ก)X(ข)</th>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบที่  ๑ : ผลสัมฤทธิ์ของงาน</td>
				<td></td>
				<td>๗๐</td>
				<td></td>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบที่  ๒ : พฤติกรรมการปฏิบัติราชการ (สมรรถนะ)</td>
				<td></td>
				<td>๓๐</td>
				<td></td>
			</tr>
			<tr>
				<td class="text-left">องค์ประกอบอื่น (ถ้ามี)</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right">รวม</td>
				<td>๑๐๐</td>
				<td></td>
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
</form>
<div class="row">
	<div class="col-md-12 text-center mb-2" >
		<p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t4"><input type="submit" class="next" value="ต่อไป"></a> </p>
	</div>
</div>




<script type="text/javascript">
 	$(document).ready(function() {
			$("a.next").click(function(){
				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				loadmain(module1,action)
			});
	});

</script>