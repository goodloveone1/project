<?php
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();
?>
<div class="row">
	<div class="col-md-12">
		<h2 class="headtitle p-2 text-center"> ข่าวประชาสัมพันธ์ </h2>
		<div class="list-group" id='testna'>
			<?php
				$re = mysqli_query($con,"SELECT re_title,re_detail,re_date,gen_id FROM relations ORDER BY 	re_date DESC");
				$n=1;
				while (list($re_title,$re_detail,$re_date,$gen_id)=mysqli_fetch_row($re)) {
				$gen = mysqli_query($con,"SELECT gen_fname,gen_lname FROM general WHERE gen_id = '$gen_id'");
				list($name,$lname) = mysqli_fetch_row($gen);
					
				if($n <= 3){
			?>
			<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1"><?php echo $re_title; ?> <span class="badge badge-danger">New</span></h5>
					<!-- <small>3 days ago</small> -->
				</div>
				<p class="mb-1"><?php echo $re_detail; ?></p>
				<small><?php echo "เผยแพร่เมื่อ ".DateThai($re_date)." โดย $name $lname" ?>  </small>
			</a>
			<?php
				}else{
			?>
			<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1"><?php echo $re_title; ?> </h5>
					<!-- <small>3 days ago</small> -->
				</div>
				<p class="mb-1"><?php echo $re_detail; ?></p>
				<small><?php echo "เผยแพร่เมื่อ ".DateThai($re_date)." โดย $name $lname" ?>  </small>
			</a>
			<?php
			}  // END IF
			$n++;
			}   // END WHILE
			mysqli_free_result($re);
			mysqli_free_result($gen);
			mysqli_close($con);
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#testna").on('hover', 'a', function(event) {
		event.preventDefault();
		/* Act on the event */
		alert("HOVER!!!")
		$(this).addClass('active');
	});
</script>