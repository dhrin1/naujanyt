$(()=>{
	window.location.hash = '#/pages';

	let getPagerequest = () =>{
    	let hash = window.location.hash;
	    if(hash == '#/my-group'){
	    	$.get('html/request-group.html').then(html => {
		       $('#content').html(html).hide().fadeIn();  
		    });
	    }else{

	    }

	    if(hash == '#/pages' || hash == ''){ $('.page-content').removeClass('hide');  }else{ $('.page-content').removeClass('hide'); }
	}

	$(window).on('hashchange', function(){
	  getPagerequest();
	});

	getPagerequest();


	let loadthegrouplistbytable = async (value) => await $.post('function/function.php', {load:'loadthegrouplistbytable', parse:'getTable', cty:value}, function(data){
		$('#g-lt-tble-group-list').html(data.getTable);
		$('#table-group-list').DataTable({
		  	"dom": 'lrtip',
		  	"bLengthChange": false,
			"bFilter": true,
			"bInfo": false,
		  	"bAutoWidth": false,
		  	"async": true,
		  	"order":[[0, "asc"]],
		  	"pagingType": "simple",
		   
		    "columnDefs": [{
		          "targets": [0],  /*column index*/ 
		          "orderable": false, /* true or false */
		    }]
		});
	},'json');
	

	let loadthedesignatedstatelidbgetdrop = async () => await $.post('function/function.php', {load:'loadthedesignatedstatelidbgetdrop', parse:'getCity'}, function(data){
		for(let i = 0; i < data.length; i++){
			$("#ld-mncplty-dstctv-rdo").append("<input type='radio' name='rdo' class='radioBtnClass' value='" + data[i]['city'] + "' "+(([i] == 0) ? 'checked' : "" )+" /> "+data[i]['city'] + " <br/>");
		}
		let _rdomun = $("input[type='radio'].radioBtnClass:checked").val();
		loadthestatecountableattribute(_rdomun);
		loadthegrouplistbytable(_rdomun);
		
	},'json');
	

	let loadthestatecountableattribute = async (value = '') => await $.post('function/function.php', {load:'loadthegrouplistbytable', parse:'getCount', cty:value}, function(data){
		$('#ld-num-group-list').text(data.attr);
		$('#ld-num-member-list').text(data.member);
		
	},'json');


	$('#ld-mncplty-dstctv-rdo').change(function () {
	    if($("input[type='radio'].radioBtnClass").is(':checked')) {
		    let _rdomun = $("input[type='radio'].radioBtnClass:checked").val();
		    loadthestatecountableattribute(_rdomun);
		    loadthegrouplistbytable(_rdomun);
		} 
	});
	
	loadthedesignatedstatelidbgetdrop();
});