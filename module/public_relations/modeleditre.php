<?php

include("../../function/db_function.php");
$con=connect_db();
$date = date("Y-m-d");

$re_id = $_POST['reid'];

$resultre = $con->query("SELECT re_title,re_detail,re_date,gen_id FROM relations");

list($re_title,$re_detail,$re_date,$gen_id) = $resultre->fetch_row();


$resultre->free_result();
$con->close();

?>

<form id="formeditre">
    <div class="modal fade" id="modelre" tabindex="-1" role="dialog" aria-labelledby="modelre" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข่าวประชาสัมพันธ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                    <div class="form-group">
                        <label > หัวเรื่อง :</label>
                         <input type="text"   class="form-control" value="<?php echo $re_title ?>" placeholder="หัวเรื่อง" name="title" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > รายละเอียด :</label>

                          <textarea class="form-control" id="" rows="3" require name="detail"><?php echo $re_detail ?></textarea >
                    </div>
                    <div class="form-group">
                        <label > วันที่ :</label>
                         <input type="date"   class="form-control" value="<?php echo $re_date ?>" placeholder="วันที่" name="date" size=40   >
                    </div>

                    <input type="hidden" name="re_id" value="<?php echo $re_id ?>">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="addsu">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">

    $("#addsu").click(function(event) {
        var r = confirm("คุณต้องการเพื่มข้อมูลใช่ไหม?");
        if (r == true) {
            $.post( "module/public_relations/updatere.php", $("#formeditre").serialize()).done(function(data,txtstuta){
                alert(data);
                $('#modelre').modal("hide")

                $('#modelre').on('hidden.bs.modal', function (e) {

                 var module1 = sessionStorage.getItem("module1")
                 var action = sessionStorage.getItem("action")
                 loadmain(module1,action);
                })
             })
            
           
            
        } 

       
    });
</script>
