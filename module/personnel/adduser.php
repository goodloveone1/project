<?php

include("../../function/db_function.php");
$con=connect_db();
$imgname;
if(!empty($_FILES['pic']['name'])){
	$target_dir = "../../img/";

	$name = date("yyyymmdd")."ASDFGHJKLZXCVBNM";
	$name = substr(str_shuffle($name),0,10);
	$typepic = explode("/",$_FILES["pic"]["type"]);
	$name .= ".".$typepic[1];

	$target_file = $target_dir . basename($name);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


	echo "name +>".$name." ";

	// Check if image file is a actual image or fake image
	
	    $check = getimagesize($_FILES["pic"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	       // copy($_FILES["pic"]["tmp_name"], "$target_file");
	        $imgname=$name;
	        
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	        $imgname="user_default.svg";
	    }
	
}else{
 $imgname="user_default.svg";
}

/*
echo $_POST['degn1']." ==> ";
echo $_POST['degaddes1']." ==> ";
echo $_POST['degn2']." ==> ";
echo $_POST['degaddes2']." ==> ";
echo $_POST['degn3']." ==> ";
echo $_POST['degaddes3']." ==> ";
*/


 $sql = "INSERT INTO general VALUES ('','".$_POST['uname']."','".$_POST['passwd']."','".$_POST['brn']."','".$_POST['suj']."','".$_POST['codeid']."','".$_POST['titlename']."','".$_POST['fname']."','".$_POST['lname']."','".$_POST['salary']."','".$_POST['ap']."','','".$_POST['startwork']."','".$_POST['permiss']."','".$_POST['pos']."','".$imgname."')";
echo $sql;

 // mysqli_query($con,$sql ) or  die ("mysql error=>>".mysql_error($con));
 //     mysqli_close($con);


?>


     