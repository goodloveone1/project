<?php
    session_start();
    include("../../function/db_function.php");
    
 if(empty($_POST['evdid'])) {   ///// 1
   
?>
<form id="foredittext">
 <div class="modal fade" id="edittext" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไบข้อความ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label > ข้อความ :</label>
                  
                          <textarea class="form-control" name="evd_textname" id="" rows="3" require><?php echo $_POST['evdtext'] ?></textarea>
               
                        
                          <input type="hidden"    value="<?php echo $_POST['evdidtext'] ?>"  name="evdtextid" size=40 require>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-success" id="updatesu">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">

$("#updatesu").click(function(event) {
    // var r = confirm("คุณต้องการแก้ไขข้อความใช่หรือไหม?");
    // if (r == true) {
        $.post( "module/assessment/update_evd_text.php", $( "#foredittext" ).serialize()).done(function(data,txtstuta){
            //alert(data);
         });
        $('#edittext').modal("hide");

        $('#edittext').on('hidden.bs.modal', function (e) {

            var module1 = sessionStorage.getItem("module1");
            var action = sessionStorage.getItem("action");
           loadmain(module1,action);
        })
    //}
});
</script>

<?php
}else{   ////////////////////////////////// 2
?>
<form id="foredittext">
 <div class="modal fade" id="edittext" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไบข้อความ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label > ข้อความ :</label>
                  
                          <textarea class="form-control" name="evd_textname" id="" rows="3" require></textarea>
               
                        
                          <input type="hidden"    value="<?php echo $_POST['evdid'] ?>"  name="evd_id" size=40 require>
                          <input type="hidden"    value="<?php echo $_POST['seid'] ?>"  name="se_id" size=40 require>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-success" id="updatesu">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">

$("#updatesu").click(function(event) {
    // var r = confirm("คุณต้องการแก้ไขข้อความใช่หรือไหม?");
    // if (r == true) {
        $.post( "module/assessment/update_evd_text.php", $( "#foredittext" ).serialize()).done(function(data,txtstuta){
            //alert(data);
         });
        $('#edittext').modal("hide");

        $('#edittext').on('hidden.bs.modal', function (e) {

            var module1 = sessionStorage.getItem("module1");
            var action = sessionStorage.getItem("action");
           loadmain(module1,action);
        })
    //}
});
</script>

<?php  
}
?>
