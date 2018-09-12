function urlwrite(module1,action){
		
		window.history.pushState("", action, "userlogin-"+module1+"-"+action);
	
}

function loadingpage(module1,action){
					
					setsession(module1,action)
					$("#picloading").show();
					$("#contramain").hide();
	        		// $("#detail").hide();
	        		// $("#footers").hide();
	        		
	        			$.when( loadmain(module1,action) ).done(function( x ) {
	        			setTimeout(function(){
					  	urlwrite(module1,action);
					 	$("#picloading").hide();
		        	  	// $("#detail").show();
		        	  	// $("#footers").show();
		        	  	$("#contramain").show();
		        	  	},1500)	
						});
						
					
	        		
	        		
	        		
	        					
			
}

function loadingpagepost(module1,action,ids){
		
					$("#picloading").show();
	        		$("#detail").hide();
	        		$("#footers").hide();
	        		$.post('module/'+module1+'/'+action+'.php',{id:ids},function(){
					}).done(function(data){
				 		$("#detail").html(data);
					})
	        		urlwrite(module1,action);
	        		setTimeout(function(){
	        			$("#picloading").hide();
		        		$("#detail").show();
		        		 $("#footers").show();
						
					},1500)				
			
}

function setsession(module1,action,id){

	sessionStorage.setItem("module1", module1);
	sessionStorage.setItem("action", action);

}


