var Slider = 
{
	identifier: "slider",

	remove: function(id, element)
	{
		UI.confirm("Do you really want to delete this slider?", "Yes", function()
		{
			$(element).parents("tr").slideUp(300, function()
			{
				$(this).remove();
			});

			$.get(Config.URL + "admin/slider/delete/" + id);
		});
	},
	create: function(form)
	{
		var values = {csrf_token_name: Config.CSRF};

		$(form).find("input, select").each(function()
		{
			if($(this).attr("type") != "submit")
			{
				values[$(this).attr("name")] = $(this).val();
			}
		});


		$.post(Config.URL + "admin/slider/add/", values, function(data)
		{
			UI.alert(data);
		});
	},
	save: function(form, id)
	{
		var values = {csrf_token_name: Config.CSRF};

		$(form).find("input, select").each(function()
		{
			if($(this).attr("type") != "submit")
			{
				values[$(this).attr("name")] = $(this).val();
			}
		});


		$.post(Config.URL + "admin/slider/save/" + id, values, function(data)
		{
			UI.alert(data);
		});
	},
	move: function(direction, id, element)
	{
		var row = $(element).parents("tr");
		var targetRow = (direction == "up") ? row.prev("tr") : row.next("tr");

		if(targetRow.length)
		{
			$.get(Config.URL + "admin/slider/move/" + id + "/" + direction, function(data)
			{

			});

			row.hide(300, function()
			{
				if(direction == "down")
				{
					targetRow.after(row);
				}
				else
				{
					targetRow.before(row);
				}

				row.slideDown(300);
			});
		}
	},
	saveSettings: function(form)
	{
		var values = {csrf_token_name: Config.CSRF};

		$(form).find("input, select").each(function()
		{
			if($(this).attr("type") != "submit")
			{
				values[$(this).attr("name")] = $(this).val();
			}
		});

		$.post(Config.URL + "admin/slider/saveSettings", values, function(data)
		{
			UI.alert(data);
		});
	}	
}