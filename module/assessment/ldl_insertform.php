<?php
    session_start();
    include("../../function/db_function.php");
    include("../../function/fc_time.php");
	$con=connect_db();

    $yearbudget=DATE('Y')+543;  //ปีปัจจุบัน

    $min=DATE('i');
    $m=date('m');
    $y="$yearbudget";
    $yy=DATE('Y');
if($m<=9 && $m>3){
    $loop=2;
}else{
    $loop=1;
}

if($loop==2){
    $y-=1;
    $yy-=1;
}
$tor_id = $y.$loop;
echo $tor_id;

    
    $seldlt=mysqli_query($con,"SELECT *FROM idlel_type")or die(mysqli_error($con));
    for ($set = array (); $row = $seldlt->fetch_assoc(); $set[] = $row);
    //print_r($set);

   // echo $set[0]['idl_type_name'];
?>

<form id="foreditbrc">
 <div class="modal fade" id="addsub" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header headtitle">
                    <h5 class="modal-title" id="exampleModalLabel"> บันทึกการมาปฏิบัติงาน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <?php $years ="2018";  ?>
                <input type="hidden"  value="<?php echo $tor_id;; ?>"  name="a_no" size=40 >
                <div class="col-sm" >
                <?php  for($i=0;$i<count($set);$i++){
                    $name="value";
                    $n=1 ?>
                    <div class="col-md form-group row" >
                        <label class="col-sm col-form-label" > <?php echo $set[$i]['idl_type_name']; ?> :</label>
                        <!-- <input type="text"   class="form-control" value=""  name="i_no" size=10 > -->
                       <input type="text"   class="form-control col-sm" value=""  name="i_no<?php echo $i+1 ?>" size=3 ><label class="col-sm-1 col-form-label" > ครั้ง</label>
                       <input type="text"   class="form-control col-sm" value=""  name="i_day<?php echo $i+1 ?>" size=3 ><label class="col-sm-1 col-form-label" > วัน</label>
                       <input type="hidden"    value="<?php echo $set[$i]['idl_type_id']; ?>"  name="type<?php echo $i+1  ?>" size=40 >
                       <input type="hidden"    value="<?php echo$_SESSION['user_id']?>"  name="gen_id" size=40 >
                    </div>
                <?php   }?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" id="updatesu">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $("#updatesu").click(function(event) {
            
            var r = confirm("Press a button!");
            if (r == true) {
                $.post( "module/assessment/ldl_insert.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
                    alert(data);
                });
                
                $('#addsub').modal("hide");
            
                $('#addsub').on('hidden.bs.modal', function (e) {
                    var module1 = sessionStorage.getItem("module1")
                    var action = sessionStorage.getItem("action")
                    loadmain(module1,action);
                })
            
                
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
