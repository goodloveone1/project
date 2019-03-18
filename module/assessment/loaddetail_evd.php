<!-- Modal -->
<div class="modal fade bd-example-modal-xl" id="showmodelpre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">แสดงหลักฐานการประเมิน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div id='checkevd'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$( document ).ready(function() {
loadevd()
	function loadevd(){
			$.post("module/assessment/editformreport_prm_check.php",{evdid: '<?php echo $_POST['evdid']?>', checkshowfile: '<?php echo $_POST['checkshowfile']?>'  }).done(function(data){
				//sessionStorage.setItem("module1","assessment")
				//sessionStorage.setItem("action","manage_Evidence")
				$("#checkevd").html(data);
			})
  }
});
</script>