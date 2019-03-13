<?php
  session_start();
  include("../../function/db_function.php");
  include("../../function/fc_time.php");
$con=connect_db();
?>

<div class="table-responsive">
  <table class="table" id="Datatable">
    <thead>
      <tr>
        <th> รหัสประเมิน </th>
        <th> ปีการประเมิน </th>
        <th> รอบที่ </th>
				<th> ชื่อ - สกุล</th>
		
				<th> สาขา </th>
				<th> หลักสูตร </th>
				<th> ตำแหน่ง </th>
				<th> สถานะ </th>
        <th class="text-center"> จัดการหลักฐาน</th>
      </tr>
    </thead>
    <tbody>
			<?php
						$dept= mysqli_query($con,"SELECT br_name,(SELECT dept_name FROM departments WHERE dept_id=branchs.dept_id ) FROM branchs WHERE br_id='$_SESSION[branch]'" ) or  die("SQL Error==> ".mysqli_error($con));
						list($br_name,$dept_name) = mysqli_fetch_row($dept);
						mysqli_free_result($dept);

						if($_SESSION['user_level'] == 3){ //  หลักสูตร

						$asm= mysqli_query($con,"SELECT ass_id,year_id,st.st_id,st.fname,st.lname,st.position FROM assessments AS ass INNER JOIN staffs AS st ON ass.staff = st.st_id WHERE ass.staff != '$_SESSION[user_id]' AND st.branch_id='$_SESSION[branch]' AND st.permiss_id = '2' AND year_id='$_POST[year]' ORDER BY year_id DESC") or  die("SQL Error==> ".mysqli_error($con));
						
						}else if($_SESSION['user_level'] == 4){ // สาขา
							$asm= mysqli_query($con,"SELECT ass_id,year_id,st.st_id,st.fname,st.lname,st.position FROM assessments AS ass INNER JOIN staffs AS st ON ass.staff = st.st_id WHERE ass.staff != '$_SESSION[user_id]' AND st.branch_id='$_SESSION[branch]' AND st.permiss_id = '3' AND year_id='$_POST[year]' ORDER BY year_id DESC") or  die("SQL Error==> ".mysqli_error($con));
						}else if($_SESSION['user_level'] == 5){ // คณะ
							$asm= mysqli_query($con,"SELECT ass_id,year_id,st.st_id,st.fname,st.lname,st.position FROM assessments AS ass INNER JOIN staffs AS st ON ass.staff = st.st_id WHERE ass.staff != '$_SESSION[user_id]' AND st.branch_id='$_SESSION[branch]' AND st.permiss_id = '4' AND year_id='$_POST[year]' ORDER BY year_id DESC") or  die("SQL Error==> ".mysqli_error($con));
						}	
						while(list($ass_id,$tor_year,$st_id,$st_name,$st_lname,$position) = mysqli_fetch_row($asm)){

					echo "<tr>";
					echo " <td> $ass_id </td>";

							$year = substr($tor_year,0,4);
							$rond = substr($tor_year,4,4);
			    echo "<td> $year</td>";
					echo "<td> $rond</td>";
					echo "<td> $st_name $st_lname</td>";

					echo "<td> $dept_name</td>";
					echo "<td>   $br_name</td>";

					$pos= mysqli_query($con,"SELECT pos_name FROM position WHERE pos_id='$position'  ") or  die("SQL Error1==>1".mysql_error($con));
					list($pos_name)=mysqli_fetch_row($pos);
					mysqli_free_result($pos);

    			echo "<td>$pos_name</td>";


					$evd= mysqli_query($con,"SELECT evd_id,evd_status FROM evidence WHERE st_id='$st_id' AND ass_id='$ass_id'");
					list($evd_id,$evd_status) = mysqli_fetch_row($evd);
					
					if(chk_idtest() ==  $tor_year)	{

					if(empty($evd_status)){
							echo "<td><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i> ยังไม่ได้อัปโหลดหลักฐาน</b></td>";
							echo "  <td class='text-center'> <b class='btn text-info' ><i class='far fa-clock fa-2x'></i> รอบุคลากรอัปโหลดหลักฐาน </b></td>";
					}else if($evd_status == 1){
						echo "<td><b class='text-danger'><i class='far fa-clock fa-2x'></i> รอยืนยันอีกครั้ง </b></td>"; 
							echo "  <td class='text-center'> <b class='btn text-info' ><i class='far fa-clock fa-2x'></i> รอบุคลากรยืนยันหลักฐาน </b></td>";
					}else if($evd_status == 2){
						echo "<td><b class='text-info'> <b><i class='far fa-clock fa-2x'></i> รอผู้บังคับบัญชาพิจารณา </b></td>"; 
							echo "  <td class='text-center '> <b class='btn checkevd text-success' data-evdid='$evd_id'><i class='fas fa-check-circle fa-2x'></i>ตรวจสอบหลักฐาน </b></td>";
					}else if($evd_status == 3){
						echo "<td><b class='text-success'> <b><i class='fas fa-check-circle fa-2x'></i> ผู้บังคับบัญชาได้พิจารณาแล้วให้การรับรองแล้ว </b></td>"; 
							echo "  <td class='text-center text-success '> <b class='btn checkevd text-success' data-evdid='$evd_id'><i class='fas fa-info fa-2x'></i> รายละเอียดหลักฐาน </b></td>";
					}	else if($evd_status == 4){
						echo "<td><b class='text-danger'> <b><i class='fas fa-times-circle fa-2x'></i> ผู้บังคับบัญชาได้พิจารณาแล้วไม่ให้การรับรอง </b></td>"; 
						echo "  <td class='text-center'> <b class='btn text-primary'><i class='fas fa-times-circle fa-2x'></i> รอบุคลากรตรวจสอบหลักอีกครั้ง </b></i></td>";
					}		
	
				}	else{
						if(empty($evd_status)){
							echo "<td><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i> ยังไม่ได้อัปโหลดหลักฐาน</b></td>";
							echo "  <td class='text-center text-danger'><b> <i class='fas fa-exclamation fa-2x'></i> อยู่นอกระยะการประเมิน </b> </td>";
					}else if($evd_status == 1){
						echo "<td><b class='text-danger'><i class='far fa-clock fa-2x'></i> รอยืนยันอีกครั้ง </b></td>"; 
						echo "  <td class='text-center text-danger'><b> <i class='fas fa-exclamation fa-2x'></i> อยู่นอกระยะการประเมิน </b> </td>";
					}else if($evd_status == 2){
						echo "<td><b class='text-info'><i class='far fa-clock fa-2x'></i> รอผู้บังคับบัญชาพิจารณา </b></td>"; 
						echo "  <td class='text-center text-danger'><b> <i class='fas fa-exclamation fa-2x'></i> อยู่นอกระยะการประเมิน </b> </td>";
					}else if($evd_status == 3){
						echo "<td><b class='text-info'><i class='far fa-clock fa-2x'></i> ผู้บังคับบัญชาได้พิจารณาแล้วให้การรับรองแล้ว </b></td>"; 
						echo "  <td class='text-center text-success '> <i class='fas fa-info fa-2x'></i> รายละเอียดหลักฐาน</td>";
					}else if($evd_status == 4){
						echo "<td><b class='text-info'><i class='far fa-clock fa-2x'></i> รอผู้บังคับบัญชาพิจารณา </b></td>"; 
							echo "  <td class='text-center text-info '></td>";
					}		
				}

					
					
			    echo " </tr>";
					mysqli_free_result($evd);
	 } // END WHILE

	 
	 mysqli_free_result($asm);
	 mysqli_close($con);
?>
    </tbody>
  </table>
</div>


<script>
$.getScript('js/mydatatable.js')

	$(".checkevd").click(function(){
			var tor_id = $(this).data("torid");
			$("#detail").html("");
			$.post("module/assessment/editformreport_prm_check.php",{evdid: $(this).data("evdid") }).done(function(data){
				sessionStorage.setItem("module1","assessment")
				<?php 
					if($_SESSION['user_level'] == 2){ // อาจารย์
				?>
				sessionStorage.setItem("action","manage_Evidence")
				<?php 
					}else { // หลักสูตร
				?>
				sessionStorage.setItem("action","manage_Evidence_course")
				<?php 
					}
				?>
				$("#detail").html(data);
			})
	})
</script>
