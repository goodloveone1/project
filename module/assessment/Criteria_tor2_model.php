<?php
    session_start();
?>
<form id="formedit_tor2">
 <div class="modal fade" id="editsub" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขสมรรถนะที่คาดหวัง</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                    <i class="fas fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                <input type="hidden"  name="atbid" value='<?php echo $_POST['atbid'] ?>'>
              
                 <div class="form-group">
                  <p><label for=""> <b>สมรรถนะ: </b> <?php echo $_POST['subname'] ?></label></p> 
                  <p><label for=""> <b>ตำแหน่ง:</b> <?php echo $_POST['aca'] ?></label></p>
                   <input type="number" max = "5" min="0"
                     class="form-control" name="score" value='<?php echo $_POST['score'] ?>'>
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
    
    
        $.post( "module/assessment/updateCriteria.php", $( "#formedit_tor2" ).serialize()).done(function(data,txtstuta){
            // alert(data);
           // alert("ับันทึกข้อมูลสำเร๊จ");
            $('#editsub').modal("hide");

            $('#editsub').on('hidden.bs.modal', function (e) {
                
            loadmain("assessment","Criteria_manage_tor2");
            })
        });
    
});
</script>