<?php  
session_start();
include("../../function/db_function.php");
include("../../function/fc_time.php"); 
$con=connect_db();
?>
<div class="row">
    <div class="col-md">
        <?php
            $year = $_POST['year'];
            $year_now=chk_idtest();
      // เช็ค PRE
            $se_PRE=mysqli_query($con,"SELECT  ass_id FROM assessments WHERE staff='$_SESSION[user_id]'AND year_id='$year' AND ass_id LIKE'PRE%'") or die("SQL-error".mysqli_error($con));
            list($PER_id)=mysqli_fetch_row($se_PRE);
            mysqli_free_result($se_PRE);

      // เช็ค TOR
          $se_TOR=mysqli_query($con,"SELECT  ass_id FROM assessments WHERE staff='$_SESSION[user_id]'AND year_id='$year' AND ass_id LIKE'TOR%'") or die("SQL-error".mysqli_error($con));
          list($TOR_id)=mysqli_fetch_row($se_TOR);
          mysqli_free_result($se_TOR);


          if($year==$year_now){
              // echo $year,$year_now;
        ?>       
            <table class="table table-border col-md" >
  <thead>
    <tr>
      <th>รหัส </th>
      <th>แบบฟอร์ม </th>
      <th>สถานะ</th>
      <th>หมายเหตุ</th>
    </tr>
  <thead>
  <tbody>
    <tr>
        <td><?php echo $PER_id  ?></td>
        <td>ข้อตกลง</td>
        <td>
        <?php
              if(empty($PER_id)){
                echo  "<b class='text-danger'><i class='fas fa-times-circle fa-2x'></i></b>";
              }else{
                echo "<b class='text-success'><i class='fas fa-check-circle fa-2x'></i></b>";
              }
               
            ?>
        </td>
        <td>
            <?php
              if(empty($PER_id)){
                echo  "<a href='javascript:void(0)' class='addpre'  data-year='$year' title='คลิกเพื่อกรอกข้อมูล'>ยังไม่มีข้อมูล </a>";
              }else{
                echo "ทำข้อตกลงแล้ว";
              }
               
            ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $TOR_id ?></td>
        <td>TOR</td>
        <td>
        <?php
              if(empty($PER_id)){
                echo "<b class='text-danger'><i class='fas fa-times-circle fa-2x'></i></b>";
              }else{
                  if(empty($TOR_id)){
                    echo "<b class='text-success'><i class='fas fa-times-circle fa-2x'></i></b>";
                  }else{
                    echo "<b class='text-success'><i class='fas fa-check-circle fa-2x'></i></b>";
                  }
              }
               
            ?>
        </td>
        <td>
        <?php
              if(empty($PER_id)){
                echo "<p style='color:red;'>ยังไม่สามารประเมินได้ ***ต้องทำข้อตกลงก่อน</p>";
              }else{
                  if(empty($TOR_id)){
                    echo "<a href='javascript:void(0)' class='addtor'  data-year='$year' data-tor='$PER_id' title='คลิกเพื่อทำการประเมิน'>ประเมินตนเอง</a>";
                  }else{
                    echo "ประเมินเสร็จแล้ว";
                  }
              }
               
            ?>
        </td>
    </tr>
  </tbody>
        <?php        
          }else if($year<$year_now){
            echo "<p align='center' style='color:red;'>***หมดเวลาประเมินแล้ว กรุณาตรวจสอบปีการประเมิน</p>";
          }else{
            echo "<p align='center' style='color:blue;'>***ยังไม่ถึงเวลาประเมิน กรุณาตรวจสอบปีการประเมิน</p>";
          }



        ?>
    </div>
</div>


<script>
    $(".addpre").click(function(){
        var year_id = $(this).data("year");

        $.ajax({
            url: "module/assessment/test_tor_stepBystep.php",
            data:{year:year_id},
            type: "POST"
        }).done(function(data){
        $("#detail").html(data);
    })
})

$(".addtor").click(function(){
        var year_id = $(this).data("year");
        var tor_id = $(this).data("tor");

        $.ajax({
            url: "module/assessment/ass_form.php",
            data:{year:year_id,tor:tor_id},
            type: "POST"
        }).done(function(data){
        $("#detail").html(data);
    })
})



</script>