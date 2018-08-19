
<html>

<head>
<title>opendir()</title>
</head>

<body style="background-color:black;">
<img src="../../img/การัณฑ์-logo-500p.png">
<?php



    $dir = "../../img";
    mkdir("../../img/gg");
    // Open a directory, and read its contents
    if (is_dir($dir)){
      if ($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){
          echo "ไฟล์ :" . $file . "<br>";
        }
        closedir($dh);
      }
    }

    if( file_exists("../../img/e810zihfvd_2344.jpg") )
{
echo "<p style='color:red;'>มีไฟล์แล้ว<p>";
}
else
{ 
echo "ไม่มีไฟล์";
}
    ?>


</body>
</html>