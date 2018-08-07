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
<table class ="table" id="tabldegree">
        <thead class="thead-light">
        <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">ชื่อ - นามสกุล</th>
            <th scope="col">สาขา</th>
            <th scope="col">หลักสูตร</th>
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
    mysqli_free_result($sedegree);
    mysqli_close($con);
?>
 </tbody>

</table>
<script>
     $('#tabldegree').DataTable();
  
        $("#backpage").click(function(event) {

            var module1 = $(this).data('modules');
            var action = $(this).data('action');
			loadmain(module1,action)

        })
</script>