$(()=>{
	let getPagerequest = () =>{
    	let hash = window.location.hash;
	    if(hash == '#/group_source' || hash == ''){
	    	$.get('php/request-group.php').then(html => {
	      		$('.content').html(html).hide().fadeIn();  
	    	});
	    }else{
	    	$.get('php/request-group.php').then(html => {
	      		$('.content').html(html).hide().fadeIn();  
	    	});
	    }

	   
	}

	window.addEventListener('hashchange', function(){
	  getPagerequest();
	});

	getPagerequest();
});