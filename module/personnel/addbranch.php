<?php

include("../../function/db_function.php");
$con=connect_db();
?>
<?php

?>
<form id="formaddbrc">
    <div class="modal fade" id="addsub" tabindex="-1" role="dialog" aria-labelledby="addsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">เพื่มข้อมูลหลักสูตร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label > ชื่อหลักสูตร :</label>
                         <input type="text"   class="form-control" value="" placeholder="ชื่อหลักสตร" name="subject" size=40 require>
                    </div>
                    <div class="form-group">
                        <label > ชื่อสาขาวิชา :</label>
                        <select class="form-control" name="branch">
                            <?php
                                $selectB=mysqli_query($con,"SELECT dept_id,dept_name FROM departments") or die ("mysql error=>>".mysql_error($con));
                                while(list( $dept_id,$dept_name)=mysqli_fetch_row($selectB)){
                                echo "<option value='$dept_id'>$dept_name</option>";
                                }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-success" id="addsu"> เพื่มข้อมูล</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">

    $("#addsu").click(function(event) {
        var r = confirm("คุณต้องการเพื่มข้อมูลใช่ไหม?");
        if (r == true) {
            $.post( "module/personnel/adddatabranch.php", $("#formaddbrc").serialize()).done(function(data,txtstuta){
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
