


function modules(module1,action){
	if(module1 != undefined && action != undefined){
		var Url ="";
		switch (module1) {
			    case "assessment":break;
			    case "personnel":break;
			    case "public_relations":break;
			    case "download":break;
			   	default: module1 = "404" ;
			}
		

		switch (action) {
			    case "home":break;
			    case "mangauser":break;
			    case "edituser":break;
			    case "Criteria_manage":break;
			    case "pr_manage":break;
			    case "download_manage":break;
			    case "evidence_manage":break;
			   	default: action = "404";  
			}

		if(module1 == "404" || action == "404"){
				Url = "module/404/404.php";
		}else{
				Url = "module/"+module1+"/"+action+".php";
		}
			
			return Url;
	}else{
		return "module/personnel/home.php";
	}

	
	}



	
