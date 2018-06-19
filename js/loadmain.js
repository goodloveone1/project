

function loadmain(module1,action){ 


						sessionStorage.setItem("module1", module1);
						sessionStorage.setItem("action", action);

						$.getScript("js/module.js", function() {
							var url = modules(module1 ,action);
							$.ajax({
							  type: "POST",
							  url: url,
							  dataType: "text",
							  data : {name:"55555",sure:"666666"},
							  statusCode: {
								    404: function() {
								      alert( "page not found" );
								    }
								  }
							}).done(function(data) {
							  $("#detail").html(data);	
							});
						});
				}