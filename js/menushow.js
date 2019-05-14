	var maxside = "228px";
	var minside = "88px";
	var maxside2 = "180px";
	var minside2 = "88px";
	var iconsizabig1 = " fa-3x ";
	var iconsizasmall1 = " fa-lg";
	var iconsizabig2 = " fa-2x ";
	var iconsizasmall2 = " fa-sm";



	function checksceen(){
			var x = document.getElementById("mySidenav");
			var y = document.getElementById("main2");
			if(window.innerWidth*window.devicePixelRatio <= 770 ){
				
				if(x.style.width = "0px"){
					x.style.width = maxside2;
					y.style.marginLeft = maxside2;
					chechopenNav(x,y);
				}else if(x.style.width = maxside2){
					x.style.width = minside;
					y.style.marginLeft = minside;
					chechopenNav(x,y);
				}
				
			}else{
		
				if(x.style.width == maxside){
					x.style.width = minside;
					y.style.marginLeft = minside;
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



	function openNav2(x,y) {
			
			
			if(window.innerWidth*window.devicePixelRatio <= 770 ){ /* CHECK หน้าจอ น้อยกว่า 770*/
										
				if (x.style.width == maxside2 && y.style.marginLeft == maxside2 || x.style.width == maxside && y.style.marginLeft == maxside) {
					
					$(".icon").removeClass(iconsizasmall1.trim());
					$(".icon").removeClass(iconsizasmall2.trim());
					$(".icon").addClass(iconsizabig2.trim());
					
					$(".text").css("display","none");
					
					$(".list-group-item .text").css("font-size","14px");
					$(".list-menu-user").css("text-align","center");
						if(x.style.width == maxside2)
													return 	minside2;
						else
							return minside;
				}else if(x.style.width == minside2 && y.style.marginLeft == minside2 || x.style.width == minside && y.style.marginLeft == minside){
					
					$(".icon").removeClass(iconsizabig1.trim());
					$(".icon").removeClass(iconsizabig2.trim());
					$(".icon").addClass(iconsizasmall2.trim());
					
					$(".text").css("display","inline-table");
					
					$(".list-menu-user").css("text-align","left");
					if(x.style.width == minside2)
												return 	maxside2;
					else
												return 	maxside;
				}
			}
			else{ /* หน้าจอ มากกว่า 770*/
				if (x.style.width == maxside && y.style.marginLeft == maxside || x.style.width == maxside2 && y.style.marginLeft == maxside2) {
					
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
		
