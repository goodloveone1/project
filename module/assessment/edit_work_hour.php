<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
  
    if(empty($_POST['id'])){
        $_POST['id']="";
    }
    $i=$_POST['id'];  
?>
<form id="foreditbrc">
 <div class="modal fade" id="editsub" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขภาระขั้นต่ำ <?php  ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                    <i class="fas fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?php   
                            $se_minWork=mysqli_query($con,
                            "SELECT work_hour.hw_id,evaluation.e_name,academic.aca_name,work_hour.min_hour 
                            FROM work_hour 
                            INNER JOIN academic
                            ON academic.aca_id=work_hour.aca_id
                            INNER JOIN evaluation
                            ON evaluation.e_id=work_hour.aca_id
                            WHERE hw_id ='$i' ")or die("SQL-error".mysqli_error($con));
                            list($hw_id,$e_name,$aca_name,$minWork)=mysqli_fetch_row($se_minWork);
                            //echo $hw_id,$minWork;

                        ?>
                        <label ><b>ตำแหน่งงาน :</b> <?php echo $aca_name ?></label><br>
                        <label ><b>ภาระงาน :</b> <?php echo $e_name ?></label>
                         <input type="text"   class="form-control" value="<?php echo $minWork;  ?>"  name="minwork" size=40 required>
                          <input type="hidden"    value="<?php echo $i ?>"  name="id" size=40 require>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="updatesu">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>

    <?php
        mysqli_close($con);
    ?>


<script type="text/javascript">
$( document ).ready(function() {
    $("#updatesu").click(function(event){
        $( "#foreditbrc" ).submit() 
    })
    $("#foreditbrc").submit(function(e) {
        e.preventDefault();
         var chack=$( this ).valid()
        if(chack==true){
            $.post( "module/assessment/update_minhourWork.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
                // alert(data);
            });
            $('#editsub').modal("hide");
            swal("บันทึกสำเร็จแล้ว!", "", "success") 
            $('#editsub').on('hidden.bs.modal', function (e) { 
            loadmain("assessment","min_hour_work");
            })
        }
    });
});
</script>