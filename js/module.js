


function modules(module1,action){
	if(module1 != null && action != null){
		var Url ="";
		switch (module1) {
			    case "assessment":break;
			    case "personnel":break;
			    case "public_relations":break;
			    case "download":break;
			   	default: module1 = "404" ;
			}
		

		switch (action) {
			  /* personnel */
			    case "home":break;
			    case "mangauser":break;
			    case "edituser":break; 
			    case "menumanage":break;
			  /* END personnel */
			    case "Criteria_manage":break;
			    case "pr_manage":break;
			    case "download_manage":break;
				case "evidence_manage":break;
				case "managebranch":break;
				case "managesubject":break;
				case "editbranch":break;
				case "editsubjects":break;
				case "formuser":break;
				case "editdegree":break;
				case "managedegree":break;
				case "weight":break;
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



	
