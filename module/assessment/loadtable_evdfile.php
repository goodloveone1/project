

<table class="table tableevdfile" id="Datatable">
                        <thead>
                            <tr>
                            <th scope="col">ลำดับ</th>
                            <th >ชื่อไฟล์</th>
                            <th >ประเภทไฟล์</th>
                            <th >ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        include("../../function/db_function.php");
                        $con=connect_db();

                        //echo $_POST['torid']."<br>".$_POST['seid']."<br>".$_POST['evdid'];


                        $torid = $_POST['torid'];
                        $sql = "SELECT evd_file_id,evd_file_name,evd_name_thai FROM evidence_file WHERE se_id='$_POST[seid]' AND evd_id='$_POST[evdid]' ";
                        $evd_file =  mysqli_query($con,$sql) or  die("SQL Error1==>1".mysqli_error($con));
                        $i=1;
                        while(list($evd_file_id,$evd_file_name,$evd_name_thai) = mysqli_fetch_row($evd_file)){ 
                            $url = "file/$torid/$evd_file_name";
                        ?>
                            <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo "<a href='$url' target='_blank'> $evd_name_thai </a>"; ?></td>
                            <td><?php echo pathinfo($url,PATHINFO_EXTENSION)?></td>
                            <td > <a href="javascript:void(0)" class='text-danger filedel' data-evdfileid='<?php echo $evd_file_id ?>' data-url='<?php echo $url ?>'><b><i class="fas fa-trash fa-lg"></i><br> ลบ </br></a></td>
                            </tr>
                        <?php
                        $i++;
                        } // END WHILE
                        mysqli_close($con);
                        ?>
                        </tbody>
</table>

<script type="text/javascript">

$(document).ready(function() {
    $.getScript('js/mydatatable.js');

    $(".tableevdfile").on("click",".filedel",function(){
         var r = confirm("คุณต้องลบไฟล์ใช่หรือไหม?");
         if (r == true) {
        $.post("module/assessment/del_evd_file.php", { evdidfile : $(this).data("evdfileid") ,url: $(this).data("url") }).done(function(data){
           //alert(data);
           alert("ลบไฟล์สำเร็จแล้ว");
           loadtablefile(<?php echo $_POST['torid'] ?>,<?php echo $_POST['seid'] ?>,<?php echo $_POST['evdid'] ?>)
        })
        }
    })

    function loadtablefile(torids,seids,evdids){

    $.post("module/assessment/loadtable_evdfile.php", { evdid : evdids ,seid : seids ,torid: torids }).done(function(data){
            ////alert(data)
            $('#tablefile').html(data);
            
        })
        }



});