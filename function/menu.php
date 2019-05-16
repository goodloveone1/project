<?php
function webmenu($id){

	switch ($id) {
		case "1":  // ADMIN MENU
?>
			<ul class="list-group" id="menuaside">

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="home" title="หน้าหลัก" >
					<button class="btn-block bt-color"  >
					<li class="list-group-item list-menu-user" >
						<i class="icon fas fa-home fa-lg" ></i><span class="text">&nbsp;หน้าหลัก</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel"  data-action="mangauser" title="จัดการบุคลากร">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-tie fa-lg " ></i><span class="text">&nbsp;จัดการบุคลากร</span>
					</li>
					</button>
				</a> 
				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="managesubject" title="จัดการสาขา">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-tie fa-lg " ></i><span class="text">&nbsp;จัดการสาขา</span>
					</li>
					</button>
				</a> 
				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="managebranch" title="จัดการหลักสูตร">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-tie fa-lg " ></i><span class="text">&nbsp;จัดการหลักสูตร</span>
					</li>
					</button>
				</a> 
				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="managedegree" title="จัดการวุฒิการศึกษา">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-book fa-lg " ></i><span class="text">&nbsp;จัดการวุฒิการศึกษา</span>
					</li>
					</button>
				</a> 

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_record_ad" title="จัดการการปฏิบัติงาน">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-briefcase fa-lg " ></i><span class="text">&nbsp;จัดการการปฏิบัติงาน</span>
					</li>
					</button>
				</a>
				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Ass" title="จัดการการประเมิน">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-briefcase fa-lg " ></i><span class="text">&nbsp;จัดการการประเมิน</span>
					</li>
					</button>
				</a>
					<a>
					<button class="btn-block bt-color" id="flip" title="จัดการเกณฑ์การประเมิน">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-edit fa-lg " ></i><span class="text" >&nbsp;จัดการเกณฑ์การประเมิน</span>
					</li>
				
					</button>
					<div id="panelassess" style='display:none'>
					<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="year" title="ปีงบประมาณ">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text">ปีงบประมาณ</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="weight" title="น้ำหนักความสำคัญของงาน">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text">น้ำหนักความสำคัญของงาน</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="evaluation" title="ตัวชีวัด/เกณฑ์การประเมิน">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text">ตัวชีวัด/เกณฑ์การประเมิน</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="min_hour_work" title="ภาระงานขั้นต่ำ">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text">ภาระงานขั้นต่ำ</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="Criteria_manage_tor2" title="พฤติกรรมการปฏิบัติงาน">
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
				<a href="javascript:void(0)" class="menuuser" data-modules="public_relations" data-action="pr_manage" title="จัดการประชาสัมพันธ์">
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
				<a href="logout.php" onclick='return confirm("คุณ้องการออกจากระบบใช่หรือไม่")' title="ออกจากระบบ">
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
						<i class="icon fas fa-home fa-lg " ></i><span class="text">&nbsp;หน้าหลัก</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-cog fa-lg " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_record">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-book-open fa-lg " ></i><span class="text">&nbsp;บันทึกการปฏิบัติงาน</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_tor">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-check-square fa-lg " ></i><span class="text">&nbsp;จัดการประเมิน</span>
					</li>
					</button>
				</a>

		

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-archive fa-lg " ></i><span class="text">&nbsp;จัดการไฟล์หลักฐาน</span>
					</li>
					</button>
			

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_assessment">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-calendar-check fa-lg " ></i><span class="text">&nbsp;ผลการประเมิน</span>
					</li>
					</button>
				</a>
				
				<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="reportstaff2">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-chart-bar"></i><span class="text">&nbsp;รายงานผลการประเมิน </span>
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
						<i class="icon fas fa-home fa-lg " ></i><span class="text">&nbsp;หน้าหลัก</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-cog fa-lg " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_record">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-book-open fa-lg " ></i><span class="text">&nbsp;บันทึกการปฏิบัติงาน</span>
					</li>
					</button>
				</a>


				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_asmIn">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-check fa-lg " ></i><span class="text">&nbsp;ประเมินบุคลากร</span>
					</li>
					</button>
				</a>


				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_tor">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-check-square fa-lg " ></i><span class="text">&nbsp;ประเมินตนเอง</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
					<i class="icon fas fa-archive fa-lg"></i><span class="text"> จัดการหลักฐานของตนเอง</span>
					</li>
					</button>
				</a>
				

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

						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="reportstaff2">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-chart-bar"></i><span class="text">&nbsp;รายงานผลการประเมิน </span>
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
			case 4: // หัวหน้าสาขาMENU
	?>
	<ul class="list-group" >
		<a href="javascript:void(0)" class="menuuser " data-modules="personnel" data-action="home" >
			<button class="btn-block bt-color"  >
			<li class="list-group-item list-menu-user" >
				<i class="icon fas fa-home fa-lg " ></i><span class="text">&nbsp;หน้าหลัก</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-user-cog fa-lg " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_record">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-book-open fa-lg " ></i><span class="text">&nbsp;บันทึกการปฏิบัติงาน</span>
			</li>
			</button>
		</a>


		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_asmIn">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-user-check fa-lg " ></i><span class="text">&nbsp;ประเมินบุคลากร</span>
			</li>
			</button>
		</a>


		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_tor">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-check-square fa-lg " ></i><span class="text">&nbsp;ประเมินตนเอง</span>
			</li>
			</button>
		</a>


		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
					<i class="icon fas fas fa-archive fa-lg"></i><span class="text"> จัดการหลักฐานของตนเอง</span>
					</li>
					</button>
				</a>

	
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

						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="reportstaff2">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-chart-bar"></i><span class="text">&nbsp;รายงานผลการประเมิน </span>
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

			case 5: /// หัวหน้าคณะ MENU
	?>


	<ul class="list-group" >
		<a href="javascript:void(0)" class="menuuser " data-modules="personnel" data-action="home" >
			<button class="btn-block bt-color"  >
			<li class="list-group-item list-menu-user" >
				<i class="icon fas fa-home fa-lg " ></i><span class="text">&nbsp;หน้าหลัก</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-user-cog fa-lg " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
			</li>
			</button>
		</a>

	

		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_asmIn">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-user-check fa-lg " ></i><span class="text">&nbsp;ประเมินบุคลากร</span>
			</li>
			</button>
		</a>

	
		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_asmIn">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-calendar-check fa-lg " ></i><span class="text">&nbsp;ผลการประเมินบุคลากร</span>
			</li>
			</button>
		</a>

		<button class="btn-block bt-color" id="flip2" >
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-chart-bar fa-lg "></i> <span class="text"> รายงาน</span>
					</li>
					</button>
					<div id="panelassess2" style='display:none'>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="listuser">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> รายงานผลส่วนบุคคล </span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="reportsumall">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user">
							<i class="icon fas fa-angle-double-right"></i><span class="text">  รายงานผลทั้งหมด</span>
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

			default: ERROE;

	}
}



?>
