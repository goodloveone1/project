<?php
include("../../function/db_function.php");
$con=connect_db();
$tor_id = empty($_POST['id'])?'':$_POST['id'];
$tor_subname = empty($_POST['name'])?'':$_POST['name'];

$academic = $con->query("SELECT * FROM academic");
?>
<form id="fortor2score">
    <div class="modal fade" id="updatescore" tabindex="-1" role="dialog" aria-labelledby="updatescore" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขระดับสมรรถนะที่คาดหวัง ของ <?php echo $tor_subname ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php
                    while(list($aca_id,$aca_name)=$academic->fetch_row()){
                          $torscore = $con->query("SELECT exp_id,exp_score FROM tort2_exp WHERE tort2_subtit=$tor_id AND aca_id='$aca_id'") or die('ERROR sql '.$con->error());
                          list($exp_id,$exp)=$torscore->fetch_row();
                          $torscore->free_result();
                     ?>                  
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">ตำแหน่ง</label>
                          <input type="text" class="form-control"  value="<?php echo $aca_name ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword4">ระดับสมรรถนะที่คาดหวัง</label>
                          <input type="text" class="form-control score"  name='exp_score[]' value="<?php echo $exp ?>">
                        </div>
                        <input  type="hidden" name="exp_id[]" value="<?php echo $exp_id ?>">
                      </div>
                     <?php     
                         // echo $aca_name."->".$tor_subname."->".$exp."<br>"; 
                    } //END while
                    mysqli_free_result($academic);
                    mysqli_close($con);
                ?>      
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="updatesu"  disabled="disabled">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">

  $("#fortor2score").on('change', '.score', function(event) {
    event.preventDefault();
       $("#updatesu").prop("disabled",false)
  });


    $("#updatesu").click(function(event) {
        var r = confirm("คุณต้องการบันทึกข้อมูลใช้ไหม");
        if (r == true) {
            $.post( "module/assessment/Criteria_tor2subscoreUpdate.php", $( "#fortor2score" ).serialize()).done(function(data,txtstuta){
                  alert(data);
                $('#updatescore').modal("hide");

                $('#updatescore').on('hidden.bs.modal', function (e) {

                loadingpage("assessment","Criteria_manage_tor2")
                
                })          
             });
           
        }     
    });

    
</script>