<div class="row headtitle" >
	<div class="col-md-12 text-center mb-2">
		<h2> แก้ไขบุคลากร </h2>
		<button type="button" class="btn re" data-modules="personnel" data-action="edituser"> REFRE </button>
		<button type="button" class="btn re" data-modules="personnel" data-action="mangauser"> ย้อนกลับ </button>

	</div>
</div>
<form method="" enctype="multipart/form-data" id="edituser">
	<div class="row mt-2">
		<div class="col-md-3">
			<div class="card">
				<img class="card-img-top img-thumbnail" src="http://lorempixel.com/200/200/" alt="Card image cap">
				<div class="card-body text-center">
					<div class="form-group row">
						<input type="file" name="" class="form-control  btn" >
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">คำนำหน้า</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="staticEmail" placeholder="คำนำหน้า" name="titlename">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ชื่อ</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputPassword" placeholder="ชื่อ"  name="name">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">สกุล</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputPassword" placeholder="สกุล"  name="lname">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm-10">
					<select class="form-control" id="exampleFormControlSelect1" name="pos">
						<option>อาจารย์</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ตำแหน่งวิชาการ</label>
				<div class="col-sm-10">
					<select class="form-control" id="exampleFormControlSelect1" name="ap">
						<option>ข้าราชการ</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">สาขา</label>
				<div class="col-sm-4">
					<select class="form-control" id="exampleFormControlSelect1" name="suj">
						<option>บริหารธุรกิจ</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
				<label for="inputPassword" class="col-sm-2 col-form-label">สาขาวิชา</label>
				<div class="col-sm-4">
					<select class="form-control" id="exampleFormControlSelect1" name="brn">
						<option>สารสนเทศทางคอมพิวเตอร์</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">Username</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="staticEmail" placeholder="Username" name="uname">
				</div>
				<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-4">
					<input type="Password" class="form-control" id="staticEmail" placeholder="Password" name="passwd">
				</div>
			</div>
		</div>
		<div class="col-md-12"> 		<!-- >ปริญญาตรี -->
			<div class="form-group row p-1 pb-2 m-1" style="border: solid 2px;border-radius: 25px;">
				<div class="col-sm-12" >
					<label for="staticEmail" class="col-sm-12 col-form-label">ปริญญาตรี</label>
				</div>
				
				<span class="col-sm-12">
					<div class='row'>
						
						<div class="col-md">
							<button type="button" class="btn btn-secondary adddegree1 btn-block">เพิ่ม</button>
						</div>
						<div class="col-md">
							<button type="button" class="btn btn-secondary cleardegree1 btn-block">CLEAR</button>
						</div>

						<ul class="loaddegree col-12  list-group"></ul>
						
					</div>
				</span>
			</div>
		</div> <!-- > END ปริญญาตรี -->

		<div class="col-md-12"> 		<!-- >ปริญญาโท -->
			<div class="form-group row p-1 pb-2 m-1" style="border: solid 2px;border-radius: 25px;">
				<div class="col-sm-12" >
					<label for="staticEmail" class="col-sm-12 col-form-label">ปริญญาโท</label>
				</div>
				
				<span class="col-sm-12">
					<div class='row'>
						
						<div class="col-md">
							<button type="button" class="btn btn-secondary adddegree2 btn-block">เพิ่ม</button>
						</div>
						<div class="col-md">
							<button type="button" class="btn btn-secondary cleardegree2 btn-block">CLEAR</button>
						</div>

						<ul class="loaddegree2 col-12  list-group"></ul>
						
					</div>
				</span>
			</div>
		</div> <!-- > END ปริญญาโท -->

		<div class="col-md-12"> 		<!-- >ปริญญาเอก -->
			<div class="form-group row p-1 pb-2 m-1" style="border: solid 2px;border-radius: 25px;">
				<div class="col-sm-12" >
					<label for="staticEmail" class="col-sm-12 col-form-label">ปริญญาเอก</label>
				</div>
				
				<span class="col-sm-12">
					<div class='row'>
						
						<div class="col-md">
							<button type="button" class="btn btn-secondary adddegree3 btn-block">เพิ่ม</button>
						</div>
						<div class="col-md">
							<button type="button" class="btn btn-secondary cleardegree3 btn-block">CLEAR</button>
						</div>

						<ul class="loaddegree3 col-12  list-group"></ul>
						
					</div>
				</span>
			</div>		
		</div> <!-- > END ปริญญาโท -->
		<button type="button" class="btn updateuser" data-modules="personnel" data-action="updateuser"> ADD </button>
	</div>	
</form>
<script type="text/javascript">


		$(document).ready(function() {
			$("button.re").click(function(){
				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				loadmain(module1,action);
			});

		

// ปริญญาตรี 

			$("button.cleardegree1").on("click",function(e) {
				e.preventDefault();
			    var r = confirm("คณต้องการล้างใช่ไหม?");
			    if(r == true){
					$('.loaddegree').html("");
				}
			});

			$('.loaddegree').on('click', '.deldegree1', function(e) {
			    e.preventDefault();
			    var r = confirm("คณต้องการลบใช่ไหม?");
            	if (r == true) {
			    	$(this).parent().remove();
				}

			});


			$("button.adddegree1").on("click",function(e) {
  				e.preventDefault();
			    degreeload1()
			});

			function degreeload1(){

				var count =$('.loaddegree li').length

					if(count < 10 && count >= 0){
						var text = "<li class='list-group-item'>"
						+ "<input type='text' class='form-control' id='staticEmail' placeholder='คำนำหน้า' name='a1[]'> "
						+ "<input type='text'class='form-control' id='staticEmail' placeholder='จบที่'  name='a2[]'> "
						+ "<button type='button' class='btn btn-danger btn-block deldegree1 '>ลบ</button>"
						+ "</li>"
				
						 $(".loaddegree").append(text);
					}else{
						alert("ไม่สามารเพื่มได้แล้ว");
					}		

					}

// END ปริญญาตรี 

//  ปริญญาโท

			$("button.cleardegree2").on("click",function(e) {
				e.preventDefault();
			    var r = confirm("คณต้องการล้างใช่ไหม?");
			    if(r == true){
					$('.loaddegree2').html("");
				}
			});

			$("button.adddegree2").on("click",function(e) {
  				e.preventDefault();
			    degreeload2()
			});

			$('.loaddegree2').on('click', '.deldegree2', function(e) {
			    e.preventDefault();
			    var r = confirm("คณต้องการลบใช่ไหม?");
            	if (r == true) {
			    	$(this).parent().remove();
				}

			});


				function degreeload2(){

					var count =$('.loaddegree2 li').length

					if(count < 10 && count >= 0){
						var text = "<li class='list-group-item'>"
						+ "<input type='text' class='form-control' id='staticEmail' placeholder='คำนำหน้า' name='a1[]'> "
						+ "<input type='text'class='form-control' id='staticEmail' placeholder='จบที่'  name='a2[]'> "
						+ "<button type='button' class='btn btn-danger btn-block deldegree2 '>ลบ</button>"
						+ "</li>"
				
						 $(".loaddegree2").append(text);
					}else{
						alert("ไม่สามารเพื่มได้แล้ว");
					}		

					}

// END ปริญญาโท

// ปริญญาเอก 

			$("button.cleardegree3").on("click",function(e) {
				e.preventDefault();
			    var r = confirm("คณต้องการล้างใช่ไหม?");
			    if(r == true){
					$('.loaddegree3').html("");
				}
			});			

			$("button.adddegree3").on("click",function(e) {
  				e.preventDefault();
			    degreeload3()
			});

			$('.loaddegree3').on('click', '.deldegree3', function(e) {
			    e.preventDefault();
			    var r = confirm("คณต้องการลบใช่ไหม?");
            	if (r == true) {
			    	$(this).parent().remove();
				}

			});


				function degreeload3(){

					var count =$('.loaddegree3 li').length

					if(count < 10 && count >= 0){
						var text = "<li class='list-group-item'>"
						+ "<input type='text' class='form-control' id='staticEmail' placeholder='คำนำหน้า' name='a1[]'> "
						+ "<input type='text'class='form-control' id='staticEmail' placeholder='จบที่'  name='a2[]'> "
						+ "<button type='button' class='btn btn-danger btn-block deldegree3 '>ลบ</button>"
						+ "</li>"
				
						 $(".loaddegree3").append(text);
					}else{
						alert("ไม่สามารเพื่มได้แล้ว");
					}		

					}

// END ปริญญาเอก

			

			

		



					
			$(".updateuser").click(function(){

				 $.post( "module/personnel/updateuser.php", $( "#edituser" ).serialize()).done(function(data,txtstuta){
            	 	alert(data);
		         });

		        // $('#editsub').modal("hide");

		        // $('#editsub').on('hidden.bs.modal', function (e) {

		        //     var module1 = sessionStorage.getItem("module1");
		        //     var action = sessionStorage.getItem("action");
		        //    loadmain(module1,action);
		        // })
			})	

				
				
		

			
		});

		
		


</script>