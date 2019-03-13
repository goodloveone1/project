<?php
session_start();
include("../../function/db_function.php");
$con=connect_db();

//print_r($_POST['se_id']);

//print_r($_FILES['fileimg1']);
//print_r($_FILES);

echo $sql = "INSERT INTO evidence VALUES ('','$_POST[ass_id]','$_SESSION[user_id]','".date("Y-m-d")."','','','1')";
mysqli_query($con,$sql);

$remaxid = mysqli_query($con,"SELECT max(evd_id) FROM evidence");

list($maxevid) = mysqli_fetch_row($remaxid);
mysqli_free_result($remaxid);


$url = '../../file/'.$_POST['ass_id']; // ตำแหน่ง folder
//echo $url;  

if (!file_exists($url)) {    // CHECK folder มีหรือยัง
    mkdir($url, 0777, true);  // สร้าง folder
}

for($i=1;$i< count($_FILES);$i++){
  
$rename="fileimg".$i;
echo "ข้อความ -->".$_POST['text'][($i-1)]."<br>";
$num = count($_FILES[$rename]['name']);

$se_id = $_POST['se_id'][($i-1)];
$text = $_POST['text'][($i-1)];

if(!empty($text)){

mysqli_query($con,"INSERT INTO evidence_text VALUES ('','$maxevid','$se_id','$text')") or die("ERROR text ->".mysqli_error($con));

}


for($j=0;$j< $num;$j++){

    if(!empty($_FILES[$rename]['name'][$j])){

        $typefile = explode("/",$_FILES[$rename]["type"][$j]);

        if($typefile['1']=='msword'){
            $typefile['1']="doc";
        }else if($typefile['1'] == "vnd.openxmlformats-officedocument.wordprocessingml.document"){
            $typefile['1'] = "docx";
        }

        
        $filename =$_POST['se_id'][($i-1)].'-'.str_shuffle(date("dmythi"));

        $filename = substr($filename,0,10);

        $filename .= ".".$typefile['1'];

        mysqli_query($con,"INSERT INTO evidence_file VALUES ('','$maxevid','$se_id','$filename')");

        echo "filename -->".$filename." "."<br>";
        echo "name ->". $_FILES[$rename]['name'][$j]."<br>";
       
        copy($_FILES[$rename]['tmp_name'][$j],$url."/".$filename);
    }
    
   
}
echo "---------------------------- <br>";

}






     

?>
