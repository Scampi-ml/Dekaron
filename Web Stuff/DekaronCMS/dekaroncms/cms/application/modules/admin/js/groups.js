var Groups = 
{
	save: function(form, id)
	{
		var values = {csrf_token_name: Config.CSRF};

		$(form).find("input, select").each(function()
		{
			if($(this).attr("type") != "submit" && $(this).attr("type") != "checkbox")
			{
				values[$(this).attr("name")] = $(this).val();
			}
			else if($(this).attr("type") == "checkbox")
			{
				values[$(this).attr("name")] = this.checked;
			}
		});


		$.post(Config.URL + "admin/groups/groupSave/" + id, values, function(response)
		{	
			if(response == "yes")
			{
				UI.alert("Group has been saved!");	
			}
			else
			{
				UI.alert(response);	
			}
		});
	}
}