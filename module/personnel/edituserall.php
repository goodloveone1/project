<?php
	 session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$yearnow = chk_idtest();
	$con=connect_db();


	$gen_id=$_SESSION['user_id'];
	$selectA=mysqli_query($con,"SELECT st_id,user,pwd,branch_id,code,prefix,fname,lname,salary,aca_code,acadeic,leves,other,startdate,permiss_id,position,picture,savetime
	 FROM staffs WHERE st_id='$gen_id'")or die("SQL ERROR =>".mysqli_error($con));
	list($st_id,$user,$pwd,$branch_id,$code,$prefix,$fname,$lname,$salary,$aca_code,$acadeic,$levels,$other,$startdate,$permiss_id,$position,$picture,$savetime)=mysqli_fetch_row($selectA);

	$userphoto=empty($picture)?"default/user_default.svg":$picture;
?>

<div class=" headtitle text-center p-2 row mb-2 row">
	<div class="col-md-2" ></div>
    <div class="col-md">
        <h2>แก้ไขข้อมูลส่วนตัว</h2>
    </div>
     <div class="col-md-2" ></div>
</div>

<form method="POST" enctype="multipart/form-data" id="edituser">
	<div class="row mt-2">
	<div class="col-lg-4">
			<div class="card">
				<img class="card-img-top img-thumbnail" src="img/<?php echo $userphoto; ?>" alt="Card image cap">
				<div class="card-body text-center">
					<div class="form-group row">
							<input type="file" class="form-control-file" name="pic_u" accept="image/* " id="gen_pic">	
						</div>
				</div>
			</div>
		</div>
		<div class="col-lg">
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">คำนำหน้า</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" placeholder="id" name="gen_id" value="<?php echo $gen_id ?>" hidden>
					<input type="text" class="form-control" placeholder="id" name="old_pic" value="<?php echo $picture ?>" hidden>
					<input type="text" class="form-control"  placeholder="คำนำหน้า"  name="titlename" value="<?php echo $prefix ?>" id="staticEmail" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ชื่อ</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="ชื่อ"  name="name" value="<?php echo $fname ?>"required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">สกุล</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="สกุล"  name="lname" value="<?php echo $lname ?>"required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label" maxlength="13" >รหัสประชาชน</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="รหัสประชาชน"  name="codeid" value="<?php echo$code?>"required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">เลขที่ประจำตำแหน่ง</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="เลขที่ประจำตำแหน่ง"  name="aca_code" value="<?php echo $aca_code; ?>"required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ตำแหน่ง </label>
				<div class="col-sm">
				<?php 
					$selectP=mysqli_query ($con,"SELECT  * FROM position WHERE pos_id='$position' ") or die ("error".mysqli_error($con));
					list($pos_id,$pos_name)=mysqli_fetch_row($selectP)
				?>
				<input type="hidden"  name="pos" value="<?php echo $pos_id ?>">
				<input type="text" class="form-control"   value="<?php echo $pos_name; ?>" disabled>
					<!-- <select class="form-control"  name="pos" disabled>
					<?php
						// $selectP=mysqli_query ($con,"SELECT  *FROM position ") or die ("error".mysqli_error($con));

						//  while(list($pos_id,$pos_name)=mysqli_fetch_row($selectP)){
						// 	$select=$pos_id==$position?"selected":"";
						// 	echo "<option value=$pos_id $select>$pos_name</option>";
						//  }

						?>
					</select>  -->
				</div>

				<label for="inputPassword" class="col-sm-2 col-form-label">ตำแหน่งวิชาการ</label>
				<div class="col-sm">
				<?php 
					$selectP=mysqli_query ($con,"SELECT * FROM academic  WHERE aca_id='$acadeic' ") or die ("error".mysqli_error($con));
					list($aca_id,$aca_name)=mysqli_fetch_row($selectP);
					$selectP->free_result();

					$seltor= mysqli_query($con,"SELECT * FROM assessments WHERE staff = '$gen_id' AND  year_id = '$yearnow'  ");
					$numtor = mysqli_num_rows($seltor);
					$seltor->free_result();

					$num ='0';
					if($permiss_id==2){
						$sumas= mysqli_query($con,"SELECT am.ass_id,y.y_no,y.y_year,sumt3.sum_score
						FROM assessments AS am 
						INNER JOIN years AS y ON am.year_id = y.y_id
						INNER JOIN sum_score_assessment_t3 AS sumt3 ON am.ass_id = sumt3.ass_id
						INNER JOIN asessment_t5 AS amt5 ON am.ass_id = amt5.ass_id
						INNER JOIN asessment_t6 AS amt6 ON am.ass_id = amt6.ass_id
						WHERE  am.staff='$gen_id' AND  am.ass_id LIKE  'TOR%' AND  amt5.accept = 1 AND amt5.inform = 1 
						AND amt6.leader_comt != 0 AND amt6.supervisor_comt != 0
						 ") or  die("SQL Error1==>1".mysqli_error($con));
						 $num = mysqli_num_rows($sumas);
						 mysqli_free_result($sumas);
					
					}
					if($permiss_id==3){
						$sumas= mysqli_query($con,"SELECT am.ass_id,y.y_no,y.y_year,sumt3.sum_score
						FROM assessments AS am 
						INNER JOIN years AS y ON am.year_id = y.y_id
						INNER JOIN sum_score_assessment_t3 AS sumt3 ON am.ass_id = sumt3.ass_id
						INNER JOIN asessment_t5 AS amt5 ON am.ass_id = amt5.ass_id
						INNER JOIN asessment_t6 AS amt6 ON am.ass_id = amt6.ass_id
						WHERE  am.staff='$gen_id' AND  am.ass_id LIKE  'TOR%' AND  amt5.accept = 1 AND amt5.inform = 1 
						AND amt6.leader_comt != 0 ") or  die("SQL Error1==>1".mysqli_error($con));
						$num = mysqli_num_rows($sumas);
						mysqli_free_result($sumas);
					
					}
					if($permiss_id==4){
						$sumas= mysqli_query($con,"SELECT am.ass_id,y.y_no,y.y_year,sumt3.sum_score
						FROM assessments AS am 
						INNER JOIN years AS y ON am.year_id = y.y_id
						INNER JOIN sum_score_assessment_t3 AS sumt3 ON am.ass_id = sumt3.ass_id
						INNER JOIN asessment_t5 AS amt5 ON am.ass_id = amt5.ass_id
						WHERE  am.staff='$gen_id' AND  am.ass_id LIKE  'TOR%' AND  amt5.accept = 1 AND amt5.inform = 1 
						 ") or  die("SQL Error1==>1".mysqli_error($con));
						 $num = mysqli_num_rows($sumas);
						 mysqli_free_result($sumas);
					
					}			

					//echo "-".$num." -$numtor- ";

					if($num == 0 AND $numtor != 0){

				?>
				<input type="hidden"  name="ap" value="<?php echo $aca_id ?>">
				<input type="text" class="form-control"   value="<?php echo $aca_name; ?>" disabled>

				<?php
					}
					else{
				?>		
					 <select class="form-control"  name="ap" >
					<?php
						$selectP=mysqli_query ($con,"SELECT  *FROM academic ") or die ("error".mysqli_error($con));

						 while(list($aca_id,$aca_name)=mysqli_fetch_row($selectP)){
							$seA=$aca_id==$acadeic?"selected":"";
							echo "<option value=$aca_id $seA>$aca_name</option>";
						 }
						 $selectP->free_result();
						?>
					</select> 
				<?php	
					}
				?>
					
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">หลักสูตร</label>
				<div class="col-md">
				<?php 
					$result=mysqli_query ($con,"SELECT * FROM branchs WHERE br_id='$branch_id' ") or die ("error".mysqli_error($con));
					list($subject_ID,$subject_name,$dept_id)=mysqli_fetch_row($result);
					$result->free_result();
				?>
				<input type="hidden"  name="suj" value="<?php echo $subject_ID ?>">
				<input type="text" class="form-control"   value="<?php echo $subject_name; ?>" disabled>

					<!-- <select class="form-control" id="selectsuj" name="suj" disabled>
						<?php
						// $result=mysqli_query ($con,"SELECT *FROM branchs ") or die ("error".mysqli_error($con));
						//  while(list($subject_ID,$subject_name,$dept_id)=mysqli_fetch_row($result)){
						//  	$branch=mysqli_query($con,"SELECT dept_name FROM departments WHERE dept_id='$dept_id'") or die ("errorSQL".mysqli_error($con));
        				// 	list($branch_name)=mysqli_fetch_row($branch);

						// 	$seP=$branch_id==$subject_ID?"selected":"";

						//  	echo "<option value='".$subject_ID."' data-idbrn='".$dept_id."' data-nbrn='".$branch_name."'$seP>$subject_name </option>";

						//  	$branch->free_result();
						//  }
						//  $result->free_result();
						?>

					</select> -->
						
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">สาขาวิชา  <?php  ?></label>
				<div class="col-md">
				<?php
				$det=mysqli_query($con,"SELECT dept_name FROM departments WHERE dept_id='$dept_id'") or die ("errorSQL".mysqli_error($con));
				list($detname)=mysqli_fetch_row($det);
				$det->free_result();
				?>
				<input type="text" class="form-control"   value="<?php echo $detname; ?>" disabled>
					<!-- <select class="form-control" id="selectbrn" name="brn" disabled>

					</select> -->
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">เงินเดือน</label>
				<div class="col-sm-10">
				<input type="hidden" class="form-control"  placeholder="salary" name="salary" value="<?php echo $salary ?>">
				<input type="text" class="form-control"  placeholder="salary" name="salary" value="<?php echo $salary ?>" disabled>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">วันที่เริ่มทำงาน</label>
				<div class="col-sm-10">
					<input type="date" class="form-control"  placeholder="Wstert" name="gen_startdate" value="<?php echo $startdate ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">หน้าที่พิเศษ</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="หน้าที่พิเศษ" name="level_id" value="<?php echo $levels ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">มาช่วยราชการจากที่ใด (ถ้ามี)</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="มาช่วยราชการจากที่ใด (ถ้ามี)" name="other" value="<?php echo $other;  ?>" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ชื่อผู้ใช้</label>
				<div class="col-sm-10">
					<input type="text" class="form-control"  placeholder="Username" name="uname" value="<?php echo $user ?>" required>

				</div>
			</div>

			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">รหัสผ่าน</label>
				<div class="col-sm-10">
					<input type="password" class="form-control"  placeholder="Password" name="passwd" value="<?php echo $pwd ?>" required id="showpw">
					<div class="form-check">
					 <input class="form-check-input " type="checkbox" onclick="chkpw()">
					  <label class="form-check-label" for="defaultCheck2">
					   แสดงรหัส
					  </label>
					</div>

				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword" class="col-sm-2 col-form-label">ยืนยันรหัสผ่าน</label>
				<div class="col-sm-10">
					<input type="password" class="form-control"  placeholder="ConPW" name="conPW" value="<?php echo $pwd ?>"  id="showconPW" required>
					<div class="form-check">
					 <input class="form-check-input" type="checkbox" onclick="chkpwcon()">
					  <label class="form-check-label" for="defaultCheck2">
					   แสดงรหัส
					  </label>
					</div>
				</div>
			</div>
			<div class="form-group row">
				<label for="" class="col-md-2 col-form-label">ประเภทบุคลากร</label>
				<div class="col-md-10">
				<?php 
					$permiss = mysqli_query($con,"SELECT  permiss_id,permiss_decs FROM permissions WHERE permiss_id='$permiss_id'") or die ("error".mysqli_error($con));
					list($permissid,$permissname) = mysqli_fetch_row($permiss);
					$permiss->free_result();
				?>
				<input type="hidden"  name="permiss" value="<?php echo $permissid ?>">
				<input type="text" class="form-control"   value="<?php echo $permissname; ?>" disabled>

					<!-- <select class="form-control"  name="permiss" disabled>
						<?php
							// $permiss = mysqli_query($con,"SELECT  permiss_id,permiss_decs FROM permissions") or die ("error".mysqli_error($con));

							// while(list($permissid,$permissname) = mysqli_fetch_row($permiss)){
							// 	$sePM=$permiss_id==$permissid?"selected":"";
							// 	echo "<option value='".$permissid."'$sePM>$permissname</option>";
							// }
							// mysqli_free_result($permiss);
						?>
					</select> -->
				</div>
			</div>
			
			</div>
		</div>	
								
		<div id='loadtabledegree'></div>		

		<div class='row'>					
			<div class="col-md-12 text-center mb-2" >
				<button type="submit" class="btn updateuser bg-success text-white" data-modules="personnel" data-action="updateuser"> บันทึก </button>
			</div>
		</div>	


</form>
<div id="addsub"></div>
<div id="editD"></div>
<?php mysqli_close($con) ?>


<script type="text/javascript">


		$(document).ready(function() {
			bsCustomFileInput.init() // TYPE file RENAME
			selectsuj();
			function selectsuj(){
				var $idbrn = $("#selectsuj option:selected").data('idbrn');
				var $nbrn = $("#selectsuj option:selected").data('nbrn');
				$("#selectbrn").html("<option value='"+$idbrn+"'>"+$nbrn+"</option>")
			}

			$("#selectsuj").change(function() {
				selectsuj();
			});

			$("#edituser").submit(function(e){
				e.preventDefault();
				$check = $("#edituser").valid();

				if($check == true){
				var formData = new FormData(this);

					    $.ajax({
					        url: "module/personnel/updateuser.php",
					        type: 'POST',
					        data: formData,
					        success: function (data) {
								// alert("บันทึกข้อมูลสำเร็จ" );
								swal("บันทึกสำเร็จ!", {
									icon: "success",
									buttons: false,
									timer: 1000,
								});
								loadingpage("personnel","edituserall")
					        },
					        cache: false,
					        contentType: false,
					        processData: false
					    });
						
				}

			

			})


//เซ็ค PW CON
$('#edituser').validate({ // initialize the plugin
								
						        rules: {
						            passwd: { 
						                minlength:5
						            },
						            conPW: {
						                minlength:5,
						                equalTo: "#showpw"
						            }
						        }
						    });
/// =================================   degree =======================
loaddatadegree(); // โหลดครั้งแรก		 
	function loaddatadegree(){  // FUNCTION loaddatadegree
		$.post( "module/personnel/loaddatadegree2.php", { genid : <?php echo $gen_id;?> })
		.done(function( data ) {
			//alert(data)
			$("#loadtabledegree").html(data);
		});

	}									

		$("#loadtabledegree").on('click', '.editbrn', function(event) { // ปุ่มแก้ไข
			event.preventDefault();

        var iddegree =$(this).data("iddegree");

	        $.post("module/personnel/editeducate.php", { id : iddegree }).done(function(data){
				//alert(data);
	        $('#editD').html(data);
	         $('#editsub').modal('show');
	        })


        });

$("#loadtabledegree").on('click', '.delbrn', function(event) {
			event.preventDefault();
	  // $(".delbrn").click(function(){
		var ideditsub =$(this).data("iddegree");
		var degreename =$(this).data("degreename");
            //var r = confirm("ต้องการลบวุฒิ "+degreename+" ใช่หรือไม่?");
        swal({
			title: "ต้องการลบวุฒิ "+degreename+" ใช่หรือไม่?",
			text: "เมื่อลบไปแล้วจะไม่สามารถกู้คืนได้!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.post( "module/personnel/deleteducate.php", { id : ideditsub}).done(function(data,txtstuta){
					//alert(data);
					
					loaddatadegree();
                    })
				swal("ลบข้อมูลสำเร็จแล้ว!", {
				icon: "success",
				buttons: false,
				timer: 1000,
				});
			} else {
				//swal("Your imaginary file is safe!");
			}
		});

               


            

	})

$("#loadtabledegree").on('click', '#adddegree', function(event) {
		event.preventDefault();

			var genids =$(this).data("genid");

	        $.post("module/personnel/formeducate.php", { genid : genids }).done(function(data){
				//alert(data);
	        $('#addsub').html(data);
	         $('#addedu').modal('show');
	        })
		});
	/// =================================  END  degree  =======================
	}); // END DOC
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
