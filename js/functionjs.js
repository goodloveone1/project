function urlwrite(module1,action){
		
		window.history.pushState("", action, "userlogin-"+module1+"-"+action);
	
}

function loadingpage(module1,action){
		
					$("#picloading").show();
	        		$("#detail").hide();
	        		loadmain(module1,action);
	        		urlwrite(module1,action);
	        		setTimeout(function(){
	        			$("#picloading").hide();
		        		$("#detail").show();
						
					},1500)				
			
}

function loadingpagepost(module1,action,id){
		
					$("#picloading").show();
	        		$("#detail").hide();
	        		$.post('module/assessment/'+action+'.php',function(){
					}).done(function(data){
				 		$("#detail").html(data);
					})
	        		urlwrite(module1,action);
	        		setTimeout(function(){
	        			$("#picloading").hide();
		        		$("#detail").show();
						
					},1500)				
			
}


