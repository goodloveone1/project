<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
    $se_year=mysqli_query($con,"SELECT MAX(y_id) FROM years")or die("SQL.error".mysqli_error($con));
    list($last_id)=mysqli_fetch_row($se_year);
    mysqli_free_result($se_year);
    $year=substr($last_id,0,4);
    $no=substr($last_id,4,5);
    if($no==2){
       $y=$year+1;
       $n=$no-1;
       $start="-10-01";
       $end="-03-31";
       $yyyy=($y-543)+1;
      // echo $year+2;
    }else{
        $y=$year;
        $n=$no+1;
        $start="-04-01";
        $end="-09-30";
        $yyyy=($y-543)+2;
    }
   

?>

<form id="foreditbrc">
 <div class="modal fade" id="editsub" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มปีงบประมาณ  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- <span aria-hidden="true">&times;</span> -->
                    <i class="fas fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label >ปีงบประมาณ : <?php ?></label>
                         <input type="number"   class="form-control"  max="3562" min="2017"  value="<?php echo $y  ?>"  name="year" size=40 required>  
                    </div>
                    <div class="form-group">
                        <label >รอบที่ : <?php ?></label>
                         <input type="number"   class="form-control" max="2" min="1" value="<?php echo $n; ?>"  name="no" size=40 required>  
                    </div>
                    <div class="form-group">
                        <label >วันที่เริ่ม : <?php ?></label>
                         <input type="date"   class="form-control" value="<?php echo $yyyy,$start?>"  name="start" size=40 required>  
                    </div>
                    <div class="form-group">
                        <?php $e_y=$yyyy+1 ?>
                        <label >วันที่สิ้นสุด : <?php ?></label>
                         <input type="date"   class="form-control" value="<?php echo $e_y,$end?>"  name="end" size=40 required>  
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
$("#updatesu").click(function(event){
    $( "#foreditbrc" ).submit() 
})
$("#foreditbrc").submit(function(e) {
        e.preventDefault();
        var chack=$( this ).valid()
        if(chack==true){
        $.post( "module/assessment/adddata_year.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
            //alert(data);
         });
        $('#editsub').modal("hide");
        swal("บันทึกสำเร็จ!", {
				icon: "success",
				buttons: false,
				timer: 1000,
			});
        $('#editsub').on('hidden.bs.modal', function (e) {
           loadmain("assessment","year");
        })
    }
});
</script>