var Donate_paypal =
{
	add: function(form)
	{
		var data = {
			price: $("#price").val(),
			coins: $("#coins").val(),
			csrf_token_name: Config.CSRF
		};

		$.post(Config.URL + "donate_paypal/items/create/", data, function(response)
		{
			if(response == "yes")
			{
				window.location.href = Config.URL + "donate_paypal/items";
			}
			else
			{
				UI.alert(data);		
			}			
		});
	},
	save: function(form, id)
	{
		var data = {
			price: $("#price").val(),
			coins: $("#coins").val(),
			csrf_token_name: Config.CSRF
		};
		$.post(Config.URL + "donate_paypal/items/save/" + id, data, function(response)
		{
			if(response == "yes")
			{
				//Router.load(Config.URL + "donate_paypal/items");
				window.location.href = Config.URL + "donate_paypal/items";
			}
			else
			{
				UI.alert(data);		
			}			
		});
	},
	remove: function(id, element)
	{
		UI.confirm("Do you really want to delete this item?", "Yes", function()
		{
			$(element).parents("tr").slideUp(300, function()
			{
				$(this).remove();
			});

			$.get(Config.URL + "donate_paypal/items/remove/" + id);
		});
	}
}