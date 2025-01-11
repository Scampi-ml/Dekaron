var Edit = 
{
	submitConfig: function(form, moduleName, configName)
	{
		var values = {csrf_token_name: Config.CSRF};

		$(form).children("input, select").each(function()
		{
			if($(this).attr("type") != "submit")
			{
				values[$(this).attr("name")] = $(this).val();
			}
		});

		$.post(Config.URL + "admin/edit/save/" + moduleName + "/" + configName, values, function(data)
		{
			UI.alert(data);
		});
	},

	submitConfigSource: function(moduleName, configName)
	{
		var values = {
			csrf_token_name: Config.CSRF,
			source: $("#source_" + configName).val()
		};

		$.post(Config.URL + "admin/edit/saveSource/" + moduleName + "/" + configName, values, function(data)
		{
			UI.alert(data);
		});
	},

	toggleSource: function(id, field)
	{
		if($("#advanced_" + id).is(":visible"))
		{
			$(field).html("Edit source code (advanced)");

			$("#advanced_" + id).fadeOut(150, function()
			{
				$("#gui_" + id).fadeIn(150);
			});
		}
		else
		{
			$(field).html("Edit values (simple)");

			$("#gui_" + id).fadeOut(150, function()
			{
				$("#advanced_" + id).fadeIn(150);
			});
		}
	},
	liveUpdate: function(element, type)
	{
		if(type == "headline_size")
		{
			$("#live_headline").css("font-size", element.value + "px");
		}
		else
		{
			$("#live_" + type).html(element.value);
		}
	},
	changeStructure: function(element)
	{
		switch(element.value)
		{
			case "1":
				$("#two, #three").hide();
				$("#one").show();
			break;

			case "2":
				$("#one, #three").hide();
				$("#two").show();
			break;

			case "3":
				$("#two, #one").hide();
				$("#three").show();
			break;
		}
	}
}