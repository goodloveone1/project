
<?php
  
	include("../../function/db_function.php");
    $con=connect_db();
?>
จัดการหลักสูตร
<table border=1 class="table">
    <tr align='center'>
        <td>ลำดับ</td>
        <td>หลักสูตร</td>
        <td>สาขา</td>
        <td>แก้ไข</td>
        <td>ลบ</td>
    </tr>
<?php
   $result=mysqli_query ($con,"SELECT  subject_id,subject_name,branch_id FROM subjects") or die ("error".mysqli_error($con));
    $i=1;
    while(list($subject_id,$subject_name,$branch)=mysqli_fetch_row($result)){
        $branch=mysqli_query($con,"SELECT branch_name FROM branch WHERE branch_id='$branch'") or die ("errorSQL".mysqli_error($con));
        list($branch_name)=mysqli_fetch_row($branch);
        echo"
                <tr>
                    <td>$i<ttd> 
                    <td>$subject_name<ttd>
                    <td> $branch_name</td>
                    <td><a href='#'class='editbrn' data-ideditsub='$subject_id' data-toggle='modal'>แก้ไข</a></td>
                    <td><a href='#' data-ideditsub='$subject_id' class='delbrn'>ลบ</a></td>
                </tr>";
        $i++;
    }
    mysqli_free_result($result);
  
?>
</table>

<<<<<<< HEAD
    
=======
<?php
    mysqli_close($con);
?>

>>>>>>> 53bae3641f2fc1d2d694b501129d5871a3f8f8d6

<div id="loadeditsub"></div>

<script>
    $(".editbrn").click(function( ){
        var ideditsub =$(this).data("ideditsub");
        
            $.post("module/personnel/editbranch.php", { id : ideditsub }).done(function(data){
                $('#loadeditsub').html(data);
                 $('#editsub').modal('show');
            })
       
        
    });
    $(".delbrn").click(function(){
        var ideditsub =$(this).data("ideditsub");
        var r = confirm("คณต้องการลบใช่ไหม?");
        if (r == true) {
            $.post( "module/personnel/delbranch.php", {id : ideditsub}).done(function(data,txtstuta){
                var module1 = sessionStorage.getItem("module1");
                var action = sessionStorage.getItem("action");
                loadmain(module1,action);
             })
        }
    })
     
</script>
