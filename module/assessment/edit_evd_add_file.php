<?php

include("../../function/db_function.php");
$con=connect_db();

//print_r($_FILES['addfile']);

    if(!empty($_FILES['addfile'])){

        $url = '../../file/'.$_POST['torid'];

        
        if (!file_exists($url)) {    // CHECK folder มีหรือยัง
            mkdir($url, 0777, true);  // สร้าง folder
        }

         echo  $num = count($_FILES['addfile']['name']);

        if( $num == 1 ){

            try {

                echo $_FILES['addfile']["type"]['0'];

                $typefile = explode("/",$_FILES['addfile']["type"]['0']);

                if($typefile['1'] == 'msword'){
                    $typefile['1'] = "doc";
                }else if($typefile['1'] == "vnd.openxmlformats-officedocument.wordprocessingml.document"){
                    $typefile['1'] = "docx";
                }
        
                
                $filename =$_POST['seid'].'-'.str_shuffle(date("dmythi"));
        
                $filename = substr($filename,0,10);
        
                $filename .= ".".$typefile[1];

                $sql = "INSERT INTO evidence_file VALUES ('','$_POST[evdid]','$_POST[seid]','$filename')";
        
                mysqli_query($con,$sql) or die(mysqli_error($con));

                copy($_FILES['addfile']['tmp_name']['0'],$url."/".$filename);

            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }

        }else{

            try {
                for($i=0;$i < $num;$i++){

                    echo $_FILES['addfile']["type"][$i];

                    $typefile = explode("/",$_FILES['addfile']["type"][$i]);

                    if($typefile[1] == 'msword'){
                        $typefile[1] = "doc";
                    }else if($typefile[1] == "vnd.openxmlformats-officedocument.wordprocessingml.document"){
                        $typefile[1] = "docx";
                    }
            
                    
                    $filename =$_POST['seid'].'-'.str_shuffle(date("dmythi"));
            
                    $filename = substr($filename,0,10);
            
                    $filename .= ".".$typefile[1];

                    $sql = "INSERT INTO evidence_file VALUES ('','$_POST[evdid]','$_POST[seid]','$filename')";
            
                    mysqli_query($con,$sql) or die(mysqli_error($con));

                    copy($_FILES['addfile']['tmp_name'][$i],$url."/".$filename);


                }
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }

        }

    }

$con->close();

?>
