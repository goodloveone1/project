<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
?>
จัดการสาขาวิชา

<table border=1 class="table">
    <tr>
        <td>ลำดับ</td>
        <td>สาขา</td>
        <td>แก้ไข</td>
        <td>ลบ</td>
    </tr>
<?php
    $Sbranch=mysqli_query($con,"SELECT *FROM branch") or die("errorSQLselect".mysqli_error($con));
    $no=1;
    while(list($branch_ID,$branch_Name)=mysqli_fetch_row($Sbranch)){
        echo"
            <tr>
                <td>$no</td>
                <td>$branch_Name</td>
                <td><a href='#'class='editbrn' data-ideditsub='$branch_ID' data-toggle='modal' >แก้ไข</a></td>
                <td><a href='#'  onclick='return confirm(\"ต้องการลบสาขา $branch_Name ใช่หรือไม่ \")'>ลบ</a></td>
            </tr>";
            $no++;
    }
    mysqli_free_result($Sbranch);
    mysqli_close($con);
?>
<div id="loadeditsub"></div>

<script>
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
         
       
        </script>