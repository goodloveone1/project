<?php

	include("../../function/db_function.php");
    $con=connect_db();
?>
<div class=" headtitle text-center p-2 row mb-2 row">
    <div class="col-md-2" >
       <!-- <a href=#> <button type="button" class="btn btn-block menuuser" id="backpage" data-modules="assessment" data-action="Criteria_manage_tor1"><i class="fas fa-chevron-left"></i>&nbsp;ย้อนกลับ</button></a> -->
    </div>

    <div class="col-md">
        <h2>ตัวชีวัด / เกณฑ์การประเมิน</h2>
    </div>
    <div class="col-md-2" ></div>

</div>

<?php
    $se_acaCon=mysqli_query($con,
    "SELECT DISTINCT conditions.aca_id,academic.aca_name
    FROM conditions
    INNER JOIN academic
    ON academic.aca_id=conditions.aca_id")or die("sqlError".mysqli_error($con));
    while(list($aca_id,$aca_name)=mysqli_fetch_row($se_acaCon)){

    $re=mysqli_query($con,"SELECT * FROM conditions WHERE aca_id='$aca_id' GROUP BY e_name" ) or die("errorSQLselect".mysqli_error($con));

    $no=1;

      echo "<table  class='table table-bordered' id='tablebranch' >
    <thead>
         <p style='color:blue;'>$aca_name</p>
         <tr>
            
            <th scope='col'>ภาระงาน</th>
            <th>เกณฑ์การประเมิน</th>
            <th scope='col'>แก้ไข</th>
        </tr>
    </thead>
<tbody>
";
    while(list($con_id,$aca_id,$tit,$lv,$lue,$ex)=mysqli_fetch_row($re)){
       // echo "<p>$tit</p>";
    
        $setit = mysqli_query($con,"SELECT e_name FROM evaluation WHERE e_id='$tit'") or die("SQL error".mysqli_error($con));
        list($tit_name)=mysqli_fetch_row($setit);
        mysqli_free_result($setit);
        if($lv==0){
            $lv="-";
        }
        ?>
            <tr>
                <td><?php echo " $tit_name"?></td>
                <td>
                    <?php  
                        $se_ex=mysqli_query($con,"SELECT con_ex FROM conditions WHERE e_name='$tit' AND aca_id='$aca_id'")or die("SQL.error".mysqli_error($con));
                        while(list($ex)=mysqli_fetch_row($se_ex)){
                        
                        echo "<p>$ex</p>";
                        echo "<hr>";
                        }
                        mysqli_free_result($se_ex);
                    ?>
                </td>
                <td><a href='#'class='edit' data-ideditsub='<?php echo $aca_id ?>' data-idename='<?php echo $tit ?>' data-toggle='modal' ><i class='fas fa-edit fa-2x'></i></a></td>
            </tr>

<?php      $no++;
    }
   echo " </tbody>" ;
   echo " </table>" ;

}
    mysqli_free_result($re);
    mysqli_free_result($se_acaCon);


    mysqli_close($con);
?>

<div id="loadeditsub"></div>

<script>
     //$('#tablebranch').DataTable();
    $(".edit").click(function( ){
        var ideditsub =$(this).data("ideditsub");
        var eid =$(this).data("idename");

        $.post("module/assessment/editevaluation.php", { id : ideditsub,id2 : eid }).done(function(data){
        $('#loadeditsub').html(data);
        $('#editsub').modal('show');
        })

        });

</script>
