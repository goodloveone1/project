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
					<input type="password" class="form-control"  placeholder="Password" name="passwd" value="<?php echo $gen_pass ?>" required id="showpw">
					<input type="checkbox" onclick="chkpw()">แสดงรหัส
				</div>	
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ยืนยันรหัสผ่าน</label>
				<div class="col-sm-10">
					<input type="password" class="form-control"  placeholder="ConPW" name="conPW" value="<?php echo $gen_pass ?>" required id="showconPW">
					<input type="checkbox" onclick="chkpwcon()">แสดงรหัส
				</div>	
			</div>
			<div class="form-group row">
				<label for="" class="col-md-2 col-form-label">ประเภทบุคลากร</label>
				<div class="col-md-10">
					<select class="form-control"  name="permiss">
						<?php
							$permiss = mysqli_query($con,"SELECT  permiss_id,permiss_decs FROM permissions") or die ("error".mysqli_error($con));
							
							while(list($permissid,$permissname) = mysqli_fetch_row($permiss)){
								$sePM=$permiss_id==$permissid?"selected":""; 
								echo "<option value='".$permissid."'$sePM>$permissname</option>";
							}
							mysqli_free_result($permiss);
						?>
					</select>
				</div>
			</div>
			<div class="form-group row " >
				<label for="" class="col-md-2 col-form-label">วุฒิการศึกษา</label>
				<div class="col-md-30">


					<table class="table col-md display" id="tbeucation">
					<thead>

					<table class="table" id="tbeducate">
					<thead class="thead-light">


					<table class="table" id="tbeducate">
					<thead class="thead-light">

					<tr>	
							<th>วุฒิการศึกษา</th>
							<th>ชื่อวุฒิการศึกษา</th>
							<th>สถานที่จบการศึกษา</th>
							<th>แก้ไข</th>
							<th>ลบ</th>
					</tr>
					</thead>
					<tbody>


					<?php
						$degree = mysqli_query($con,"SELECT  ed_id,degree_id,ed_name,ed_loc FROM education WHERE gen_id='$gen_id'") or die ("error".mysqli_error($con));
						while(list($ed_id,$degree_id,$ed_name,$ed_loc)=mysqli_fetch_row($degree)){
							$deName = mysqli_query($con,"SELECT degree_name FROM degree WHERE degree_id='$degree_id'")or die("errorSQL".mysqli_error($con));
							list($degree_name)=mysqli_fetch_row($deName);
							echo"
									<tr>
							
						// 				<td>$degree_name</td>
						// 				<td>$ed_name</td>
						// 				<td>$ed_loc</td>
						// 				<td><a href='#'class='editbrn' data-iddegree='$ed_id' data-toggle='modal' ><i class='fas fa-edit fa-2x'></i></a></td>
      //           						<td><a href='#' class='delbrn' data-degreename='$degree_name' data-iddegree='$ed_id'><i class='fas fa-trash-alt fa-2x'></i></a></td>
										
									</tr>
							";
						}
						mysqli_free_result($degree);
					?>
					<tr>
						<td><button type="button" class="adddegree" data-toggle="modal">เพิ่มวุฒิการศึกษา</button></td>
					</tr>

					</tbody>
					</table>
				</div>
			</div>
		</div>
		</div>

		<div class="col-md-12 text-center mb-2" >
		<button type="submit" class="btn updateuser" data-modules="personnel" data-action="updateuser"> บันทึก </button>
		</div>

	</div>
</form>
<div id="addsub"></div>
<div id="editD"></div>
<?php mysqli_close($con) ?>


<script type="text/javascript">

		//var table=$("#tbeducate").DataTable()
		$(document).ready(function() {
	
	$(".test").click(function(event) {
		  $('#tbeucation').DataTable().ajax.reload();
	});

		$("#tbeucation").DataTable({
			 "ajax" : {
			 	 "url": "module/personnel/loaddatadegree.php",
			 	 "data" : {getid: <?php echo $gen_id;?>},
			 	 "type": "POST",
				 "dataSrc":""
			 }

		});
			

			

			
		

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

					
//เซ็ค PW CON
$('#edituser').validate({ // initialize the plugin
						        rules: {
						            passwd: {
						                required: true,
						                minlength:5
						            },
						            conPW: {
						                required: true,
						                minlength:5,
						                equalTo: "#showpw"
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
		
		$("#tbeucation").on('click', '.editbrn', function(event) {
			event.preventDefault();
		// });	
	 //   $(".editbrn").click(function(){
        var iddegree =$(this).data("iddegree");
        
        $.post("module/personnel/editdegree.php", { id : iddegree }).done(function(data){
			// alert(data);
        $('#editD').html(data);
         $('#editsub').modal('show');
        })
        
        
        });						

$("#tbeucation").on('click', '.delbrn', function(event) {
			event.preventDefault();
	  // $(".delbrn").click(function(){
		var ideditsub =$(this).data("iddegree");
		var degreename =$(this).data("degreename");
			
            var r = confirm("ต้องการลบวุฒิ "+degreename+" ใช่หรือไม่?");
            if (r == true) {
				
                $.post( "module/personnel/deletedegree.php", { id : ideditsub}).done(function(data,txtstuta){
					alert(data);
<<<<<<< HEAD
					 $('#tbeucation').DataTable().ajax.reload();// NEW LOAD DATA
					 
=======
					//table.ajex.reload(null,false);
					//location.reload();
>>>>>>> c7f58b93ef7d9b8f38c6b9b653ccb8cbb444a9e4
                    })

               
            }
		
	})

$("#tbeucation").on('click', '#adddegree', function(event) {
		event.preventDefault();
        // $("#adddegree").click(function( ){

        $('#loadaddsub').load("module/personnel/adddegree.php",function(){
            $('#addsub').modal('show');     
            });
         });	
				
		

			
		});
//ดูรหัส
function chkpw() {
    var x = document.getElementById("showpw");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
function chkpwcon() {
    var x = document.getElementById("showconPW");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

       	
		
</script>