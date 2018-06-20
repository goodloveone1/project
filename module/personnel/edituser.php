<div class="row headtitle" >
	<div class="col-md-12 text-center mb-2">
		<h2> แก้ไขบุคลากร </h2>
		<button type="button" class="btn re" data-modules="personnel" data-action="edituser"> REFRE </button>
		<button type="button" class="btn re" data-modules="personnel" data-action="mangauser"> ย้อนกลับ </button>
	</div>
</div>
<form method="" enctype="multipart/form-data">
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
					<input type="text" class="form-control" id="staticEmail" placeholder="คำนำหน้า">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ชื่อ</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputPassword" placeholder="ชื่อ">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">สกุล</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputPassword" placeholder="สกุล">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm-10">
					<select class="form-control" id="exampleFormControlSelect1">
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
					<select class="form-control" id="exampleFormControlSelect1">
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
					<select class="form-control" id="exampleFormControlSelect1">
						<option>บริหารธุรกิจ</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
				<label for="inputPassword" class="col-sm-2 col-form-label">สาขาวิชา</label>
				<div class="col-sm-4">
					<select class="form-control" id="exampleFormControlSelect1">
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
					<input type="text" class="form-control" id="staticEmail" placeholder="Username">
				</div>
				<label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="staticEmail" placeholder="Password">
				</div>
			</div>
		</div>
		<div class="col-md-12">
			
		
	
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
							<button type="button" class="btn btn-secondary deldegree1 btn-block">CLEAR</button>
						</div>

						<div class="loaddegree col-md-12"></div>
						
					</div>
				</span>
			</div>
		</div>
	</div>
	
</form>
<script type="text/javascript">


		$(document).ready(function() {
			$("button.re").click(function(){
				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				loadmain(module1,action);
			});

			$(window).on('load', function(){
   				
				sessionStorage.removeItem("count");
								
			});

			$("button.deldegree1").on("click",function(event) {
				sessionStorage.removeItem("count");
				var count = 0;
				degreeload1(count);
			});


			/* reload ปริญญาตรี*/

			$("button.adddegree1").on("click",function(event) {
				

				var count = sessionStorage.getItem("count")

				alert(count);
				degreeload1(count);
				

				
			});

				function degreeload1(count){

				if(count == null){
					count=1;	
				}



				var text =[];
				var i;
				
				if(count != undefined){
					if(count != 0){
						for(i=0;i < count;i++){
							text[i] = "<div class='row m-1 text11'><div class='col-sm'><input type='text' class='form-control' id='staticEmail' placeholder='คำนำหน้า'></div><div class='col-sm'><input type='text'class='form-control' id='staticEmail' placeholder='จบที่'></div><div class='col-sm-2'><button type='button' class='btn btn-danger btn-block deldegree1' data-nums="+i+">ลบ</button></div></div>";
						}

					}

					count++;
					sessionStorage.setItem("count",count);
					sessionStorage.setItem("text1[]",text);
																	
					// $(".loaddegree").html(text);

						$.ajax({
							  type: "POST",
							  url: "module/personnel/loaddata.php",
							  data : {textdata:text},
							  statusCode: {
								    404: function() {
								      alert( "page not found" );
								    }
								  }
							}).done(function(data) {
							  $(".loaddegree").html(data);	
							});

							

					}
					
				}

				
				
		

			
		});

		
		


</script>