$(document).ready(function() {
	$('#login-warning').hide();
	$('#login-failed').hide();
	$('#loading').hide();
	
	$('#password').keydown(function(e) {
		if (e.which == 13) {
			loginAPI()
		}
	})

	$('#login-button').click(function() {
		loginAPI()
	})

	//API
	function loginAPI() {
		$('#login-warning').hide();
		$('#login-failed').hide();
		if ($('#username').val() == '' || $('#password').val() == '') {
			$('#login-warning').fadeIn();
		} else {
			$('#loading').fadeIn();
			$.post('method.php?name=login', { username: $('#username').val(), password: $('#password').val()})
			.done(function(data) {

				$('#loading').fadeOut("fast", function() {
					if (data == 200) {
						window.location = baseurl + '/models'
					} else {
						$('#login-failed').fadeIn();
					}
				});
				
			})
		}
	}
})