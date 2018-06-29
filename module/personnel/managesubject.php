<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
?>
<div class=" headtitle text-center p-2 row mb-2 row">
    <div class="col-sm-2">
        <button type="button" class="btn" id="backpage" data-modules="personnel" data-action="menumanage">ย้อนกลับ</button>
    </div>
    <div class="col-sm-2">
        <button type="button" class="btn" id="addbrn" data-toggle='modal'>เพื่มสาขา</button>
    </div>
    <div class="col-md">
        <h2>จัดการสาขา</h2>
    </div>
</div>
<table  class="table" id="tablebranch" >
    <thead class="thead-light">
         <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">สาขา</th>
            <th scope="col">แก้ไข</th>
            <th scope="col">ลบ</th>
        </tr>
    </thead>
<tbody>
<?php
    $Sbranch=mysqli_query($con,"SELECT *FROM branch") or die("errorSQLselect".mysqli_error($con));
    $no=1;
    while(list($branch_ID,$branch_Name)=mysqli_fetch_row($Sbranch)){
        echo"
            <tr>
                <td>$no</td>
                <td>$branch_Name</td>
                <td><a href='#'class='editbrn' data-ideditsub='$branch_ID' data-toggle='modal' ><i class='fas fa-edit fa-2x'></i></a></td>
                <td><a href='#' class='delbrn' data-branchname='$branch_Name' data-ideditsub='$branch_ID'><i class='fas fa-trash-alt fa-2x'></i></a></td>
            </tr>";
            $no++;
    }
    mysqli_free_result($Sbranch);
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
             
            $('#detail').animateCss('fadeOut' , function() { /* ANIMATION USE */
                loadmain(module1,action)
            });
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