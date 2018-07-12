<?php
	session_start();
	include("../../function/db_function.php");
	$con=connect_db();
?>
<div class="row  p-2 headtitle">
	<div class="col-md-2" style="display: block;"><a href="javascript:void(0)" id="btnre" data-modules='personnel' data-action='menumanage'><button type="button" class="btn btn-block"><i class="fas fa-chevron-left"></i> ย้อนกลับ</button></a>
	
</div>

<div class="col-md text-center">
	<h2> จัดการบุคลากร </h2>
</div>
<div class="col-md-2" style="display: block;"><a href="javascript:void(0)" class="managaedituser" data-modules='personnel' data-action='formuser'><button type="button" class="btn btn-block"><i class="fas fa-plus"></i> เพิ่มบุคลากร</button></a>
	
</div>
</div>
<div class="row">
<div class="col-md-12 mt-2">
	<table class="table" id="example">
		<thead class="thead-light">
			<tr>
				<th scope="col">ลำดับ</th>
				<th scope="col">ชื่อ </th>
				<th scope="col">นามสกุล</th>
				<th scope="col">สาขา</th>
				<th scope="col">หลักสูตร</th>
				<th scope="col">แก้ไข</th>
				<th scope="col">ลบ</th>
			</tr>
		</thead>
		<tbody>
		

			<?php
					
					$show= mysqli_query($con,"SELECT gen_id,gen_fname,gen_lname,branch_id,subject_id FROM general ") or  die("SQL Error1==>1".mysql_error($con)); ;
					$i=1;


						while(list($gen_id,$gen_fname,$genlname,$branch_id,$subject_id)=mysqli_fetch_row($show)){
							$Sbrach=mysqli_query($con,"SELECT branch_id,branch_name FROM branch WHERE branch_id='$branch_id'") or die ("mysql error=>>".mysql_error($con));
								list($Sbranch_id,$branch_name)=mysqli_fetch_row($Sbrach);
							$subjects=mysqli_query($con,"SELECT subject_id,subject_name,branch_id FROM subjects WHERE subject_id='$subject_id'") or die ("mysql error=>>".mysql_error($con));
							list($Ssubject_id,$subject_name,$branch_id)=mysqli_fetch_row($subjects);
						echo"
							<tr>
										<td>$i</td>					
										<td>$gen_fname</td>
										<td>$genlname</td>
										<td>$branch_name</td>
										<td>$subject_name</td>
										<td><a href='javascript:void(0)' class='managaedituser' data-modules='personnel' data-action='edituser' data-iduser='$gen_id'><i class='fas fa-edit fa-2x '></i></a></td>
										<td><a href='javascript:void(0)'  class='deluser' data-iduser='$gen_id' data-nuser='$gen_fname $genlname'><i class='fa fa-trash fa-2x'</i></a></td>
									";
							$i++;
							}
				
					
				?>
				
			</tbody>
		</table>
		
	</div>
	
</div>

<!-- <a href="#" class="mangadeluser" data-modules="personnel" data-action="edituser">cdhw-</a> LINK TO EDIT -->
<script type="text/javascript">
		$(document).ready(function() {

			$("#btnre").click(function(event) {
				var module1 = $(this).data('modules');
				var action = $(this).data('action');

				loadmain(module1,action);
			});


			$("a.managaedituser").click(function(){

				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				var genid = $(this).data('iduser');
				
			
				$.post('module/personnel/'+action+'.php', {id:genid}, function(){
					
				}).done(function(data){
				
					 $("#detail").html(data);
				})

			

				
			});

			$("#btnsearch").click(function(event) {

				$.post('module/personnel/mangauser.php', $("#search").serialize(), function(data, textStatus, xhr) {
					$("#detail").html(data)
				});
				
			});

			$(".deluser").click(function(){
            
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

			$('#example').DataTable();


		});
</script>
<!-- aleat-->
