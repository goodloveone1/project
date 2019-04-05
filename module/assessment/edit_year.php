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

?>
<form id="foreditbrc">
 <div class="modal fade" id="editsub" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขปีงบประมาณ <?php  ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                    <i class="fas fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label >ภาระงาน : <?php ?></label>
                         <input type="text"   class="form-control" value="<?php ?>"  name="wid" size=40 require>
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
        mysqli_close($con);
    ?>


<script type="text/javascript">

$("#updatesu").click(function(event) {
   // var r = confirm("Press a button!");
   //if (r == true) {
        $.post( "module/assessment/updateweight.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
            alert(data);
         });
        $('#editsub').modal("hide");

        $('#editsub').on('hidden.bs.modal', function (e) {
            
           loadmain("assessment","weight");
        })
       
        
  //  } 

   
});
</script>