<?php
session_start();
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();

$st_id=empty($_POST['id'])?'':$_POST['id'];

$st = mysqli_query($con,"SELECT prefix,fname,lname,permiss_id FROM staffs WHERE st_id='$st_id'") or  die("SQL Error1==>1".mysqli_error($con));
list($prefix,$fname,$lname,$permiss_id)=mysqli_fetch_row($st);

if($permiss_id==2){
	$sumas= mysqli_query($con,"SELECT am.ass_id,y.y_no,y.y_year,sumt3.sum_score
	FROM assessments AS am 
	INNER JOIN years AS y ON am.year_id = y.y_id
	INNER JOIN sum_score_assessment_t3 AS sumt3 ON am.ass_id = sumt3.ass_id
	INNER JOIN asessment_t5 AS amt5 ON am.ass_id = amt5.ass_id
	INNER JOIN asessment_t6 AS amt6 ON am.ass_id = amt6.ass_id
	WHERE  am.staff='$st_id' AND  am.ass_id LIKE  'TOR%' AND  amt5.accept = 1 AND amt5.inform = 1 
	AND amt6.leader_comt != 0 AND amt6.supervisor_comt != 0
	 ") or  die("SQL Error1==>1".mysqli_error($con));

}
if($permiss_id==3){
	$sumas= mysqli_query($con,"SELECT am.ass_id,y.y_no,y.y_year,sumt3.sum_score
	FROM assessments AS am 
	INNER JOIN years AS y ON am.year_id = y.y_id
	INNER JOIN sum_score_assessment_t3 AS sumt3 ON am.ass_id = sumt3.ass_id
	INNER JOIN asessment_t5 AS amt5 ON am.ass_id = amt5.ass_id
	INNER JOIN asessment_t6 AS amt6 ON am.ass_id = amt6.ass_id
	WHERE  am.staff='$st_id' AND  am.ass_id LIKE  'TOR%' AND  amt5.accept = 1 AND amt5.inform = 1 
	AND amt6.leader_comt != 0 ") or  die("SQL Error1==>1".mysqli_error($con));

}
if($permiss_id==4){
	$sumas= mysqli_query($con,"SELECT am.ass_id,y.y_no,y.y_year,sumt3.sum_score
	FROM assessments AS am 
	INNER JOIN years AS y ON am.year_id = y.y_id
	INNER JOIN sum_score_assessment_t3 AS sumt3 ON am.ass_id = sumt3.ass_id
	INNER JOIN asessment_t5 AS amt5 ON am.ass_id = amt5.ass_id
	WHERE  am.staff='$st_id' AND  am.ass_id LIKE  'TOR%' AND  amt5.accept = 1 AND amt5.inform = 1 
	 ") or  die("SQL Error1==>1".mysqli_error($con));

}


$r1 ="";
$r2 ="";

while(list($assid,$y_no,$y_year,$sum_score)=mysqli_fetch_row($sumas)){
   
		if($y_no==1){
			if($r1==""){
				$r1="{ label: 'ปี ".($y_year+543)."', y: $sum_score }";
			}
			else{
				$r1.=",{ label: 'ปี ".($y_year+543)."', y: $sum_score }";
			}
		}
		else{
			if($r2==""){
				$r2="{ label: 'ปี ".($y_year+543)."', y: $sum_score }";
			}
			else{
				$r2.=",{ label: 'ปี ".($y_year+543)."', y: $sum_score }";
			}
		}
}

//echo $r1;
//echo $r2;


?>
<div class="row  p-2 headtitle">
<div class="col-md-2 text-center ">
	<button type="button" class="btn  btn-block menuuser" data-modules="report" data-action="listuser"><i class="fas fa-chevron-left"></i> ย้อนกลับ </button>
</div>
	<h4 class="text-center col-md "> รายงานผลการประเมินของ <?php echo $prefix." ".$fname." ".$lname?> </h4>
<div class="col-md-2 text-center "></div>
</div>
<br>

<?php 
 if($r1 != "" OR $r2 !=""){
?>
<div id="resizable" style="height: 370px">
	<div id="chartContainer" style="height: 100%; width: 100%;"></div>
</div>
<script>
$( document ).ready(function() {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "ผลการประเมินของ <?php echo $prefix." ".$fname." ".$lname ?>"
	},	
	axisY: {
		title: "คะแนนผลการปฏิบัติงาน รอบที่ 1",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
	axisY2: {
		title: "คะแนนผลการปฏิบัติงาน รอบที่ 2",
		titleFontColor: "#C0504E",
		lineColor: "#C0504E",
		labelFontColor: "#C0504E",
		tickColor: "#C0504E"
	},	
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "รอบที่ 1",
		legendText: "รอบที่ 1",
		showInLegend: true, 
		dataPoints:[
			<?php
				echo $r1;
			?>
			
		
		]
	},
	{
		type: "column",	
		name: "รอบที่ 2",
		legendText: "รอบที่ 2",
		axisYType: "secondary",
		showInLegend: true,
		dataPoints:[
			<?php
				echo $r2;
			?>
			
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

<?php
 }
 else{
	 echo "<div class='row'><div class='col text-center text-danger'> <h4>*ไม่พบข้อมูล </h4></div></div>";
 }
?>



