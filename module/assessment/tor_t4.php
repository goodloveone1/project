

<form class="p-2" name="tort4" id="tort4"> 
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
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="know[]" value="" require></td>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="devp[]" value="" require></td>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="lt[]" value="" require></td>
				</tr>

				<tr>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="know[]" value=""></td>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="devp[]" value=""></td>
					<td><input type='text'  class="borderNon form-control" placeholder="ข้อมูล" name="lt" value=""></td>
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
			$("#tort4").submit(function(){
				$check = $("#tort4").valid();
				if($check == true){
				var formData = new FormData(this);
					    $.ajax({
					        url: "module/assessment/adddata_tor4.php",
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
				loadmain("assessment","tor_t4")
			})	
	});

</script>