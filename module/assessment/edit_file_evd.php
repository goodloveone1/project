<?php
    session_start();
    include("../../function/db_function.php");
    $con=connect_db();

?>
<form id="foredittext">
 <div class="modal fade" id="editfile" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไบข้อความ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div id="tablefile"></div>   

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-dismiss="modal">ยกเลิก</button>
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

    loadtablefile(<?php echo $_POST['torid'] ?>,<?php echo $_POST['seid'] ?>,<?php echo $_POST['evdid'] ?>)

    function loadtablefile(torids,seids,evdids){

        $.post("module/assessment/loadtable_evdfile.php", { evdid : evdids ,seid : seids ,torid: torids }).done(function(data){
            ////alert(data)
            $('#tablefile').html(data);
            
        })
    }




});
</script>


