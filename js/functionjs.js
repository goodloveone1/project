function urlwrite(module1,action){
		
		window.history.pushState("", action, "userlogin-"+module1+"-"+action);
	
}

function loadingpage(module1,action){
	

					$(document).ajaxStart(function() {
						$("#picloading").show();
		        		$("#detail").hide();
		        		loadmain(module1,action);
		        		urlwrite(module1,action);
	        		});

					$(document).ajaxComplete(function(event, xhr, settings) {
						$("#picloading").hide();
		        		$("#detail").show();
					});
					
					 // $("#picloading").show();
	    //     		$("#detail").hide();
	    //     		loadmain(module1,action);
	    //     		urlwrite(module1,action);
	    //     		setTimeout(function(){
	    //     			$("#picloading").hide();
		   //      		$("#detail").show();
						
					// },1500)				
						
	
}


