<?php
  session_start();
  include("../../function/db_function.php");
  include("../../function/fc_time.php");
$con=connect_db();
?>
<div class="row  p-2 headtitle">

	<h2 class="text-center col-xl "> จัดการหลักฐาน </h2>

</div>
<br>
<div class="table-responsive">
  <table class="table" id="Datatable">
    <thead>
      <tr>
        <th> รหัสประเมิน </th>
        <th> ปีการประเมิน </th>
        <th> รอบที่ </th>
				<th> สถานะ </th>
        <th class="text-center"> จัดการหลักฐาน </th>
      </tr>
    </thead>
    <tbody>
			<?php
					  $asm= mysqli_query($con,"SELECT tor_id,tor_year FROM tor ORDER BY tor_year DESC") or  die("SQL Error1==>".mysql_error($con));
						while(list($tor_id,$tor_year) = mysqli_fetch_row($asm)){

					echo "<tr>";
					echo " <td> $tor_id </td>";

							$year = substr($tor_year,0,4);
							$rond = substr($tor_year,4,4);
			    echo "<td> $year</td>";
			    echo "<td> $rond</td>";
				  echo "	<td> ยังไม่ได้อัปโหลดหลักฐาน </td>";
			    echo "  <td class='text-center'> <b class='btn text-primary addevd' data-torid='$tor_id' data-modules='assessment' data-action='formreport_prm'><i class='far fa-plus-square fa-2x'> <b></i>";
			    echo " </tr>";

	 } // END WHILE
?>
    </tbody>
  </table>
</div>

<script>
$.getScript('js/mydatatable.js')
  $(".addevd").click(function(){
			var tor_id = $(this).data("torid");
			$.post("module/assessment/formreport_prm.php",{ torid:tor_id}).done(function(data){
				sessionStorage.setItem("module1","assessment")
				sessionStorage.setItem("action","formreport_prm")
				$("#detail").html(data);
			})
	})
</script>
