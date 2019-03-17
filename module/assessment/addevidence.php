<?php
session_start();
include("../../function/db_function.php");
$con=connect_db();

//print_r($_POST['se_id']);

//print_r($_FILES['fileimg1']);
//print_r($_FILES);

try{

    $sql = "INSERT INTO evidence VALUES ('','$_POST[ass_id]','$_SESSION[user_id]','".date("Y-m-d")."','','','1')";
    mysqli_query($con,$sql);

    $remaxid = mysqli_query($con,"SELECT max(evd_id) FROM evidence");

    list($maxevid) = mysqli_fetch_row($remaxid);
    mysqli_free_result($remaxid);


    $url = '../../file/'.$_POST['ass_id']; // ตำแหน่ง folder
    //echo $url;  

    if (!file_exists($url)) {    // CHECK folder มีหรือยัง
        mkdir($url, 0777, true);  // สร้าง folder
    }

    for($i=1;$i<= count($_POST['se_id']);$i++){
    
    $rename="fileimg".$i;
    //echo "ข้อความ -->".$_POST['text'][($i-1)]."<br>";


    $num = empty($_FILES[$rename]['name'])?'0':count($_FILES[$rename]['name']);
    

    $se_id = $_POST['se_id'][($i-1)];

    $text = empty($_POST['text'][($i-1)])?'':$_POST['text'][($i-1)];

    

    if(!empty($text)){

    mysqli_query($con,"INSERT INTO evidence_text VALUES ('','$maxevid','$se_id','$text')") or die("ERROR text ->".mysqli_error($con));

    }

    if($num != 0){
        for($j=0;$j< $num;$j++){

            if(!empty($_FILES[$rename]['name'][$j])){

        

                    $oldname = $_FILES[$rename]['name'][$j];
            
                    $type = $_FILES[$rename]["type"][$j];

                    $typefile = explode("/",$type);

                    if($typefile['1']=='msword'){
                        $typefile['1']="doc";
                    }else if($typefile['1'] == "vnd.openxmlformats-officedocument.wordprocessingml.document"){
                        $typefile['1'] = "docx";
                    }else if($typefile['1'] == "octet-stream"){
                        $typefile['1'] = "rar";
                    }else if($typefile['1'] == "x-zip-compressed"){
                        $typefile['1'] = "zip";
                    }

                    
                    $filename =$_POST['se_id'][($i-1)].'-'.str_shuffle(date("dmythi"));

                    $filename = substr($filename,0,10);

                    $filename .= ".".$typefile['1'];


                  //echo "filename m -->".$filename." "."<br>";

                

               mysqli_query($con,"INSERT INTO evidence_file VALUES ('','$maxevid','$se_id','$oldname','$filename')");

                //  $filename = iconv('UTF-8','windows-874',$filename);  // แปลง file name ไทย
                // / echo "name ->". $_FILES[$rename]['name'][$j]."<br>";
                
               copy($_FILES[$rename]['tmp_name'][$j],$url."/".$filename);

            }
            
        
        } /// END FOR   
    } /// END IF
    else {
        
        
        for($k=1;$k<=5;$k++){
            $rename = "fileimg2".$se_id.$k;
            if(!empty($_FILES[$rename]['name'])){

                $oldname = $_FILES[$rename]['name'];
            /// echo "filename o -->".$_FILES[$rename]['name']." "."<br>";

            $type = $_FILES[$rename]["type"];

            $typefile = explode("/",$type);

            if($typefile['1']=='msword'){
                $typefile['1']="doc";
            }else if($typefile['1'] == "vnd.openxmlformats-officedocument.wordprocessingml.document"){
                $typefile['1'] = "docx";
            }else if($typefile['1'] == "octet-stream"){
                $typefile['1'] = "rar";
            }else if($typefile['1'] == "x-zip-compressed"){
                $typefile['1'] = "zip";
            }

            
            $filename =$se_id.'-'.str_shuffle(date("dmythi"));

            $filename = substr($filename,0,10);

            $filename .= ".".$typefile['1'];

             ///   echo "filename -->".$filename." "."<br>";

               mysqli_query($con,"INSERT INTO evidence_file VALUES ('','$maxevid','$se_id','$oldname','$filename')");

               copy($_FILES[$rename]['tmp_name'],$url."/".$filename);


            }
        }


    }   ////END IF 


    //  echo "---------------------------- <br>";
                
    } //   /// END FOR
    echo 'อัปโหลดไฟล์สำเร็จ ';   

}  catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}  

mysqli_close($con);




     

?>
