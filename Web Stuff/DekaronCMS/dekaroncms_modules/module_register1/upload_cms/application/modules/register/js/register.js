var Register =
{
	save: function(form)
	{
		var data = {
			use_captcha: $("#use_captcha").val(),
			captcha_length: $("#captcha_length").val(),
			captcha_distortionLevel: $("#captcha_distortionLevel").val(),
			captcha_height: $("#captcha_height").val(),
			captcha_width: $("#captcha_width").val(),
			min_length_username: $("#min_length_username").val(),
			max_length_username: $("#max_length_username").val(),
			min_length_password: $("#min_length_password").val(),
			csrf_token_name: Config.CSRF
		};

		$.post(Config.URL + "register/admin/saveEdit/", data, function(response)
		{
			if(response == "yes")
			{
				UI.alert("Settings have been saved!");
				Router.load(Config.URL + "register/admin");
			}
			else
			{
				UI.alert(data);		
			}			
		});
	}
}