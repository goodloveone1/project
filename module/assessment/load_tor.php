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

          //  echo" NOw : $year_now<br>";
          //  echo " postID : $year";
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

       // เช็ค assid 5
      $se_ass5=mysqli_query($con,"SELECT asst5_id,accept,date_accept,inform,date_inform FROM asessment_t5 WHERE ass_id='$TOR_id'") or die("SQL-error".mysqli_error($con));
      list($asst5_id,$accept,$date_accept,$inform,$date_inform)=mysqli_fetch_row($se_ass5);
      mysqli_free_result($se_ass5);
 


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
        <td>TOR</td>
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
                echo "<b class='text-success'>ทำTORแล้ว<b>";
              }
               
            ?>
        </td>
    </tr>
    <tr>
        <td><?php echo empty($TOR_id)?"-":$TOR_id; ?></td>
        <td>ข้อตกลงการประเมิน</td>
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
                echo "<p style='color:red;'>ยังไม่สามารประเมินได้ ***ต้องทำTORก่อน</p>";
              }else{
                  if(empty($TOR_id)){
                    echo "<a href='javascript:void(0)' class='addtor'  data-year='$year' data-tor='$PER_id' title='คลิกเพื่อทำการประเมิน'>ประเมินตนเอง</a>";
                  }else{
                     //ตรวจสอบ ส่วนที่ 1-6
                     //ส่วนที่1
                     $se_asst1=mysqli_query($con,
                     "SELECT ass_id FROM asessment_t1 WHERE ass_id='$TOR_id'") or die("SQL.error-asst1".mysqli_error($con));
                     list($asst1)=mysqli_fetch_row($se_asst1);
                     mysqli_free_result($se_asst1);
                    //ส่วนที่2
                     $se_asst2=mysqli_query($con,
                     "SELECT ass_id FROM asessment_t2 WHERE ass_id='$TOR_id'") or die("SQL.error-asst1".mysqli_error($con));
                     list($asst2)=mysqli_fetch_row($se_asst2);
                     mysqli_free_result($se_asst2);
                    //ส่วนที่3
                     $se_asst3=mysqli_query($con,
                     "SELECT ass_id FROM asessment_t3 WHERE ass_id='$TOR_id'") or die("SQL.error-asst1".mysqli_error($con));
                     list($asst3)=mysqli_fetch_row($se_asst3);
                     mysqli_free_result($se_asst3);
                    //ส่วนที่4
                     $se_asst4=mysqli_query($con,
                     "SELECT ass_id FROM asessment_t4 WHERE ass_id='$TOR_id'") or die("SQL.error-asst1".mysqli_error($con));
                     list($asst4)=mysqli_fetch_row($se_asst4);
                     mysqli_free_result($se_asst4);

                     $se_asst5=mysqli_query($con,
                     "SELECT ass_id FROM asessment_t5 WHERE ass_id='$TOR_id'") or die("SQL.error-asst1".mysqli_error($con));
                     list($asst5)=mysqli_fetch_row($se_asst5);
                     mysqli_free_result($se_asst5);

                     $se_asst6=mysqli_query($con,
                     "SELECT ass_id FROM asessment_t6 WHERE ass_id='$TOR_id'") or die("SQL.error-asst1".mysqli_error($con));
                     list($asst6)=mysqli_fetch_row($se_asst6);
                     mysqli_free_result($se_asst6);

                     if(empty($asst1)){
                      echo "<p><a href='javascript:void(0)' class='asst1'  data-year='$year' data-tor='$PER_id' title='คลิกเพื่อทำการประเมิน'>ยังไม่ได้ทำ ส่วนที่1,2,3,4,5,6</a></p>";
                     }else if(empty($asst2)){
                      echo "<p><a href='javascript:void(0)' class='asst2'  data-year='$year' data-tor='$PER_id' title='คลิกเพื่อทำการประเมิน'>ยังไม่ได้ทำ ส่วนที่2,3,4,5,6</a></p>";
                     }else if(empty($asst3)){
                      echo "<p><a href='javascript:void(0)' class='asst3'  data-year='$year' data-tor='$PER_id' title='คลิกเพื่อทำการประเมิน'>ยังไม่ได้ทำ ส่วนที่3,4,5,6</a></p>";
                     }else if(empty($asst4)){
                      echo "<p><a href='javascript:void(0)' class='asst4'  data-year='$year' data-tor='$PER_id' title='คลิกเพื่อทำการประเมิน'>ยังไม่ได้ทำ ส่วนที่4,5,6</a></p>";
                     }
                     else if(empty($asst5)){
                      echo "<p><a href='javascript:void(0)' class='asst5'  data-year='$year' data-tor='$PER_id' title='คลิกเพื่อทำการประเมิน'>ยังไม่ได้ทำ ส่วนที่5,6</a></p>";
                     }else if(empty($asst6)){
                      echo "<p><a href='javascript:void(0)' class='asst6'  data-year='$year' data-tor='$PER_id' title='คลิกเพื่อทำการประเมิน'>ยังไม่ได้ทำ ส่วนที่6</a></p>";
                     }
                     else{
                      echo "<b class='text-success'>ประเมินเสร็จแล้ว<b>";
                     }
                    
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
                echo "<td><p style='color:red;'>ยังไม่สามารอัปโหลดหลักฐานได้ ***ต้องทำข้อตกลงก่อน</p></td>";
              }else{
                  if(empty($TOR_id)){
                    echo "<td><b class='text-success'><i class='fas fa-times-circle fa-2x'></i></b></td>";
                    echo "<td><p style='color:red;'>ยังไม่สามารอัปโหลดหลักฐานได้ ***ต้องทำข้อตกลงก่อน</p></td>";
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
                        echo "<td><p class='text-success'><b>อัปโหลดหลักฐานแล้วเสร็จแล้ว <b></p></td>";
                      }

                    }
                  }
              }
               
            ?>
        
        
    </tr>
    <!-- ASS 5 -->
    <tr> 
        <td> - </td>
        <td> หัวหน้าตรวจสอบการประเมิน </td>
        
        <?php
                   if($evd_status == 2){
                      if($inform == 0){
                        echo "<td><b class='text-success'><i class='far fa-clock fa-2x'></i></b></td>";
                        echo "<td> <p style='color:red;'><b>  รอหัวหน้าตรวจสอบการประเมิน </b></p></td>";
                        }else if($inform == 1){
                          echo "<td><b class='text-success'><i class='fas fa-check-circle fa-2x'></i></b></td>";
                          echo "<td><p class='text-success'><b> หัวหน้าตรวจสอบการประเมินแล้ว</b></p> </td>";
                        }
                    }else{
                      echo "<td><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i></b></td>";
                      echo "<td><p style='color:red;'>ยังไม่ได้อัปโหลดหลักฐานได้</p></td>";
                    }        
            ?>
        
        
    </tr>
    <tr> 
        <td> - </td>
        <td> รับทราบการประเมิน </td>
        <?php          
                if($evd_status == 2){
                      if($inform == 0){
                        echo "<td><b class='text-success'><i class='far fa-clock fa-2x'></i></b></td>";
                        echo "<td><p style='color:red;'><b> รอหัวหน้าตรวจสอบการประเมิน </b></p></td>";
                      }else if($inform == 1 && $accept == 0){
                          echo "<td><b class='text-success'><i class='far fa-times-circle fa-2x'></i></b></td>";
                          echo "<td><a href='javascript:void(0)' class='loadsum_assessment' title='คลิกเพื่อทำการรับทราบการประเมิน'>รับทราบการประเมิน</a></td>";
                      }else if($inform == 1 && $accept == 1){
                          echo "<td><b class='text-success'><i class='fas fa-check-circle fa-2x'></i></b></td>";
                          echo "<td><p class='text-success'><b>รับทราบการประเมินแล้ว </b></p></td>";
                      }  
                    }else{
                      echo "<td><b class='text-danger'><i class='fas fa-times-circle fa-2x'></i></b></td>";
                      echo "<td><p style='color:red;'>ยังไม่ได้อัปโหลดหลักฐานได้</p></td>";
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

  $(".loadsum_assessment").click(function(){
			//var tor_id = $(this).data("torid");
			//$("#detail").html("");
			// $.post("module/assessment/formreport_prm.php",{ torid:tor_id}).done(function(data){
			// 	sessionStorage.setItem("module1","assessment")
			// 	sessionStorage.setItem("action","formreport_prm")
			// 	$("#detail").html(data);
			// })
      sessionStorage.setItem("module1","assessment")
			sessionStorage.setItem("action","sum_assessment")
      loadingpage("assessment","sum_assessment")
	})


  



</script>