<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
?>

<?php
    $result=mysqli_query($con,"SELECT branch_id,branch_name FROM branch WHERE branch_id='$_POST[branch_ID]'") or die ("mysql error=>>".mysql_error($con));
    list($branch_id,$branch_name)=mysqli_fetch_row($result);

?>

<form>
<p>ชื่อสาขาวิชา : 
    <input type="text"  value="<?php echo $branch_name ?>" require>
<p/>

    <?php
        mysqli_free_result($result);
        mysqli_close($con);
    ?>
<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="updatesu">บันทึก</button>
  </div>

</form>

<script type="text/javascript">

$("#updatesu").click(function(event) {
    var r = confirm("Press a button!");
    if (r == true) {
        $.post( "module/personnel/#.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
             // alert(data);
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