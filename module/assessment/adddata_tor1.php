<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

$scwei=$_POST['scwei'];  


for($i=0;$i<5;$i++){
    $no=$i+1;
 echo  $no,":",$scwei[$i],"/";
}


?>