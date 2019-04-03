<?php
include("../../function/db_function.php");
$con=connect_db();
$id=$_POST['id'];
$condition=$_POST['condition'];
$lv=$_POST['level'];
$disc=$_POST['disc'];

$max=count($lv);
for($i=0;$i<$max;$i++){
   $sql=
   "UPDATE conditions 
    SET con_level ='$lv[$i]',con_con='$condition[$i]',con_ex='$disc[$i]' 
    WHERE con_id ='$id[$i]'";
    //echo $sql;
    mysqli_query($con,$sql);
}
 mysqli_close($con);
?>