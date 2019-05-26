<?php
   
    include("../../function/db_function.php");
    include("../../function/fc_time.php");
    $con=connect_db();

    $se_year=mysqli_query($con,"SELECT *FROM years")or die("SQL.error".mysqli_error($con));
   
?>
<form>
<div class=" headtitle text-center p-2 row mb-2 row"> 
    <div class="col-lg">
        <h2>ปีงบประมาณ</h2>
    </div>
    <div class="col-md-3" style="display: block;">
         <button type="button"  class="addyear btn btn-block bg-white text-center" data-modules='personnel' data-action='formuser'><i class="fas fa-plus"></i> เพิ่มปีงบประมาณ </button>
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
            <th >วันที่เริ่ม</th>
            <th >วันที่สิ้นสุด</th>
            <th>แก้ไข</th>
            <th>ลบ</th>
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
            echo"<td><a href='javascript:void(0)'  class='del' data-iduser='$y_id' data-nuser='ปี$yearthai รอบที่ $y_no'><i class='fa fa-trash fa-2x'</i></a></td>";
       echo "</tr>";
    }
?>
    </tbody>
    </table>
    </div>
</div>
</form>
<div id="loadeditsub"></div>
<div id="addyear"></div>
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
    $(".del").click(function(){   /// ป่มลบข้อมูล 
        var iduser =$(this).data("iduser");
        var nuser =$(this).data("nuser");
       // var r = confirm("ต้องการลบ "+nuser+" ใช่หรือไม่?");
       swal({
            title: "ต้องการลบ "+nuser+" ใช่หรือไม่?",
            text: "เมื่อลบไปแล้วจะไม่สามารถกู้คืนได้!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            buttons:["ยกเลิก","ตกลง"],
        })
        .then((willDelete) => {
            if (willDelete) {
                $.post( "module/assessment/delete_year.php", {id : iduser}).done(function(data,txtstuta){
                //alert(data);
                var module1 = sessionStorage.getItem("module1");
                var action = sessionStorage.getItem("action");
                loadmain(module1,action);
            })
            swal("บันทึกสำเร็จ!", {
									icon: "success",
									buttons: false,
									timer: 1000,
								});
            } else {
               // swal("Your imaginary file is safe!");
            }
        });
            
        
    })
    $(".addyear").click(function(){
        $.post("module/assessment/add_year.php").done(function(data){
        $('#loadeditsub').html(data);
        $('#editsub').modal('show');
        }) 

    })
       
</script>
