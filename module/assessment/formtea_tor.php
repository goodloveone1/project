<?php
	include("../../function/db_function.php");
	$con=connect_db();

?>
<table class="table" border="1">
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

	while (list($tit,$weight)=mysqli_fetch_row($weights)) {
		$sql = "SELECT e_name FROM evaluation WHERE e_id='$tit'";
		$eval = mysqli_query($con,$sql) or die(mysqli_error($con));
		list($e_name)=mysqli_fetch_row($eval);

		echo "<tr>";
		echo "<td>$e_name</td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td>$weight</td>";
		echo "<td></td>";
		echo "</tr>";
	}
?>	

</table>