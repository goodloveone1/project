<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
?>

<?php
    if(empty($_POST['id']) && empty($_POST['id2'])){
        $_POST['id']="";
        $_POST['id2']="";
    }
    $i=$_POST['id'];
    $eid=$_POST['id2'];

    $re=mysqli_query($con,"SELECT * FROM conditions WHERE aca_id='$i' AND e_name='$eid' " ) or die("errorSQLselect".mysqli_error($con));

     $setit = mysqli_query($con,"SELECT e_name FROM evaluation WHERE e_id='$eid'") or die("SQL error".mysqli_error($con));
    list($tit_name)=mysqli_fetch_row($setit);
     $setit->free_result();
      

    $seac = mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$i'" ) or die("SQL error".mysqli_error($con));
    list($aca_name)=mysqli_fetch_row($seac);
    $seac->free_result();
      

?>
<form id="foreditbrc">
 <div class="modal fade" id="editsub" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขตัวชีวัดเกณฑ์การประเมิน ด้านที่ <?php  echo $eid ." ". $tit_name ." ( $aca_name )" ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                    <i class="fas fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <?php
                        while(list($con_id,$aca_id,$tit,$lv,$lue,$ex)=mysqli_fetch_row($re)){
                                             
                        // if($lv==0){
                        //     $lv="-";
                        // }
                    ?>                 

                     <div class="form-row">
                        <div class="col-md mb-3">
                          <label for="validationCustom03">ระดับคะแนน</label>
                          <input type="hidden" name="id[]" class="form-control"  required value="<?php echo $con_id ?>">
                        <div class="col-md mb-3">
                            <input type="text" name="level[]" class="form-control"  required value="<?php echo $lv ?>">
                        </div>
                         
                       
                        <div class="col-md mb-3">
                          <label for="validationCustom04">เงื่อนไข  </label>
                          <!-- <input type="text" name="condition[]" class="form-control"  required value="<?php echo $lue ?>"> -->
                          <textarea name="condition[]" class="form-control" rows=5 required ><?php echo $lue ?></textarea>
                          
                        </div>
                        <div class="col-md mb-3">
                          <label for="validationCustom05">รายล่ะเอียด</label>
                          <textarea name="disc[]" class="form-control" rows=5 required ><?php echo $ex ?></textarea>
                        
                        </div>
                     </div>
                      </div>
                      

                <?php } //END while ?>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="update">บันทึก</button>
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

$("#update").click(function(event) {
    var r = confirm("บันทึกสำเร็จแล้ว");
    // if (r == true) {
        $.post( "module/assessment/update_evaluation.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
            // alert(data);
         })
        $('#editsub').modal("hide");

        $('#editsub').on('hidden.bs.modal', function (e) {
            
           loadmain("assessment","evaluation");
        })
       
        
    // } 

   
});
</script>