<!-- Modal -->
<div class="modal fade bd-example-modal-xl" id="showmodelpre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header headtitle">
        <h5 class="modal-title" id="exampleModalLongTitle">แสดงผลการประเมิน ของ <?php echo $_POST['fullname'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="loadpretest">

     

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php 
      $year = $_POST['year'];
      $stid = $_POST['stid'];
      ?>

<script>

$( document ).ready(function() {

  loadpretest();

  function loadpretest(){
    $.post( "module/assessment/load_sum_ass2.php", { year: "<?php echo $year ?>", stid: "<?php echo $stid ?>" })
  .done(function( data ) {
     $("#loadpretest").html(data)
  });

  }
    
});


</script>