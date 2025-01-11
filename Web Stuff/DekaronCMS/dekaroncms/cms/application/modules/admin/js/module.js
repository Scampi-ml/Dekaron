var Module = 
{
	enableModule: function(moduleId, moduleName, type, element)
	{
		UI.confirm("Are you sure you want to "+type+" <b>" + moduleName + "</b>?", "Yes", function()
		{		
			$.post(Config.URL + 'admin/module/enable/' + moduleId, {csrf_token_name: Config.CSRF}, function(data)
			{
				if(data == "INSTALL")
				{
					UI.alert("Module has been installed!");	
					Router.load(Config.URL + "admin/module");	
				}
				else if(data == "SUCCESS")
				{
					UI.alert("Module has been installed!");	
					Router.load(Config.URL + "admin/module");	
				}
				else
				{
					UI.alert(data);	
				}
			});
		});
	},
	disableModule: function(moduleId, moduleName, element)
	{
		UI.confirm("Are you sure you want to disable <b>" + moduleName + "</b>?", "Yes", function()
		{
			$.post(Config.URL + 'admin/module/disable/' + moduleId, {csrf_token_name: Config.CSRF}, function(data)
			{
				if(data == "SUCCESS")
				{
					UI.alert("Module has been disabled!");
					Router.load(Config.URL + "admin/module");
				}
				else
				{
					UI.alert(moduleId + " is a core module that can not be disabled!");
				}
			});
		});
	},
	deleteModule: function(moduleId, moduleName, element)
	{
		UI.confirm("Are you sure you want to unintsall <b>" + moduleName + "</b>?<br>This will be deleted from your installation.", "Yes", function()
		{
			$.post(Config.URL + 'admin/module/uninstallModule/' + moduleId, {csrf_token_name: Config.CSRF}, function(data)
			{
				if(data == "SUCCESS")
				{
					UI.alert("Module has been removed!");
					Router.load(Config.URL + "admin/module");
				}
				else if(data == "CORE")
				{
					UI.alert(moduleId + " is a core module that can not be deleted!");
				}
				else
				{
					UI.alert(data);	
				}
			});
		});
	}	
}

