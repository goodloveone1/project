<?php
    session_start();
    include("../../function/db_function.php");
    include("../../function/fc_time.php");
	$con=connect_db();

$yearid = empty($_POST['yearid'])?'':$_POST['yearid'];
$stid = empty($_POST['stid'])?'':$_POST['stid'];

if(empty($yearid)){
    $yearid = chk_idtest();
}

//echo $yearid;


    $seldlt=mysqli_query($con,"SELECT * FROM absence_type")or die(mysqli_error($con));
    for ($set = array (); $row = $seldlt->fetch_assoc(); $set[] = $row);
    //print_r($set);

   // echo $set[0]['idl_type_name'];
?>

<form id="foreditbrc">
 <div class="modal fade" id="addsub" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel"> บันทึกการปฏิบัติงาน <?php echo $_POST['name'] ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php $years ="2018";  ?>
                <input type="hidden"  value="<?php echo $yearid; ?>"  name="a_no" size=40 >
                <div class="col-sm" >
                <?php  for($i=0;$i<count($set);$i++){
                    $name="value";
                    $n=1 ?>
                    <div class="col-md form-group row" >
                        <label class="col-sm col-form-label" > <?php echo $set[$i]['abt_name']; ?> :</label>
                        <!-- <input type="text"   class="form-control" value=""  name="i_no" size=10 > -->
                       <input type="number" min='0' max='999'  class="form-control col-sm" value="0"  name="i_no<?php echo $i+1 ?>" size=3 ><label class="col-sm-1 col-form-label" > ครั้ง</label>
                       <input type="number" min='0' max='999'  class="form-control col-sm" value="0"  name="i_day<?php echo $i+1 ?>" size=3 ><label class="col-sm-1 col-form-label" > วัน</label>
                       <input type="hidden"    value="<?php echo $set[$i]['abt_id']; ?>"  name="type<?php echo $i+1  ?>" size=40 >
                       <input type="hidden"    value="<?php echo $stid ?>"  name="gen_id" size=40 >
                       <input type="hidden" value="1" name="chk">
                    </div>
                <?php   }?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="updatesu">บันทึก</button>
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
        $("#updatesu").click(function(event) {

            var r = confirm("คุณต้องการบันทึกข้อมูลใช่ไหม?");
            if (r == true) {
                $.post( "module/assessment/ldl_insert.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
                    //alert(data);
                   
                    $('#addsub').modal("hide");

                    $('#addsub').on('hidden.bs.modal', function (e) {
                        var module1 = sessionStorage.getItem("module1")
                        var action = sessionStorage.getItem("action")
                        loadmain(module1,action);
                    })
                    alert("บันทึกข้อมูลสำเร๊จ");
                });

            }
        });
        $("#inputState").change(function(){
                var years=$(this,"option:selected").val()
            //  alert(years)
                $.post("module/assessment/loaddatayear.php",{year:years},
                function (data, textStatus, jqXHR) {
                    // alert(data)
                    $("#inputNo").html(data)
                }
                );
            });
        });
</script>
