function urlwrite(module1,action){
		
		window.history.pushState("", action, "userlogin-"+module1+"-"+action);
	
}

function loadingpage(module1,action){
	$("#detail").html("<img style='display: block;margin-left: auto;margin-right: auto;' src='img/loading.svg'>")
					setTimeout(function(){
						loadmain(module1,action);
						urlwrite(module1,action);			
						
	} ,3000);
}
