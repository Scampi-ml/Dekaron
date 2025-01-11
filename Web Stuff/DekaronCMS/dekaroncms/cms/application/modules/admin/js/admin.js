var Admin = {
	saveNotes: function()
	{
		var data = {
			notes:$("#notes").val(),
			csrf_token_name: Config.CSRF
		};

		$.post(Config.URL + "admin/saveNotes", data, function(response)
		{
			if(response.trim() === "yes")
			{
				UI.alert('Notes have been saved!');
			}
			else
			{
				UI.alert(response);
			}
		});
	}
}
