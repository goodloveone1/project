<?php
session_start();

include("../../function/db_function.php");
$con=connect_db();

$gen_id=$_SESSION['user_id'];

echo $gen_id,"<br>";
echo $_POST['year'],"<br>";
echo $_POST['no'],"<br>";
echo $_POST['name'],"<br>";
echo $_POST['g_pos'],"<br>";
echo $_POST['dept'],"<br>";
echo $_POST['leader'],"<br>";
echo $_POST['l_pos'],"<br>";
echo $_POST['g_aca'],"<br>";
echo $_POST['salary'],"<br>";
echo $_POST['acd_no'],"<br>";
echo $_POST['leves'],"<br>";
echo $_POST['aff'],"<br>";
echo $_POST['st_work'],"<br>";
echo $_POST['sum_work'],"<br>";
echo $_POST['inspector'],"<br>";
echo $_POST['punishment'],"<br>";






?>