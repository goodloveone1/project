<?php

include("../../function/db_function.php");
$con=connect_db();

//print_r($_POST['se_id']);

//print_r($_FILES['fileimg1']);
//print_r($_FILES);

for($i=1;$i< count($_FILES);$i++){
  
$rename="fileimg".$i;
echo $_POST['text'][$i]."<br>";
$num = count($_FILES[$rename]['name']);
for($j=0;$j< $num;$j++){
    echo "name ->". $_FILES[$rename]['name'][$j]."<br>";
   
}
echo "---------------------------- <br>";
}





     

?>
