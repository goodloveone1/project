<?php

include("../../function/db_function.php");
$con=connect_db();

//print_r($_POST['se_id']);

//print_r($_FILES['fileimg1']);
//print_r($_FILES);



$url = '../../file/'.$_POST['ass_id']; // ตำแหน่ง folder
//echo $url;  

if (!file_exists($url)) {    // CHECK folder มีหรือยัง
    mkdir($url, 0777, true);  // สร้าง folder
}

for($i=1;$i< count($_FILES);$i++){
  
$rename="fileimg".$i;
echo "ข้อความ -->".$_POST['text'][$i]."<br>";
$num = count($_FILES[$rename]['name']);



for($j=0;$j< $num;$j++){

    if(!empty($_FILES[$rename]['name'][$j])){

        $typefile = explode("/",$_FILES[$rename]["type"][$j]);

        if($typefile[1]=='msword'){
            $typefile[1]="doc";
        }

        
        $filename =$_POST['se_id'][($i-1)].'-'.str_shuffle(date("dmythi"));

        $filename = substr($filename,0,10);

        $filename .= ".".$typefile[1];



        echo "filename -->".$filename." "."<br>";
        echo "name ->". $_FILES[$rename]['name'][$j]."<br>";
       
        copy($_FILES[$rename]['tmp_name'][$j],$url."/".$filename);
    }
    
   
}
echo "---------------------------- <br>";
}







     

?>
