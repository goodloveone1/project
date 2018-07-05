<?php
include("../../function/db_function.php");
$con=connect_db();

echo $_POST['titlename'],"/";
echo $_POST['name'],"/";
echo $_POST['lname'],"/";
echo $_POST['codeid'],"/";
echo $_POST['pos'],"/";
echo $_POST['ap'],"/";
echo $_POST['suj'],"/";
echo $_POST['brn'],"/";
echo $_POST['salary'],"/";
echo $_POST['gen_startdate'],"/";
echo $_POST['level_id'],"/";
echo $_POST['uname'],"/";
echo $_POST['passwd'],"/";

$update="UPDATE general SET gen_id='',gen_user=' $_POST[uname]',gen_pass='$_POST[passwd]',branch_id='$_POST[brn]',subject_id='$_POST[suj]',gen_code=' $_POST[codeid]',gen_prefix=' $_POST[titlename]',gen_fnam='$_POST[name]',gen_lname='$_POST[lname]',
gen_salary=' $_POST[salary]',gen_acadeic='$_POST[ap]',level_id='$_POST['level_id']',gen_startdate='',permiss_id='',gen_pos='',genpict='' ";

/*echo $_POST['titlename'];
$a1 =  $_POST['a1'];

foreach ($a1 as $value) {
	echo "$value => ";
}
*/
?>