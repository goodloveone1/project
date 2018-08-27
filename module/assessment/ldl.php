<?php
    include("../../function/db_function.php");
	$con=connect_db();

    $seldlt=mysqli_query($con,"SELECT *FROM idlel_type")or die(mysqli_error($con));
    // while($resuat=mysqli_fetch_assoc($seldlt)){
    //     print_r($resuat);
    // }

    for ($set = array (); $row = $seldlt->fetch_assoc(); $set[] = $row);
print_r($set);
?>

<form id="foreditbrc" method="get" action="ldl_insert.php">
 <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel"> บันทึกการมาปฏิบัติงาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label > ลาป่วย :</label>
                        <input type="text"   class="form-control" value=""  name="i_no" size=10 hiddent >
                       <input type="text"   class="form-control" value=""  name="i_no" size=10 > ครั้ง
                       <input type="text"   class="form-control" value=""  name="i_day" size=10 > วัน
                       <input type="hidden"    value=""  name="branch_id" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > ลากิจ :</label>
                       <input type="text"   class="form-control" value=""  name="g_no" size=10 > ครั้ง
                       <input type="text"   class="form-control" value=""  name="g_day" size=10 > วัน
                       <input type="hidden"    value=""  name="branch_id" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > มาสาย :</label>
                       <input type="text"   class="form-control" value=""  name="l_no" size=10 > ครั้ง
                       <input type="text"   class="form-control" value=""  name="l_day" size=10 > วัน
                       <input type="hidden"    value=""  name="branch_id" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > ลาคลอดบุตร :</label>
                       <input type="text"   class="form-control" value=""  name="s_no" size=10 > ครั้ง
                       <input type="text"   class="form-control" value=""  name="s_day" size=10 > วัน
                       <input type="hidden"    value=""  name="branch_id" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > ลาอุปสมบท :</label>
                       <input type="text"   class="form-control" value=""  name="b_no" size=10 > ครั้ง
                       <input type="text"   class="form-control" value=""  name="b_day" size=10 > วัน
                       <input type="hidden"    value=""  name="branch_id" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > ลาป่วยจำเป็นต้องรักษาตัวเป็นเวลานาน
คราวเดียวหรือหลายคราวรวมกัน :</label>
                       <input type="text"   class="form-control" value=""  name="sex_no" size=10 > ครั้ง
                       <input type="text"   class="form-control" value=""  name="sex_day" size=10 > วัน
                       <input type="hidden"    value=""  name="branch_id" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > ขาดราชการ :</label>
                       <input type="text"   class="form-control" value=""  name="p_no" size=10 > ครั้ง
                       <input type="text"   class="form-control" value=""  name="p_day" size=10 > วัน
                       <input type="hidden"    value=""  name="branch_id" size=40 require>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" id="updatesu">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>