<div class='row p-2 headtitle mb-3'>
        <div class='col-md text-center'><h3  class="h3">ภาระงานขั้นต่ำ</h3> </div> 
</div>
<div class="row">
    <div class="col-md"> 
<?php  
	include("../../function/db_function.php");
    $con=connect_db();
    
    $se_acaid=mysqli_query($con,
    "SELECT distinct work_hour.aca_id,academic.aca_name
    FROM work_hour
    INNER JOIN academic
    ON work_hour.aca_id=academic.aca_id
    ")or die("SQL-error.se_acaid".mysqli_error($con));
    while(list($ACA_ID,$aca_name)=mysqli_fetch_row($se_acaid)){

    $se_hour = mysqli_query($con,
    "SELECT work_hour.hw_id,work_hour.aca_id,evaluation.e_name,work_hour.min_hour
    FROM work_hour
    INNER JOIN evaluation
    ON work_hour.e_id=evaluation.e_id  
    WHERE work_hour.aca_id='$ACA_ID'
    ORDER BY work_hour.aca_id ASC")
   or die("SQL.se_hourError".mysqli_error($con));  
?>
<br>
<p style="color:blue;"><b><?php echo $aca_name ?></b></p>
<table class="table table-bordered">
<thead>
    <tr>
        <th>ภาระงาน/กิจกรรม / โครงการ / งาน</th>
        <th>ภาระงานขั้นต่ำ</th>
        <th>แก้ไข</th>
    </tr>
</thead>
<tbody>
<?php 
    while(list($hw_id,$aca_id,$e_name,$min_hour)=mysqli_fetch_row($se_hour)){
        echo "<tr>";
            echo"<td>$e_name</td>";
            echo"<td>$min_hour</td>";
            echo"<td><a href='#' class='edit' data-ideditsub='$hw_id' data-toggle='modal' ><i class='fas fa-edit fa-2x'></i></a></td>";
        echo "</tr>";
    }

?>
</tbody>
<div id="loadeditsub"></div>
</table>
    <?php  }  ?>
 

    </div>
</div>
<script>
     //$('#tablebranch').DataTable();
    $(".edit").click(function( ){
        var ideditsub =$(this).data("ideditsub");
        
        $.post("module/assessment/editwidght.php", { id : ideditsub }).done(function(data){
        $('#loadeditsub').html(data);
            $('#editsub').modal('show');
        })    
    });   
 </script>
