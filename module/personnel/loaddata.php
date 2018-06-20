<?php
$textdata = $_POST['textdata'];

foreach ($textdata as $value) {
	echo $value;
}
?>

<script type="text/javascript">
	
		$(".deldegree1").on("click",function(event) {
					var num = $(this).data('nums');
					var text1 =[];
					text1 = sessionStorage.getItem("text1");
					var count = sessionStorage.getItem("count");
					alert(typeof(text1));
					count--;
					degreeload1(count);	
				
				})
	
		
</script>