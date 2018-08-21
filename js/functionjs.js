function urlwrite(module1,action){
		
		window.history.pushState("", action, "userlogin-"+module1+"-"+action);
	
}
