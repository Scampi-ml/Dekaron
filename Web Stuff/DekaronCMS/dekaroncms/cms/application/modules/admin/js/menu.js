var Menu =
{
	remove: function(id, element)
	{
		UI.confirm("Do you really want to delete this menu link?", "Yes", function()
		{
			$(element).parents("tr").slideUp(300, function()
			{
				$(this).remove();
			});

			$.get(Config.URL + "admin/menu/delete/" + id);
		});
	},
	create: function(form)
	{
		var data = {
			name: $("#name").val(),
			link: $("#link").val(),
			side: $("#side").val(),
			direct_link: $("#direct_link").val(),
			visibility: $("#visibility").val(),
			csrf_token_name: Config.CSRF
		};

		$.post(Config.URL + "admin/menu/send/", data, function(response)
		{
			if(response == "yes")
			{
				Router.load(Config.URL + "admin/menu");
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
			side: $("#side").val(),
			direct_link: $("#direct_link").val(),
			visibility: $("#visibility").val(),
			csrf_token_name: Config.CSRF
		};


		$.post(Config.URL + "admin/menu/save/" + id, data, function(response)
		{
			Router.load(Config.URL + "admin/menu");
		});
	},
	move: function(direction, id, element)
	{
		var row = $(element).parents("tr");
		var targetRow = (direction == "up") ? row.prev("tr") : row.next("tr");

		if(targetRow.length)
		{
			$.get(Config.URL + "admin/menu/move/" + id + "/" + direction);

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
	}
}