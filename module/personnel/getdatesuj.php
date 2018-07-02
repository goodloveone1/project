<?php
include("../../function/db_function.php");
$con=connect_db();


$idbrn = empty($_POST['id'])?'':$_POST['id'];
echo $idbrn;
$result=mysqli_query ($con,"SELECT  subject_id,subject_name,branch_id FROM subjects WHERE branch_id='$idbrn'") or die ("error".mysqli_error($con));
		while(list($subject_id,$subject_name,$idbranch)=mysqli_fetch_row($result)){
				$branch=mysqli_query($con,"SELECT branch_name FROM branch WHERE branch_id='$idbranch'") or die ("errorSQL".mysqli_error($con));
						list($branch_name)=mysqli_fetch_row($branch);
							echo "<option value='".$subject_id."' data-idbrn='".$idbranch."' data-nbrn='".$branch_name."'>$subject_name</option>";
						}

					mysql_free_result($result);
					mysql_close($con);
					
?>