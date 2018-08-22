<?php

include("../../function/db_function.php");
$con=connect_db();
$date = date("Y-m-d H:i:s");

echo  $date;


?>

<form id="formaddbrc">
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
                         <input type="text"   class="form-control" value="" placeholder="หัวเรื่อง" name="subject" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > รายละเอียด :</label>
                         <input type="text"   class="form-control" value="" placeholder="ชื่อสาขา" name="subject" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > วันที่ :</label>
                         <input type="datetime-local"   class="form-control" value="<?php echo $date ?>" placeholder="วันที่" name="subject" size=40   >
                    </div>
                    
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
            $.post( "module/personnel/adddatasubject.php", $("#formaddbrc").serialize()).done(function(data,txtstuta){
                //alert(data);
                $('#addsub').modal("hide")

                $('#addsub').on('hidden.bs.modal', function (e) {

                var module1 = sessionStorage.getItem("module1")
                var action = sessionStorage.getItem("action")
              loadmain(module1,action);
                })
             })
            
           
            
        } 

       
    });
</script>

            <?php
            
            mysqli_close($con);
            ?>

     