<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
?>

<?php
    if(empty($_POST['id'])){
        $_POST['id']="";
    }
    $i=$_POST['id'];
     $re=mysqli_query($con,"SELECT *FROM weights WHERE w_id='$i'" ) or die("errorSQLselect".mysqli_error($con));
     list($w_id,$aca_id,$tit,$weighs)=mysqli_fetch_row($re);
     $seac = mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$aca_id'" ) or die("SQL error".mysqli_error($con));
     list($aca_name)=mysqli_fetch_row($seac);
     $setit = mysqli_query($con,"SELECT e_name FROM evaluation WHERE e_id='$tit'") or die("SQL error".mysqli_error($con));
    list($tit_name)=mysqli_fetch_row($setit);

?>
<form id="foreditbrc">
 <div class="modal fade" id="editsub" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขน้ำหนัก <?php echo $aca_name ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label >ภาระงาน : <?php echo $tit_name; ?></label>
                         <input type="text"   class="form-control" value="<?php echo $weighs ?>"  name="wid" size=40 require>
                          <input type="hidden"    value="<?php echo $w_id ?>"  name="w_id" size=40 require>
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
        mysqli_free_result($re);
        mysqli_free_result($seac);
        mysqli_free_result($setit);
        mysqli_close($con);
    ?>


<script type="text/javascript">

$("#updatesu").click(function(event) {
    var r = confirm("Press a button!");
    if (r == true) {
        $.post( "module/assessment/updateweight.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
             alert(data);
         });
        $('#editsub').modal("hide");

        $('#editsub').on('hidden.bs.modal', function (e) {
            
           loadmain("assessment","weight");
        })
       
        
    } 

   
});
</script>