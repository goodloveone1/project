<?php
	include("../../function/db_function.php");
    $con=connect_db();

    $dee = mysqli_query($con,"SELECT *FROM degree WHERE degree_id='$_POST[id]'") or die ("error".mysqli_error($con));

    list($degree_id,$degree_name)=mysqli_fetch_row($dee);

?>


<form id="foreditbrc">
 <div class="modal fade" id="editde" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title " id="exampleModalLabel">แก้ไปไขวุฒิการศึกษา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label > วุฒิการศึกษา :</label>
                         <input type="text"   class="form-control" value="<?php echo $degree_name ?>"  name="degree_name" size=40 required>
                          <input type="hidden"    value="<?php echo $degree_id ?>"  name="degree_id" size=40 require>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-success" id="updatede">บันทึกข้อมูล</button>
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
$("#updatede").click(function(event){
    $( "#foreditbrc" ).submit() 
})
$("#foreditbrc").submit(function(e) {
    e.preventDefault();
        var chack=$( this ).valid()
        if(chack==true){
        $.post( "module/personnel/updatedegree.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){        
            $('#editde').modal("hide");
            swal("บันทึกสำเร็จ!", {
									icon: "success",
									buttons: false,
									timer: 1000,
								});
            $('#editde').on('hidden.bs.modal', function (e) {
                var module1 = sessionStorage.getItem("module1")
                var action = sessionStorage.getItem("action")
                loadmain(module1,action);
            })  
         });
        }
});
</script>
