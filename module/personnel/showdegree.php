<?php
	include("../../function/db_function.php");
    $con=connect_db(); 
    if(empty($_POST['id'])){
        $sedegree = "";
    }else{
        $sedegree=mysqli_query($con,"SELECT *FROM education WHERE degree_id ='$_POST[id]'") or die("errorSQLselect".mysqli_error($con));
    }
   
?>



 <div class="modal fade" id="showdegree" tabindex="-1" role="dialog" aria-labelledby="editsub" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">รายชื่อ ฒิการศึกษา </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <div class="form-group">
                    <table class ="table" id="tabldegree">
                        <thead class="thead-light">
                             <tr>
                                <th scope="col">ลำดับ</th>
                                <th scope="col">ชื่อ - นามสกุล</th>
                                <th scope="col">แก้ไข</th>
                                <th scope="col">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
   
    $no=1;
    while(list($ed_id,$gen_id,$ed_name,$ed_loc,$id_degree)=mysqli_fetch_row($sedegree)){
        $re_genname = mysqli_query($con,"SELECT  gen_prefix,gen_fname,gen_lname,branch_id,subject_id FROM general WHERE gen_id = '$gen_id'") or die("SQL_Error".mysqli_error($con));
        list($gen_prefix,$gen_fname,$gen_lname,$branch_id,$subject_id)=mysqli_fetch_row($re_genname);
        $br = mysqli_query($con,"SELECT branch_name FROM branch WHERE branch_id='$branch_id'") or die("SQL_Error".mysqli_error($con));
        list($branch_name)=mysqli_fetch_row($br);
        echo"
            <tr>
                <td>$no</td>
                <td>$gen_prefix $gen_fname $gen_lname</td>
                <td>$branch_name</td>
                <td>$subject_id</td>
            </tr>";
            $no++;
    }
    ?>
                        </tbody>

                    </table>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>
    </div>


    <?php
        
        mysqli_free_result($sedegree);
        mysqli_close($con);

    ?>


<script type="text/javascript">
$('#tabldegree').DataTable();
$("#updatesu").click(function(event) {
    var r = confirm("Press a button!");
    if (r == true) {
        $.post( "module/personnel/updatedegree.php", $( "#foreditbrc" ).serialize()).done(function(data,txtstuta){
              alert(data);
              
         });
        $('#showdegree').modal("hide");

        
       
        
    } 

   
});
</script>