<?php
    session_start();
    include("../../function/db_function.php");
    include("../../function/fc_time.php");
    $con=connect_db();
?>

<?php
    if(empty($_POST['id'])){
        $_POST['id']="";
    }
    $i=$_POST['id'];
     $re=mysqli_query($con,"SELECT *FROM years WHERE y_id='$i'" ) or die("errorSQLselect".mysqli_error($con));
     list($y_id,$y_year,$y_no,$y_start,$y_end)=mysqli_fetch_row($re);
     $thai_y=$y_year+543;
    //  echo $y_id,$y_year,$y_no,$y_start,$y_end;

?>
<form id="foreditbrc">
 <div class="modal fade" id="editsub" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขปีงบประมาณ <?php  ?> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                    <i class="fas fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label >ปีงบประมาณ : </label>
                         <input type="hidden" name="y_id" value="<?php echo $y_id ?>">
                         <input type="number"   class="form-control"  max="3030" min="2017"  value="<?php echo $thai_y  ?>"  name="year" size=40 required>  
                    </div>
                    <div class="form-group">
                        <label >รอบที่ : <?php ?></label>
                         <input type="number"   class="form-control" max="2" min="1" value="<?php echo $y_no ?>"  name="no" size=40 required>  
                    </div>
                    <div class="form-group">
                        <label >วันที่เริ่ม : <?php ?></label>
                         <input type="date"   class="form-control" value="<?php echo $y_start ?>"  name="start" size=40 required>  
                    </div>
                    <div class="form-group">
                       
                        <label >วันที่สิ้นสุด : <?php ?></label>
                         <input type="date"   class="form-control" value="<?php echo $y_end ?>"  name="end" size=40 required>  
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
        mysqli_free_result($re);
        mysqli_close($con);
    ?>


<script type="text/javascript">
$("#updatesu").click(function(event){
    $( "#foreditbrc" ).submit() 
})
$("#foreditbrc").submit(function(e) {
    e.preventDefault();
        var chack=$( this ).valid()
        if(chack==true){
        $.post( "module/assessment/update_year.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
            //alert(data);
         });
        $('#editsub').modal("hide");
        swal("บันทึกสำเร็จแล้ว!", "", "success") 
        $('#editsub').on('hidden.bs.modal', function (e) { 
           loadmain("assessment","year");
        }) 
    }
});
</script>