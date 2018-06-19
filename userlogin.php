<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
		<link rel="stylesheet" href="fontawesome/web-fonts-with-css/css/fontawesome-all.css" >
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<link rel="stylesheet" type="text/css" href="css/animate.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.0/cropper.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.4.0/cropper.min.js"></script>
		 <script src="js/loadmain.js"></script> <!--FUNCTION LOAD MAIN -->
		<?php
			require('function/menu.php');
		?>
		<style type="text/css">
			
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
			
			.list-group  span.text{
				display: none;
			}
			.list-group a{
				text-decoration: none;
			}
			.list-group-item{
				padding: 5px;
				background:transparent;
				border: none;
			}
			.list-group-item .text{
				text-indent: 1px;
			}

			section#detail{
				box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); 
			}


			.icon{
				text-align: center;
			}
			.FontSetBig{
				font-size: 18px;
			}
			.FontSetSmall{
				font-size: 14px;
			}
			.icon , .FontSetBig ,.FontSetSmall{
				transition: .3s ease-in-out;
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
		<?php 
				$module = empty($_GET['modules'])?'personnel':$_GET['modules'];
				$action = empty($_GET['action'])?'home':$_GET['action'];
		
		?>

	</head>
	<body>
		<aside class="text-light" id="mySidenav" style="width:88px;">
			
			
			<?php
				webmenu("1","ผู้ดูและระบบ");
			?>
			
			
		</aside>
		
		
		<div id="main2" style="margin-left:88px;">
			<!-- MENU -->
			<nav class="navbar navbar-expand-lg navbar-dark bg-Brown">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item active" id="usermenu">
						<a class="nav-link" href="#"  ><i class="fas fa-bars" ></i> เมนู <span class="sr-only">(current)</span></a>
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
				<div class="dropdown my-2 my-lg-0 " >
					<a class="btn btn-sm dropdown-toggle text-light" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 16px;">
						<i class="fas fa-user-tie fa-lg d-inline-block "></i>
						ทองดี สุขอิ่นใจ
					</a>
					
					<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						<a class="dropdown-item" href="#"><i class="fas fa-user-tie fa-md d-inline-block "></i> ประวัติส่วนตัว</a>
						<a class="dropdown-item" href="index.php"><i class="fas fa-sign-out-alt fa-md d-inline-block" ></i> ออกจากระบบ</a>
					</div>
				</div>
				<!-- END USER LOGIN -->
				
			</nav>
			<!-- MEUN END -->
			<div class="container-fluid mt-2">
				<div class="row">
					<section class="col-md-12 pt-2 pb-2" id="detail">
						
					</section>
					<footer class="col-md-12 mt-3">
						
					</footer>
				</div>
		
			
			
			
			
			<script
			src="https://code.jquery.com/jquery-3.3.1.min.js"
			integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
			<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
			<script src="bootstrap/js/bootstrap.js" ></script>

			
			<?php 
				$name="ทองดี สุขอิ่นใจ";
			?>

			<script>
				var modules = '<?php echo $module; ?>'
				var action = '<?php echo $action; ?>'


			$(document).ready(function() {
				$("#usermenu").click(function(){
					openNav();
				});

				/* CLICK MENU */
				
				$(".menuuser").on('click',loadmain(modules,action));

				/* ANIMATION*/
					/* ANIMATION USE */

					$(".menuuser").on('click',function(){
						$('#detail').animateCss('fadeIn');
					});
					/* END ANIMATION USE */
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

			
				// FISTH LOAD PAGE
				$(window).on('load', function(){
				    // your logic here`enter code here`
				    
					checksceen(); /* MENU SIDE CHECK*/
					
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
					if(x.style.width = "0px")
					x.style.width = "180px";
					y.style.marginLeft = "180px";
					chechopenNav(x,y);
				}else{
					if(x.style.width == "220px"){
						x.style.width = "0px";
						y.style.marginLeft = "0px";
						chechopenNav(x,y);
						
					}else if(x.style.width == "0px"){
							x.style.width = "220px";
							y.style.marginLeft = "220px";
							chechopenNav(x,y);
							
					}else if(x.style.width == "180px"){
							x.style.width = "220px";
							y.style.marginLeft = "220px";
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
				var minside2 = "0px";
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
						$(".text").addClass('FontSetSmall');
							/*
						var lefts = document.getElementsByClassName("list-menu-user");
						for(var i=0; i<lefts.length; i++) {
							lefts[i].classList.remove("text-left");
						}
						*/
						$(".list-menu-user").removeClass("text-left");
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
						$(".text").addClass('FontSetSmall');
						/*
						var lefts = document.getElementsByClassName("list-menu-user");
						for(var i=0; i<lefts.length; i++) {
							lefts[i].className +=" text-left";
						}
						*/
						$(".list-menu-user").addClass("text-left");
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
						/*
						var icon = document.getElementsByClassName("icon");
						for(var i=0; i< icon.length; i++) {
						icon[i].classList.remove(iconsizasmall1.trim());
						icon[i].classList.remove(iconsizasmall2.trim());
						icon[i].className += iconsizabig1;
							}
						*/
						$(".icon").removeClass(iconsizasmall1.trim());
						$(".icon").removeClass(iconsizasmall2.trim());
						$(".icon").addClass(iconsizabig1.trim());
						/*
						var text = document.getElementsByClassName("text");
						for(var i=0; i<text.length; i++) {
							text[i].style.display = "none";
							text[i].classList.remove("FontSetSmall");
						}
						*/
						$(".text").css("display","none");
						$(".text").removeClass('FontSetSmall');
						/*
						var lefts = document.getElementsByClassName("list-menu-user");
						for(var i=0; i<lefts.length; i++) {
							lefts[i].classList.remove("text-left");
						}
						*/
						$(".list-menu-user").removeClass("text-left");
						if(x.style.width == maxside)
										return 	minside;
						else
							return  minside2;
					}else if(x.style.width == minside && y.style.marginLeft == minside || x.style.width == minside2 && y.style.marginLeft == minside2){
						/*
						x.style.width = maxside;
						y.style.marginLeft= maxside;
						*/
						/*
						var icon =document.getElementsByClassName("icon");
						
						for(var i=0; i<icon.length; i++) {
							icon[i].classList.remove(iconsizabig1.trim());
							icon[i].classList.remove(iconsizabig2.trim());
						icon[i].className += iconsizasmall1;
							}
						var text = document.getElementsByClassName("text");
						for(var i=0; i<text.length; i++) {
							text[i].style.display = "inline";
							text[i].classList.remove("FontSetSmall");
						}
						var lefts = document.getElementsByClassName("list-menu-user");
						for(var i=0; i<lefts.length; i++) {
							lefts[i].className +=" text-left";
						}
						*/
						$(".icon").removeClass(iconsizabig1.trim());
						$(".icon").removeClass(iconsizabig2.trim());
						$(".icon").addClass(iconsizasmall1.trim());
						$(".text").css("display","inline-grid");
						$(".text").removeClass('FontSetSmall');
						$(".list-menu-user").addClass("text-left");
						if(x.style.width == minside)
										return 	maxside;
						else
							return  maxside2;
					}
				}
			}
			
			/* END MENU SIDE*/
			</script>
		</body>
	</html>