<?php
session_start();
include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();



$st_id=empty($_POST['id'])?'':$_POST['id'];

$sumas= mysqli_query($con,"SELECT am.ass_id,y.y_no,y.y_year,sumt3.sum_score
FROM ((assessments AS am INNER JOIN years AS y ON am.year_id = y.y_id)  INNER JOIN sum_score_assessment_t3 AS sumt3 ON am.ass_id = sumt3.ass_id)
WHERE  am.staff='$st_id' AND  am.ass_id LIKE  'TOR%' ") or  die("SQL Error1==>1".mysqli_error($con));

$st = mysqli_query($con,"SELECT prefix,fname,lname FROM staffs WHERE st_id='$st_id'") or  die("SQL Error1==>1".mysqli_error($con));
list($prefix,$fname,$lname)=mysqli_fetch_row($st);


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
	<h4 class="text-center col-md "> รายงาน </h4>
</div>
<br>

<?php 
 if($r1 != "" OR $r2 !=""){
?>
<div id="resizable" style="height: 370px;border:1px solid gray;">
	<div id="chartContainer" style="height: 100%; width: 100%;"></div>
</div>
<?php
 }
 else{
	 echo "<div class='row'><div class='col text-center text-danger'> <h4>*ไม่พบข้อมูล </h4></div></div>";
 }
?>


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

