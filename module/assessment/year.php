<?php
   
    include("../../function/db_function.php");
    include("../../function/fc_time.php");
    $con=connect_db();

    $se_year=mysqli_query($con,"SELECT *FROM years")or die("SQL.error".mysqli_error($con));
   
?>
<div class=" headtitle text-center p-2 row mb-2 row"> 
    <div class="col-lg">
        <h2>ปีงบประมาณ</h2>
    </div>
</div>
<div class="row">
    <div class="col-md">
    <table class="table table-bordered" id="">
    <thead>
         <tr>
            <th >รหัสปี</th>
            <th>ปีการประเมิน</th>
            <th >รอบที่</th>
            <th >วันที่เริ่มการประเมิน</th>
            <th >วันที่สิ้นสุดการประเมิน</th>
            <th>แก้ไข</th>
        </tr>
    </thead>
    <tbody>
    <?php  
     while(list($y_id,$y_year,$y_no,$y_start,$y_end)=mysqli_fetch_row($se_year)){
         $yearthai=$y_year+543;
         $start=DateThai($y_start);
         $end=DateThai($y_end);
       echo "<tr>";
            echo"<td class='text-center'>$y_id</td>";
            echo"<td class='text-center'>$yearthai</td>";
            echo"<td class='text-center'>$y_no</td>";
            echo"<td>$start</td>";
            echo"<td>$end</td>";
            echo"<td><a href='#'class='edit' data-ideditsub='$y_id' data-toggle='modal' ><i class='fas fa-edit fa-2x'></i></a></td>";
       echo "</tr>";
    }
?>
    </tbody>
    </table>
    </div>
</div>
<div id="loadeditsub"></div>
<?php 
    mysqli_free_result($se_year);
    mysqli_close($con);
?>


<script>
     //$('#tablebranch').DataTable();
    $(".edit").click(function( ){
        var ideditsub =$(this).data("ideditsub");
        $.post("module/assessment/edit_year.php", { id : ideditsub }).done(function(data){
        $('#loadeditsub').html(data);
        $('#editsub').modal('show');
        })
        
        
    });
       
</script>
