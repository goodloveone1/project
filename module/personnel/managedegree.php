<?php
   
	include("../../function/db_function.php");
    $con=connect_db();
?>
<div class=" headtitle text-center p-2 row mb-2 row">
    <div class="col-sm-2" >
       <a href=#> <button type="button" class="btn btn-block" id="backpage" data-modules="personnel" data-action="menumanage"><i class="fas fa-chevron-left"></i>&nbsp;ย้อนกลับ</button></a>
    </div>
    <div class="col-sm-2">
        <a href=#><button type="button" class="btn btn-block" id="addbrn" data-toggle='modal'><i class="fas fa-plus"></i>&nbsp;เพิ่มวุฒิการศึกษา</button></a>
    </div>
    <div class="col-md">
        <h2>จัดการวุฒิการศึกษา</h2>
    </div>
</div>
<table  class="table" id="tabldegree" >
    <thead class="thead-light">
         <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">วุฒการศึกษา</th>
            <th scope="col">แก้ไข</th>
            <th scope="col">ลบ</th>
        </tr>
    </thead>
<tbody>
<?php
    $sedegree=mysqli_query($con,"SELECT *FROM degree") or die("errorSQLselect".mysqli_error($con));
    $no=1;
    while(list($D_id,$D_name)=mysqli_fetch_row($sedegree)){
      
        echo"
            <tr>
                <td>$no</td>
                <td>$D_name</td>
                <td><a href='#'class='editbrn' data-ideditsub='$D_id' data-toggle='modal' ><i class='fas fa-edit fa-2x'></i></a></td>
                <td><a href='#' class='delbrn' data-branchname='$D_name' data-ideditsub='$D_id'><i class='fas fa-trash-alt fa-2x'></i></a></td>
            </tr>";
            $no++;
    }
    mysqli_free_result($sedegree);
    mysqli_close($con);
?>
 </tbody>
<div id="loadeditsub"></div>
<div id="loadaddsub"></div> 

<script>
     $('#tabldegree').DataTable();
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