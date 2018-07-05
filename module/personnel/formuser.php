<?php
	include("../../function/db_function.php");
	$con=connect_db();
?>
<div class="row headtitle p-2" >
	<div class="col-md-2 text-center ">
	<button type="button" class="btn re btn-block" data-modules="personnel" data-action="mangauser"><i class="fas fa-chevron-left"></i> ย้อนกลับ </button>
	</div>
	<div class="col-md text-center">
		<h2> เพิ่มบุคลากร </h2>
	</div>
</div>
<form method="POST"  enctype="multipart/form-data" id="edituser">
	<div class="row mt-2">
		<div class="col-md-3">
			<div class="card">
				<img class="card-img-top img-thumbnail" src="img/user_default.svg" id="showpic" alt="Card image cap">

				<div class="card-body text-center">
					<div class="form-group row">
						<input type="file" name="pic" class="form-control  btn" >
					</div>
				</div>
			</div>
		</div>
		<div class="col-md mt-2">
			<div class="form-group row">
				<label for="staticEmail" class="col-sm-2 col-form-label">คำนำหน้า</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="staticEmail" placeholder="คำนำหน้า" name="titlename" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ชื่อ</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="ชื่อ"  name="fname" required> 
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">สกุล</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="สกุล"  name="lname" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label" >รหัสประชาชน</label>
				<div class="col-sm-10">
					<input type="number" class="form-control"   placeholder="รหัสประชาชน"  name="codeid" maxlength="13" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<select class="form-control"  name="pos">
						<?php
							$result=mysqli_query($con,"SELECT * FROM position ") or die ("errorSQL".mysqli_error($con));
							while(list($position_id,$position_name)=mysqli_fetch_row($result)){
								echo "<option value='".$position_id."' data-idbrn='".$position_id."' data-nbrn='".$position_name."'>$position_name</option>";
							}
						?>
					</select>
				</div>
				
				<label for="inputPassword" class="col-sm-2 col-form-label">ตำแหน่งวิชาการ</label>
				<div class="col-sm">
					<select class="form-control"  name="ap">
						<?php
							$result=mysqli_query($con,"SELECT * FROM academic ") or die ("errorSQL".mysqli_error($con));
							while(list($academic_id,$academic_name)=mysqli_fetch_row($result)){
								echo "<option value='".$academic_id."' data-idbrn='".$academic_id."' data-nbrn='".$academic_name."'>$academic_name</option>";
							}
						?>					
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">สาขาวิชา</label>
				<div class="col-md">
					<select class="form-control" id="selectbrn" name="brn" >
						<?php
						$result=mysqli_query($con,"SELECT * FROM branch ") or die ("errorSQL".mysqli_error($con));
						while(list($branch_id,$branch_name)=mysqli_fetch_row($result)){
						echo "<option value='".$branch_id."' data-idbrn='".$branch_id."' data-nbrn='".$branch_name."'>$branch_name</option>";
						}
						?>
						
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">หลักสูตร</label>
				<div class="col-md">
					<select class="form-control" id="selectsuj" name="suj">
						<?php
						$result=mysqli_query ($con,"SELECT  subject_id,subject_name,branch_id FROM subjects") or die ("error".mysqli_error($con));
						while(list($subject_id,$subject_name,$idbranch)=mysqli_fetch_row($result)){
						$branch=mysqli_query($con,"SELECT branch_name FROM branch WHERE branch_id='1'") or die ("errorSQL".mysqli_error($con));
						list($branch_name)=mysqli_fetch_row($branch);
							echo "<option value='".$subject_id."' data-idbrn='".$idbranch."' data-nbrn='".$branch_name."'>$subject_name</option>";
						}
						?>
						
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="วันเริ่มทำงาน" class="col-md-2 col-form-label">วันเริ่มทำงาน</label>
				<div class="col-md-10">
					<input type="date" class="form-control" min="0"  placeholder="วันเริ่มทำงาน" name="startwork" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="salary" class="col-md-2 col-form-label">เงินเดือน</label>
				<div class="col-md-10">
					<input type="number" class="form-control" min="0"  placeholder="เงินเดือน" name="salary" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-md-2 col-form-label">ชื่อผู้ใช้</label>
				<div class="col-md-10">
					<input type="text" class="form-control"  placeholder="Username" name="uname" required >
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-md-2 col-form-label">รหัสผ่าน</label>
				<div class="col-md-10">
					<input type="Password" class="form-control"  placeholder="Password" name="passwd" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-md-2 col-form-label">ยืนยันรหัสผ่าน</label>
				<div class="col-md-10">
					<input type="Password" class="form-control"  placeholder="Password" name="passwdv" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="" class="col-md-2 col-form-label">ประเภทบุคลากร</label>
				<div class="col-md-10">
					<select class="form-control"  name="permiss">
						<?php
							$permiss = mysqli_query($con,"SELECT  permiss_id,permiss_decs FROM permissions") or die ("error".mysqli_error($con));
							while(list($permissid,$permissname) = mysqli_fetch_row($permiss)){
								echo "<option value='".$permissid."'>$permissname</option>";
							}
							mysqli_free_result($permiss);
						?>
					</select>
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
<div class="col-md-12 row">
<div class="col-md-10">
</div>
<div class="col-md">
	<button type="submit" class="btn adduser ml-0" data-modules="personnel" data-action="updateuser"> ADD </button>
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
			
			$("#selectbrn").change(function(event) {
				var idbrn = $("#selectbrn option:selected").data("idbrn")
				$.post('module/personnel/getdatesuj.php', {id: idbrn}, function(data, textStatus, xhr) {
					$("#selectsuj").html(data);
				});
				
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
						+ "<input type='text' class='form-control'  placeholder='จบสาขาวิชา' name='degn1[]'> "
						+ "<input type='text'class='form-control' placeholder='จบที่'  name='degaddes1[]'> "
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
						+ "<input type='text' class='form-control'  placeholder='จบสาขาวิชา' name='degn2[]'> "
						+ "<input type='text'class='form-control'  placeholder='จบที่'  name='degaddes2[]'> "
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
						+ "<input type='text' class='form-control'  placeholder='จบสาขาวิชา' name='degn3[]'> "
						+ "<input type='text'class='form-control'  placeholder='จบที่'  name='degaddes3[]'> "
						+ "<button type='button' class='btn btn-danger btn-block deldegree3 '>ลบ</button>"
						+ "</li>"
				
						$(".loaddegree3").append(text);
					}else{
						alert("ไม่สามารเพื่มได้แล้ว");
							}
					}
// END ปริญญาเอก

			$('#edituser').change(function(event) {
				/* Act on the event */
		
			$('#edituser').validate({ // initialize the plugin
						        rules: {
						            passwd: {
						                required: true,
						                minlength:5
						            },
						            passwdv: {
						                required: true,
						                minlength:5,
						                equalTo: "#passwd"
						            }
						        },
								messages: {
									password: {
										required: "Please provide a password",
										minlength: "Your password must be at least 5 characters long"
									},
									confirm_password: {
										required: "Please provide a password",
										minlength: "Your password must be at least 5 characters long",
										equalTo: "Please enter the same password as above"
									},
									
								}

						    });
		
					});	
			$("#edituser").submit(function(e){

				
				
					$check = $("#edituser").valid();

					if($check == true){


					    e.preventDefault();

					    var formData = new FormData(this);

					    $.ajax({
					        url: "module/personnel/adduser.php",
					        type: 'POST',
					        data: formData,
					        success: function (data) {
					            alert(data)
					        },
					        cache: false,
					        contentType: false,
					        processData: false
					    });
					}

					

			
				
				})	// END adduser
		
		})

	
		// $('#editsub').modal("hide");
		// $('#editsub').on('hidden.bs.modal', function (e) {
		//     var module1 = sessionStorage.getItem("module1");
		//     var action = sessionStorage.getItem("action");
		//    loadmain(module1,action);
		// })
			
				
				
		

		
		
</script>