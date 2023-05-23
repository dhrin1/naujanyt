function message(ctrl = '', msg = '', type = ''){
	$(ctrl).html('<div class="alert alert-'+type+'">'+msg+'</div>');
	setTimeout(function(){
		$(ctrl).html('');
	},4000);
}