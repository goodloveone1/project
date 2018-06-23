<?php

include("../../function/db_function.php");
$con=connect_db();
?>
<?php

$s_id = empty($_POST['id'])?'':$_POST['id'];
// echo "text s_id =".$s_id;
$result=mysqli_query($con,"SELECT subject_id,subject_name,branch_id FROM subjects WHERE subject_id='$s_id'") or die ("mysql error=>>".mysql_error($con));
list($subject_id,$subject_name,$branch_id)=mysqli_fetch_row($result);

?>
<form id="foreditbrc">
    <div class="modal fade" id="editsub" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
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
                        <label > ชื่อหลักสูตร :</label>
                         <input type="text"   class="form-control" value="<?php echo $subject_name ?>"  name="subject" size=40 require>
                          <input type="hidden"    value="<?php echo $subject_id ?>"  name="subject_id" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > ชื่อสาขาวิชา :</label>
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
                    <button type="button" class="btn btn-primary" id="updatesu">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">

    $("#updatesu").click(function(event) {
        var r = confirm("Press a button!");
        if (r == true) {
            $.post( "module/personnel/updatebranch.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
                 // alert(data);
             });
            $('#editsub').modal("hide");

            $('#editsub').on('hidden.bs.modal', function (e) {

                var module1 = sessionStorage.getItem("module1");
                var action = sessionStorage.getItem("action");
               loadmain(module1,action);
            })
           
            
        } else {
            
        }

       
    });
</script>

            <?php
            mysqli_free_result($result);
            mysqli_close($con);
            ?>

     