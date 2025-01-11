var Sidebox = 
{
	remove: function(id, element)
	{
		UI.confirm("Do you really want to delete this " + identifier + "?", "Yes", function()
		{
			$(element).parents("tr").slideUp(300, function()
			{
				$(this).remove();
			});

			$.get(Config.URL + "admin/sidebox/delete/" + id);
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


		$.post(Config.URL + "admin/sidebox/create/", values, function(data)
		{
			eval(data);
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

		$.post(Config.URL + "admin/sidebox/save/" + id, values, function(data)
		{
			eval(data);
		});
	},

	move: function(direction, id, element)
	{
		var row = $(element).parents("tr");
		var targetRow = (direction == "up") ? row.prev("tr") : row.next("tr");

		if(targetRow.length)
		{
			$.get(Config.URL + "admin/sidebox/move/" + id + "/" + direction, function(data)
			{
				eval(data);
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

	toggleCustom: function(select)
	{
		if(select.value == "sidebox_custom")
		{
			$("#custom_field").fadeIn(150);
		}
		else
		{
			$("#custom_field").fadeOut(150);
		}
	}
}