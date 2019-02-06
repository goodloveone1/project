<?php
include("../../function/db_function.php");
$con=connect_db();
?>
<div class=" headtitle text-center p-2 row mb-2 row">
    <div class="col-sm-2">
        <a href='javascript:void(0)'><button type="button" class="btn btn-block menuuser" id="backpage" data-modules="personnel" data-action="menumanage"><i class="fas fa-chevron-left"></i>&nbsp;ย้อนกลับ</button></a>
    </div>
    <div class="col-md">
        <h2>จัดการหลักสูตร</h2>
    </div>
    <div class="col-sm-2">
        <a href='javascript:void(0)'><button type="button" class="btn btn-block btn-light" id="addbrn" data-toggle='modal'><i class="fas fa-plus"></i>&nbsp;เพื่มหลักสูตร</button></a>
    </div>
</div>
<table  class="table" id="Datatable">
    <thead class="thead-light">
        <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">หลักสูตร</th>
            <th scope="col">สาขา</th>
            <th scope="col">แก้ไข</th>
            <th scope="col">ลบ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result=mysqli_query ($con,"SELECT  br_id,br_name,dept_id FROM branchs") or die ("error1".mysqli_error($con));
        $i=1;
        while(list($subject_id,$subject_name,$branch)=mysqli_fetch_row($result)){
        $branch=mysqli_query($con,"SELECT dept_name FROM departments WHERE dept_id='$branch'") or die ("errorDept".mysqli_error($con));
        list($branch_name)=mysqli_fetch_row($branch);
        echo"
        <tr>
            <td>$i<ttd>
                <td>$subject_name<ttd>
                    <td> $branch_name</td>
                    <td><a href='javascript:void(0)'class='editbrn' data-ideditsub='$subject_id'><i class='fas fa-edit fa-2x'></i></a></td>
                    <td><a href='javascript:void(0)'data-branchname='$subject_name' data-ideditsub='$subject_id' class='delbrn'><i class='fas fa-trash-alt fa-2x'></i></a></td>
                </tr>";
                mysqli_free_result($branch);

                $i++;
                }
                mysqli_free_result($result);

                ?>
            </tbody>
        </table>
        <?php
        mysqli_close($con);
        ?>


</table>



<div id="loadeditsub"></div>
<div id="loadaddsub"></div>


<script>


    $.getScript('js/mydatatable.js');

         $("#Datatable").on('click', '.editbrn', function(event) {
        var ideditsub =$(this).data("ideditsub");

        $.post("module/personnel/editbranch.php", { id : ideditsub }).done(function(data){
        $('#loadeditsub').html(data);
        $('#editsub').modal('show');
        })


        });

        $("#Datatable").on('click', '.delbrn', function(event) {
            var ideditsub =$(this).data("ideditsub");
            var branchname =$(this).data("branchname");
            var r = confirm("คณต้องการลบหลักสูตร "+branchname+" ใช่ไหม?");
            if (r == true) {
                $.post( "module/personnel/delbranch.php", {id : ideditsub}).done(function(data,txtstuta){
                    var module1 = sessionStorage.getItem("module1");
                    var action = sessionStorage.getItem("action");
                    loadmain(module1,action);
                    })
            }
        })





       $("#addbrn").click(function( ){
            $('#loadaddsub').load("module/personnel/addbranch.php",function(){
                $('#addsub').modal('show');
            });
         });



        </script>
