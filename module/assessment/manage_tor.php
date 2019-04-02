<?php
  session_start();
  include("../../function/db_function.php");
  include("../../function/fc_time.php");
$con=connect_db();
 ?>
<div class="row  p-2 headtitle">
	<h4 class="text-center col-md ">การประเมิน </h4>
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
          $sY_No=mysqli_query($con,"SELECT y_id,y_no,y_start,y_end FROM years WHERE  y_id='$yNow'")or die(mysqli_error($con));
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
<!-- <div class="col-md  ">
    <button type='button' class="btn btn-block btn-success" id="btnOk"> ตกลง </button>
</div> -->
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
        url: "module/assessment/load_tor.php",
        data:{year:years},
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
