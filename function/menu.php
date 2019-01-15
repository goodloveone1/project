<?php
function webmenu($id){

	switch ($id) {
		case "1":  // ADMIN MENU
?>


			<ul class="list-group" id="menuaside">

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="home" >
					<button class="btn-block bt-color"  >
					<li class="list-group-item list-menu-user" >
						<i class="icon fas fa-home fa-lg" ></i><span class="text">  หน้าหลัก</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="menumanage">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-tie fa-lg " ></i><span class="text">  จัดการบุคลากร</span>
					</li>
					</button>
				</a>
				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="main_assess">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-edit fa-lg " ></i><span class="text">  จัดการเกณฑ์การประเมิน</span>
					</li>
					</button>
				</a>
				<a href="javascript:void(0)" class="menuuser" data-modules="public_relations" data-action="pr_manage">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-bullhorn fa-lg " ></i><span class="text">  จัดการประชาสัมพันธ์</span>
					</li>
					</button>
				</a>
				<a href="javascript:void(0)" class="menuuser" data-modules="download" data-action="download_manage">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-arrow-circle-down fa-lg " ></i><span class="text">   จัดการไฟล์ดาวโหลด</span>
					</li>
					</button>
				</a>
				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="evidence_manage">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-archive fa-lg " ></i><span class="text">  จัดการไฟล์หลักฐาน</span>
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
						<i class="icon fas fa-home fa-3x " ></i><span class="text"> หน้าหลัก</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-cog fa-3x " ></i><span class="text">แก้ไขข้อมูลส่วนตัว</span>
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

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="menuassm">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-check-square fa-3x " ></i><span class="text"> จัดการประเมิน</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-archive fa-3x " ></i><span class="text">จัดการไฟล์หลักฐาน</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="sum_assessment">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-calendar-check fa-3x " ></i><span class="text">  ผลการประเมิน</span>
					</li>
					</button>
				</a>
			</ul>
<?php
			break;

		case 3: /// หัวหน้าสาขา MENU
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


				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="menuassm">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-check-square fa-3x " ></i><span class="text">&nbsp;ประเมินตนเอง</span>
					</li>
					</button>
				</a>

				<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-archive fa-3x " ></i><span class="text">&nbsp;จัดการไฟล์หลักฐาน</span>
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
			</ul>
<?php
			break;
			case 4: // หัวหน้าลักสูตร MENU
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


		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="menuassm">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-check-square fa-3x " ></i><span class="text">&nbsp;ประเมินตนเอง</span>
			</li>
			</button>
		</a>

		<a href="javascript:void(0)" class="menuuser" data-modules="assessment" data-action="manage_Evidence">
			<button class="btn-block bt-color">
			<li class="list-group-item list-menu-user">
				<i class="icon fas fa-archive fa-3x " ></i><span class="text">&nbsp;จัดการไฟล์หลักฐาน</span>
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
	</ul>
	<?php
				break;

			case 5: /// หัวหน้าคณะ MENU
	?>


					<a href="javascript:void(0)" class="menuuser" data-modules="staff" data-action="2">
						<button class="btn-block bt-color">
						<li class="list-group-item list-menu-user">
							<i class="icon fas fa-user-cog fa-3x " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
						</li>
						</button>
					</a>

					<a href="javascript:void(0)" class="menuuser" data-modules="staff" data-action="2">
						<button class="btn-block bt-color">
						<li class="list-group-item list-menu-user">
							<i class="icon fas fa-book-open fa-3x " ></i><span class="text">&nbsp;จัดการภาระงานของตน</span>
						</li>
						</button>
					</a>

					<a href="javascript:void(0)" class="menuuser" data-modules="staff" data-action="2">
						<button class="btn-block bt-color">
						<li class="list-group-item list-menu-user">
							<i class="icon fas fa-archive fa-3x " ></i><span class="text">&nbsp;จัดการไฟล์หลักฐาน</span>
						</li>
						</button>
					</a>

					<a href="javascript:void(0)" class="menuuser" data-modules="staff" data-action="2">
						<button class="btn-block bt-color">
						<li class="list-group-item list-menu-user">
							&nbsp;<i class="icon fas fa-info fa-3x " ></i><span class="text">&nbsp;รับทราบข้อตกลง TOR</span>
						</li>
						</button>
					</a>

					<a href="javascript:void(0)" class="menuuser" data-modules="staff" data-action="2">
						<button class="btn-block bt-color">
						<li class="list-group-item list-menu-user">
							<i class="icon fas fa-check-square fa-3x " ></i><span class="text">&nbsp;ประเมินตนเอง</span>
						</li>
						</button>
					</a>

					<a href="javascript:void(0)" class="menuuser" data-modules="staff" data-action="2">
						<button class="btn-block bt-color">
						<li class="list-group-item list-menu-user">
							<i class="icon fas fa-user-check fa-3x " ></i><span class="text">&nbsp;ประเมินการบุคลากร</span>
						</li>
						</button>
					</a>

					<a href="javascript:void(0)" class="menuuser" data-modules="staff" data-action="2">
						<button class="btn-block bt-color">
						<li class="list-group-item list-menu-user">
							<i class="icon fas fa-calendar-check fa-3x " ></i><span class="text">&nbsp;ผลการประเมิน</span>
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
