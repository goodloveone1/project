

function loadmain(module1,action,idbranch){ 


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
							$.post( url, { name: "John", s_id : idbranch })
						  	.done(function( data ) {
						      $("#detail").html(data);	
						  });
						});
				}