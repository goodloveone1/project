<?php
    include("../../function/db_function.php");
	$con=connect_db();

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
                <SELECT name='no' >
                    <option>รอบที่1</option>
                    <option>รอบที่2</option>
                </SELECT>
                <?php  for($i=0;$i<count($set);$i++){
                    $name="value";
                    $n=1 ?>
                    <div class="col-md form-group row" >
                        <label class="col-sm col-form-label" > <?php echo $set[$i]['idl_type_name']; ?> :</label>
                        <!-- <input type="text"   class="form-control" value=""  name="i_no" size=10 > -->
                       <input type="text"   class="form-control col-sm" value=""  name="i_no<?php echo $i+1 ?>" size=3 ><label class="col-sm-1 col-form-label" > ครั้ง</label>
                       <input type="text"   class="form-control col-sm" value=""  name="i_day<?php echo $i+1 ?>" size=3 ><label class="col-sm-1 col-form-label" > วัน</label>
                       <input type="hidden"    value="<?php echo $set[$i]['idl_type_id']; ?>"  name="<?php  ?>" size=40 require>
                       <input type="hidden"    value=""  name="<?php  ?>" size=40 require>
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
</script>
