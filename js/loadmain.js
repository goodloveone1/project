

function loadmain(module1,action){ 


						sessionStorage.setItem("module1", module1);
						sessionStorage.setItem("action", action);

						

						$.getScript("js/module.js", function() {
							var url = modules(module1 ,action);

							$.post( url, { name: "John"})
						  	.done(function( data ) {

						  		$("#detail").html(data);

						
						  });
						  		

						});
				}