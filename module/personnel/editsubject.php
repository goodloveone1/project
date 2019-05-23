<?php
    session_start();
	///include("../../function/db_function.php");
   
?>
<form id="foreditbrc">
 <div class="modal fade" id="editsub" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไบข้อมูลสาขาวิชา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label > ชื่อสาขาวิชา :</label>
                         <input type="text"   class="form-control" value="<?php echo $_POST['branchname'] ?>"  name="branch_name" size=40 require>
                          <input type="hidden"    value="<?php echo $_POST['id'] ?>"  name="branch_id" size=40 require>
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
    // var r = confirm("คุณต้องการแก้ไขข้อมูลใช่หรือไหม?");
    // if (r == true) {
        $.post( "module/personnel/updatesubject.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
            //alert(data);
           
         });
        $('#editsub').modal("hide");

        $('#editsub').on('hidden.bs.modal', function (e) {
            
            var module1 = sessionStorage.getItem("module1");
            var action = sessionStorage.getItem("action");
            loadmain(module1,action);
            alert("บันทึกสำเร็จ");
        })
    //}
});
</script>
