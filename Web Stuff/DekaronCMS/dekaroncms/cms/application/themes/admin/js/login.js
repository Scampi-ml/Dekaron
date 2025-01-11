var Login = {
	send: function(form)
	{
		var values = {csrf_token_name: Config.CSRF, send:"1"};

		$(form).find("input[type='text'], input[type='password']").each(function()
		{
			values[$(this).attr("id")] = $(this).val();
		});

		$.post(Config.URL + "admin", values, function(data)
		{
			switch(data.trim())
			{
				case "username":
					alert("You do not have the correct username");
				break;

				case "password":
					alert("You do not have the correct password");
				break;

				case "permission":
					alert("You do not have permission to access the admin panel.");
				break;

				default:
					alert("Something went wrong as i try to login");
					console.log(data);
				break;
			}
		});
	}
};