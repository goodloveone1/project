<?php
include("../../function/db_function.php");
$con=connect_db();
$gen_id = $_POST['getid'];
$data=array();
						$degree = mysqli_query($con,"SELECT  ed_id,degree_id,ed_name,ed_loc FROM education WHERE gen_id='$gen_id'") or die ("error".mysqli_error($con));
						while(list($ed_id,$degree_id,$ed_name,$ed_loc)=mysqli_fetch_row($degree)){
							$deName = mysqli_query($con,"SELECT degree_name FROM degree WHERE degree_id='$degree_id'")or die("errorSQL".mysqli_error($con));
							list($degree_name)=mysqli_fetch_row($deName);
							$addarry = array($degree_name,$ed_name,$ed_loc, "<a href='javascript:void(0)'class='editbrn' data-iddegree='$ed_id' data-toggle='modal' ><i class='fas fa-edit fa-2x'></i></a>",
										"<a href='javascript:void(0)' class='delbrn' data-degreename='$degree_name' data-iddegree='$ed_id'><i class='fas fa-trash-alt fa-2x'></i></a>"
											);

							array_push($data,$addarry);
							mysqli_free_result($deName);

						}
						mysqli_free_result($degree);

						mysqli_close($con);

			echo	json_encode($data);

?>
