<?php
	session_start();
	include("../../function/db_function.php");
	$con=connect_db();
?>
<div class="row  p-2 headtitle">
	<div class="col-md-2" style="display: block;">
		<!-- <button type="button" class="btn bg-white btn-block  menuuser"  data-modules="personnel" data-action="menumanage"><i class="fas fa-chevron-left"></i> ย้อนกลับ</button> -->
	</div>

<div class="col-md text-center">
	<h2> จัดการบุคลากร </h2>
</div>
<div class="col-md-2" style="display: block;"><button type="button"  class="managaedituser btn btn-block bg-white text-center" data-modules='personnel' data-action='formuser'><i class="fas fa-plus"></i> เพิ่มบุคลากร </button>

</div>
</div>
<div class="row">
<div class="col-md-12 mt-2">
<form  id="delall">
<div class="table-responsive">
	<table class="table " id="Datatable">
		<thead class="thead-light">
			<tr>
				<?php
					if(!empty($_GET['se'])){
						echo "<th><a href='javascript:void(0)' class='select1' >ไม่เลือก</a></th>";
						$ch="checked";
						}
						else{
							echo "<th><a href='javascript:void(0)' class='select2' >เลือกทั้งหมด</a></th>";
						$ch="";
							}

				echo"
				<th scope='col'>ลำดับ</th>
				<th scope='col' width='10%' class='text-center'>รูปภาพ </th>
				<th scope='col'>ชื่อ </th>
				<th scope='col'>นามสกุล</th>
				<th scope='col'>สาขา</th>
				<th scope='col'>หลักสูตร</th>
				<th scope='col'>แก้ไข</th>
				<th scope='col'>ลบ</th>";

				?>
			</tr>
		</thead>
		<tbody>


			<?php

					$show= mysqli_query($con,"SELECT st_id,fname,lname,branch_id,picture FROM staffs WHERE permiss_id !='1' ") or  die("SQL Error1==>1".mysql_error($con));
					$i=1;
						while(list($st_id,$fname,$lname,$branch_id,$picture)=mysqli_fetch_row($show)){
							$Sbrach=mysqli_query($con,"SELECT br_id,br_name,dept_id FROM branchs WHERE br_id='$branch_id'") or die ("mysql error=>>".mysql_error($con));
							list($Sbranch_id,$branch_name,$dept_id)=mysqli_fetch_row($Sbrach);
							$sdept=mysqli_query($con,"SELECT dept_name FROM departments WHERE dept_id='$dept_id'") or die("dept_error".mysqli_error($con));
							list($dept_name)=mysqli_fetch_row($sdept);

							$userphoto=empty($picture)?"default/user_default.svg":$picture;
						echo"
							<tr>	
								<td><div class='form-check ml-2'><input class='form-check-input' type='checkbox' name='delid[]' value='$st_id' $ch></div></td>
										<td>$i</td>
										<td><img src='img/$userphoto' alt='Responsive image' class='img-fluid' ></td>
										<td>$fname</td>
										<td>$lname</td>
										<td>$dept_name</td>
										<td>$branch_name</td>
										<td><a href='javascript:void(0)' class='managaedituser' data-modules='personnel' data-action='edituser' data-iduser='$st_id'><i class='fas fa-edit fa-2x '></i></a></td>
										<td><a href='javascript:void(0)'  class='deluser' data-iduser='$st_id' data-nuser='$fname $lname'><i class='fa fa-trash fa-2x'</i></a></td>
									";
							$i++;
							$Sbrach->free_result();
							
							}
							$show->free_result();
							$con->close();
				?>
			</tbody>

		</table>
	</div>
		<input type="hidden" name="test" value="1">
			</form>
		<tfoot>
		<p><input type="button " class="btn bg-success" value="ลบที่เลือก" id="btndelall" ></p>
		</tfoot>
	</div>

</div>


<script type="text/javascript">
		$(document).ready(function() {

			$.getScript('js/mydatatable.js') // dataTable	

			$(".managaedituser").click(function(){

				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				var genid = $(this).data('iduser');


				$.post('module/personnel/'+action+'.php', {id:genid}, function(){

				}).done(function(data){

					 $("#detail").html(data);
				})
			});
			$(".deluser").click(function(){   /// ป่มลบข้อมูล user

            var iduser =$(this).data("iduser");
            var nuser =$(this).data("nuser");

            var r = confirm("ต้องการลบข้อมูล "+nuser+" ใช่หรือไม่?");
            if (r == true) {
                $.post( "module/personnel/deluser.php", {id : iduser}).done(function(data,txtstuta){
					alert(data);
                    var module1 = sessionStorage.getItem("module1");
                    var action = sessionStorage.getItem("action");
                    loadmain(module1,action);
                    })
            	}
        	})

      
			// ไมเลือกทั้งหมด
			$(".select1").click(function(){
				$.get("module/personnel/mangauser.php",{se : ""}).done(function(data,txtstuta){
					//alert(data);
					$("#detail").html(data);
                    })
			});

			// เลือกทั้งหมด
			$(".select2").click(function(){
				$.get("module/personnel/mangauser.php",{se : "1"}).done(function(data,txtstuta){
					//alert(data);
					$("#detail").html(data);
                    })
			});

			$("#btndelall").click(function(){

				var text=$("input[name='delid[]']:checked").val();



				if(text!=undefined){
					$.post("module/personnel/deluser.php",$("#delall").serialize()).done(function(data,txtstuta){
					//alert(data);
					var module1 = sessionStorage.getItem("module1");
                    var action = sessionStorage.getItem("action");
                    loadmain(module1,action);
				})
				}
				else{
					alert("กรุณาเลือกข้อมูลที่ต้องการลบ");
				}

			})

		});

</script>
<!-- aleat-->
