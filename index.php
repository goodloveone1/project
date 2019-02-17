<!DOCTYPE html>
<html>
	<head>
		<title>ระบบประเมิน</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
		<link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.css" >
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<script src="js/jquery-3.3.1.min.js"></script>
	</head>
	
	<body>
		<!-- เมนู -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-Brown sticky-top">
			<div class="container">
				
				<a class="navbar-brand" href="#">
					<img src="img/rmutl-web-logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
				ระบบประเมิน</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="index.php?page"><i class="fas fa-home"></i> หน้าแรก <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								เกี่ยวกับ
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="index.php?page=history" >ความเป็นมา</a>
								<a class="dropdown-item" href="index.php?page=philosophy">วิสัยทัศน์/ปรัชญา/พันธกิจ</a>
								<!--<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>-->

							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#" >ผังการบริหาร</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								ดาวน์โหลด
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#" >อาจารย์</a>
								<a class="dropdown-item" href="#">ผู้ช่วยศาสตราจารย์</a>
								<a class="dropdown-item" href="#">รองศาสตราจารย์</a>
								<a class="dropdown-item" href="#">ศาสตราจารย์</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">ไฟล์ที่เกี่ยวข้อง </a>
							</div>
						</li>
						
					</ul>
					
					<ul class="navbar-nav">
						<li class="nav-item">
							<a class="nav-link my-2 my-lg-0" href="javascript:void(0)" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-user-tie" style="font-size:24px;"></i> เข้าสู่ระบบ</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END เมนู -->
		<div class="container clearfix" id="main" style="">
			<div class="row">
		<!-- banner-->
				<header class="col-sm-12">
				<br>
				<!-- <img src="https://bala.rmutl.ac.th/assets/img/website-logo-th.jpg" alt="โลโก้เว็บไซต์ คณะบริหารธุรกิจและศิลปศาสตร์" class="img-fluid" style="margin:0;"> -->
				<img src="img/banner.jpg" alt="โลโก้เว็บไซต์ คณะบริหารธุรกิจและศิลปศาสตร์" class="img-fluid" style="margin:0;">
				
				</header>
				
		<!--main -->

				<div class="col-md-12">
					<br>
				<?php
					if(empty($_GET['page'])){
						$page="history"; 
					}else{
						$page=$_GET['page']; 
					}
					include("$page.html"); 
				?>
				
				<button onclick="topFunction()" id="myBtn" title="Go to top">^</button>
   				</div>
		<!--footer -->		
				<footer class="col-sm-12">
					<p>Copyright สาขาระบบสารสนเทศทางคอมพิวเตอร์</p>
					<p> <a href="https://www.rmutl.ac.th"target="_blank">มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา
					</a>: 128 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่ 50300</p>
					<p>โทรศัพท์ : 0 5392 1444 , โทรสาร : 0 5321 3183.</p>
					 
				</footer>
			</div>
			
		</div>
		<!-- MODEL LOGIN  -->
		<form class="form-control" id="logins" action="checklogin.php" method="post">
		<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" >
					<div class="modal-header bg-Brown" >
						<h5 class="modal-title" id="exampleModalCenterTitle">เข้าสู่ระบบ</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fas fa-times" style="color: #EEE;"></i></span>
						</button>
					</div>
					<div class="modal-body">
						
							<div class="input-group mb-3">
								
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="user" required>
							</div>
							<div class="input-group mb-3">
							
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock"></i></span>
								</div>
								<input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="pwd" required>
							</div>
				    </div>
					<div class="modal-footer bg-Brown" >
						<button type="submin" class="btn btn-primary" id="">เข้าสู่ระบบ</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" >ยกเลิก</button>
						
					</div>
				</div>
			</div>
		</div>
		</form>
		<!-- END MODEL LOGIN  -->
		
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="bootstrap/js/bootstrap.min.js" ></script>

	
		<!--black to top Menu -->
<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>
		
	</body>
</html>