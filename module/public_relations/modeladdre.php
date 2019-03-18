<?php

include("../../function/db_function.php");
$date = date("Y-m-d");

?>

<style>
.ck-editor__editable {
    min-height: 400px !important;
}
</style>

<form id="formaddbrc" enctype="multipart/form-data">
    <div class="modal fade" id="addre" tabindex="-1" role="dialog" aria-labelledby="addre" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">เพื่มข่าวประชาสัมพันธ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                    <div class="form-group">
                        <label > หัวเรื่อง :</label>
                         <input type="text"   class="form-control" value="" placeholder="หัวเรื่อง" name="title" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > รายละเอียด :</label>

                          <textarea class="" id="editor" rows="20" require name="detail"></textarea >
                    </div>
                    <div class="form-group">
                        <label > วันที่ :</label>
                         <input type="date"   class="form-control" value="<?php echo $date ?>" placeholder="วันที่" name="date" size=40   >
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" id="addsu">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">


 CKEDITOR.replace('editor')


    $("#formaddbrc").submit(function(event) {
        var r = confirm("คุณต้องการเพื่มข้อมูลใช่ไหม?");
        if (r == true) {

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            
            var formData = new FormData(this);

						    $.ajax({
						        url: "module/public_relations/insertre.php",
						        type: 'POST',
						        data: formData,
						        success: function (data) {
                                    alert(data);
						        },
						        cache: false,
						        contentType: false,
						        processData: false
						    }).done(function() {
                                
                               
								$('#addre').modal("hide")

                                $('#addre').on('hidden.bs.modal', function (e) {

                                var module1 = sessionStorage.getItem("module1")
                                var action = sessionStorage.getItem("action")
                                loadmain(module1,action);

						        })
  
                             })   
        }                  
    });
</script>
