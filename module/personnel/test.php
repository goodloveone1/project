<?php
                      
                      $gen_id=$_POST['id'];
						$degree = mysqli_query($con,"SELECT  ed_id,degree_id,ed_name,ed_loc FROM education WHERE gen_id='$gen_id'") or die ("error".mysqli_error($con));
						while(list($ed_id,$degree_id,$ed_name,$ed_loc)=mysqli_fetch_row($degree)){
							$deName = mysqli_query($con,"SELECT degree_name FROM degree WHERE degree_id='$degree_id'")or die("errorSQL".mysqli_error($con));
							list($degree_name)=mysqli_fetch_row($deName);
							echo"
									<tr>
							
										<td>$degree_name</td>
										<td>$ed_name</td>
										<td>$ed_loc</td>
										<td><a href='#'class='editbrn' data-iddegree='$ed_id' data-toggle='modal' ><i class='fas fa-edit fa-2x'></i></a></td>
                						<td><a href='#' class='delbrn' data-degreename='$degree_name' data-iddegree='$ed_id'><i class='fas fa-trash-alt fa-2x'></i></a></td>
										
									</tr>
							";
						}
                        mysqli_free_result($degree);
					?>
<script>

    location.reload();
</script>