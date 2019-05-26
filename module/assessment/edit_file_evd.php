<?php
    session_start();
    include("../../function/db_function.php");
    $con=connect_db();

?>

 <div class="modal fade" id="editfile" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไบไฟล์หลักฐาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

        
                        <form enctype="multipart/form-data" id='formupload' action='javascript:void(0)'>
                            <div class="form-group row">
                                <div class="col-sm-5"></div>
                                    <div class="col-sm">
                                        <input type="hidden"  name='torid' value='<?php echo $_POST['torid'] ?>'>
                                        <input type="hidden"  name='seid' value='<?php echo $_POST['seid'] ?>'>
                                        <input type="hidden"  name='evdid' value='<?php echo $_POST['evdid'] ?>'>
                                        <input type="file" class="form-control-file filecheck" name='addfile[]' multiple>
                                        <small id='fileHelpInline' class='form-text text-muted '>**อัปโหลดเฉพาะไฟล์ PDF DOC DOCX PNG JPG RAR ZIP XLS XLSX เท่านั้น</small>
                                    </div>
                                <div class="col-sm-2"> <button type='submit' class='btn btn-secondary' ><i class="fas fa-file-medical fa-lg"></i> อัปโหลดไฟล์ </button> </div>
                           </div>
                        </form>   
         

                        <div id="tablefile"></div>   

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

    loadtablefile('<?php echo $_POST['torid'] ?>',<?php echo $_POST['seid'] ?>,'<?php echo $_POST['evdid'] ?>')

    function loadtablefile(torids,seids,evdids){

        $.post("module/assessment/loadtable_evdfile.php", { evdid : evdids ,seid : seids ,torid: torids }).done(function(data){
            ////alert(data)
            $('#tablefile').html(data);  
        })
    }
    $.validator.addMethod('filesize', function (value, element, param) {
			// alert( element.files.length)
			 var count = element.files.length;
			 var check;
			 for(var i=0;i < count ;i++){
				if(this.optional(element) || (element.files[i].size <= param)){
					check = true;
				}else{
					check = false;
					break;
				}
			 }
			 return check
		}, jQuery.validator.format("ไฟล์เกินกำหนด 2 MB") );
		

	jQuery.validator.addClassRules("filecheck", {
		extension: "pdf|doc|png|jpg|docx|rar|zip|xls|xlsx",
        filesize : 2000000, // MAX 2 MB
        required: true
	});


    $vform = $( "#formupload");
	$vform.validate();

    $( "#formupload" ).submit(function(e){
		e.preventDefault() 

			if($vform.valid()){
				//$conf = confirm("คุณต้องการบันทึกข้อมูลใช่ไหม?");
				swal({
                title: "คุณต้องการอัปโหลดไฟล์ใช่หรือไม่?",
                text: " ",
                icon: "info",
                buttons: true,
                dangerMode: true,
                buttons:["ยกเลิก","ตกลง"],
                })
                .then((willDelete) => {
                if (willDelete) {
                    var formData = new FormData(this);
						$.ajax({
							url: "module/assessment/edit_evd_add_file.php",
							type: 'POST',
							data: formData,
							success: function (data) {

                            //alert(data)

							},
							cache: false,
							contentType: false,
							processData: false
						}).done(function(data) {
                            $('.filecheck').val("");
                            loadtablefile('<?php echo $_POST['torid'] ?>',<?php echo $_POST['seid'] ?>,'<?php echo $_POST['evdid'] ?>')
						})
                    swal("อัปโหลดไฟล์สำเร็จแล้ว", {
                    icon: "success",
                    buttons: false,
					timer: 1000,
                    });
                } else {
            
                }
                });
					
		
	}
	
	});




});
</script>


