var Settings = 
{
	saveTheme: function(name)
	{
		$.get(Config.URL + "admin/settings/saveTheme/" + name, function()
		{
			UI.alert('The theme has been changed!', 2000);
			Router.load(Config.URL + "admin/settings/settings#theme");
		});
	},

	saveSlider: function()
	{
		var data = {
			slider:$("#slider :selected").val(),
			slider_home:$("#slider_home :selected").val(),
			slider_interval:$("#slider_interval").val(),
			slider_style:$("#slider_style :selected").val(),
			csrf_token_name: Config.CSRF
		};
		$.post(Config.URL + "admin/settings/saveSlider", data, function(response)
		{
			UI.alert('Settings have been saved!', 2000);
		});
	},

	saveApi: function()
	{
		var data = {
			api_server:$("#api_server").val(),
			api_http_user:$("#api_http_user").val(),
			api_http_pass:$("#api_http_pass").val(),
			api_http_auth:$("#api_http_auth :selected").val(),
			api_ssl_verify_peer:$("#api_ssl_verify_peer").val(),
			api_send_cookies:$("#api_send_cookies").val(),
			api_api_name:$("#api_api_name").val(),
			api_api_key:$("#api_api_key").val(),
			api_ssl_cainfo:$("#api_ssl_cainfo").val(),
			api_debug:$("#api_debug").val(),
			csrf_token_name: Config.CSRF
		};
		$.post(Config.URL + "admin/settings/saveApi", data, function(response)
		{
			UI.alert('Settings have been saved!', 2000);
		});
	},

	saveMssql: function()
	{
		var data = {
			mssql_host:$("#mssql_host").val(),
			mssql_username:$("#mssql_username").val(),
			mssql_password:$("#mssql_password").val(),
			mssql_driver:$("#mssql_driver :selected").val(),
			csrf_token_name: Config.CSRF
		};
		$.post(Config.URL + "admin/settings/saveMssql", data, function(response)
		{
			UI.alert('Settings have been saved!', 2000);
		});
	},	
	
	saveWebsite: function()
	{
		var data = {				
			title:$("#title").val(),
			server_name:$("#server_name").val(),
			keywords:$("#keywords").val(),
			description:$("#description").val(),
			news_limit:$("#news_limit :selected").val(),
			connection_type:$("#connection_type :selected").val(),
			csrf_token_name: Config.CSRF
		};
		$.post(Config.URL + "admin/settings/saveWebsite", data, function(response)
		{
			UI.alert('Settings have been saved!', 2000);
		});
	},	

	saveLogin: function()
	{
		var data = {
			admin_nickname:$("#admin_nickname").val(),
			admin_username:$("#admin_username").val(),
			admin_password:$("#admin_password").val(),
			csrf_token_name: Config.CSRF
		};
		$.post(Config.URL + "admin/settings/saveLogin", data, function(response)
		{
			UI.alert('Settings have been saved!', 2000);
		});
	},

	saveSmtp: function()
	{
		var data = {
			smtp_host:$("#smtp_host").val(),
			smtp_user:$("#smtp_user").val(),
			smtp_pass:$("#smtp_pass").val(),
			smtp_port:$("#smtp_port").val(),
			csrf_token_name: Config.CSRF
		};
		$.post(Config.URL + "admin/settings/saveSmtp", data, function(response)
		{
			UI.alert('Settings have been saved!', 2000);
		});
	},	

	testEmail: function()
	{
		
		var data = {
			to:$("#to").val(),
			from:$("#from").val(),
			subject:$("#subject").val(),
			message:$("#message").val(),
			csrf_token_name: Config.CSRF
		};
		$.post(Config.URL + "admin/settings/testEmail/", data, function(response)
		{
			if(response == "yes")
			{
				UI.alert('The email was sent!', 2000);
			}
			else
			{
				UI.alert(response);
			}
		});
	},	

	clearCache: function(type)
	{
		
		Settings.calculateTotal();
		Settings.progressBars(type);

		$.get(Config.URL + "admin/settings/deleteCache/" + type, function()
		{
			switch(type)
			{	
				case "template":
					$("#row_template .progress_bar a").animate({width:"100%"}, 200, function()
					{
						$("#row_template").html("0");
						$("#row_template_size").html("0 byte");
					});
				break;
			}
			setTimeout(Settings.calculateTotal, 300);
		});
	},

	progressBars: function(type)
	{
		switch(type){
			case "template":
				$("#row_template").html('<div class="progress_bar"><a style="width:0%"></a></div>');
			break;			
		}
	},
	getPercent: function(part, whole)
	{
		if(!part || !whole)
		{
			return 0;
		}
		else
		{
			return Math.round((part / whole) * 100, 1);
		}
	},
	calculateTotal: function()
	{
		
		var templateHTML = $("#row_template").html().replace(")", "").split(" files (")
		
		var template = {
			files: parseInt(templateHTML[0]),
			size: Settings.toBytes(templateHTML[1])
		};		

		var totalFiles = template.files;
		var totalSize = Settings.formatSize(parseInt(template.size));

		$("#row_total").html(""+totalFiles+"");
		$("#row_total_size").html(""+totalSize+"");
	},
	toBytes: function(string)
	{
		if(string == undefined)
		{
			return "0 byte";	
		}
		else if(/ bytes$/.test(string))
		{
			return parseInt(string.replace(" byte", ""));
		}
		else if(/ kilobytes$/.test(string))
		{
			return parseInt(string.replace(" kilobyte", "")) * 1024;
		}
		else if(/ megabytes$/.test(string))
		{
			return parseInt(string.replace(" megabyte", "")) * 1024 * 1024;
		}
		else if(/ gigabytes$/.test(string))
		{
			return parseInt(string.replace(" gigabyte", "")) * 1024 * 1024 * 1024;
		}
	},

	formatSize: function(size)
	{
		if(size == undefined)
		{
			return "0 bytes"
		}
		else if(size < 1024)
		{
			return size + " byte";
		}
		else if(size < 1024 * 1024)
		{
			return Math.round(size / 1024) + " kilobyte";
		}
		else if(size < 1024 * 1024 * 1024)
		{
			return Math.round(size / (1024 * 1024)) + " megabyte";
		}
		else
		{
			return Math.round(size / (1024 * 1024 * 1024)) + " gigabyte";
		}
	}	
}