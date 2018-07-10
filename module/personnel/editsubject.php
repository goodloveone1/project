<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
?>

<?php
    $result=mysqli_query($con,"SELECT branch_id,branch_name FROM branch WHERE branch_id='$_POST[id]'") or die ("mysql error=>>".mysql_error($con));
    list($branch_id,$branch_name)=mysqli_fetch_row($result);

?>
<form id="foreditbrc">
 <div class="modal fade" id="editsub" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไบข้อมูลสาขาวิชา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label > ชื่อสาขาวิชา :</label>
                         <input type="text"   class="form-control" value="<?php echo $branch_name ?>"  name="branch_name" size=40 require>
                          <input type="hidden"    value="<?php echo $branch_id ?>"  name="branch_id" size=40 require>
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

    <?php
        mysqli_free_result($result);
        mysqli_close($con);
    ?>


<script type="text/javascript">

$("#updatesu").click(function(event) {
    var r = confirm("Press a button!");
    if (r == true) {
        $.post( "module/personnel/updatesubject.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
             alert(data);
         });
        $('#editsub').modal("hide");

        $('#editsub').on('hidden.bs.modal', function (e) {

            var module1 = sessionStorage.getItem("module1");
            var action = sessionStorage.getItem("action");
           loadmain(module1,action);
        })
       
        
    } 

   
});
</script>