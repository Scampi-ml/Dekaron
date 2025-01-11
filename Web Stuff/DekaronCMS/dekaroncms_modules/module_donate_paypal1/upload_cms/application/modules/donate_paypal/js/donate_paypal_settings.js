var Donate_paypal =
{
	save: function(form)
	{
		var data = {
			paypal_clientSecret: $("#paypal_clientSecret").val(),
			paypal_clientId: $("#paypal_clientId").val(),
			paypal_mode: $("#paypal_mode").val(),
			paypal_ConnectionTimeOut: $("#paypal_ConnectionTimeOut").val(),
			paypal_LogEnabled: $("#paypal_LogEnabled").val(),
			paypal_LogLevel: $("#paypal_LogLevel").val(),
			paypal_validationLevel: $("#paypal_validationLevel").val(),
			paypal_currency: $("#paypal_currency").val(),
			csrf_token_name: Config.CSRF
		};

		$.post(Config.URL + "donate_paypal/settings/saveEdit/", data, function(response)
		{
			if(response == "yes")
			{
				UI.alert("Settings have been saved!");
				Router.load(Config.URL + "donate_paypal/settings/");
			}
			else
			{
				UI.alert(data);		
			}			
		});
	}
}