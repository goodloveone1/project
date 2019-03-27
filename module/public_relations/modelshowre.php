<?php

include("../../function/db_function.php");
include("../../function/fc_time.php");
$con=connect_db();
$date = date("Y-m-d");


$re_id = $_POST['reid'];

$resultre = $con->query("SELECT re_title,re_detail,re_date,staff_id FROM relations WHERE re_id='$re_id'") or die($con->error);

list($re_title,$re_detail,$re_date,$gen_id) = $resultre->fetch_row();

$resultre = $con->query("SELECT fname,lname FROM staffs WHERE st_id = $gen_id");

list($gen_fname,$gen_lname) = $resultre->fetch_row();


?>

<form id="formaddbrc">
    <div class="modal fade" id="modelre" tabindex="-1" role="dialog" aria-labelledby="modelre" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แสดงข่าวประชาสัมพันธ์</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                    <div class="form-group">
                        <label > หัวเรื่อง :</label>
                         <input type="text"   class="form-control" value="<?php echo $re_title ?>" placeholder="หัวเรื่อง" name="title" size=40  disabled>
                    </div>
                    <div class="form-group">
                        <label > รายละเอียด :</label>

                          <textarea class="form-control" id="editor" rows="3"  name="detail" disabled><?php echo $re_detail ?></textarea >
                    </div>
                    <div class="form-group">
                        <label > วันที่ :</label>
                         <input type="text"   class="form-control" value="<?php echo DateThai($date); ?>" placeholder="วันที่" name="date" size=40   disabled>
                    </div>
                    <div class="form-group">
                        <label > ผู้อัพโหลด :</label>
                         <input type="text"   class="form-control" value="<?php echo $gen_fname." ".$gen_lname ?>" placeholder="วันที่" name="date" size=40   disabled>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <!-- <button type="button" class="btn btn-primary" id="addsu">บันทึก</button> -->
                </div>
            </div>
        </div>
    </div>
</form>


            <?php
            mysqli_free_result($resultre);
            mysqli_close($con);
            ?>
<script type="text/javascript">
$( document ).ready(function() {

CKEDITOR.replace('editor')
})

</script>
     