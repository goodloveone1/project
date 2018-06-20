<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
?>

<?php
    $result=mysqli_query($con,"SELECT subject_id,subject_name,branch_id FROM subjects WHERE subject_id='$_GET[s_id]'") or die ("mysql error=>>".mysql_error($con));
    list($subject_id,$subject_name,$branch_id)=mysqli_fetch_row($result);
   
?>

<form>
<p>ชื่อสาขาวิชา : 
    <input type="text"  value="<?php echo $subject_name ?>" size=40 require >
<p>
<p>
    ชื่อหลักสูตร :
    <select name="branch">
        <?php

            $selectB=mysqli_query($con,"SELECT branch_id,branch_name FROM branch") or die ("mysql error=>>".mysql_error($con));
		    while(list( $branch_ID,$branch_name)=mysqli_fetch_row($selectB)){
			    $select=$branch_ID==$branch_id?"selected":"";
			    echo "<option value=$branch_ID $select>$branch_name</option>";
		    }

	?></select>
</p>
    <?php
        mysqli_free_result($result);
        mysqli_close($con);
    ?>
<p>
    <input type="submit" value="บันทึก"> 
    <input type="reset" value="ยกเลิก">
</p>

</form>