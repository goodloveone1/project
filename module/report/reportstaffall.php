<?php
session_start();
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();


$year=empty($_POST['year'])?'':$_POST['year'];

$sumas= mysqli_query($con,"SELECT st.prefix,st.fname,st.lname,pos.pos_name,dp.dept_name,br.br_name,st.picture,sumt3.sum_score
FROM assessments AS am  
INNER JOIN sum_score_assessment_t3 AS sumt3 ON am.ass_id = sumt3.ass_id 
INNER JOIN staffs AS st ON st.st_id = am.staff 
INNER JOIN branchs AS br ON br.br_id = st.branch_id
INNER JOIN departments AS dp ON dp.dept_id = br.dept_id
INNER JOIN position AS pos ON pos.pos_id = st.position
WHERE am.ass_id LIKE  'TOR%' AND am.year_id = '$year' ") or  die("SQL Error1==>1".mysqli_error($con));

$numrow = mysqli_num_rows($sumas);

$r="";

while(list($prefix,$fname,$lname,$pos_name,$dept_name,$br_name,$picture,$sum_score)=mysqli_fetch_row($sumas)){

	$picture = empty($picture)?"default/user_default.svg":$picture;

	if($r==""){
		$r= "{ label: '$prefix $fname $lname', y: $sum_score, br: '$br_name',dp: '$dept_name',pos: '$pos_name', url: '$picture' }";
	}else{
		$r.= ",{ label: '$prefix $fname $lname', y: $sum_score, br: '$br_name',dp: '$dept_name',pos: '$pos_name', url: '$picture' }";
	}
	
}
//echo $r;


if($numrow !=0){

?>
<div id="resizable" style="height: 400px">
	<div id="chartContainer" style="height: 100%; width: 100%;"></div>
	
<script>
$( document ).ready(function() {

	var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "ผลสรุปการประเมิน"
	},
	axisX: {
		interval: 1
	},
	axisY: {
		title: "คะแนนที่ได้",
		scaleBreaks: {
			type: "wavy",
			customBreaks: [{
				startValue: 80,
				endValue: 210
				},
				{
					startValue: 230,
					endValue: 600
				}
		]}
	},
	data: [{
		type: "bar",
		toolTipContent: "<img src=\"img/\"{url}\"\" style=\"width:40px; height:20px;\"> <b>{label}</b><br>หลักสูตร: {br}<br>สาขา: {dp}<br>ตำแหน่ง: {pos}<br>คะแนน: {y}",
		dataPoints: [
			<?php echo  $r; ?>	
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

});
</script>
</div>
<?php
}
else{
	echo "<h4 class='h4 text-center text-danger'> *ไม่พบข้อมูล  </h4>";
}

mysqli_free_result($sumas);
mysqli_close($con);


?>

