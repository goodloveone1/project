<div class="row">
	<div class="col-md-12">
	<h2 class="headtitle p-2 text-center"> ข่าวประชาสัมพันธ์ </h2> 
		<div class="list-group" id='testna'>
		  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
		    <div class="d-flex w-100 justify-content-between">
		      <h5 class="mb-1">List group item heading</h5>
		      <small>3 days ago</small>
		    </div>
		    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
		    <small>Donec id elit non mi porta.</small>
		  </a>
		  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
		    <div class="d-flex w-100 justify-content-between">
		      <h5 class="mb-1">List group item heading</h5>
		      <small class="text-muted">3 days ago</small>
		    </div>
		    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
		    <small class="text-muted">Donec id elit non mi porta.</small>
		  </a>
		  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
		    <div class="d-flex w-100 justify-content-between">
		      <h5 class="mb-1">List group item heading</h5>
		      <small class="text-muted">3 days ago</small>
		    </div>
		    <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
		    <small class="text-muted">Donec id elit non mi porta.</small>
		  </a>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#testna").on('hover', 'a', function(event) {
		event.preventDefault();
		/* Act on the event */
		alert("HOVER!!!")
		$(this).addClass('active');
	});
</script>
