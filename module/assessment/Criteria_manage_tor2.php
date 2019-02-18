<?php
	include("../../function/db_function.php");
	$con=connect_db();

	$academic = $con->query("SELECT * FROM academic ");
	
	


	

		// 	$tor = $con->query("SELECT * FROM tort2_title");
		

			while(list($ac_id,$ac_name) = $academic->fetch_row()){

?>
			<div class='row mb-5'>
				<div class='col-md-12'><h3 class='h3'> <?php echo $ac_id." " .$ac_name ?> </h3> </div>
				
				<?php 
					$tit = $con->query("SELECT * FROM tort2_title ");
	
					while(list($tit_id,$tit_name) = $tit->fetch_row()){
						
						echo "<div class='col-md-12'> ";	
							
					?>
					<table class="table table-bordered">
							<thead>
								<tr class='' >
									<th > <?php echo $tit_name ?></th>
									<th > สมรรถนะที่คาดหวัง </th>
									<th > แก้ไข </th>
								</tr>
					</thead>
					<tbody>
					<?php
					$tor2_exp = $con->query("SELECT exp_id,tort2_subtit,tort2_name,exp_score FROM  tort2_exp as exp INNER JOIN tort2_subtit as sub ON exp.tort2_subtit = sub.tort2_sub_id WHERE aca_id='$ac_id' AND sub.tort2_tit_id = '$tit_id' ") or die($con->error);			
					while($fettor2 = $tor2_exp->fetch_assoc()){
						//print_r($fettor2);													
						echo	"<tr>";
						echo		"<td scope='row'> $fettor2[tort2_name] </td>";
						echo		"<td> $fettor2[exp_score] </td>";
						echo		"<td>แก้ไข </td>";	
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
			
