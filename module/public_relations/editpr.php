<?php
include("../../function/db_function.php");
$con=connect_db();
$date = date("Y-m-d");

$re_id = $_POST['reid'];
$resultre = $con->query("SELECT re_title,re_detail,re_date,staff_id FROM relations WHERE re_id='$re_id'");
list($re_title,$re_detail,$re_date,$gen_id) = $resultre->fetch_row();
$resultre->free_result();
$con->close();

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
        <h2>แก้ไขข่าวประชาสัมพันธ์</h2>
    </div>
    <div class="col-md-2"></div>
</div>

<form id="formeditpr" enctype="multipart/form-data">
<div class="form-group">
                        <label > หัวเรื่อง :</label>
                         <input type="text"   class="form-control" value="<?php echo $re_title ?>" placeholder="หัวเรื่อง" name="title" size=40 required>
                    </div>
                    <div class="form-group">
                        <label > รายละเอียด :</label>

                          <textarea class="form-control" id="editor" rows="3" required name="detail"><?php echo $re_detail ?></textarea >
                    </div>
                    <div class="form-group">
                        <label > วันที่ :</label>
                         <input type="date"   class="form-control" value="<?php echo $re_date ?>" placeholder="วันที่" name="date" size=40 required  >
                    </div>

                    <input type="hidden" name="re_id" value="<?php echo $re_id ?>">
                   <div class='text-center'> <button type="submit" class="btn btn-primary" >บันทึก</button></div>
</form>



<script type="text/javascript">

CKEDITOR.replace('editor')

CKEDITOR.config.height = 500;

    $("#formeditpr").submit(function(event) {
        event.preventDefault()
        //var r = confirm("คุณต้องการแก้ไขข้อมูลใช่ไหม?");
        

            for (instance in CKEDITOR.instances) {
               CKEDITOR.instances[instance].updateElement();
           }


            $.post( "module/public_relations/updatere.php", $("#formeditpr").serialize()).done(function(data,txtstuta){
                swal("บันทึกสำเร็จ!", {
									icon: "success",
									buttons: false,
									timer: 1000,
								});
 
                 var module1 = sessionStorage.getItem("module1")
                 var action = sessionStorage.getItem("action")
                 loadmain(module1,action);
               
             })

        


    });
</script>