<?php
session_start();
    include("../../function/db_function.php");
$con=connect_db();
?>
<?php
$result=mysqli_query($con,"SELECT subject_id,subject_name,branch_id FROM subjects WHERE subject_id='$_POST[s_id]'") or die ("mysql error=>>".mysql_error($con));
list($subject_id,$subject_name,$branch_id)=mysqli_fetch_row($result);

?>
<form>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label >ชื่อสาขาวิชา :</label>
                         <input type="text"   class="form-control" value="<?php echo $subject_name ?>" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > ชื่อหลักสูตร :</label>
                        <select class="form-control" name="branch">
                            <?php
                                $selectB=mysqli_query($con,"SELECT branch_id,branch_name FROM branch") or die ("mysql error=>>".mysql_error($con));
                                while(list( $branch_ID,$branch_name)=mysqli_fetch_row($selectB)){
                                $select=$branch_ID==$branch_id?"selected":"";
                                echo "<option value=$branch_ID $select>$branch_name</option>";
                                }
                            ?>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>

            <?php
            mysqli_free_result($result);
            mysqli_close($con);
            ?>

     