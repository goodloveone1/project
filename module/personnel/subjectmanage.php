<?php
    session_start();
	include("../../function/db_function.php");
    $con=connect_db();
?>
จัดการสาขาวิชา

<table border=1>
    <tr align='center'>
        <td>ลำดับ</td>
        <td>สาขา</td>
        <td>แก้ไข</td>
        <td>ลบ</td>
    </tr>
<?php
    $Sbranch=mysqli_query($con,"SELECT *FROM branch") or die("errorSQLselect".mysqli_error($con));
    $no=1;
    while(list($branch_ID,$branch_Name)=mysqli_fetch_row($Sbranch)){
        echo"
            <tr>
                <td>$no</td>
                <td>$branch_Name</td>
                <td><a href='editbranch.php?b_id=$branch_ID'>แก้ไข</a></td>
                <td><a href='#'  onclick='return confirm(\"ยืนยันการลบ\")'>ลบ</a></td>
            </tr>";
            $no++;
    }
    mysqli_free_result($Sbranch);
    mysqli_close($con);
?>