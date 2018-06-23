<?php
include("../../function/db_function.php");
$con=connect_db();
?>
<div class="col-md headtitle text-center p-2 row mb-2">
    <div class="col-sm-2">
        <button type="button" class="btn" id="backpage" data-modules="personnel" data-action="menumanage">ย้อนกลับ</button>
    </div>
    <div class="col-sm-2">
        <button type="button" class="btn" id="addbrn" data-toggle='modal'>เพื่มหลักสูตร</button>
    </div>
    <div class="col-md">
        <h2>จัดการหลักสูตร</h2>
    </div>
</div>
<table  class="table">
    <thead class="thead-light">
        <tr>
            <td>ลำดับ</td>
            <td>หลักสูตร</td>
            <td>สาขา</td>
            <td>แก้ไข</td>
            <td>ลบ</td>
        </tr>
    </thead>
    <tbody>
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
                    <td><a href='#'class='editbrn' data-ideditsub='$subject_id' data-toggle='modal'><i class='fas fa-edit fa-2x'></i></a></td>
                    <td><a href='#' data-ideditsub='$subject_id' class='delbrn'><i class='fas fa-trash-alt fa-2x'></i></a></td>
                </tr>";
<<<<<<< HEAD

                $i++;
                }
                mysqli_free_result($result);
                
                ?>
            </tbody>
        </table>
        <?php
        mysqli_close($con);
        ?>
            
=======
        $i++;
    }
    mysqli_free_result($result);
  
?>
>>>>>>> e7dae0d66eb38cdfdbc87f0834e82c636a63c497
</table>



<div id="loadeditsub"></div> 
<div id="loadaddsub"></div>     


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

        $("#backpage").click(function(event) {

            var module1 = $(this).data('modules');
            var action = $(this).data('action');
             
            $('#detail').animateCss('fadeOut' , function() { /* ANIMATION USE */
                loadmain(module1,action)
            });
        })

        $("#addbrn").click(function( ){

        $('#loadaddsub').load("module/personnel/addbranch.php",function(){
              $('#addsub').modal('show');     
        });
      
        
        });
       
         
       
        </script>