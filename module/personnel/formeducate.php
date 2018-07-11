<?php
	include("../../function/db_function.php");
    $con=connect_db();
    
  $genid = $_POST['genid'];
   
?>


<form id="formaddeud">
 <div class="modal fade" id="addedu" tabindex="-1" role="dialog" aria-labelledby="addedu" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">เพิ่มวุฒิการศึกษา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label> วุฒิการศึกษา :</label>
                        <select class="form-control"  name="degree_id">
						<?php
							$edu = mysqli_query($con,"SELECT *FROM degree") or die ("error".mysqli_error($con));
							
							while(list($id_D,$name_D) = mysqli_fetch_row($edu)){
								
								echo "<option value='".$id_D."'$seleced>$name_D</option>";
							}
							mysqli_free_result($edu);
						?>
					</select>
                    </div>
                    <div class="form-group">
                        <label > ชื่อวุฒิการศึกษา :</label>
                         <input type="text"   class="form-control" value=""  name="ed_name" size=40 require>
                         <input type="hidden"   class="form-control" value="<?php echo $genid ?>"  name="genid">
                    </div>
                    <div class="form-group">
                        <label > สถานที่จบการศึกษา :</label>
                        <input type="text"   class="form-control" value=""  name="ed_loc" size=40 require>
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

$("#updatesu").click(function(event) {


         var r = confirm("Press a button!");
            if (r == true) {
                $.post( "module/personnel/addedu.php", $( "#formaddeud" ).serialize()).done(function(data,txtstuta){
                     alert(data);
                 });
                $('#addedu').modal("hide");

                $('#addedu').on('hidden.bs.modal', function (e) {
                    $('#tbeucation').DataTable().ajax.reload();
                })
               
                
            } 
    

    
        

    

   

   
});
</script>