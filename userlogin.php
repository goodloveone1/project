<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ระบบประเมิน</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
		<link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.css" >
		<link rel="stylesheet" type="text/css" href="css/home.css?Ver=0001">
		<link rel="stylesheet" type="text/css" href="css/animate.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.0/cropper.min.css">
		<link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>  <!-- DATATABLE  CSS -->

		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.0/cropper.min.js"></script> -->
		<script src="js/loadmain.js?Ver=0001" ></script> <!--FUNCTION LOAD MAIN -->

		
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
			/*box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
			
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
	<body>
		<aside class="text-light" id="mySidenav" style="width:220px;">
			<?php
				webmenu("1","ผู้ดูและระบบ");
			?>
		</aside>
		
		
		<div id="main2" style="margin-left:220px;">
			<!-- MENU -->
			<nav class="navbar navbar-expand-lg navbar-dark bg-Brown " style="height: 50px;">
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
				<div class="dropdown my-2 my-lg-0 mr-1" >
					 <button class="btn btn-sm dropdown-toggle text-light bg-transparent" type="button"  id="dropdownMenuLink99" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20">
						<i class="fas fa-user-tie fa-lg d-inline-block "></i>
						<?php echo $_SESSION['user_fnaem'],"&nbsp;",$_SESSION['user_lnaem'] ?>
					 </button>
					
					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink99">
						<a class="dropdown-item" href="#"><i class="fas fa-user-tie  d-inline-block "></i> ประวัติส่วนตัว</a>
						<a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt  d-inline-block" ></i> ออกจากระบบ</a>
					</div>
				</div>
				<!-- END USER LOGIN -->
				
			</nav>
			<!-- MEUN END -->
			<div class="container-fluid mt-2">
				
					<section class="col-md-12  mt-0 pb-2" id="detail">
						
					</section>
					<footer class="col-md-12 mt-3">
						
					</footer>
			

				<script src="js/jquery-3.3.1.min.js"></script>
				<script src="js/jquery.validate.min.js" ></script>
				<script src="js/additional-methods.min.js" ></script>


				<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
				<script src="bootstrap/js/bootstrap.js" ></script>

				<script type="text/javascript" src="js/DataTables/datatables.min.js"></script> <!-- DATATABLE  JS -->

				<script type="text/javascript" src="https://unpkg.com/popper.js@1.14.3/dist/umd/popper.min.js"></script>

				<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js"></script>				
				<!-- IMGREDER -->
				
				<?php
					$name="ทองดี สุขอิ่นใจ";
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
				
						$(".menuuser").on('click',function(){
							
							module1 = $(this).data('modules');
							action = $(this).data('action');
							loadmain(module1,action);
							
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
				function checksceen(){
					var x = document.getElementById("mySidenav");
					var y = document.getElementById("main2");
					if(window.innerWidth*window.devicePixelRatio <= 770 ){
						if(x.style.width = "0px"){
							x.style.width = "180px";
							y.style.marginLeft = "180px";
							chechopenNav(x,y);
						}else if(x.style.width = "180px"){
							x.style.width = "88px";
							y.style.marginLeft = "88px";
							chechopenNav(x,y);
						}
						
					}else{
						if(x.style.width == "220px"){
							x.style.width = "88px";
							y.style.marginLeft = "88px";
							chechopenNav(x,y);
							
						}else if(x.style.width == "0px"){
								x.style.width = "220px";
								y.style.marginLeft = "220px";
								chechopenNav(x,y);
								
						}else if(x.style.width == "180px"){
								x.style.width = "220px";
								y.style.marginLeft = "220px";
								chechopenNav(x,y);
						
						}else if(x.style.width == "88px"){
								x.style.width = "88px";
								y.style.marginLeft = "88px";
								chechopenNav(x,y);
					}
				}
				}
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
				function openNav2(x,y) {
					/*
					alert(x.style.width);
					alert(y.style.marginLeft);
					alert(window.innerWidth*window.devicePixelRatio);
					*/
					var maxside = "220px";
					var minside = "88px";
					var maxside2 = "180px";
					var minside2 = "88px";
					var iconsizabig1 = " fa-3x ";
					var iconsizasmall1 = " fa-lg";
					var iconsizabig2 = " fa-2x ";
					var iconsizasmall2 = " fa-sm";
					if(window.innerWidth*window.devicePixelRatio <= 770 ){ /* CHECK หน้าจอ น้อยกว่า 770*/
												
						if (x.style.width == maxside2 && y.style.marginLeft == maxside2 || x.style.width == maxside && y.style.marginLeft == maxside) {
							/*
							x.style.width = minside;
							y.style.marginLeft = minside;
							*/
							/*
							var icon = document.getElementsByClassName("icon");
							for(var i=0; i< icon.length; i++) {
							icon[i].classList.remove(iconsizasmall1.trim());
							icon[i].classList.remove(iconsizasmall2.trim());
							icon[i].className += iconsizabig2;
								}
							*/
							$(".icon").removeClass(iconsizasmall1.trim());
							$(".icon").removeClass(iconsizasmall2.trim());
							$(".icon").addClass(iconsizabig2.trim());
							/*
							var text = document.getElementsByClassName("text");
							for(var i=0; i<text.length; i++) {
							text[i].style.display = "none";
							text[i].classList.remove("FontSetSmall");
								}
							*/
							$(".text").css("display","none");
							
							// $(".text").addClass('FontSetSmall');
								/*
							var lefts = document.getElementsByClassName("list-menu-user");
							for(var i=0; i<lefts.length; i++) {
								lefts[i].classList.remove("text-left");
							}
							*/
							$(".list-group-item .text").css("font-size","14px");
							$(".list-menu-user").css("text-align","center");
								if(x.style.width == maxside2)
														return 	minside2;
								else
									return minside;
						}else if(x.style.width == minside2 && y.style.marginLeft == minside2 || x.style.width == minside && y.style.marginLeft == minside){
							/*
							x.style.width = maxside;
							y.style.marginLeft= maxside;
							*/
							/*
							var icon =document.getElementsByClassName("icon");
							for(var i=0; i<icon.length; i++) {
								icon[i].classList.remove(iconsizabig1.trim());
								icon[i].classList.remove(iconsizabig2.trim());
							icon[i].className += iconsizasmall2;
								}
							*/
							$(".icon").removeClass(iconsizabig1.trim());
							$(".icon").removeClass(iconsizabig2.trim());
							$(".icon").addClass(iconsizasmall2.trim());
								/*
							var text = document.getElementsByClassName("text");
							for(var i=0; i<text.length; i++) {
								text[i].style.display = "inline";
								text[i].className += " FontSetSmall";
							}
							*/
							$(".text").css("display","inline-table");
							// $(".text").addClass('FontSetSmall');
							/*
							var lefts = document.getElementsByClassName("list-menu-user");
							for(var i=0; i<lefts.length; i++) {
								lefts[i].className +=" text-left";
							}
							*/
							$(".list-menu-user").css("text-align","left");
							if(x.style.width == minside2)
													return 	maxside2;
							else
													return 	maxside;
						}
					}
					else{ /* หน้าจอ มากกว่า 770*/
						if (x.style.width == maxside && y.style.marginLeft == maxside || x.style.width == maxside2 && y.style.marginLeft == maxside2) {
							/*
							x.style.width = minside;
							y.style.marginLeft = minside;
							*/
							$(".icon").removeClass(iconsizasmall1.trim());
							$(".icon").removeClass(iconsizasmall2.trim());
							$(".icon").addClass(iconsizabig1.trim());
				
							$(".text").css("display","none");
							$(".list-group-item .text").css("font-size","16px");
							$(".list-menu-user").css("text-align","center");
							if(x.style.width == maxside){
								
													return 	minside;
							}
							else{
								
								return  minside2;
							}
								
						}else if(x.style.width == minside && y.style.marginLeft == minside || x.style.width == minside2 && y.style.marginLeft == minside2){
							/*
							x.style.width = maxside;
							y.style.marginLeft= maxside;
							*/
							$(".icon").removeClass(iconsizabig1.trim());
							$(".icon").removeClass(iconsizabig2.trim());
							$(".icon").addClass(iconsizasmall1.trim());
							$(".text").css("display","inline-grid");
							$(".list-menu-user").css("text-align","left");
							if(x.style.width == minside)
													return 	maxside;
							else
								return  maxside2;
						}
					}
				}
				
				/* END MENU SIDE*/
				$('.managetable').DataTable();
				</script>
				<?php
					// Set session variables
					
				?>
			</body>
		</html>