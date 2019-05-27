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
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text">ปีงบประมาณ</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="weight" title="น้ำหนักความสำคัญของงาน">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text">น้ำหนักความ<br>สำคัญของงาน</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="evaluation" title="ตัวชีวัด/เกณฑ์การประเมิน">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text">ตัวชีวัด/เกณฑ์การประเมิน</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="min_hour_work" title="ภาระงานขั้นต่ำ">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text">ภาระงานขั้นต่ำ</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="Criteria_manage_tor2" title="พฤติกรรมการปฏิบัติงาน">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
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
				<a href="javascript:void(0)" onclick='swal({
									title: "คุณต้องการออกจากระบบใช่หรือไม่?",
									text: "",
									icon: "warning",
									buttons: true,
									dangerMode: true,
									buttons:["ยกเลิก","ตกลง"],
									})
									.then((willDelete) => {
									if (willDelete) {
										window.location.href = "logout.php";
									// swal("Poof! Your imaginary file has been deleted!", {
										//   icon: "success",
										//});
									} else {
									// swal("Your imaginary file is safe!");
									}
});' title="ออกจากระบบ">
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
				<a href="javascript:void(0)" class="menuuser " data-modules="personnel" data-action="home" title="หน้าหลัก">
					<button class="btn-block bt-color"  >
					<li class="list-group-item list-menu-user" >
						<i class="icon fas fa-home fa-lg " ></i><span class="text">&nbsp;หน้าหลัก</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall" title="แก้ไขข้อมูลส่วนตัว">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-cog fa-lg " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_record" title="บันทึกการปฏิบัติงาน">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-book-open fa-lg "></i><span class="text">&nbsp;บันทึกการปฏิบัติงาน</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_tor" title="จัดการประเมิน">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-check-square fa-lg "></i><span class="text">&nbsp;จัดการประเมิน</span>
					</li>
					</button>
				</a>

		

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence" title="จัดการไฟล์หลักฐาน">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-archive fa-lg "></i><span class="text">&nbsp;จัดการไฟล์หลักฐาน</span>
					</li>
					</button>
			

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_assessment" title="ผลการประเมิน">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-calendar-check fa-lg "></i><span class="text">&nbsp;ผลการประเมิน</span>
					</li>
					</button>
				</a>
				

					<button class="btn-block bt-color" id="flip2" >
					<li class="list-group-item list-menu-user" title="รายงาน">
						<i class="icon fas fa-chart-bar fa-lg "></i> <span class="text">รายงาน</span>
					</li>
					</button>
					<div id="panelassess2" style='display:none'>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="list_tor" title="ผลการประเมินของบุคลากร">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> รายงาน TOR </span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="list_pre" title="ผลการประเมินของบุคลากร">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> รายงานข้อตกลง </span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="reportstaff2Y5" title="ผลการประเมินของตนเอง">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> รายงานผลแบบกราฟ<br> 5 ปี ย้อนหลัง</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="reportstaff2Y10" title="ผลการประเมินของตนเอง">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> รายงานผลแบบกราฟ<br> 10 ปี ย้อนหลัง</span>
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

				<a href="javascript:void(0)" onclick='swal({
									title: "คุณต้องการออกจากระบบใช่หรือไม่?",
									text: "",
									icon: "warning",
									buttons: true,
									dangerMode: true,
									buttons:["ยกเลิก","ตกลง"],
									})
									.then((willDelete) => {
									if (willDelete) {
										window.location.href = "logout.php";
									// swal("Poof! Your imaginary file has been deleted!", {
										//   icon: "success",
										//});
									} else {
									// swal("Your imaginary file is safe!");
									}
});' title="ออกจากระบบ">
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
				<a href="javascript:void(0)" class="menuuser " data-modules="personnel" data-action="home" title="หน้าหลัก">
					<button class="btn-block bt-color"  >
					<li class="list-group-item list-menu-user" >
						<i class="icon fas fa-home fa-lg " ></i><span class="text">&nbsp;หน้าหลัก</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall" title="แก้ไขข้อมูลส่วนตัว">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-cog fa-lg " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_record" title="บันทึกการปฏิบัติงาน">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-book-open fa-lg " ></i><span class="text">&nbsp;บันทึกการปฏิบัติงาน</span>
					</li>
					</button>
				</a>


				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_asmIn" title="ประเมินบุคลากร">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-check fa-lg " ></i><span class="text">&nbsp;ประเมินบุคลากร</span>
					</li>
					</button>
				</a>


				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_tor" title="ประเมินตนเอง">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-check-square fa-lg " ></i><span class="text">&nbsp;ประเมินตนเอง</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence" title="จัดการหลักฐานของตนเอง">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
					<i class="icon fas fa-archive fa-lg"></i><span class="text"> จัดการหลักฐานของตนเอง</span>
					</li>
					</button>
				</a>
				

				<button class="btn-block bt-color" id="flip2" >
					<li class="list-group-item list-menu-user" title="ผลการประเมิน">
						<i class="icon fas fa-calendar-check fa-lg "></i><span class="text">  ผลการประเมิน</span>
					</li>
					</button>
					<div id="panelassess2" style='display:none'>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_assessment" title="ผลการประเมินของตนเอง">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> ผลการประเมินของตนเอง</span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_asmIn" title="ผลการประเมินของบุคลากร">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
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

					<button class="btn-block bt-color" id="flip3" >
					<li class="list-group-item list-menu-user" title="รายงาน">
						<i class="icon fas fa-chart-bar fa-lg "></i> <span class="text"> รายงาน</span>
					</li>
					</button>
					<div id="panelassess3" style='display:none'>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="list_tor" title="ผลการประเมินของบุคลากร">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> รายงาน TOR </span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="list_pre" title="ผลการประเมินของบุคลากร">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> รายงานข้อตกลง </span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="reportstaff2" title="ผลการประเมินของตนเอง">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> รายงานผลแบบกราฟ</span>
							</li>
							</button>
						</a>
					</div>
					<script> 
						$(document).ready(function(){
						$("#flip3").click(function(){
							$("#panelassess3").slideToggle();
						});
						});
					</script>				


				<a href="javascript:void(0)" onclick='swal({
									title: "คุณต้องการออกจากระบบใช่หรือไม่?",
									text: "",
									icon: "warning",
									buttons: true,
									dangerMode: true,
									buttons:["ยกเลิก","ตกลง"],
									})
									.then((willDelete) => {
									if (willDelete) {
										window.location.href = "logout.php";
									// swal("Poof! Your imaginary file has been deleted!", {
										//   icon: "success",
										//});
									} else {
									// swal("Your imaginary file is safe!");
									}
});' title="ออกจากระบบ">
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
		<a href="javascript:void(0)" class="menuuser " data-modules="personnel" data-action="home" title="หน้าหลัก">
			<button class="btn-block bt-color"  >
			<li class="list-group-item list-menu-user" >
				<i class="icon fas fa-home fa-lg " ></i><span class="text">&nbsp;หน้าหลัก</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall" title="แก้ไขข้อมูลส่วนตัว">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-user-cog fa-lg " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_record" title="บันทึกการปฏิบัติงาน">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-book-open fa-lg " ></i><span class="text">&nbsp;บันทึกการปฏิบัติงาน</span>
			</li>
			</button>
		</a>


		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_asmIn" title="ประเมินบุคลากร">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-user-check fa-lg " ></i><span class="text">&nbsp;ประเมินบุคลากร</span>
			</li>
			</button>
		</a>


		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_tor" title="ประเมินตนเอง">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-check-square fa-lg " ></i><span class="text">&nbsp;ประเมินตนเอง</span>
			</li>
			</button>
		</a>


		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence" title="จัดการหลักฐานของตนเอง">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
					<i class="icon fas fas fa-archive fa-lg"></i><span class="text"> จัดการหลักฐานของตนเอง</span>
					</li>
					</button>
				</a>

	
						<button class="btn-block bt-color" id="flip2" >
							<li class="list-group-item list-menu-user" title="ผลการประเมิน">
								<i class="icon fas fa-calendar-check fa-lg "></i><span class="text">  ผลการประเมิน</span>
							</li>
							</button>
							<div id="panelassess2" style='display:none'>
								<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_assessment" title="ผลการประเมินของตนเอง">
									<button class="btn-block bt-color">
									<li class="list-group-item list-menu-user addindent">
									<i class="icon fas fa-angle-double-right"></i> <span class="text"> ผลการประเมินของตนเอง</span>
									</li>
									</button>
								</a>
								<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_asmIn" title="ผลการประเมินของบุคลากร">
									<button class="btn-block bt-color">
									<li class="list-group-item list-menu-user addindent">
									<i class="icon fas fa-angle-double-right"></i> <span class="text"> ผลการประเมินของบุคลากร</span>
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

<button class="btn-block bt-color" id="flip3" >
					<li class="list-group-item list-menu-user" title="รายงาน">
						<i class="icon fas fa-chart-bar fa-lg "></i><span class="text"> รายงาน</span>
					</li>
					</button>
					<div id="panelassess3" style='display:none'>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="list_tor" title="ผลการประเมินของบุคลากร">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> รายงาน TOR </span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="list_pre" title="ผลการประเมินของบุคลากร">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> รายงานข้อตกลง </span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="reportstaff2" title="ผลการประเมินของตนเอง">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> รายงานผลแบบกราฟ</span>
							</li>
							</button>
						</a>
					</div>
					<script> 
						$(document).ready(function(){
						$("#flip3").click(function(){
							$("#panelassess3").slideToggle();
						});
						});
					</script>			

		<a href="javascript:void(0)" onclick='swal({
									title: "คุณต้องการออกจากระบบใช่หรือไม่?",
									text: "",
									icon: "warning",
									buttons: true,
									dangerMode: true,
									buttons:["ยกเลิก","ตกลง"],
									})
									.then((willDelete) => {
									if (willDelete) {
										window.location.href = "logout.php";
									// swal("Poof! Your imaginary file has been deleted!", {
										//   icon: "success",
										//});
									} else {
									// swal("Your imaginary file is safe!");
									}
});' title="ออกจากระบบ">
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
		<a href="javascript:void(0)" class="menuuser " data-modules="personnel" data-action="home" title="หน้าหลัก">
			<button class="btn-block bt-color"  >
			<li class="list-group-item list-menu-user" >
				<i class="icon fas fa-home fa-lg " ></i><span class="text">&nbsp;หน้าหลัก</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall" title="แก้ไขข้อมูลส่วนตัว">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-user-cog fa-lg " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
			</li>
			</button>
		</a>

	

		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_asmIn" title="ประเมินบุคลากร">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-user-check fa-lg " ></i><span class="text">&nbsp;ประเมินบุคลากร</span>
			</li>
			</button>
		</a>

	
		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_asmIn" title="ผลการประเมินบุคลากร">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-calendar-check fa-lg " ></i><span class="text">&nbsp;ผลการประเมินบุคลากร</span>
			</li>
			</button>
		</a>

		<button class="btn-block bt-color" id="flip2" >
					<li class="list-group-item list-menu-user" title="รายงาน">
						<i class="icon fas fa-chart-bar fa-lg "></i> <span class="text"> รายงาน</span>
					</li>
					</button>
					<div id="panelassess2" style='display:none'>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="listuser" title="รายงานผลส่วนบุคคล">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
							<i class="icon fas fa-angle-double-right"></i><span class="text"> รายงานผลแต่ละบุคคล </span>
							</li>
							</button>
						</a>
						<a href="javascript:void(0)" class="menuuser" data-modules="report" data-action="reportsumall" title="รายงานผลทั้งหมด">
							<button class="btn-block bt-color">
							<li class="list-group-item list-menu-user addindent">
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

					
		<a href="javascript:void(0)" onclick='swal({
									title: "คุณต้องการออกจากระบบใช่หรือไม่?",
									text: "",
									icon: "warning",
									buttons: true,
									dangerMode: true,
									buttons:["ยกเลิก","ตกลง"],
									})
									.then((willDelete) => {
									if (willDelete) {
										window.location.href = "logout.php";
									// swal("Poof! Your imaginary file has been deleted!", {
										//   icon: "success",
										//});
									} else {
									// swal("Your imaginary file is safe!");
									}
});'>
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
					<i class="icon fas fa-sign-out-alt  d-inline-block" ></i><span class="text" title="ออกจากระบบ">&nbsp;ออกจากระบบ</span>
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
