<?php

	
	
	$seldlt=mysqli_query($con,"SELECT *FROM idlel WHERE gen_id='$_SESSION[user_id]' AND year_id='$y_id'")or die(mysqli_error($con));
	for ($set1 = array (); $row = $seldlt->fetch_assoc(); $set1[] = $row);

	$mm=date('m');  //เดือนปัจจุบัน
    $yearbudget=DATE('Y')+543;  //ปีปัจจุบัน
    $m="$mm";
    $y="$yearbudget";
    if($m<=9 && $m>3){
        $loop=2;
    }else{
        $loop=1;
    }
    if($loop==2){
        $y-=1;
    }
    $y_id = $y.$loop;
	echo $y_id;
	
	// print_r($set1);	
	// print_r($set2);				
?>


	<table class="table table-bordered">
		<thead>
			<tr>
				<!-- <th rowspan="2" class="text-center">ประเภท</th>
				<th colspan="2">การประเมินรอบที่ <?php echo $notest ?></th>
			
				<th rowspan="2" class="text-center">ประเภท</th>
				<th colspan="2">การประเมินรอบที่ <?php echo $notest ?></th> -->
		
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
				<td><?php echo empty($set1[0]['idl_num'])?"-":$set1[0]['idl_num'] ?></td>
				<td><?php echo empty($set1[0]['idl_day'])?"-":$set1[0]['idl_day'] ?></td>
		
				<?php
					echo empty($set1[8]['idl_num'])?"":"$set1[8]['idl_num']";

				?>
				<td rowspan="3">ลาป่วยจำเป็นต้องรักษาตัวเป็นเวลานาน<br>คราวเดียวหรือหลายคราวรวมกัน</td>
				<td><?php echo empty($set1[5]['idl_num'])?"-":$set1[5]['idl_num'] ?></td>
				<td><?php echo empty($set1[5]['idl_day'])?"-":$set1[5]['idl_day'] ?></td>
			
			</tr>
			<tr>
				<td>ลากิจ</td>
				<td><?php echo empty($set1[1]['idl_num'])?"-":$set1[1]['idl_num'] ?></td>
				<td><?php echo empty($set1[1]['idl_day'])?"-":$set1[1]['idl_day'] ?></td>
			
				<td></td>
				<td></td>
				
				
				
			</tr>	
			<tr>
				<td>มาสาย</td>
				<td><?php echo empty($set1[2]['idl_num'])?"-":$set1[2]['idl_num'] ?></td>
				<td><?php echo empty($set1[2]['idl_day'])?"-":$set1[2]['idl_day'] ?></td>
			
				<td></td>
				<td></td>
				
			
				
			</tr>	
			<tr>
				<td>ลาคลอดบุตร</td>
				<td><?php echo empty($set1[3]['idl_num'])?"-":$set1[3]['idl_num'] ?></td>
				<td><?php echo empty($set1[3]['idl_day'])?"-":$set1[3]['idl_day'] ?></td>
			
				<td>ขาดราชการ</td>
				<td><?php echo empty($set1[6]['idl_num'])?"-":$set1[6]['idl_num'] ?></td>
				<td><?php echo empty($set1[6]['idl_day'])?"-":$set1[6]['idl_day'] ?></td>
				
			</tr>
			<tr>
				<td>ลาอุปสมบท</td>
				<td><?php echo empty($set1[4]['idl_num'])?"-":$set1[4]['idl_num'] ?></td>
				<td><?php echo empty($set1[4]['idl_day'])?"-":$set1[4]['idl_day'] ?></td>
				
				<td colspan="5"></td>
				
			</tr>		
		</tbody>
	</table>

