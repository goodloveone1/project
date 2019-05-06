<?php
        include("../../function/db_function.php");
        include("../../function/fc_time.php");
        $con=connect_db();
        $re = mysqli_query($con,"SELECT re_title,re_detail,re_date,staff_id FROM relations WHERE re_id='$_POST[reid]'");
        list($re_title,$re_detail,$re_date,$gen_id)=mysqli_fetch_row($re);
        $gen = mysqli_query($con,"SELECT fname,lname FROM staffs WHERE st_id = '$gen_id'");
        list($name,$lname) = mysqli_fetch_row($gen);
    ?>
<div class="modal fade" id="showpr" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header headtitle">
        <h5 class="modal-title" id="exampleModalScrollableTitle"> หัวเรื่อง  <?php echo $re_title ?> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class='row'>
                <div class='col'>
                    <h5>รายละเอียด </h5>
                    <div style='text-indent: 50px;'>
                        <?php echo $re_detail ?>
                    </div>    
                </div>
            </div>
            <div class='row'>
                <div class='col'>
                    <h6>เผยแพร่เมื่อ  <?php echo DateThai($re_date) ?> </h6>      
                </div>
            </div>
            <div class='row'>
                <div class='col'>
                    <h6>โดย  <?php echo "โดย ".$name." ".$lname ?> </h6>      
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>