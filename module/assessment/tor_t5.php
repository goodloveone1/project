

<form class="p-2"> 
<div class="row">
	<div class="col-md">
		<b><u>ส่วนที่ ๕  การรับทราบผลการประเมิน</u></b>
	</div>
</div>

<div class="row">
	<div class="col-md-6 border border-dark p-3">
		<p>ผู้รับการประเมิน :</p>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			    ได้รับทราบผลการประเมินและแผนพัฒนา การปฏิบัติราชการรายบุคคลแล้ว

			  </label>
		</div>

	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ลงชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
	</div>
	<!-- ผู้ประเมิน : -->
	<div class="col-md-6 border border-dark p-3">
		<p>ผู้ประเมิน : :</p>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			   ได้แจ้งผลการประเมินและผู้รับการประเมินได้ลงนามรับทราบ
			  </label>
		</div>
		<div class="form-check">
			  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
			  <label class="form-check-label" for="defaultCheck1">
			   ได้แจ้งผลการประเมินเมื่อวันที่.............................................
      			แต่ผู้รับการประเมินไม่ลงนามรับทราบผลการ
     			ประเมินโดยมี………………..........เป็นพยาน


			  </label>
		</div>

	</div>
	<div class="col-md-6 border   border-dark p-3">
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ลงชื่อ</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
		<div class="form-group row">
				<label  class="col-sm-2 col-form-label">วันที่</label>
				<div class="col-sm">
					<input type="text" class="form-control" id="inputEmail3" placeholder="">
				</div>				
		</div>
	</div>

</div>
</form>	
<br>



<div class="row">
	<div class="col-md-12 text-center mb-2" >
		<p><a href="javascript:void(0)" class="text-center next" data-modules="assessment" data-action="tor_t6"><input type="submit" class="next" value="ต่อไป"></a> </p>
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