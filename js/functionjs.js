function urlwrite(module1,action){
		
		window.history.pushState("", action, "userlogin-"+module1+"-"+action);
	
}


function loadmain(module1,action){ 

	sessionStorage.setItem("module1", module1);
	sessionStorage.setItem("action", action);

	$.getScript("js/module.js",function(){
		var url = modules(module1,action);

		$.post( url, { name: "John"})
		  .done(function( data ) {

			  $("#detail").html(data);

	
	  });


	})
		
			  


}

function loadingpage(module1,action){
					
					setsession(module1,action)
					$("#picloading").show();					
					$("#contramain").hide();
					$("#detail").html("");
	        		// $("#detail").hide();
	        		// $("#footers").hide();
	        		
	        			
	        			setTimeout(function(){
						  urlwrite(module1,action);
						  loadmain(module1,action);
					 	$("#picloading").hide();
		        	  	// $("#detail").show();
		        	  	// $("#footers").show();
		        	  	$("#contramain").show();
		        	  	},1500)	
				
						
	
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


