

function loadmain(module1,action){ 

						$.getScript("js/module.js", function() {
							var url = modules(module1 ,action);
							alert(url);
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