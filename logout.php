<?php
session_start();
session_destroy(); 

echo "<script> sessionStorage.clear(); window.location='index.php'</script>";
?>
