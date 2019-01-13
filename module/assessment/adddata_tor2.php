
<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

// $tit_sub=$_POST['stit0'];
// echo $tit_sub;

$st="stit";
for($i=0;$i<14;$i++){
    $tit_sub=$st.$i;
    echo $_POST[$tit_sub];
}

?>


