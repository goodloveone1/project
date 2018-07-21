<?php
   
	include("../../function/db_function.php");
    $con=connect_db();
?>
<div class=" headtitle text-center p-2 row mb-2 row">
    <div class="col-sm-2" >
       <a href=#> <button type="button" class="btn btn-block" id="backpage" data-modules="personnel" data-action="menumanage"><i class="fas fa-chevron-left"></i>&nbsp;ย้อนกลับ</button></a>
    </div>
    
    <div class="col-md">
        <h2>จัดการสาขา</h2>
    </div>
    <div class="col-sm-2">
        <a href=#><button type="button" class="btn btn-block" id="addbrn" data-toggle='modal'><i class="fas fa-plus"></i>&nbsp;เพื่มสาขา</button></a>
    </div>
</div>
<table  class="table" id="tablebranch" >
    <thead class="thead-light">
         <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">ตำแหน่ง</th>
            <th scope="col">ภาระงาน</th>
            <th scope="col">น้ำหนัก</th>
        </tr>
    </thead>
<tbody>
<?php
    $sums=mysqli_query($con,"SELECT COUNT(aca_id) FROM academic");

    for($i=1;$i<=$y){
    $re=mysqli_query($con,"SELECT *FROM weights WHERE aca_id='$i'" ) or die("errorSQLselect".mysqli_error($con));
    $no=1;
    while(list($w_id,$aca_id,$tit,$weighs)=mysqli_fetch_row($re)){
        $seac = mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$aca_id'" ) or die("SQL error".mysqli_error($con));
        list($aca_name)=mysqli_fetch_row($seac);
        $setit = mysqli_query($con,"SELECT e_name FROM evaluation WHERE e_id='$tit'") or die("SQL error".mysqli_error($con));
        list($tit_name)=mysqli_fetch_row($setit);

        if($weighs==0){
            $weighs="ไม่มี";
        }
        echo"
            <tr>
                <td>$no</td>
                <td>$aca_name</td>
                <td>$tit_name</td>
                <td>$weighs</td>
                <td><a href='#'class='editbrn' data-ideditsub='$w_id' data-toggle='modal' ><i class='fas fa-edit fa-2x'></i></a></td>
                <td><a href='#' class='delbrn' data-branchname='$w_id' data-ideditsub='$w_id'><i class='fas fa-trash-alt fa-2x'></i></a></td>
            </tr>";
            $no++;
    }
}
    mysqli_free_result($re);
    mysqli_close($con);
?>
 </tbody>
<div id="loadeditsub"></div>
<div id="loadaddsub"></div> 

<script>
     $('#tablebranch').DataTable();
    $(".editbrn").click(function( ){
        var ideditsub =$(this).data("ideditsub");
        
        $.post("module/personnel/editsubject.php", { id : ideditsub }).done(function(data){
        $('#loadeditsub').html(data);
        $('#editsub').modal('show');
        })
        
        
        });
       

        $("#backpage").click(function(event) {

            var module1 = $(this).data('modules');
            var action = $(this).data('action');
			loadmain(module1,action)

        })
        $(".delbrn").click(function(){
            
            var ideditsub =$(this).data("ideditsub");
            var branchname =$(this).data("branchname");

            var r = confirm("ต้องการลบสาขา "+branchname+" ใช่หรือไม่?");
            if (r == true) {
                $.post( "module/personnel/deletesubject.php", {id : ideditsub}).done(function(data,txtstuta){
                    var module1 = sessionStorage.getItem("module1");
                    var action = sessionStorage.getItem("action");
    
                    loadmain(module1,action);
                    })
            }
        })
        $("#addbrn").click(function( ){

        $('#loadaddsub').load("module/personnel/addsubject.php",function(){
            $('#addsub').modal('show');     
            });
         });
       
        </script>