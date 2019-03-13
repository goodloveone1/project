<?php
	include("../../function/db_function.php");
    $con=connect_db();

?>


<form id="foreditbrc">
 <div class="modal fade" id="showsumass" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title " id="exampleModalLabel">แสดงผลการประเมิน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div id="loaddatasumass"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                </div>
            </div>
        </div>
    </div>
</form>

    <?php
     
        mysqli_close($con);
    ?>


<script type="text/javascript">

$(document).ready(function() {

loadsumass();
function loadsumass(){
    $.ajax({
        url: "module/assessment/load_sum_ass2.php",
        data:{year: '<?php echo $_POST['year'] ?>',stid: '<?php echo $_POST['stid'] ?>' },
        type: "POST"
      }).done(function(data){
     
          $("#loaddatasumass").html(data)
    
      })

}

    

});
</script>
