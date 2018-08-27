<?php
    include("../../function/db_function.php");
	$con=connect_db();

    $seldlt=mysqli_query($con,"SELECT *FROM idlel_type")or die(mysqli_error($con));
    for ($set = array (); $row = $seldlt->fetch_assoc(); $set[] = $row);
    //print_r($set);

    echo $set[0]['idl_type_name'];
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
                <?php  for($i=0;$i<count($set);$i++){
                    $name="value";
                    $n=1 ?>
                    <div class="form-group">
    
                        <label > <?php echo $set[$i]['idl_type_name']; ?> :</label>
                        <!-- <input type="text"   class="form-control" value=""  name="i_no" size=10 > -->
                       <input type="text"   class="form-control" value=""  name="i_no<?php echo $i+1 ?>" size=10 > ครั้ง
                       <input type="text"   class="form-control" value=""  name="i_day<?php echo $i+1 ?>" size=10 > วัน
                       <input type="hidden"    value="<?php echo $set[$i]['idl_type_id']; ?>"  name="<?php  ?>" size=40 require>
                    </div>
                <?php   }?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" id="updatesu">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>