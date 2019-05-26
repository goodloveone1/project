<?php
	session_start();

	if(empty($_SESSION['user_fnaem']) || empty($_SESSION['user_lnaem'])){

		echo "<script> alert('กรุณาล็อกอินก่อนใช้งาน!') </script>";
		echo "<script> window.location='index.php' </script>";

	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ระบบประเมิน</title>
		<meta charset="utf-8">
	
		<link rel="icon" type="image/png" sizes="32x32" href="icon/favicon-96x96.png">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
		<link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.css" >
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<link rel="stylesheet" type="text/css" href="css/animate.css">

		<!-- DATATABLE  CSS -->
		<link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
		<link rel="stylesheet" type="text/css" href="js/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css"/>
	
		
		
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/menushow.js"></script> <!--FUNCTION MENU -->
		<script src="js/functionjs.js"></script> <!--FUNCTION script -->
		
		<!-- bootstrap -->		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="bootstrap/js/bootstrap.js" ></script>
		<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js" ></script>
		<!--  CKEDTIL4 -->
		<script src="js/ckeditor/ckeditor.js" ></script> 
		<?php
			require('function/menu.php');
		?>

		<!-- JS ui -->
		<link rel="stylesheet" href="js/jsui/jquery-ui.min.css">
		<script type="text/javascript" src="js/jsui/jquery-ui.min.js"></script>

		<!-- canvasjs -->
		<script type="text/javascript" src="js/canvasjs/jquery.canvasjs.min.js"></script>
		
	</head>
	<body id='idbody'>
		<aside class="text-light" id="mySidenav" style="width:228px;">

			<div class="row ">
				<div class='col-auto mx-auto'><i class="fas fa-user-circle fa-3x"></i> </div>
			</div>
			<div class="row d-flex mb-2">
				<div class="col-auto mx-auto flex-shrink-1 text-center"> ยินดีต้อนรับ <?php echo $_SESSION['permiss_decs'] ?> </div>
			</div>
			<?php


	webmenu($_SESSION['user_level']);


			?>
		</aside>


		<div id="main2" style="margin-left:228px;">
			<!-- MENU -->
			<nav class="navbar navbar-expand-lg navbar-dark bg-Brown sticky-top" style="height: 50px;">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item active" id="usermenu">
						<a class="nav-link" href="javascript:void(0)"  ><i class="fas fa-bars" ></i> เมนู <span class="sr-only">(current)</span></a>
					</li>
				</ul>
				<!-- BAND CENTER -->
				<ul class="nav navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a class="navbar-brand mx-auto" href="javascript:void(0)" id='nameMain'>ระบบจัดการบริหารการประเมินผลการปฏิบัติงาน</a>
					</li>
				</ul>
				<!-- END BAND CENTER -->
				<!-- USER LOGIN -->
				<ul class="nav navbar-nav my-2 my-lg-0 mr-1">

					<li class="nav-item dropdown">
						<button class="btn btn-sm dropdown-toggle text-light bg-transparent" type="button"  id="dropdownMenuLink99" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
						<i class="fas fa-user-tie fa-lg d-inline-block "></i>
						<?php echo $_SESSION['user_fnaem'],"&nbsp;",$_SESSION['user_lnaem'] ?>
						</button>

						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink99">
							<a class="dropdown-item menuuser" href="javascript:void(0)" data-modules="personnel" data-action="edituserall"><i class="fas fa-user-tie  d-inline-block "></i> ประวัติส่วนตัว</a>
							<a  href="javascript:void(0)"class="dropdown-item"  onclick='swal({
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
});'><i class="fas fa-sign-out-alt  d-inline-block" ></i> ออกจากระบบ</a>
						</div>
					</li>
				</ul>
				<!-- END USER LOGIN -->

			</nav>
			<!-- MEUN END -->
			<div class="container-fluid mt-2" id="contramain">

				<section class="col-md-12  mt-0 pb-2" id="detail">

				</section>
				<button onclick="topFunction()" id="myBtn" title="Go to top">^</button>
				<footer id="footers" class="col-md-12 mt-3">

				</footer>
			</div>
			<div id='picloading' style="display: none;"><img style='display: block;margin:12% auto; ' src='img/loading.svg'></div>
		</div>
	
		<?php //validate ?>
		<script src="js/validate/jquery.validate.min.js" ></script>
		<script src="js/validate/additional-methods.min.js" ></script>
		<script src="js/validate/localization/messages_th.min.js" ></script>
		<script src="js/validateSetdef.js" ></script> 
		<?php //END validate ?>	
	
		<!-- Sweetalert -->
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

		<!-- DATATABLE -->
		<script type="text/javascript" src="js/DataTables/datatables.min.js"></script>
		<script type="text/javascript" src="js/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>

		

	

		<script>
			window.onscroll = function() {scrollFunction()};
			function scrollFunction() {
				if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
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
		$(document).ready(function() {

			if(sessionStorage.getItem("module1")=="" || sessionStorage.getItem("action")=="" ){
				var module1 = "personnel"
				var action = "home"
			}else{
				var module1 = sessionStorage.getItem("module1");
				var action = sessionStorage.getItem("action");
			}

			checksceen(); /* MENU SIDE CHECK*/
			loadmain(module1,action);

			$('[data-toggle="tooltip"]').tooltip();  

			$("#menuaside li").hover(function() {

			}, function() {
				/* Stuff to do when the mouse leaves the element */
			});
			
			$("#usermenu").click(function(){
				openNav();
			});

				$("#idbody").on('click',".menuuser",function(e){
					e.preventDefault();
					module1 = $(this).data('modules');
					action = $(this).data('action');
				
					loadingpage(module1,action); //code local functionjs.js

				});

			/* ANIMATION*/
			$.fn.extend({
				animateCss: function(animationName, callback) {
				var animationEnd = (function(el) {
				var animations = {
				animation: 'animationend',
				OAnimation: 'oAnimationEnd',
				MozAnimation: 'mozAnimationEnd',
				WebkitAnimation: 'webkitAnimationEnd',
				};
				for (var t in animations) {
				if (el.style[t] !== undefined) {
				return animations[t];
				}
				}
				})(document.createElement('div'));
				this.addClass('animated ' + animationName).one(animationEnd, function() {
				$(this).removeClass('animated ' + animationName);
				if (typeof callback === 'function') callback();
				});
				return this;
				},
				});
			/* END ANIMATION*/


			/* script HOVER MENU  COVER CSS .bg-color*/
				$(".bt-color").hover(function() {
					/* Stuff to do when the mouse enters the element */
					$(this).css("color",'#aaa');
				}, function() {
					/* Stuff to do when the mouse leaves the element */
					$(this).css("color",'#EEE');
				});
			/* END script HOVER MENU */

		});

		function chechopenNav(x,y){
			z = openNav2(x,y);
			x.style.width = z.trim();
			y.style.marginLeft = z.trim();
		}

		window.addEventListener("resize", function() {

			checksceen();
			checkMainname()

		});
		function openNav(){
			var x = document.getElementById("mySidenav");
			var y = document.getElementById("main2");
			var z ="";
			z = openNav2(x,y);
				/*alert(z);*/
				if (z != undefined) {
				x.style.width = z.trim();
				y.style.marginLeft = z.trim();
			}
		}

		function checkMainname(){
			if(window.innerWidth*window.devicePixelRatio <= 800 ){
				
				$("#nameMain").text("ระบบการประเมินผล");
			}else{
				$("#nameMain").text("ระบบจัดการบริหารการประเมินผลการปฏิบัติงาน");
			}
		}

		</script>

</body>
</html>
