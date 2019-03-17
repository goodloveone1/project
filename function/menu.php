<?php
function webmenu($id){

	switch ($id) {
		case "1":  // ADMIN MENU
?>
			<ul class="list-group" id="menuaside">

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="home" >
					<button class="btn-block bt-color"  >
					<li class="list-group-item list-menu-user" >
						<i class="icon fas fa-home fa-lg" ></i><span class="text">&nbsp;หน้าหลัก</span>
					</li>
					</button>
				</a>

				

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel"  data-action="mangauser" >
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-tie fa-lg " ></i><span class="text">&nbsp;จัดการบุคลากร</span>
					</li>
					</button>
				</a> 
				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="managesubject" >
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-tie fa-lg " ></i><span class="text">&nbsp;จัดการสาขา</span>
					</li>
					</button>
				</a> 
				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="managebranch"  >
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-tie fa-lg " ></i><span class="text">&nbsp;จัดการหลักสูตร</span>
					</li>
					</button>
				</a> 
				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="managedegree">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-book fa-lg " ></i><span class="text">&nbsp;จัดการวุฒิการศึกษา</span>
					</li>
					</button>
				</a> 

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_record_ad">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-briefcase fa-3x " ></i><span class="text">&nbsp;จัดการการมาปฏิบัติงาน</span>
					</li>
					</button>
				</a>
				
					<button class="btn-block bt-color" id="flip" >
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-edit fa-lg " ></i><span class="text">&nbsp;จัดการเกณฑ์การประเมิน</span>
					</li>
					</button>
					<div id="panelassess" style='display:none'>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="weight">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text">น้ำหนักความสำคัญของงาน</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="evaluation">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text">ตัวชีวัด/เกณฑ์การประเมิน</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="Criteria_manage_tor2">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text">พฤติกรรมการปฏิบัติงาน</span>
							</li>
							</button>
						</a>
					</div>
					<script> 
						$(document).ready(function(){
						$("#flip").click(function(){
							$("#panelassess").slideToggle();
						});
						});
					</script>
				<a href="javascript:void(0)" class="menuuser" data-modules="public_relations" data-action="pr_manage">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-bullhorn fa-lg " ></i><span class="text">&nbsp;จัดการประชาสัมพันธ์</span>
					</li>
					</button>
				</a>
				<!-- <a href="javascript:void(0)" class="menuuser" data-modules="download" data-action="download_manage">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-arrow-circle-down fa-lg " ></i><span class="text">&nbsp;จัดการไฟล์ดาวโหลด</span>
					</li>
					</button>
				</a> -->
				<a href="logout.php" onclick='return confirm("คุณ้องการออกจากระบบใช่หรือไม่")'>
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
					<i class="icon fas fa-sign-out-alt  d-inline-block" ></i><span class="text">&nbsp;ออกจากระบบ</span>
					</li>
					</button>
				</a>



				
		</ul>

<?php
			break;

		case "2": // อาจาทย์
?>

			<ul class="list-group" id="menuaside">
				<a href="javascript:void(0)" class="menuuser " data-modules="personnel" data-action="home" >
					<button class="btn-block bt-color"  >
					<li class="list-group-item list-menu-user" >
						<i class="icon fas fa-home fa-3x " ></i><span class="text">&nbsp;หน้าหลัก</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-cog fa-3x " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_record">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-book-open fa-3x " ></i><span class="text">&nbsp;บันทึกการปฏิบัติงาน</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_tor">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-check-square fa-3x " ></i><span class="text">&nbsp;จัดการประเมิน</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-folder fa-3x " ></i><span class="text">&nbsp;จัดการไฟล์หลักฐาน</span>
					</li>
					</button>
				</a>

				

				

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_assessment">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-calendar-check fa-3x " ></i><span class="text">&nbsp;ผลการประเมิน</span>
					</li>
					</button>
				</a>
				<a href="logout.php" onclick='return confirm("คุณ้องการออกจากระบบใช่หรือไม่")'>
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
					<i class="icon fas fa-sign-out-alt  d-inline-block" ></i><span class="text">&nbsp;ออกจากระบบ</span>
					</li>
					</button>
				</a>
			</ul>
<?php
			break;

		case 3: /// หัวหน้าหลักสูตร MENU
?>


			<ul class="list-group" >
				<a href="javascript:void(0)" class="menuuser " data-modules="personnel" data-action="home" >
					<button class="btn-block bt-color"  >
					<li class="list-group-item list-menu-user" >
						<i class="icon fas fa-home fa-3x " ></i><span class="text">&nbsp;หน้าหลัก</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-cog fa-3x " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_record">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-book-open fa-3x " ></i><span class="text">&nbsp;บันทึกการปฏิบัติงาน</span>
					</li>
					</button>
				</a>


				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_asmIn">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-check fa-3x " ></i><span class="text">&nbsp;ประเมินบุคลากร</span>
					</li>
					</button>
				</a>


				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_tor">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-check-square fa-3x " ></i><span class="text">&nbsp;ประเมินตนเอง</span>
					</li>
					</button>
				</a>
				
				<button class="btn-block bt-color" id="flip" >
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-folder fa-lg " ></i><span class="text">&nbsp;จัดการไฟล์หลักฐาน</span>
					</li>
					</button>
					<div id="panelassess" style='display:none'>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> จัดการหลักฐานของตนเอง</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence_course">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> ตรวจสอบหลักฐานบุคลากร</span>
							</li>
							</button>
						</a>
					</div>
					<script> 
						$(document).ready(function(){
						$("#flip").click(function(){
							$("#panelassess").slideToggle();
						});
						});
					</script>
			


				<button class="btn-block bt-color" id="flip2" >
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-calendar-check fa-lg "></i> <span class="text">  ผลการประเมิน</span>
					</li>
					</button>
					<div id="panelassess2" style='display:none'>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_assessment">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> ผลการประเมินของตนเอง</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_asmIn">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> ผลการประเมินของบุคลากร</span>
							</li>
							</button>
						</a>
					</div>
					<script> 
						$(document).ready(function(){
						$("#flip2").click(function(){
							$("#panelassess2").slideToggle();
						});
						});
					</script>		


				<a href="logout.php" onclick='return confirm("คุณ้องการออกจากระบบใช่หรือไม่")'>
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
					<i class="icon fas fa-sign-out-alt  d-inline-block" ></i><span class="text">&nbsp;ออกจากระบบ</span>
					</li>
					</button>
				</a>
			</ul>
<?php
			break;
			case 4: // หัวหน้าสาขาMENU
	?>
	<ul class="list-group" >
		<a href="javascript:void(0)" class="menuuser " data-modules="personnel" data-action="home" >
			<button class="btn-block bt-color"  >
			<li class="list-group-item list-menu-user" >
				<i class="icon fas fa-home fa-3x " ></i><span class="text">&nbsp;หน้าหลัก</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-user-cog fa-3x " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_record">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-book-open fa-3x " ></i><span class="text">&nbsp;บันทึกการปฏิบัติงาน</span>
			</li>
			</button>
		</a>


		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_asmIn">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-user-check fa-3x " ></i><span class="text">&nbsp;ประเมินบุคลากร</span>
			</li>
			</button>
		</a>


		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_tor">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-check-square fa-3x " ></i><span class="text">&nbsp;ประเมินตนเอง</span>
			</li>
			</button>
		</a>


		<button class="btn-block bt-color" id="flip" >
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-folder fa-lg " ></i><span class="text">&nbsp;จัดการไฟล์หลักฐาน</span>
					</li>
					</button>
					<div id="panelassess" style='display:none'>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> จัดการหลักฐานของตนเอง</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence_course">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> ตรวจสอบหลักฐานบุคลากร</span>
							</li>
							</button>
						</a>
					</div>
					<script> 
						$(document).ready(function(){
						$("#flip").click(function(){
							$("#panelassess").slideToggle();
						});
						});
					</script>

	
						<button class="btn-block bt-color" id="flip2" >
							<li class="list-group-item list-menu-user">
								<i class="icon fas fa-calendar-check fa-lg "></i> <span class="text">  ผลการประเมิน</span>
							</li>
							</button>
							<div id="panelassess2" style='display:none'>
								<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_assessment">
									<button class="btn-block bt-color">
									<li class="list-group-item list-menu-user">
									<i class="icon fas fa-angle-double-right"></i><span class="text"> ผลการประเมินของตนเอง</span>
									</li>
									</button>
								</a>
								<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_asmIn">
									<button class="btn-block bt-color">
									<li class="list-group-item list-menu-user">
									<i class="icon fas fa-angle-double-right"></i><span class="text"> ผลการประเมินของบุคลากร</span>
									</li>
									</button>
								</a>
							</div>
							<script> 
								$(document).ready(function(){
								$("#flip2").click(function(){
									$("#panelassess2").slideToggle();
								});
								});
							</script>		



		<a href="logout.php" onclick='return confirm("คุณ้องการออกจากระบบใช่หรือไม่")'>
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
					<i class="icon fas fa-sign-out-alt  d-inline-block" ></i><span class="text">&nbsp;ออกจากระบบ</span>
					</li>
					</button>
				</a>
	</ul>
	<?php
				break;

			case 5: /// หัวหน้าคณะ MENU
	?>


	<ul class="list-group" >
		<a href="javascript:void(0)" class="menuuser " data-modules="personnel" data-action="home" >
			<button class="btn-block bt-color"  >
			<li class="list-group-item list-menu-user" >
				<i class="icon fas fa-home fa-3x " ></i><span class="text">&nbsp;หน้าหลัก</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-user-cog fa-3x " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_record">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-book-open fa-3x " ></i><span class="text">บันทึกการปฏิบัติงาน</span>
			</li>
			</button>
		</a>


		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_asmIn">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-user-check fa-3x " ></i><span class="text">&nbsp;ประเมินบุคลากร</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence_course">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-folder fa-3x " ></i><span class="text">&nbsp;หลักฐานบุคลากร</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_asmIn">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-calendar-check fa-3x " ></i><span class="text">&nbsp;ผลการประเมินบุคลากร</span>
			</li>
			</button>
		</a>

					
		<a href="logout.php" onclick='return confirm("คุณ้องการออกจากระบบใช่หรือไม่")'>
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
					<i class="icon fas fa-sign-out-alt  d-inline-block" ></i><span class="text">&nbsp;ออกจากระบบ</span>
					</li>
					</button>
				</a>
	</ul>
	<?php

					break;

			default: ERROE;

	}
}



?>
