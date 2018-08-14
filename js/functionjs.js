function urlwrite(module1,action){
		
		window.history.pushState($data, action, "userlogin-"+module1+"-"+action);
	
}
