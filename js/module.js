


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


		switch (action){
			  /* personnel */
			    case "home":break;
			    case "mangauser":break;
			    case "edituser":break;
			    case "menumanage":break;
			  /* END personnel */
			  /* assessment */
			    case "Criteria_manage_tor1":break;
			    case "Criteria_manage_tor2":break;
			    case "Criteria_manage_tor2sub":break;
			    case "evidence_manage":break;
			    case "menuassm":break; // mainmenu
			    case "formtea_agree":break; //
			    case "formreport_prm":break; //
			    case "main_assess":break;
					case "manage_tor":break;
					case "sum_assessment":break;
					case "manage_Evidence":break;
					case "Indicator":break;
					case "manage_asmIn":break;
					case "manage_record":break;
					case "manage_record_ad":break;
			 /* END assessment */
			 	case "download_manage":break;
			  case "pr_manage":break;
				case "managebranch":break;
				case "managesubject":break;
				case "editbranch":break;
				case "editsubjects":break;
				case "formuser":break;
				case "editdegree":break;
				case "managedegree":break;
				case "manage_Ass":break;
				case "weight":break;
				case "year":break;
				case "editwidght":break;
				case "edituserall":break;
				case "evaluation":break;
				case "test_tor_stepBystep":break;
				case "pretest_tor":break;
				case "ass_form":break;
				case "ass_t1":break;
				case "ass_t2":break;
				case "ass_t3":break;
				case "ass_t4":break;
				case "ass_t5":break;
				case "ass_t6":break;
				case "tor1_pretest":break;
				case "tor2_pretest":break;
				case "tor3_pretest":break;
				case "tor4_pretest":break;
				case "min_hour_work":break;
				case "edit_tor1":break;
				case "edit_tor2":break;
				case "edit_tor3":break;
				case "edit_tor4":break;
				case "edit_tor5":break;
				case "edit_tor6":break;
				case "addtata_ass":break;
				case "adddata_tor":break;
				case "adddata_tor1":break;
				case "adddata_tor2":break;
				case "adddata_tor3":break;
				case "adddata_tor4":break;
				case "adddata_tor5":break;
				case "check_tor":break;
				case "edit_tor":break;
				case "update_tor":break;
				case "update_tor2":break;
				case "editformreport_prm":break;
				case "manage_Evidence_course":break;
				case "sum_asmIn":break;

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
