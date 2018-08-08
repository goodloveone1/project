<?php
   
	include("../../function/db_function.php");
    $con=connect_db();
?>
<div class=" headtitle text-center p-2 row mb-2 row">
    <div class="col-sm-2" >
       <a href=#> <button type="button" class="btn btn-block" id="backpage" data-modules="assessment" data-action="Criteria_manage"><i class="fas fa-chevron-left"></i>&nbsp;ย้อนกลับ</button></a>
    </div>
    
    <div class="col-md">
        <h2>ตัวชีวัดเกณฑ์การประเมิน</h2>
    </div>
</div>
<!-- <table  class="table" id="tablebranch" >
    <thead class="thead-light">
         <tr>
            <th scope="col">ลำดับ</th>
            <th scope="col">ตำแหน่ง</th>
            <th scope="col">ภาระงาน</th>
            <th scope="col">น้ำหนัก</th>
        </tr>
    </thead>
<tbody> -->
<?php
    $sums=mysqli_query($con,"SELECT COUNT(aca_id) FROM academic")or die("sqlError".mysqli_error($con));
    list($loop)=mysqli_fetch_row($sums);


    for($i=1;$i<=$loop;$i++){
    $re=mysqli_query($con,"SELECT *FROM conditions WHERE aca_id='$i'" ) or die("errorSQLselect".mysqli_error($con));
   

    $posi=mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$i'") or die("SQLerror".mysqli_error($con));
    list($post_name)=mysqli_fetch_row($posi);

    $no=1;
    
    echo "<table  class='table' id='tablebranch' >
    <thead class='thead-light'>
         <h3>$post_name</h3>
         <tr>
            <th scope='col'>ลำดับ</th>
            <th scope='col'>ตำแหน่ง</th>
            <th scope='col'>ภาระงาน</th>
            <th scope='col'>ระดับ</th>
            <th scope='col'>เงื่อนไข</th>
            <th scope='col'>รายล่ะเอียด</th>
            <th scope='col'>แก้ไข</th>
        </tr>
    </thead>
<tbody>
";
    while(list($w_id,$aca_id,$tit,$lv,$lue,$ex)=mysqli_fetch_row($re)){
        $seac = mysqli_query($con,"SELECT aca_name FROM academic WHERE aca_id='$aca_id'" ) or die("SQL error".mysqli_error($con));
        list($aca_name)=mysqli_fetch_row($seac);
        $setit = mysqli_query($con,"SELECT e_name FROM evaluation WHERE e_id='$tit'") or die("SQL error".mysqli_error($con));
        list($tit_name)=mysqli_fetch_row($setit);
        if($lv==0){
            $lv="-";
        }
        echo"
            <tr>
                <td>$no</td>
                <td>$aca_name</td>
                <td>ด้านที่ $tit $tit_name</td>
                <td>ระดับ $lv</td>
                <td>$lue</td>
                <td>$ex</td>
                <td><a href='#'class='' data-ideditsub='$w_id' data-toggle='modal' ><i class='fas fa-edit fa-2x'></i></a></td>
            </tr>";
            
            $no++;     
    }
    
   
}
    mysqli_free_result($re);
    mysqli_free_result($sums);
    mysqli_free_result($posi);
    
    
    mysqli_close($con);
?>
 </tbody>
<div id="loadeditsub"></div>

<script>
     //$('#tablebranch').DataTable();
    $(".edit").click(function( ){
        var ideditsub =$(this).data("ideditsub");
        
        $.post("module/assessment/editwidght.php", { id : ideditsub }).done(function(data){
        $('#loadeditsub').html(data);
        $('#editsub').modal('show');
        })
        
        
        });
       

        $("#backpage").click(function(event) {

            var module1 = $(this).data('modules');
            var action = $(this).data('action');
			loadmain(module1,action)

        })

        </script>