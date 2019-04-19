<?php

	include("../../function/db_function.php");
    $con=connect_db();
?>
<div class=" headtitle text-center p-2 row mb-2 row">
    <div class="col-md-3" >
       <!-- <a href="javascript:void(0)"> <button type="button" class="btn btn-block menuuser" id="backpage" data-modules="personnel" data-action="menumanage"><i class="fas fa-chevron-left"></i>&nbsp;ย้อนกลับ</button></a> -->
    </div>
    <div class="col-md">
        <h2>จัดการวุฒิการศึกษา</h2>
    </div>
    <div class="col-md-3">
        <a href="javascript:void(0)"><button type="button" class="btn btn-block btn-light" id="addbrn" ><i class="fas fa-plus"></i>&nbsp;เพิ่มวุฒิการศึกษา</button></a>
    </div>
</div>
<table  class="table" id="Datatable" >
    <thead class="thead-light">
         <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">วุฒการศึกษา</th>
            <th scope="col">แก้ไข</th>
            <th scope="col">ลบ</th>
        </tr>
    </thead>
<tbody>
<?php
    $sedegree=mysqli_query($con,"SELECT *FROM degree") or die("errorSQLselect".mysqli_error($con));
    $no=1;
    while(list($D_id,$D_name)=mysqli_fetch_row($sedegree)){

        echo"
            <tr>
                <td>$no</td>
                <td><a href='javascript:void(0)' class ='showdegree' data-iddegree='$D_id'>$D_name</a></td>
                <td><a href='javascript:void(0)'class='editbrn' data-ideditsub='$D_id' data-toggle='modal' ><i class='fas fa-edit fa-2x'></i></a></td>
                <td><a href='javascript:void(0)' class='delbrn' data-branchname='$D_name' data-ideditsub='$D_id'><i class='fas fa-trash-alt fa-2x'></i></a></td>
            </tr>";
            $no++;
    }
    mysqli_free_result($sedegree);
    mysqli_close($con);
?>
 </tbody>
<div id="loadeditsub"></div>
<div id="loadaddsub"></div>
<div id="showdegree"></div>
</table>
<script>

     $.getScript('js/mydatatable.js');


    $("#Datatable").on('click', '.editbrn', function(event) {
        var ideditsub =$(this).data("ideditsub");

        $.post("module/personnel/editdegree.php", { id : ideditsub }).done(function(data){
            $('#loadeditsub').html(data);
            $('#editde').modal('show');
            })
        });

       $("#Datatable").on('click', '.delbrn', function(event) {

            var ideditsub =$(this).data("ideditsub");
            var branchname =$(this).data("branchname");

            var r = confirm("ต้องการลบวุฒิ "+branchname+" ใช่หรือไม่?");
            if (r == true) {

                $.post( "module/personnel/deletedegree.php", {id : ideditsub}).done(function(data,txtstuta){
                    var module1 = sessionStorage.getItem("module1");
                    var action = sessionStorage.getItem("action");
                   // alert(data);
                    loadmain(module1,action);
                    })
            }
        })

        $("#addbrn").click(function(e){
            e.preventDefault()
            $('#loadaddsub').load("module/personnel/adddegree.php",function(){
                $('#addsub').modal('show');

                });
             });

        $(".showdegree").click(function(event) {
             var iddegree =$(this).data("iddegree");
             $.post("module/personnel/showdegree.php", { id : iddegree}).done(function(data){
                $('#loadeditsub').html(data);
                $('#showdegree').modal('show');
            })

        });

        </script>
