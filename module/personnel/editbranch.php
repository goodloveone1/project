<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
?>

<?php
    $result=mysqli_query($con,"SELECT branch_id,branch_name FROM branch WHERE branch_id='$_GET[b_id]'") or die ("mysql error=>>".mysql_error($con));
    list($branch_id,$branch_name)=mysqli_fetch_row($result);

?>

<form>
<p>ชื่อสาขาวิชา : 
    <input type="text"  value="<?php echo $branch_name ?>">
<p>
    <?php
        mysqli_free_result($result);
        mysqli_close($con);
    ?>
<p>
    <input type="submit" value="บันทึก"> 
    <input type="reset" value="ยกเลิก">
</p>

</form>