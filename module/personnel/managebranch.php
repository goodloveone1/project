
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
                    <td><a href='#'class='link' data-ideditsub='$subject_id' data-toggle='modal'>แก้ไข</a></td>
                    <td><a href='#' onclick='return confirm(\"ยืนยันการลบ\")'>ลบ</a></td>
                </tr>";
        $i++;
    }
    mysqli_free_result($result);
  
?>
</table>


<table border=1>
    <tr align='center'>
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
                <td><a href='editbranch.php?b_id=$branch_ID'>แก้ไข</a></td>
                <td><a href='#'  onclick='return confirm(\"ยืนยันการลบ\")'>ลบ</a></td>
            </tr>";
            $no++;
    }
    mysqli_free_result($Sbranch);
    mysqli_close($con);

    
?>


<div id="loadeditsub"></div>

<script>
    $(".link").click(function( ){
        var ideditsub =$(this).data("ideditsub");
        
            $.post("module/personnel/editbranch.php", { id : ideditsub }).done(function(data){
                $('#loadeditsub').html(data);
                 $('#editsub').modal('show');
            })
       
        
    });
</script>
