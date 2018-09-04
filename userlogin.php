<?php
	session_start();

	if(empty($_SESSION['user_fnaem']) && empty($_SESSION['user_lnaem'])){

		//echo "<script> alert('กรุณาล็อกอินก่อนใช้งาน!') </script>";
		//echo "<script> window.location='index.php' </script>";

	}

	$basename = "http://localhost/project/";

?>
<!DOCTYPE html>
<html>

	<head>
		<title>ระบบประเมิน</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="<?php echo $basename?>bootstrap/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo $basename?>fontawesome/web-fonts-with-css/css/fontawesome-all.css" >
		<link rel="stylesheet" type="text/css" href="<?php echo $basename?>css/home.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $basename?>css/animate.css">
		
		<link rel="stylesheet" type="text/css" href="<?php echo $basename?>js/DataTables/datatables.min.css"/>  <!-- DATATABLE  CSS -->
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.0/cropper.min.js"></script> -->
		<script src="<?php echo $basename?>js/loadmain.js" ></script> <!--FUNCTION LOAD MAIN -->
		<script src="<?php echo $basename?>js/menushow.js"></script> <!--FUNCTION MENU -->
		<script src="<?php echo $basename?>js/functionjs.js"></script> <!--FUNCTION script -->

		<?php
			require('function/menu.php');
			
		?>
		<style type="text/css">
		aside, #main2 , section#detail{
			box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}
			
			aside {
			height: 100%;
			position: fixed;
			z-index: 1;
			top: 0;
			left: 0;
			overflow-x: hidden;
			padding-top: 10px;
			border: none;
			background-color: #513300;
		
			}
			aside p{
				text-align: center;
			}
			
			
			#main2 {
			border: none;
			margin-left: 88px;
			}
		
			.list-group a{
				text-decoration: none;
			}
			.list-group-item{
				padding: 5px;
				background:transparent;
				border: none;
				text-align: left;
				
			}
			.list-group-item .text{
				text-indent: 1px;
				font-size: 16px;
			}
			
			
			/* COLOR MEMU */
			.bt-color{
				/* background-color:#6c757d; */
				background-color:#67441c;
				color: #EEE;
				border:none;
				border-bottom: solid 1px #EEE;
					}
		</style>
	</head>
	<body id='idbody'>
		<aside class="text-light" id="mySidenav" style="width:220px;">
			<?php

				switch ($_SESSION['user_level']) {
					case '1':
						webmenu("1");
						break;
					case '2':
						webmenu("2");
						break;
					case '3':
						webmenu("3");
						break;		
					
					default:
					
						break;
				}
				
			?>
		</aside>
		
		
		<div id="main2" style="margin-left:220px;">
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
						<a class="navbar-brand mx-auto" href="#">ระบบประเมิน</a>
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
							<a class="dropdown-item" href="javascript:void(0)" class="menuuser" data-modules="personnel" data-action="edituserall"><i class="fas fa-user-tie  d-inline-block "></i> ประวัติส่วนตัว</a>
							<a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt  d-inline-block" ></i> ออกจากระบบ</a>
						</div>
					</li>
				</ul>
				<!-- END USER LOGIN -->
				
			</nav>
			<!-- MEUN END -->
			<div class="container-fluid mt-2">
				
				<section class="col-md-12  mt-0 pb-2" id="detail">
					
				</section>
				<div id='picloading' class="p-lg-5 " style="display: none">
					<img style='display: block;margin-left: auto;margin-right: auto;' src='img/loading.svg'>
				</div>
				<footer class="col-md-12 mt-3">
					
				</footer>
			</div>
		</div>
		<script src="<?php echo $basename?>js/jquery-3.3.1.min.js"></script>
		<script src="<?php echo $basename?>js/jquery.validate.min.js" ></script>
		<script src="<?php echo $basename?>js/additional-methods.min.js" ></script>
		<!-- <script src="bootstrap/js/bootstrap.bundle.min.js" ></script> -->
		<script src="<?php echo $basename?>bootstrap/js/bootstrap.js" ></script>
		<script type="text/javascript" src="<?php echo $basename?>js/DataTables/datatables.min.js"></script> <!-- DATATABLE  JS -->
	
		
		<?php
			//$name="ทองดี สุขอิ่นใจ";
		?>
		<script>


		var module1 = sessionStorage.getItem("module1");
		var action = sessionStorage.getItem("action");
		
		$(document).ready(function() {

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
			
			$(window).bind('beforeunload', function(e) {
			var message = "Why are you leaving?";
			e.returnValue = message;
			return message;
			});
		
			// FISTH LOAD PAGE
			$(window).on('load', function(){
			
				checksceen(); /* MENU SIDE CHECK*/
				loadmain(module1,action);
				
			});
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


	
		
		</script>
		
	</body>
</html>