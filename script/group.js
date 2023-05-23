 $(()=>{
	 $.fn.dataTable.ext.errMode = 'none';
	 

	$('#btn-add-nw-muncplty').on('click',()=>{
		window.location.hash = '#/create';
	});

	$('#frm-group-cntrl').on('submit', function(event){
		event.preventDefault();
		$.post('../../function/function.php', $(this).serialize(), function(data){
			$('#frm-group-cntrl')[0].reset();
			loadthestatetablewithdatatble.ajax.reload(null, false);
			alert(data);
		});
	});

	let loadthestatetablewithdatatble = $('#tbl-municipality').DataTable({
	    "dom": 'lrtip',
	     "sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
		"bLengthChange": false,
		"bFilter": true,
		"bInfo": false,
	  	"bAutoWidth": false,
	  	"async": true,
	  	

	    "ajax": {
	        "method": "POST",
	        "url": "../../function/function.php",
	        "data": {load:'loadthestatetablewithdatatble', cty:"Naujan"}

	    },
	    "columnDefs": [{
	          "targets": [0],  /*column index*/ 
	          "orderable": true, /* true or false */
	    }]
	});

	$(document).on('blur', '.inputedit', function(){
	   var id = $(this).data("id");
	   var value = $(this).text();
	  	$.post('../../function/function.php', {action:'leteditthecontentthetitle', id:id, value:value}, function(data){
	  		loadthestatetablewithdatatble.ajax.reload(null, false);
	  	});
	});


	$(document).on('click', '#btn-remove-ctrl-group', function(){
		if(confirm('Are you sure do you want to remove this group?'))
			$.post('../../function/function.php', {action:'letchangeathegroupcontroladmin', id: $(this).attr('data-id'), parse:'groupRemove'}, function(data){
				loadthestatetablewithdatatble.ajax.reload(null, false);
			});

	});	

	$(document).on('click', '#btn-acti-ctrl-group', function(){
		$.post('../../function/function.php', {action:'letchangeathegroupcontroladmin', id:$(this).attr('data-id'), parse:'groupAct'}, function(data){
			loadthestatetablewithdatatble.ajax.reload(null, false);
		});
	});



	

});