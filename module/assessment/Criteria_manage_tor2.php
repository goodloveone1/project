<div class='row p-2 headtitle mb-3'>
<div class='col-md text-center'><h3  class="h3">เกณฑ์ให้คะแนน พฤติกรรมการปฏิบัติงาน (สมรรถนะ)</h3> </div> 
</div>
<?php
	include("../../function/db_function.php");
	$con=connect_db();

	$academic = $con->query("SELECT * FROM academic ");

		// 	$tor = $con->query("SELECT * FROM tort2_title");
	

			while(list($ac_id,$ac_name) = $academic->fetch_row()){

?>
				<div class='row mb-3 '>
			
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
					$tor2_exp = $con->query("SELECT atb_id,sub_name,score FROM  aptitudes as exp INNER JOIN sub_capacity as sub ON exp.subcap_id = sub.sub_id WHERE aca_id='$ac_id' AND sub.cap_id = '$tit_id' ") or die($con->error);			
					while($fettor2 = $tor2_exp->fetch_assoc()){
						//print_r($fettor2);													
						echo	"<tr>";
						echo		"<td scope='row'> $fettor2[sub_name] </td>";
						echo		"<td class='text-center'> $fettor2[score] </td>";
						echo		"<td class='text-center'><a href='javascript:void(0)' class='edit' data-idexp='$fettor2[atb_id]' data-subname='$fettor2[sub_name]' data-score='$fettor2[score]' ><i class='fas fa-edit fa-2x '></i></a></td>";	
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

				 $academic->free_result();
				 $tit->free_result();
				 $tor2_exp->free_result();
				 $con->close();
			?>

<div id="loademodel"></div>

<script>
     //$('#tablebranch').DataTable();
    $(".edit").click(function( ){
        
        
        $.post("module/assessment/Criteria_tor2_model.php", { atbid : $(this).data("idexp"),subname : $(this).data("subname"),score : $(this).data("score") }).done(function(data){
        $('#loademodel').html(data);
        $('#editsub').modal('show');
        })
        
        
        });
       

 

        </script>			
