<?php
  session_start();
  include("../../function/db_function.php");
  include("../../function/fc_time.php");
$con=connect_db();
 ?>
<div class="row  p-2 headtitle">
	<h4 class="text-center col-md "> ผลการประเมินของบุคลากรทั้งหมดในคณะ </h4>
</div>
<br>

<div class="row text-center" >
  <div class="col-md "> <!--ประจำปี งบประมาณ -->

  <div class="form-group row">
    <label for="" class="col-sm col-form-label">ประจำปี งบประมาณ</label>
    <div class="col-sm-6">
      <input type="hidden" name="gg" value="hidden" >
      <select id="inputState" class="form-control" name="year">
      <?php
      $sYears=mysqli_query($con,"SELECT  y_no,y_year,y_id FROM years")or die(mysqli_error($con));
      while(list($y_no,$y_year,$y_id)=mysqli_fetch_row($sYears)){
        $y_thai=$y_year+543;
       // $yy=DATE('Y');

        $select=chk_idtest()==$y_id?"selected":"";
        echo"<option value='$y_id' $select>$y_no/$y_thai</option>";
      }
      mysqli_free_result($sYears);
    ?>
      </select>
    </div>
  </div>
</div>
<div class="col-md  ">

    <!-- <div class="form-check col-sm-1">
      <input type="checkbox"  class="form-check-input" id="" value="">
    </div> -->
    <div class="form-group  row">
      <!-- <label for="inputState" class="col-sm">รอบที่  ๑  (๑ ต.ค.</label> -->
      <div class="col-md">
        <select id="inputNo" class="form-control" name="a_no" disabled>
        <?php
          $yNow=chk_idtest();
          $sY_No=mysqli_query($con,"SELECT y_id,y_no,y_start,y_end FROM years WHERE y_id='$yNow'")or die(mysqli_error($con));
          while(list($y_id,$y_no,$y_s,$y_e)=mysqli_fetch_row($sY_No)){
            
            $seNO=$yNow==$y_id?"selected":"";
            echo "<option value='$y_id' $seNO>รอบที่ $y_no  (", DateThai($y_s)," - ",DateThai($y_e),")</option>";
          }
          mysqli_free_result($sY_No);
        ?>
        </select>
      </div>
    </div>
</div>

</div>

<div class='row'>
  <div class='col-5'> 
    <div class="form-group row">
      <label for="inputPassword" class="col-sm-3 col-form-label">เลือกแบบ</label>
      <div class="col-sm-9">
        <select class="form-control" id="choose">
        <option value='0'>ทั้งหมด</option>
        <option value='1'>หลักสูตร</option>
        <option value='2'>สาขา</option>
      </select>
      </div>
    </div>
  </div>


  <div class='col' id='brh' style='display:none'> 
    <div class="form-group row">
      <label for="inputPassword" class="col-sm-2 col-form-label">หลักสูตร</label>
      <div class="col-sm-10">
        <select class="form-control" id="brsel">
        <?php
           $br=mysqli_query($con,"SELECT br_id,br_name FROM branchs")or die(mysqli_error($con));
           while(list($br_id,$br_name)=mysqli_fetch_row($br)){
             echo "<option value='$br_id'>$br_name</option>";
           }
        ?>
       
      </select>
      </div>
    </div>
  </div>

   <div class='col' id='dph' style='display:none'> 
    <div class="form-group row">
      <label for="inputPassword" class="col-sm-2 col-form-label">สาขา</label>
      <div class="col-sm-10">
        <select class="form-control" id="dpsel">
        <?php
           $dp=mysqli_query($con,"SELECT dept_id,dept_name FROM departments")or die(mysqli_error($con));
           while(list($dept_id,$dept_name)=mysqli_fetch_row($dp)){
             echo "<option value='$dept_id'>$dept_name</option>";
           }
        ?>
       
      </select>
      </div>
    </div>
  </div>    
       
</div>

<div class="col-auto" id='loaddataInasm'></div>

<div class="row" id='loadging' style='display: none;'>
      <img class='mx-auto' id='img' src='img/loading.svg'>
</div>



<?php
mysqli_close($con);
?>
<script type="text/javascript">
$(document).ready(function() {

  $.getScript('js/mydatatable.js')

  $("#inputState").change(function(){
    var years=$(this,"option:selected").val()
  //  alert(years)
   $.post("module/assessment/loaddatayear.php",{year:years},
    function (data, textStatus, jqXHR) {
     // alert(data)
     $("#inputNo").html(data)
     loadsunass()
    }
   );
   
  })

  loadsunass() // โหลดครั้งแรก

    function loadsunass(){
      var years = $("#inputNo").val();

      $("#loaddataInasm").html("")
      $("#loadging").css('display','')

      $.ajax({
        url: "module/report/reportstaffall.php",
        data:{year:years},
        type: "POST"
      }).done(function(data){

        setTimeout(function(){ 
          $("#loadging").css('display','none');
          $("#loaddataInasm").html(data)
        
        }, 2000);

      })
   
    }

    $("#choose").change(function(){
      var ch = $(this).val();
      if(ch==1){
        $("#brh").css("display","");
        $("#dph").css("display","none");
        loadsunassbr($("#brsel").val())
      }
      else if(ch==2){
        $("#brh").css("display","none");
        $("#dph").css("display","");
        loadsunassdp($("#dpsel").val())
      }else{
        $("#brh").css("display","none");
        $("#dph").css("display","none");
        loadsunass();
      }
    })

    $("#brsel").change(function(){
        loadsunassbr($(this).val())
    })

    $("#dpsel").change(function(){
        loadsunassdp($(this).val())
    })

    function loadsunassbr(braid){
      var years = $("#inputNo").val();

      $("#loaddataInasm").html("")
      $("#loadging").css('display','')

      $.ajax({
        url: "module/report/reportstaffall.php",
        data:{year:years, brid:braid},
        type: "POST"
      }).done(function(data){

        setTimeout(function(){ 
          $("#loadging").css('display','none');
          $("#loaddataInasm").html(data)
        
        }, 2000);

      })
   
    }

    function loadsunassdp(dpmid){
      var years = $("#inputNo").val();

      $("#loaddataInasm").html("")
      $("#loadging").css('display','')

      $.ajax({
        url: "module/report/reportstaffall.php",
        data:{year:years, dpid:dpmid},
        type: "POST"
      }).done(function(data){

        setTimeout(function(){ 
          $("#loadging").css('display','none');
          $("#loaddataInasm").html(data)
        
        }, 2000);

      })
   
    }


  }) // document ready

</script>
