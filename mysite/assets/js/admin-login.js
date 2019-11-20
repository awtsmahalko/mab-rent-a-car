// base url
var base_url = $('.base_url').data('value');

// set alert position
alertify.set('notifier','position', 'top-right');

// hide alert
$('#login-alert').hide();

// admin-login
$('#loginForm').submit(function(e){
	e.preventDefault();
	var logindata = $(this).serialize();
	$.ajax({
		type: 'POST',
		url: base_url+'LoginController/login',
		data: logindata,
		dataType: 'json',
		beforeSend: function(){
			$('#loader').show();
		},
		success: function(res){
			$('#loader').hide();
			if(res.error){
				alertify.error('<i class="fa fa-times-circle"></i> &nbsp; '+res.message);
			} else {
				location.href = 'myadminpanel';
			}
		},
		error: function (request, status, error) {
			alertify.error(request.responseText);
	        $('#loginForm button').html('<i class="fa fa-sign-in"></i> Sign In');
	    }
	});
});