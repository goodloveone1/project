

function loadmain(module1,action){ 


						sessionStorage.setItem("module1", module1);
						sessionStorage.setItem("action", action);

						$.getScript("js/module.js", function() {
							var url = modules(module1 ,action);
							
							/*
							$.ajax({
							  type: "POST",
							  url: url,
							  dataType: "json",
							  data : {name:"55555", testdata :"344"},
							  statusCode: {
								    404: function() {
								      alert( "page not found" );
								    }
								  }
							}).done(function(data) {
							  $("#detail").html(data);	
							});
							*/
							$.post( url, { name: "John"})
						  	.done(function( data ) {
						     
						      $('#detail').animateCss('fadeOut',function(){ /* ANIMATION USE */
						      	$("#detail").html(data)
								 $('#detail').animateCss('fadeIn')	
							}); 
						  });
						});
				}