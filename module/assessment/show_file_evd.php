<?php
    session_start();
    include("../../function/db_function.php");
    $con=connect_db();

?>

 <div class="modal fade" id="editfile" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">ตรวจสอบไฟล์หลักฐาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <table class="table tableevdfile" id="Datatable">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th >ชื่อไฟล์</th>
                            <th >ประเภทไฟล์</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
           
                        //echo $_POST['torid']."<br>".$_POST['seid']."<br>".$_POST['evdid'];


                        $torid = $_POST['torid'];
                        $sql = "SELECT evd_file_id,evd_file_name FROM evidence_file WHERE se_id='$_POST[seid]' AND evd_id='$_POST[evdid]' ";
                        $evd_file =  mysqli_query($con,$sql) or  die("SQL Error1==>1".mysqli_error($con));
                        $i=1;
                        while(list($evd_file_id,$evd_file_name) = mysqli_fetch_row($evd_file)){ 
                            $url = "file/$torid/$evd_file_name";
                        ?>
                            <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo "<a href='$url' target='_blank'> $evd_file_name </a>"; ?></td>
                            <td><?php echo pathinfo($url,PATHINFO_EXTENSION)?></td>
                            </tr>
                        <?php
                        $i++;
                        } // END WHILE
                        ?>
                        </tbody>
</table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>

<?php
mysqli_close($con);
?>

<script type="text/javascript">

$(document).ready(function() {
    $.getScript('js/mydatatable.js');

});
</script>


