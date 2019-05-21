<?php
$mm=date('m');  //เดือนปัจจุบัน
	$yearbudget=DATE('Y')+543;  //ปีปัจจุบัน
	$m="$mm";
	$y="$yearbudget";
	if($m<=9 && $m>3){
			$loop=2;
			$y-=1;
	}else{
			$loop=1;
	}
	
	$y_id = $y.$loop;
	//echo $y_id;

	$seldlt=mysqli_query($con,"SELECT * FROM absence WHERE staff='$_SESSION[user_id]' AND year_id='$y_id'")or die(mysqli_error($con));
	for ($set1 = array (); $row = $seldlt->fetch_assoc(); $set1[] = $row);

?>


	<table class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="2" class="text-center">ประเภท</th>
				<th colspan="2">การประเมินรอบที่ <?php echo $loop," ปี ",$y ?></th>

				<th rowspan="2" class="text-center">ประเภท</th>
				<th colspan="2">การประเมินรอบที่ <?php echo $loop," ปี ",$y ?></th>

			</tr>
			<tr>
				<th>ครั้ง</th>
				<th>วัน</th>
				<th>ครั้ง</th>
				<th>วัน</th>


			</tr>
		</thead>
		<tbody>
			<tr>
				<td>ลาป่วย</td>
				<td><?php echo empty($set1[0]['ab_num'])?"-":$set1[0]['ab_num'] ?></td>
				<td><?php echo empty($set1[0]['abl_day'])?"-":$set1[0]['abl_day'] ?></td>

				<?php
					echo empty($set1[8]['ab_num'])?"":"$set1[8]['ab_num']";

				?>
				<td rowspan="3">ลาป่วยจำเป็นต้องรักษาตัวเป็นเวลานาน<br>คราวเดียวหรือหลายคราวรวมกัน</td>
				<td><?php echo empty($set1[5]['ab_num'])?"-":$set1[5]['ab_num'] ?></td>
				<td><?php echo empty($set1[5]['abl_day'])?"-":$set1[5]['abl_day'] ?></td>

			</tr>
			<tr>
				<td>ลากิจ</td>
				<td><?php echo empty($set1[1]['ab_num'])?"-":$set1[1]['ab_num'] ?></td>
				<td><?php echo empty($set1[1]['abl_day'])?"-":$set1[1]['abl_day'] ?></td>

				<td></td>
				<td></td>



			</tr>
			<tr>
				<td>มาสาย</td>
				<td><?php echo empty($set1[2]['ab_num'])?"-":$set1[2]['ab_num'] ?></td>
				<td><?php echo empty($set1[2]['abl_day'])?"-":$set1[2]['abl_day'] ?></td>

				<td></td>
				<td></td>



			</tr>
			<tr>
				<td>ลาคลอดบุตร</td>
				<td><?php echo empty($set1[3]['ab_num'])?"-":$set1[3]['ab_num'] ?></td>
				<td><?php echo empty($set1[3]['abl_day'])?"-":$set1[3]['abl_day'] ?></td>

				<td>ขาดราชการ</td>
				<td><?php echo empty($set1[6]['ab_num'])?"-":$set1[6]['ab_num'] ?></td>
				<td><?php echo empty($set1[6]['abl_day'])?"-":$set1[6]['abl_day'] ?></td>

			</tr>
			<tr>
				<td>ลาอุปสมบท</td>
				<td><?php echo empty($set1[4]['ab_num'])?"-":$set1[4]['ab_num'] ?></td>
				<td><?php echo empty($set1[4]['abl_day'])?"-":$set1[4]['abl_day'] ?></td>

				<td colspan="5"></td>

			</tr>
		</tbody>
	</table>

