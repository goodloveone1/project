<?php  
session_start();
include("../../function/db_function.php");
include("../../function/fc_time.php"); 
$con=connect_db();
unset($_SESSION['yearIdpost']);
unset($_SESSION['pre_id']);

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

       // เช็ค EVD
       $se_EVD=mysqli_query($con,"SELECT evd_id,evd_status FROM evidence WHERE st_id='$_SESSION[user_id]' AND ass_id='$TOR_id'") or die("SQL-error".mysqli_error($con));
       list($evd_id,$evd_status)=mysqli_fetch_row($se_EVD);
       mysqli_free_result($se_EVD);
 


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
        <td><?php echo empty($PER_id)?"-":$PER_id;  ?></td>
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
                echo "<b class='text-success'>ทำข้อตกลงแล้ว<b>";
              }
               
            ?>
        </td>
    </tr>
    <tr>
        <td><?php echo empty($TOR_id)?"-":$TOR_id; ?></td>
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
                    echo "<b class='text-success'>ประเมินเสร็จแล้ว<b>";
                  }
              }
               
            ?>
        </td>
    </tr>
    <!-- EVD -->
    <tr> 
        <td><?php echo  empty($evd_id)?"-":$evd_id; ?></td>
        <td>หลักฐาน</td>
        
        <?php
              if(empty($PER_id)){
                echo "<td><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i></b></td>";
                echo "<td><p style='color:red;'>ยังไม่สามารอัปโหลดหลักฐานได้ ***ต้องทำ TOR ก่อน</p></td>";
              }else{
                  if(empty($TOR_id)){
                    echo "<td><b class='text-success'><i class='fas fa-times-circle fa-2x'></i></b></td>";
                    echo "<td><p style='color:red;'>ยังไม่สามารอัปโหลดหลักฐานได้ ***ต้องทำ TOR ก่อน</p></td>";
                  }else{

                    if(empty($evd_id)){
                      echo "<td><b class='text-success'><i class='fas fa-times-circle fa-2x'></i></b></td>";
                      echo "<td><a href='javascript:void(0)' class='addevd'  data-torid='$TOR_id' title='คลิกเพื่อทำการอัปโหลดหลักฐาน'>อัปโหลดหลักฐาน</a></td>";
                    }else{
                      if($evd_status ==1){
                        echo "<td><b class='text-success'><i class='far fa-clock fa-2x'></i></b></td>";
                        echo "<td><a href='javascript:void(0)' class='addevd'  data-torid='$TOR_id' title='คลิกเพื่อทำการตรวจสอบหลักฐาน'>ตรวจสอบหลักฐาน</a></td>";
                      }else if($evd_status ==2){
                        echo "<td><b class='text-success'><i class='fas fa-check-circle fa-2x'></i></b></td>";
                        echo "<td>อัปโหลดหลักฐานแล้วเสร็จแล้ว</td>";
                      }
                      
                    }
                  }
              }
               
            ?>
        
        
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

$(".addevd").click(function(){
			var tor_id = $(this).data("torid");
			//$("#detail").html("");
			// $.post("module/assessment/formreport_prm.php",{ torid:tor_id}).done(function(data){
			// 	sessionStorage.setItem("module1","assessment")
			// 	sessionStorage.setItem("action","formreport_prm")
			// 	$("#detail").html(data);
			// })
      sessionStorage.setItem("module1","assessment")
			sessionStorage.setItem("action","manage_Evidence")
      loadingpage("assessment","manage_Evidence")
	})



</script>