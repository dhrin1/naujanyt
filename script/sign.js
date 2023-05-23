$(()=>{
	$('#frm-sign').parsley();
	$(document).on('submit', '#frm-sign', function(event){
		event.preventDefault();
		if($('#frm-sign').parsley().isValid()){
			$.post('function/function.php', $(this).serialize(), function(data){
				if(data.email == undefined && data.pass == undefined){
					window.location = 'index';
				}else{
					$('#msg-err-div').html('<div class="alert alert-danger">'+((data.email == undefined) ? ''  : data.email) + ((data.pass == undefined) ? '' : data.pass)+'</div>');
				}
				// console.log(data);
			}, 'json');
		}
	});

	let getOthersUserCookie = async () => await $.post('function/function.php', {load:'getCookieloaduser'}, function(data){
		$('#inputEmail').val(data.email);
		$('#inputPassword').val(data.pass);
		$('#remember').attr('checked', 'checked');
	},'json');
	getOthersUserCookie();

});