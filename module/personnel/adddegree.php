<?php
	include("../../function/db_function.php");
    $con=connect_db();
?>


<form id="foreditbrc">
 <div class="modal fade" id="addsub" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title " id="exampleModalLabel">เพิ่มวุฒิการศึกษา</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-center">วุฒิการศึกษา :</label>
                         <div class="col-md">
                            <input type="text"   class="form-control" value=""  name="ed_name" size=40 required>
                        </div>
                          <input type="hidden"    value=""  name="degree_name" size=40 require>
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
        $.post( "module/personnel/adddatadegree.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
            swal("บันทึกสำเร็จ!", {
									icon: "success",
									buttons: false,
									timer: 1000,
								});
            $('#addsub').modal("hide");

            $('#addsub').on('hidden.bs.modal', function (e) {
                var module1 = sessionStorage.getItem("module1")
                var action = sessionStorage.getItem("action")
                loadmain(module1,action);
            })  
         });
        }    
});
</script>