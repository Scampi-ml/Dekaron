var Update = 
{	
	delete: function(version)
	{
		UI.confirm("Are you sure you want to delete update <b>" + version + "</b>?", "Yes", function()
		{		
			$.post(Config.URL + 'admin/update/deleteUpdate/' + version, {csrf_token_name: Config.CSRF}, function(response)
			{
				if(response == "ok")
				{
					UI.alert('Update was removed!', 2000);
					Router.load(Config.URL + "admin/update");
				}
				else
				{
					UI.alert(response);
				}
			});
		});
	}
}