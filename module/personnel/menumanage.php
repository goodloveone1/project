<link rel="stylesheet" type="text/css" href="css/mainmg.css">
<div class="row  p-2 headtitle">
	<h2 class="text-center col-md "> จัดการบุคลากร </h2>
</div>
<div class="row mt-5">
	<div class="col-md">
	
			<a href="javascript:void(0)" class="text-center maninuser" data-modules="personnel" data-action="mangauser" >
				<div class="col-md">
					<i class="fas fa-user-tie fa-7x mt-3"></i>
				</div>
				<div class="col-md">
					<span class=""> จัดการบุคลากร</span>
				</div>
			</a>
	
	</div>
	<div class="col-md">
	
			<a href="javascript:void(0)" class="text-center maninuser" data-modules="personnel" data-action="managebranch">
				<div class="col-md">
					<i class="fas fa-user-tie fa-7x mt-3"></i>
				</div>
				<div class="col-md">
					<span class="col-md">  จัดการหลักสูตร</span>
				</div>
			</a>
		
	</div>
</div>
<div class="row mt-5">
	<div class="col-md">
	
			<a href="javascript:void(0)" class="text-center maninuser" data-modules="personnel" data-action="managesubject">
				<div class="col-md">
					<i class="fas fa-user-tie fa-7x mt-3"></i>
				</div>
				<div class="col-md">
					<span class="col-md">จัดการสาขา </span>
				</div>
			</a>
	</div>
	<div class="col-md">
	
			<a href="javascript:void(0)" class="text-center maninuser" data-modules="managedegree" data-action="managesubject">
				<div class="col-md">
					<i class="fas fa-user-tie fa-7x mt-3"></i>
				</div>
				<div class="col-md">
					<span class="col-md">จัดการวุฒิการศึกษา </span>
				</div>
			</a>
	
	</div>
</div>
<script type="text/javascript">
		$(document).ready(function() {
			$("a.maninuser").click(function(){
				var module1 = $(this).data('modules');
				var action = $(this).data('action');
				loadmain(module1,action)
			});
		});
</script>