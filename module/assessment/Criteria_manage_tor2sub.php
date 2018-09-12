<?php
	include("../../function/db_function.php");
	$con=connect_db();

	$tortit_id= empty($_POST['id'])?'':$_POST['id'];
	$retitname = $con->query("SELECT tort2_til_name FROM  tort2_title WHERE tort2_til_id ='$tortit_id'");
	list($titname) = $retitname->fetch_row();
	$retitname->free_result();

	$re = $con->query("SELECT tort2_sub_id,tort2_name FROM  tort2_subtit WHERE tort2_tit_id ='$tortit_id'");

?>

<div class="row p-2 headtitle">
	 <div class="col-md-2" >
       <a href='javascript:void(0)'> <button type="button" class="btn re btn-block menuuser"  data-modules="assessment" data-action="Criteria_manage_tor2"><i class="fas fa-chevron-left"></i>&nbsp;ย้อนกลับ</button></a>
    </div>
	<div class="col-md text-center">
		<h3> <?php echo $titname ?> </h3>
	</div>
	 <div class="col-md-2" >
      
    </div>
</div>
<div class="row p-2">
	<div class="col-md-12 mt-2">
		<table class="table table-bordered datatables">
			<thead class="thead-light">
				<tr>
					<th scope="col">รหัส</th>
					<th scope="col"><?php echo $titname ?></th>
					<th scope="col" class="text-center">จัดการระดับสมรรถนะที่คาดหวัง
					</th>
				</tr>
			</thead>
			<tbody>
				<?php 
						while(list($id,$name) = $re->fetch_row()){
				?>
				<tr>
					<th scope="row"><?php echo $id ?></th>
					<td><?php echo $name ?></td>
					<td class="text-center"><a href='javascript:void(0)' class='addtor2score'  data-tor2subid='<?php echo $id ?>' data-tor2subname='<?php echo $name ?>'><i class='fas fa-edit fa-2x '></i></a></td>
				</tr>
				<?php
					} // END WHILE
					$re->free_result();
					$con->close();
				?>
			</tbody>
		</table>
	</div>
</div>
<div id="loadmodel"></div>	
<script type="text/javascript">
	// $(".datatables").DataTable();

	$('.addtor2score').on("click",function(event) {
		$('#loadmodel').html("")
		var tor2subid = $(this).data('tor2subid')	
		var tor2subname = $(this).data('tor2subname')	
		 $.post("module/assessment/Criteria_tor2subscore.php", { id : tor2subid , name : tor2subname }).done(function(data){
        $.when($('#loadmodel').html(data)).done(function(){
       		$('#updatescore').modal('show')
       		})       
		})
	})
</script>