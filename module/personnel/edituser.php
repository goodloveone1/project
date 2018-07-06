<?php
	include("../../function/db_function.php");
	$con=connect_db();


	$gen_id=$_POST['id'];
	$selectA=mysqli_query($con,"SELECT * FROM general WHERE gen_id='$gen_id'")or die("SQL ERROR =>".mysqli_error($con));
	list($gen_id,$gen_user,$gen_pass,$branch_id,$sub_id,$gen_code,$gen_prefix,$gen_fname,$gen_lname,$gen_salary,$gen_acadeic,$level_id,$gen_startdate,$permiss_id,$gen_pos,$gen_pict)=mysqli_fetch_row($selectA);

	$userphoto=empty($gen_pict)?"user_default.svg":$gen_pict;
?>

<div class=" headtitle text-center p-2 row mb-2 row">
    <div class="col-sm-2" >
       <a href=#> <button type="button" class="btn re btn-block" id="backpage" data-modules="personnel" data-action="mangauser"><i class="fas fa-chevron-left"></i>&nbsp;ย้อนกลับ</button></a>
    </div>
    <div class="col-md">
        <h2>แก้ไขบุคลากร</h2>
    </div>
</div>


<form method="POST" enctype="multipart/form-data" id="edituser">
	<div class="row mt-2">
		<div class="col-md-3">
			<div class="card">
				<img class="card-img-top img-thumbnail" src="img/<?php echo $userphoto; ?>" alt="Card image cap">
				<div class="card-body text-center">
					<div class="form-group row">
						<input type="file" name="pic_u" class="form-control  btn" >
					</div>
				</div>
			</div>
		</div>
		<div class="col-md">
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">คำนำหน้า</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="id" name="gen_id" value="<?php echo $gen_id ?>" hidden>
					<input type="text" class="form-control" placeholder="id" name="old_pic" value="<?php echo $gen_pict ?>" hidden>
					<input type="text" class="form-control"  placeholder="คำนำหน้า"  name="titlename" value="<?php echo $gen_prefix ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ชื่อ</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="ชื่อ"  name="name" value="<?php echo $gen_fname ?>"required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">สกุล</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="สกุล"  name="lname" value="<?php echo $gen_lname ?>"required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label" maxlength="13" >รหัสประชาชน</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="รหัสประชาชน"  name="codeid" value="<?php echo$gen_code?>"required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ตำแหน่ง</label>
				<div class="col-sm">
					<select class="form-control"  name="pos">
					<?php
						$selectP=mysqli_query ($con,"SELECT  *FROM position ") or die ("error".mysqli_error($con));

						 while(list($pos_id,$pos_name)=mysqli_fetch_row($selectP)){
							$select=$pos_id==$gen_pos?"selected":"";
							echo "<option value=$pos_id $select>$pos_name</option>";
						 }

						?>
					</select>
				</div>
		
				<label for="inputPassword" class="col-sm-2 col-form-label">ตำแหน่งวิชาการ</label>
				<div class="col-sm">
					<select class="form-control"  name="ap">
					<?php
						$selectP=mysqli_query ($con,"SELECT  *FROM academic ") or die ("error".mysqli_error($con));

						 while(list($aca_id,$aca_name)=mysqli_fetch_row($selectP)){
							$seA=$aca_id==$gen_acadeic?"selected":"";
							echo "<option value=$aca_id $seA>$aca_name</option>";
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
						$result=mysqli_query ($con,"SELECT  subject_id,subject_name,branch_id FROM subjects ") or die ("error".mysqli_error($con));

						 while(list($subject_ID,$subject_name,$idbranch)=mysqli_fetch_row($result)){
						 	$branch=mysqli_query($con,"SELECT branch_name FROM branch WHERE branch_id='$idbranch'") or die ("errorSQL".mysqli_error($con));
        					list($branch_name)=mysqli_fetch_row($branch);
							
							$seP=$sub_id==$subject_ID?"selected":""; 
						
						 	echo "<option value='".$subject_ID."' data-idbrn='".$idbranch."' data-nbrn='".$branch_name."'$seP>$subject_name</option>";		
						 }

						?>
					
					</select>
						
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">สาขาวิชา</label>
				<div class="col-md">
					<select class="form-control" id="selectbrn" name="brn">
						
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">เงินเดือน</label>
				<div class="col-sm-10">
				<input type="text" class="form-control"  placeholder="salary" name="salary" value="<?php echo $gen_salary ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">วันที่เริ่มทำงาน</label>
				<div class="col-sm-10">
					<input type="date" class="form-control"  placeholder="Wstert" name="gen_startdate" value="<?php echo $gen_startdate ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">หมายเหตุ</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="level" name="level_id" value="<?php echo $level_id ?>" required>
				</div>
			</div>
			<hr>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ชื่อผู้ใช้</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="Username" name="uname" value="<?php echo $gen_user ?>" required>	
					
				</div>
			</div>
		
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">รหัสผ่าน</label>
				<div class="col-sm-10">
					<input type="password" class="form-control"  placeholder="Password" name="passwd" value="<?php echo $gen_pass ?>" required>
				</div>	
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ยืนยันรหัสผ่าน</label>
				<div class="col-sm-10">
					<input type="password" class="form-control"  placeholder="ConPW" name="conPW" value="<?php echo $gen_pass ?>" required>
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
		
		<div class="col-md-12 text-center mb-2" >
		<button type="submit" class="btn updateuser" data-modules="personnel" data-action="updateuser"> บันทึก </button>
		</div>
	</div>
</form>
<script type="text/javascript">


		$(document).ready(function() {

			selectsuj();

			$("button.re").click(function(){
				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				loadmain(module1,action);
			});

			function selectsuj(){
				var $idbrn = $("#selectsuj option:selected").data('idbrn');
				var $nbrn = $("#selectsuj option:selected").data('nbrn');
				$("#selectbrn").html("<option value='"+$idbrn+"'>"+$nbrn+"</option>")
			}

			$("#selectsuj").change(function() {				
				selectsuj();					
			});

			
			$("#edituser").submit(function(){
				
				$check = $("#edituser").valid();

				if($check == true){
				var formData = new FormData(this);

					    $.ajax({
					        url: "module/personnel/updateuser.php",
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
				// $.post( "module/personnel/updateuser.php", $( "#edituser" ).serialize()).done(function(data,txtstuta){
            	 	//alert(data);
		        // });

		        // $('#editsub').modal("hide");

		        // $('#editsub').on('hidden.bs.modal', function (e) {

		        //     var module1 = sessionStorage.getItem("module1");
		        //     var action = sessionStorage.getItem("action");
		        //    loadmain(module1,action);
		        // })
			})	

				
				
		

			
		});

		
		


</script>