
<div class="mt-4">
	<a  href="" class="text-muted float-right" ><span class="fa fa-angle-left"></span> Back</a>
	<h4>Profiling</h4>
	<div class="row mt-3">
		
		<div class="col-md-12">
			<div class="float-left">
				<ul class="list-inline nav-tabs nav border-0">
					<li class="list-inline-item"><a class="text-muted cursor-pointer active " data-toggle="tab" href="#pnl-h"><span class="fa fa-diagnoses small"></span> Reviews</a></li>
					<li class="list-inline-item"><a class="text-muted cursor-pointer" data-toggle="tab" href="#pnl-s"><span class="fa fa-table small"></span> Summary / Graph</a></li>
					<li class="list-inline-item"><a class="text-muted cursor-pointer" id="btn-ref-mem-gr"><span class="fa fa-th small"></span> Show All</a></li>
					<li class="list-inline-item"><a class="text-muted cursor-pointer" id="btn-add-mem-gr"><span class="fa fa-plus small"></span> Information</a></li>
				</ul>
			</div>
			<select id="ld-year-opt-slct" class="input-none float-right" style="border: none; width: 50px !important; margin-top:-1vh;"></select>	
		</div>
	</div>
	<div class="tab-content pt-2">
		<div class="tab-pane active" id="pnl-h">
			<div class="row ">
				<div class="col-md-3">
					<div class="card bg-warning text-white cursor-pointer mb-2" id="btn-o-yt">
						<div class="card-body">
							<h4 id="ld-osy-txt-b"></h4>
							<div class="card-text">Out of school youth</div>
						</div>
						
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-primary text-white cursor-pointer mb-2" id="btn-u-yt">
						<div class="card-body">
							<h4 id="ld-uem-txt-b"></h4>
							<div class="card-text">Unemployed</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-success text-white cursor-pointer mb-2" id="btn-t-yt">
						<div class="card-body">
							<h4 id="ld-tep-txt-b"></h4>
							<div class="card-text">Tennage Pregnancy</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card bg-danger text-white cursor-pointer mb-2" id="btn-i-yt">
						<div class="card-body">
							<h4 id="ld-iny-txt-b"></h4>
							<div class="card-text">Indigenous youth</div>
						</div>
						
					</div>
				</div>
			</div>
												
			<div class="row mt-2">
				<div class="col-md-12">
					<div class="">
						<div class="table-responsive" id="ld-tble-pre-by-sadmn-y"></div>
						<div id="ld-dtls" class="mt-1"></div>
					</div>
				</div>
			</div>

		</div>
		<div class="tab-pane" id="pnl-s">
			<div class="table-responsive">
				<table class="table table-hover table-condensed table-sm borderless" id="table-year-num">
					<thead>
						<tr>
							<td>Year</td>
							<td class="text-center">Out of school youth</td>
							<td class="text-center">Unemployed</td>
							<td class="text-center">Teenage Pregnancy</td>
							<td class="text-center">Indigenous youth</td>
						</tr>
					</thead>
				</table>
				
			</div>
		</div>
	</div>
	
	<div class="modal draggable" id="mdl-prof-cntrl">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">

					
					<p class="h5">Information </p>
					<a href="#" data-dismiss="modal" class="close float-right">&times;</a>
				</div>
				<div class="modal-body">
					<div id="msg-alert-profile"></div>
					<form method="post" id="frm-profiling">
						<div class="form-group row">
							<div class="col-md-6">
								<label>Firstname</label>
								<input type="text" name="fname" id="fname" class="form-control" required data-parsley-pattern="^(?:[A-Za-z]+[ -]*[A-Za-z])+$" data-parsley-trigger="keyup">
							</div>
							<div class="col-md-6">
								<label>Lastname</label>
								<input type="text" name="lname" class="form-control" required data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-2">
								<label>Age</label>
								<input type="text" name="age" class="form-control" required data-parsley-type="number" data-parsley-trigger="keyup">
							</div>
							<div class="col-md-6">
								<label>Gender</label>
								<select name="gender" class="form-control" required data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup">
									<option value="" selected="">--Select Gender--</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
							<div class="col-md-4">
								<label>Year Register</label>
								<input type="text" name="year" class="form-control" value="<?php echo date('Y') ?>" required data-parsley-type="number" data-parsley-trigger="keyup">
							</div>
						</div>

						<div class="form-group ">
							<label>Description</label>
							<div class="row">
								<div class="col-sm-6">
									<ul class="list-unstyled">
									<li><input type="radio" name="descr" value="O" checked=""> Out of school</li>
									<li><input type="radio" name="descr" value="U"> Unemployed</li>
									
									</ul>
								</div>
								<div class="col-sm-6">
									<ul class="list-unstyled">
									<li><input type="radio" name="descr" value="T"> Teenage Pregnancy</li>
									<li><input type="radio" name="descr" value="I"> Indigenous</li>
									</ul>
								</div>
							</div>			
						</div>
						<div class="form-group">

							<input type="hidden" name="groupid" id="ld-groupid-holder">
							<input type="hidden" name="action" value="letaddthenewprofilingsubmitbysadmin">
							<input type="submit" class="btn btn-md btn-primary" value="Submit">
							<a class="btn btn-md btn-default cursor-pointer" id="btn-reset-from-ds">Reset</a>
						</div>
					</form>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(()=>{
	const pid = getUrlParameters()["pid"];
	

	$(document).on('click', '#btn-add-mem-gr', function(){
		$('#ld-groupid-holder').val(pid);
		$('#mdl-prof-cntrl').modal({
			backdrop:'static',
			keyboard: false,
			 handle: ".modal-header"
		});

	});


	$('#btn-ref-mem-gr').click(()=>{
		loadtheprofilenumberofinfobasepagetable(pid, $('#ld-year-opt-slct option:selected').val(), 'all');
	});

	$(document).on('change', '#ld-year-opt-slct', function(){
		var op = $('#ld-year-opt-slct option:selected').val();
		loadthecountfromosyetchfromsadminbygrp(pid, $('#ld-year-opt-slct option:selected').val());
		loadtheprofilenumberofinfobasepagetable(pid, $('#ld-year-opt-slct option:selected').val(), 'all');
	});



	let loadtheyearbydisticttheuseradminbygroup = async (id)  => await $.post('function/function.php', {load:'loadtheprofilenumberofinfobasepage', pid:id, parse:'getYear'}, function(data){
		$('#ld-year-opt-slct').empty();
		for(var i = 0; i < data.length; i++){
			$('#ld-year-opt-slct').append("<option value="+data[i]["year"]+">"+data[i]["year"]+"</option>");
		}
		loadthecountfromosyetchfromsadminbygrp(pid, $('#ld-year-opt-slct option:selected').val());	
		loadtheprofilenumberofinfobasepagetable(pid, $('#ld-year-opt-slct option:selected').val(), 'all');

	},'json');

	loadtheyearbydisticttheuseradminbygroup(pid);

	

	let loadthecountfromosyetchfromsadminbygrp = async (id, year = null) => await $.post('function/function.php', {load:'loadtheprofilenumberofinfobasepage', pid:id, year:year, parse:'getCount'}, function(data){
		$('#ld-osy-txt-b').text(data.osy);
		$('#ld-uem-txt-b').text(data.uem);
		$('#ld-tep-txt-b').text(data.tep);
		$('#ld-iny-txt-b').text(data.iyt);
	}, 'json');


	$('#frm-profiling').parsley();
	$(document).on('submit', '#frm-profiling', function(event){
		event.preventDefault();
		if($('#frm-profiling').parsley().isValid()){
			$.post('function/function.php', $(this).serialize(), function(data){
				message('#msg-alert-profile', data, 'success');
				$('#frm-profiling')[0].reset();
				loadtheprofilenumberofinfobasepagetable(pid, $('#ld-year-opt-slct option:selected').val());
				loadtheyearnumberbrgypagerequest.ajax.reload(null, false);
			});
		}
		
	});

	$(document).on('click', '#btn-reset-from-ds', function(){
		$('#frm-profiling')[0].reset();
	});


	let loadtheprofilenumberofinfobasepagetable = async (pid, yid, stat) => await $.post('function/function.php', {load:'loadtheprofilenumberofinfobasepage', pid:pid, year:yid, stat:stat, parse:'getTable'}, function(data){
		$('#ld-tble-pre-by-sadmn-y').html(data.tble);
		$('#ld-dtls').html(data.tdtls);
		$('#tbl-profiling-single').DataTable({
			"dom": 'lrtip',
			"sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
			"bLengthChange": false,
			"bFilter": true,
			"bInfo": false,
		  	"bAutoWidth": false,
		  	"async": true,
		  	"pagingType": "simple",
		    "columnDefs": [{
		          "targets": [0],  /*column index*/ 
		          "orderable": true, /* true or false */
		    }]
		});
	},'json');


	$(document).on('blur', '#inputedit', function(){
		let id = $(this).data('id');
		let valueof = $(this).text();
		$.post('function/function.php', {action:'letupdateprofilinginfowheresubadact', id:id, value:valueof, parse:'upInfo', fields:'fname'}, function(){ });
	});
	$(document).on('blur', '#inputeditAge', function(){
		let id = $(this).data('id');
		let valueof = $(this).text();
		$.post('function/function.php', {action:'letupdateprofilinginfowheresubadact', id:id, value:valueof, parse:'upInfo', fields:'age'}, function(){ });
	});
	$(document).on("change", "select[name='gen[]']", function(){
		let id = $(this).data('id');
  		let valueof = this.value;
  		$.post('function/function.php', {action:'letupdateprofilinginfowheresubadact', id:id, value:valueof, parse:'upInfo', fields:'gender'}, function(data){ console.log(data);  });
	});
	$(document).on("change", "select[name='type[]']", function(){
		let id = $(this).data('id');
  		let valueof = this.value;
  		$.post('function/function.php', {action:'letupdateprofilinginfowheresubadact', id:id, value:valueof, parse:'upInfo', fields:'type'}, function(data){ console.log(data);  });
	});

	let loadtheparamenterbytablereq = (stat) => {
		loadtheprofilenumberofinfobasepagetable(pid, $('#ld-year-opt-slct option:selected').val(), stat);
	}


	$('#btn-o-yt').click(()=>{
			loadtheparamenterbytablereq('O');
			
	});
	$('#btn-u-yt').click(()=>{
			loadtheparamenterbytablereq('U');
			
	});
	$('#btn-t-yt').click(()=>{
			loadtheparamenterbytablereq('T');
			
	});
	$('#btn-i-yt').click(()=>{
			loadtheparamenterbytablereq('I');
			
	});


	let loadtheyearnumberbrgypagerequest  = $('#table-year-num').DataTable({
		"dom": 'lrtip',
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": false,
		"bAutoWidth": false,
		"async": true,
		"pagingType": "simple",

		"ajax": {
	        "method": "POST",
	        "url": "function/function.php",
	        "data": {load:'loadtheyearnumberbrgypagerequest', pid:pid}

	    },

		"columnDefs": [{
		    "targets": [0],  /*column index*/ 
		    "orderable": true, /* true or false */
		}]
	});  

	
	



});
</script>