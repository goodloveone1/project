<?php
include("../../function/fc_time.php");
$date = date("Y-m-d");
?>
<style>
.ck-editor__editable {
    min-height: 400px !important;
}
</style>
<div class=" headtitle text-center p-2 row mb-2 row">
<div class="col-md-2 text-center ">
	<button type="button" class="btn  btn-block menuuser" data-modules="public_relations" data-action="pr_manage"><i class="fas fa-chevron-left"></i> ย้อนกลับ </button>
</div>
    <div class="col-md">
        <h2>เพื่มข่าวประชาสัมพันธ์</h2>
    </div>
    <div class="col-md-3"></div>
</div>

<form id="formaddpr" enctype="multipart/form-data">
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
                   <div class='text-center'> <button type="submit" class="btn btn-primary" id="addsu">บันทึก</button></div>
</form>

<script type="text/javascript">

$( document ).ready(function() {

CKEDITOR.replace('editor')

var vform = $("#formaddpr").validate();

   $("#formaddpr").submit(function(event) {
    event.preventDefault()
    

    if(vform.valid()){
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
                                   alert("บันทึกสำเร็จ");
                                   var module1 = sessionStorage.getItem("module1")
                                    var action = sessionStorage.getItem("action")
                                    loadmain(module1,action);
                               },
                               cache: false,
                               contentType: false,
                               processData: false
                           })
       }  
    }                
   });

})
</script>