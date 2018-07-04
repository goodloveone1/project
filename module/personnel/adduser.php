<?php

include("../../function/db_function.php");
$con=connect_db();

// echo $_POST['titlename']." ==> ";
// echo $_POST['fname']." ==> ";
// echo $_POST['lname']." ==> ";
// echo $_POST['codeid']." ==> ";
// echo $_POST['pos']." ==> ";
// echo $_POST['ap']." ==> ";
// echo $_POST['brn']." ==> ";
// echo $_POST['suj']." ==> ";
// echo $_POST['startwork']." ==> ";
// echo $_POST['salary']." ==> ";
// echo $_POST['uname']." ==> ";
// echo $_POST['passwd']." ==> ";
// echo $_POST['permiss']." ==> ";

/*
echo $_POST['degn1']." ==> ";
echo $_POST['degaddes1']." ==> ";
echo $_POST['degn2']." ==> ";
echo $_POST['degaddes2']." ==> ";
echo $_POST['degn3']." ==> ";
echo $_POST['degaddes3']." ==> ";
*/


$sql = "INSERT INTO general VALUES ('','".$_POST['uname']."','".$_POST['passwd']."','".$_POST['brn']."','".$_POST['suj']."','".$_POST['codeid']."','".$_POST['titlename']."','".$_POST['fname']."','".$_POST['lname']."','".$_POST['salary']."','".$_POST['ap']."','','".$_POST['startwork']."','".$_POST['permiss']."','".$_POST['pos']."','')";


mysqli_query($con,$sql ) or  die ("mysql error=>>".mysql_error($con));
    mysqli_close($con);


?>


     