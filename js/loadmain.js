

function loadmain(module1,action){ 


						sessionStorage.setItem("module1", module1);
						sessionStorage.setItem("action", action);

						

						$.getScript("http://localhost/project/js/module.js", function() {
							var url = modules(module1 ,action);
							
							
							$.post( url, { name: "John"})
						  	.done(function( data ) {

						      $('#detail').animateCss('fadeOut',function(){ /* ANIMATION USE */
						      	$("#detail").html(data);
								 $('#detail').animateCss('fadeIn'); 	
								});
						  });
						});
				}