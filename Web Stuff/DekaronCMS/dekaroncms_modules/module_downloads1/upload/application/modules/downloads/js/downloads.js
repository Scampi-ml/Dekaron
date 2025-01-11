var Downloads =
{
	remove: function(id, element)
	{
		UI.confirm("Do you really want to delete this download?", "Yes", function()
		{
			$(element).parents("tr").slideUp(300, function()
			{
				$(this).remove();
			});

			$.get(Config.URL + "downloads/admin/delete/" + id);
		});
	},
	create: function(form)
	{
		var data = {
			name: $("#name").val(),
			link: $("#link").val(),
			csrf_token_name: Config.CSRF
		};

		$.post(Config.URL + "downloads/admin/add/", data, function(response)
		{
			if(response == "yes")
			{
				Router.load(Config.URL + "downloads/admin");
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
			name: $("#name").val(),
			link: $("#link").val(),
			csrf_token_name: Config.CSRF
		};

		$.post(Config.URL + "downloads/admin/saveEdit/" + id, data, function(response)
		{
			if(response == "yes")
			{
				Router.load(Config.URL + "downloads/admin");
			}
			else
			{
				UI.alert(data);		
			}			
		});
	}
}