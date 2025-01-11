var Settings = {
	
	saveWebsiteSettings: function()
	{
		var data = {
			title:$("#title").val(),
			server_name:$("#server_name").val(),
			keywords:$("#keywords").val(),
			description:$("#description").val(),
			csrf_token_name: Config.CSRF
		};

		$.post(Config.URL + "admin/settings/saveWebsite", data, function(response)
		{
			if(response == "yes")
			{
				UI.alert('Settings have been saved!', 2000);
			}
			else
			{
				UI.alert(response);
			}
		});
	},

	saveSmtpSettings: function()
	{
		var data = {
			use_own_smtp_settings:$("#use_own_smtp_settings").val(),
			smtp_host:$("#smtp_host").val(),
			smtp_user:$("#smtp_user").val(),
			smtp_pass:$("#smtp_pass").val(),
			smtp_port:$("#smtp_port").val(),
			csrf_token_name: Config.CSRF
		};

		$.post(Config.URL + "admin/settings/saveSmtp", data, function(response)
		{
			if(response == "yes")
			{
				UI.alert('Settings have been saved!', 2000);
			}
			else
			{
				UI.alert(response);
			}
		});
	},

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

		console.log(values);

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