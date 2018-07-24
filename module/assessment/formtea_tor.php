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
		echo "<td><input type='radio' name='$tit' data-sco='1'></td>";
		echo "<td><input type='radio' name='$tit' data-sco='2'></td>";
		echo "<td><input type='radio' name='$tit' data-sco='3'></td>";
		echo "<td><input type='radio' name='$tit' data-sco='4'></td>";
		echo "<td><input type='radio' name='$tit' data-sco='5'></td>";
		echo "<td id='sco$tit'></td>";
		echo "<td id='wei$tit' data-wei='$weight'>$weight</td>";
		echo "<td id='total$tit'></td>";
		echo "</tr>";
	}
?>	
</form>

</table>

<script type="text/javascript">
	$('#<?php echo $titcheck[0]; ?>').on('click', 'input[name="1"]:checked', function(event) {
		
		var sco = $(this).data('sco');
		var wei = $("#wei1").data('wei');
		$("#sco1").html(sco);



		var total = (sco*wei/100);

		$('#total1').html(total);

		
	});
	

</script>