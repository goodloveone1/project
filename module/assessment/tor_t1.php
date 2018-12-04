<?php
	session_start();
	include("../../function/db_function.php");
	include("../../function/fc_time.php");
	$con=connect_db();
	

	$seaca=mysqli_query($con,"SELECT gen_acadeic,gen_prefix,gen_fname,gen_lname,gen_pos,branch_id,gen_salary,gen_startdate FROM general WHERE gen_id='$_SESSION[user_id]'")or die("SQL_ERROR".mysqli_error($con));
	list($gen_acadeic,$gen_prefix,$gen_fname,$gen_lname,$gen_pos,$branch_id,$gen_salary,$gen_startdate)=mysqli_fetch_row($seaca);
	$seacaName=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$gen_acadeic'")or die("SQL_ERROR".mysqli_error($con));
	list($acaName)=mysqli_fetch_row($seacaName);
	
	$seBrench=mysqli_query($con,"SELECT branch_name FROM branch WHERE branch_id='$branch_id'")or die("SQL_ERROR".mysqli_error($con));
	list($branchName)=mysqli_fetch_row($seBrench);

	$seexp=mysqli_query($con,"SELECT * FROM tort2_exp WHERE aca_id='$gen_acadeic'")or die(mysqli_error($con));
	for ($set = array (); $row = $seexp->fetch_assoc(); $set[] = $row);
	// print_r($set);
	mysqli_free_result($seaca);
	mysqli_free_result($seacaName);
	mysqli_free_result($seBrench);
	mysqli_free_result($seexp);
?>
<form class="p-2"> 
   <div class="row">
	    <span class="step  step-normal ">ข้อตกลง</span> &nbsp;
         <a href="javascript:void(0)"><span class="step step-color ">ส่วนที่ 1</span></a>&nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 2</span></a> &nbsp; 
		 <a href=#><span class="step step-normal">ส่วนที่ 3</span></a> &nbsp; 
		 <span class="step step-normal">ส่วนที่ 4</span> &nbsp; 
		 <span class="step step-normal">ส่วนที่ 5</span> &nbsp; 
		 <span class="step step-normal">ส่วนที่ 6</span> &nbsp;
    </div>


<div class="row ">
	<div class="col-md">
	<p><b><u>ส่วนที่  ๑  องค์ประกอบที่ ๑ ผลสัมฤทธิ์ของงาน</b></u></p>
	</div>	
</div>


<div class="row ">
	<div class="col-md">
<table class="table table-bordered" >
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
	


	$sql = "SELECT tit,weights FROM weights WHERE aca_id='$gen_acadeic'";
	$weights = mysqli_query($con,$sql) or die(mysqli_error($con));
	$titcheck;
	while (list($tit,$weight)=mysqli_fetch_row($weights)) {
		$titcheck[] = $tit;
		$sql = "SELECT e_name FROM evaluation WHERE e_id='$tit'";
		$eval = mysqli_query($con,$sql) or die(mysqli_error($con));
		list($e_name)=mysqli_fetch_row($eval);
		$sum=mysqli_query($con,"SELECT SUM(weights) FROM weights WHERE aca_id='$gen_acadeic'")or die(mysqli_error($con));
		list($sumS)=mysqli_fetch_row($sum);

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
	mysqli_close($con);
	
?>
	<tr> 
		<td colspan="8" class="text-center"> ผลรวม </td>
		<td class="text-center"> <?php echo $sumS ?> </td>
		<td class="text-center" id="tot" data-tot="<?php $tot ?>"><?php echo empty($tot)?"ยังไม่คำนวณ":""?>  </td>
	</tr>
	<tr> 
		<td colspan="9" >
			<div class="row">
				<div class="col-sm text-right" >
					<br> 
					สรุปคะแนนส่วนผลสัมฤทธิ์ของงาน  = 
				</div>		
				<div class="col-sm text-center">	
					ผลรวมของค่าคะแนนถ่วงน้ำหนัก <hr style="border-width: 3px;"> จำนวนระดับค่าเป้าหมาย = ๕  
				</div>
			</div>	
		</td>
		<td class="text-center">  </td>
	</tr>
</form>
</table>
</div>
</div>
</form>