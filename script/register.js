$(()=>{
	

	let getPagerequest = () =>{
    	let hash = window.location.hash
	    if(hash == '#/member'){
	    	$.get('html/reg-member.html').then(html => {
		       $('#content').html(html).hide().fadeIn();  
		    });
	    }else if(hash == '#/visitor'){
	    	$.get('html/reg-visitor.html').then(html => {
		       $('#content').html(html).hide().fadeIn();  
		    });
	    }else if(hash == '#/group'){
	    	$.get('html/request-group.html').then(html => {
		       $('#content').html(html).hide().fadeIn();  
		    });
	    }else{
	    	$.get('html/reg-member.html').then(html => {
		       $('#content').html(html).hide().fadeIn();  
		    });
	    }
	}

	$(window).on('hashchange', function(){
	  getPagerequest();
	});

	getPagerequest();
});