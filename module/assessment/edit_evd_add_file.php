<?php
include("../../function/db_function.php");
$con=connect_db();
//print_r($_FILES['addfile']);
try{
    if(!empty($_FILES['addfile'])){

        $url = '../../file/'.$_POST['torid'];

        if (!file_exists($url)) {    // CHECK folder มีหรือยัง
            mkdir($url, 0777, true);  // สร้าง folder
        }

         $num = count($_FILES['addfile']['name']);

        if( $num == 1 ){

            try {

                //echo $_FILES['addfile']["type"]['0'];

                $oldname = $_FILES['addfile']["name"][0];

                $typefile = explode("/",$_FILES['addfile']["type"]['0']);

                if($typefile['1'] == 'msword'){
                    $typefile['1'] = "doc";
                }else if($typefile['1'] == "vnd.openxmlformats-officedocument.wordprocessingml.document"){
                    $typefile['1'] = "docx";
                }else if($typefile['1'] == "octet-stream"){
                    $typefile['1'] = "rar";
                }else if($typefile['1'] == "x-zip-compressed"){
                    $typefile['1'] = "zip";
                }else if($typefile['1'] == "vnd.ms-excel"){
                    $typefile['1'] = "xls";
                }else if($typefile['1'] == "vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
                    $typefile['1'] = "xlsx";
                }
        
                
                $filename =$_POST['seid'].'-'.str_shuffle(date("dmythi"));
        
                $filename = substr($filename,0,10);
        
                $filename .= ".".$typefile[1];
         

                $sql = "INSERT INTO evidence_file VALUES ('','$_POST[evdid]','$_POST[seid]','$oldname','$filename')";
        
                mysqli_query($con,$sql) or die(mysqli_error($con));

                $filename = iconv('UTF-8','windows-874',$filename);  // แปลง file name ไทย

                copy($_FILES['addfile']['tmp_name']['0'],$url."/".$filename);

             
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }

        }else{

            try {
                for($i=0;$i < $num;$i++){

                    $oldname = $_FILES['addfile']["name"][$i];

                    //echo $_FILES['addfile']["type"][$i];

                    $typefile = explode("/",$_FILES['addfile']["type"][$i]);

                    if($typefile[1] == 'msword'){
                        $typefile[1] = "doc";
                    }else if($typefile[1] == "vnd.openxmlformats-officedocument.wordprocessingml.document"){
                        $typefile[1] = "docx";
                    }else if($typefile['1'] == "octet-stream"){
                        $typefile['1'] = "rar";
                    }else if($typefile['1'] == "x-zip-compressed"){
                        $typefile['1'] = "zip";
                    }
            
                    
                    $filename =$_POST['seid'].'-'.str_shuffle(date("dmythi"));
            
                    $filename = substr($filename,0,10);
            
                    $filename .= ".".$typefile[1];
         
                    $sql = "INSERT INTO evidence_file VALUES ('','$_POST[evdid]','$_POST[seid]','$oldname','$filename')";
            
                    mysqli_query($con,$sql) or die(mysqli_error($con));

                    $filename = iconv('UTF-8','windows-874',$filename);  // แปลง file name ไทย

                    copy($_FILES['addfile']['tmp_name'][$i],$url."/".$filename);

                }
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }
    echo 'อัปโหลดไฟล์สำเร็จ ';   
}  catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}  
$con->close();
?>
