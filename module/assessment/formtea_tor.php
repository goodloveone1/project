<?php
	include("../../function/db_function.php");
	$con=connect_db();

?>
<form>
<table class="table" >
	<tr>
		<th rowspan="2">(๑) ภาระงาน/กิจกรรม / โครงการ / งาน</th>
		<th rowspan="2">(๒) ตัวชี้วัด / เกณฑ์ประเมิน</th>
		<th colspan="5">(๓) ระดับค่าเป้าหมาย</th>
		<th rowspan="2">(๔) ค่าคะแนน ที่ได้ </th>
		<th rowspan="2">(๕) น้ำหนัก (ความสำคัญ/ ยากง่ายของงาน)</th>
		<th rowspan="2">(๖) ค่าคะแนน   ถ่วงน้ำหนัก (๔) × (๕) ๑๐๐ </th>
	</tr>
	<tr>
		<th >๑</th>
		<th >๒</th>
		<th >๓</th>
		<th >๔</th>
		<th >๕</th>
	</tr>
<?php
	$sql = "SELECT tit,weight FROM weights WHERE aca_id='1'";
	$weights = mysqli_query($con,$sql) or die(mysqli_error($con));

	$titcheck;
	while (list($tit,$weight)=mysqli_fetch_row($weights)) {
		$titcheck[] = $tit;
		$sql = "SELECT e_name FROM evaluation WHERE e_id='$tit'";
		$eval = mysqli_query($con,$sql) or die(mysqli_error($con));
		list($e_name)=mysqli_fetch_row($eval);

		echo "<tr id='$tit'>";
		echo "<td>$e_name</td>";
		echo "<td></td>";
		echo "<td><input type='radio' name='$tit' value='10'></td>";
		echo "<td><input type='radio' name='$tit' value='20'></td>";
		echo "<td><input type='radio' name='$tit' value='30'></td>";
		echo "<td><input type='radio' name='$tit' value='40'></td>";
		echo "<td><input type='radio' name='$tit' value='50'></td>";
		echo "<td id='sco$tit'></td>";
		echo "<td id='wei$tit' data-wei='$weight'>$weight</td>";
		echo "<td id='total$tit'></td>";
		echo "</tr>";
	}
?>	
</form>

</table>

<script type="text/javascript">

	<?php 
		foreach ($titcheck as $tit) {
	?>		
		$('#<?php echo $tit; ?>').on('click', 'input[name="<?php echo $tit; ?>"]:checked', function(event) {
		
		var sco = $(this).val();
		var wei = $("#wei<?php echo $tit; ?>").data('wei');
		$("#sco<?php echo $tit; ?>").html(sco);



		var total = (sco*wei/100);

		$("#total<?php echo $tit; ?>").html(total);

		})
	<?php
		}
	?>
	

	// 	

		
	
	

</script>