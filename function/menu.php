<?php
function webmenu($id,$head){

	switch ($id) {
		case "1":  // ADMIN MENU
?>			
	<p> ยินดีต้อนรับ ผู้ดูแลระบบ</p>
			<ul class="list-group" >

				<a href="userlogin.php?modules=personnel&action=home" class="menuuser " data-modules="personnel" data-action="home" >
					<button class="btn-block bt-color"  >
					<li class="list-group-item list-menu-user" >
						<i class="icon fas fa-home fa-3x " ></i><span class="text">  หน้าหลัก</span>
					</li>
					</button>
				</a>

				<a href="userlogin.php?modules=personnel&action=mangauser" class="menuuser" data-modules="personnel" data-action="mangauser">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-tie fa-3x " ></i><span class="text">  จัดการบุคลากร</span>
					</li>
					</button>
				</a>
				<a href="userlogin.php?modules=assessment&action=Criteria_manage" class="menuuser" data-modules="assessment" data-action="Criteria_manage">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-edit fa-3x " ></i><span class="text">  จัดการเกณฑ์การประเมิน</span>
					</li>
					</button>
				</a>
				<a href="userlogin.php?modules=public_relations&action=pr_manage" class="menuuser" data-modules="advertise" data-action="adv_manage">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-bullhorn fa-3x " ></i><span class="text">  จัดการประชาสัมพันธ์</span>
					</li>
					</button>
				</a>
				<a href="userlogin.php?modules=download&action=download_manage" class="menuuser" data-modules="advertise" data-action="home">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-arrow-circle-down fa-3x " ></i><span class="text">   จัดการไฟล์ดาวโหลด</span>
					</li>
					</button>
				</a>
				<a href="userlogin.php?modules=assessment&action=evidence_manage" class="menuuser" data-modules="staff" data-action="1">
					<button class="btn-block bt-color">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-archive fa-3x " ></i><span class="text">  จัดการไฟล์หลักฐาน</span>
					</li>
					</button>
				</a>
		</ul>
			
<?php
			break;

		case "2": // อาจาทย์
?>
		<p> ยินดีต้อนรับ อาจารย์</p>
			<ul class="list-group" >
				<a href="#" class="menuuser " data-modules="staff" data-action="1" >
					<button class="btn-block"  >
					<li class="list-group-item list-menu-user" >
						<i class="icon fas fa-home fa-3x " ></i><span class="text">&nbsp;หน้าหลัก</span>
					</li>
					</button>
				</a>

				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-cog fa-3x " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
					</li>
					</button>
				</a>

				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-book-open fa-3x " ></i><span class="text">&nbsp;จัดการภาระงานของตน</span>
					</li>
					</button>
				</a>

				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-archive fa-3x " ></i><span class="text">&nbsp;จัดการไฟล์หลักฐาน</span>
					</li>
					</button>
				</a>

				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-info fa-3x " ></i><span class="text">&nbsp;รับทราบข้อตกลง TOR</span>
					</li>
					</button>
				</a>

				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-check-square fa-3x " ></i><span class="text">&nbsp;ประเมินตนเอง</span>
					</li>
					</button>
				</a>
		
				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-calendar-check fa-3x " ></i><span class="text">&nbsp;ผลการประเมิน</span>
					</li>
					</button>
				</a>
			</ul>	
<?php
			break;

		case 3: /// หัวหน้าหลักสูตร MENU
?>
				<p> ยินดีต้อนรับ หัวหน้าหลักสูตร</p>
			<ul class="list-group" >
				<a href="#" class="menuuser " data-modules="staff" data-action="1" >
					<button class="btn-block"  >
					<li class="list-group-item list-menu-user" >
						<i class="icon fas fa-home fa-3x " ></i><span class="text">&nbsp;หน้าหลัก</span>
					</li>
					</button>
				</a>

				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-cog fa-3x " ></i><span class="text">&nbsp;แก้ไขข้อมูลส่วนตัว</span>
					</li>
					</button>
				</a>

				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-book-open fa-3x " ></i><span class="text">&nbsp;จัดการภาระงานของตน</span>
					</li>
					</button>
				</a>

				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-archive fa-3x " ></i><span class="text">&nbsp;จัดการไฟล์หลักฐาน</span>
					</li>
					</button>
				</a>

				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-info fa-3x " ></i><span class="text">&nbsp;รับทราบข้อตกลง TOR</span>
					</li>
					</button>
				</a>

				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-check-square fa-3x " ></i><span class="text">&nbsp;ประเมินตนเอง</span>
					</li>
					</button>
				</a>

				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
					<li class="list-group-item list-menu-user">
						<i class="icon fas fa-user-check fa-3x " ></i><span class="text">&nbsp;ประเมินการบุคลากร</span>
					</li>
					</button>
				</a>
		
				<a href="#" class="menuuser" data-modules="staff" data-action="2">
					<button class="btn-block">
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