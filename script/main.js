$(()=>{
	let getPagerequest = () =>{
    	let hash = window.location.hash;
	    if(hash == '#/create'){
	    	$.get('html/create-state.html').then(html => {
	      		$('#content').html(html).hide().fadeIn();  
	    	});
	    }

	    if(hash=='#/member'){
	    	$.get('html/member.html').then(html=>{
	    		$('#content').html(html).hide().fadeIn();
	    	});
	    }
	}

	window.addEventListener('hashchange', function(){
	  getPagerequest();
	});



	getPagerequest();
});