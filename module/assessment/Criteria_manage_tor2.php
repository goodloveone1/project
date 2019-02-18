<?php
	include("../../function/db_function.php");
	$con=connect_db();

	$academic = $con->query("SELECT * FROM academic ");

		// 	$tor = $con->query("SELECT * FROM tort2_title");
	

			while(list($ac_id,$ac_name) = $academic->fetch_row()){

?>
			<div class='row mb-5'>
			<div class='col-md-12 text-center'><h3  class="h3">ส่วนที่  ๒  องค์ประกอบที่ ๒ พฤติกรรมการปฏิบัติงาน (สมรรถนะ)</h3> </div> 
				<div class='col-md-12'><h3 class='h3'> <?php echo $ac_id." " .$ac_name ?> </h3> </div>
				
				<?php 
					$tit = $con->query("SELECT * FROM capacity ");
	
					while(list($tit_id,$tit_name) = $tit->fetch_row()){
						
						echo "<div class='col-md-12'> ";	
							
					?>
					<table class="table table-bordered">
							<thead>
								<tr class='' >
									<th class='w-50'> <?php echo $tit_name ?></th>
									<th class='text-center'> สมรรถนะที่คาดหวัง </th>
									<th class='text-center'> แก้ไข </th>
								</tr>
					</thead>
					<tbody>
					<?php
					$tor2_exp = $con->query("SELECT atb_id,subtit,sub_name,score FROM  aptitudes as exp INNER JOIN sub_capacity as sub ON exp.subtit = sub.sub_id WHERE aca_id='$ac_id' AND sub.cap_id = '$tit_id' ") or die($con->error);			
					while($fettor2 = $tor2_exp->fetch_assoc()){
						//print_r($fettor2);													
						echo	"<tr>";
						echo		"<td scope='row'> $fettor2[sub_name] </td>";
						echo		"<td class='text-center'> $fettor2[score] </td>";
						echo		"<td class='text-center'><a href='javascript:void(0)' class='managaedituser' data-idexp='$fettor2[atb_id]'><i class='fas fa-edit fa-2x '></i></a></td>";	
						echo	"</tr>";
						
													
					} 
					echo  "</tbody>";
					echo  "</table>";
					echo "</div>";

				} // END WHILE TOR2 title
				
					
						
				?>

 			</div>
	 
<?php	 
				 } // END WHILE ตำแหน่งวิชาการ
			?>
			
