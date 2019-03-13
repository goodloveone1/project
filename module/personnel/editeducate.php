<?php
	include("../../function/db_function.php");
    $con=connect_db();
    
    $dee = mysqli_query($con,"SELECT  ed_id,degree_id,ed_name,ed_loc,staff_id FROM education WHERE ed_id='$_POST[id]'") or die ("error".mysqli_error($con));
    
    list($ed_iD,$degree_iD,$ed_name,$ed_Locate,$staff_id)=mysqli_fetch_row($dee);
   
?>


<form id="foreditbrc">
 <div class="modal fade" id="editsub" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไปไขวุฒิการศึกษา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-group row">
                        <label class="col-md-4 col-form-label "> วุฒิการศึกษา :</label>
                        <div class="col-md">
                            <select class="form-control"  name="degree_id">
    						<?php
    							$edu = mysqli_query($con,"SELECT *FROM degree") or die ("error".mysqli_error($con));
    							
    							while(list($id_D,$name_D) = mysqli_fetch_row($edu)){
    								$seleced=$id_D==$degree_iD?"selected":""; 
    								echo "<option value='".$id_D."'$seleced>$name_D</option>";
    							}
    							mysqli_free_result($edu);
    						?>
					       </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label "> ชื่อวุฒิการศึกษา :</label>
                        <div class="col-md">
                         <input type="text"   class="form-control" value="<?php echo $ed_name ?>"  name="ed_name" size=40 require>
                        </div>
                          <input type="hidden"    value="<?php echo $ed_iD ?>"  name="ed_id" size=40 require>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label ">สถานที่จบการศึกษา:</label>
                        <div class="col-md">
                            <input type="text"   class="form-control" value="<?php echo $ed_Locate ?>"  name="ed_loc" size=40 require>
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="updateedu">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>

    <?php
        mysqli_free_result($dee);
        mysqli_close($con);
    ?>


<script type="text/javascript">

$("#updateedu").click(function(event) {
    var r = confirm("คุณต้องการแก้ไขวุฒิการศึกษาใช่ไหม");
    if (r == true) {

        $.post( "module/personnel/updateeducate.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
             //alert(data);

         });
        $('#editsub').modal("hide");

        $('#editsub').on('hidden.bs.modal', function (e) {
            $.post( "module/personnel/loaddatadegree2.php", { genid : <?php echo $staff_id;?> })
            .done(function( data ) {
                alert("บันทึกข้อมูลสำเร็จ")
                $("#loadtabledegree").html(data);
            });
        })
       
        
    } 

   
});
</script>