var Cache = {
	load: function(){
		var up = true;
		var interval = setInterval(function(){
			if(up){
				if($("#loading_dots").html() == "..."){
					$("#loading_dots").html("..");
					up = false;
				}else{
					$("#loading_dots").append(".");
				}
			}else{
				if($("#loading_dots").html() == "."){
					$("#loading_dots").html("");
					up = true;
				}else if($("#loading_dots").html() == ".."){
					$("#loading_dots").html(".");
				}
			}
		}, 150);
		$.get(Config.URL + "admin/cachemanager/get", function(data){
			$("#cache_data").html(data);
		});
	},
	progressBars: function(type){
		switch(type){
			case "website":
				$("#row_website").html('<div class="progress_bar"><a style="width:0%"></a></div>');
			break;
			case "template":
				$("#row_template").html('<div class="progress_bar"><a style="width:0%"></a></div>');
			break;			
			case "all":
				$("#row_template").html('<div class="progress_bar"><a style="width:0%"></a></div>');
				$("#row_website").html('<div class="progress_bar"><a style="width:0%"></a></div>');
			break;
		}
	},
	getPercent: function(part, whole)
	{
		console.log(part + " of " + whole);

		if(!part || !whole)
		{
			return 0;
		}
		else
		{
			return Math.round((part / whole) * 100, 1);
		}
	},
	clear: function(type)
	{
		Cache.calculateTotal();
		Cache.progressBars(type);

		$.get(Config.URL + "admin/cachemanager/delete/" + type, function(data)
		{
			switch(type)
			{
				case "website":
					$("#row_website .progress_bar a").animate({width:"100%"}, 200, function()
					{
						$("#row_website").html("0 files (0 B)");
					});
				break;
				
				case "template":
					$("#row_template .progress_bar a").animate({width:"100%"}, 200, function()
					{
						$("#row_template").html("0 files (0 B)");
					});
				break;				

				case "all":
					$("#row_website .progress_bar a").animate({width:"100%"}, 200, function()
					{
						$("#row_website").html("0 files (0 B)");
					});
					
					$("#row_template .progress_bar a").animate({width:"100%"}, 200, function()
					{
						$("#row_template").html("0 files (0 B)");
					});					
				break;
			}

			setTimeout(Cache.calculateTotal, 300);
		});
	},

	calculateTotal: function()
	{


		var websiteHTML = $("#row_website").html().replace(")", "").split(" files (");
		var website = {
			files: parseInt(websiteHTML[0]),
			size: Cache.toBytes(websiteHTML[1])
		};
		
		var templateHTML = $("#row_template").html().replace(")", "").split(" files (")
		var template = {
			files: parseInt(templateHTML[0]),
			size: Cache.toBytes(templateHTML[1])
		};		



		var totalFiles = website.files + template.files,
			totalSize = Cache.formatSize(parseInt(website.size + template.size));

		$("#row_total").html("<b>" + totalFiles + " files (" + totalSize + ")</b>")

	},

	toBytes: function(string)
	{
		if(/ B$/.test(string))
		{
			return parseInt(string.replace(" B", ""));
		}
		else if(/ KB$/.test(string))
		{
			return parseInt(string.replace(" KB", "")) * 1024;
		}
		else if(/ MB$/.test(string))
		{
			return parseInt(string.replace(" MB", "")) * 1024 * 1024;
		}
		else if(/ GB$/.test(string))
		{
			return parseInt(string.replace(" GB", "")) * 1024 * 1024 * 1024;
		}
	},

	formatSize: function(size)
	{
		if(size < 1024)
		{
			return size + " B";
		}
		else if(size < 1024 * 1024)
		{
			return Math.round(size / 1024) + " KB";
		}
		else if(size < 1024 * 1024 * 1024)
		{
			return Math.round(size / (1024 * 1024)) + " MB";
		}
		else
		{
			return Math.round(size / (1024 * 1024 * 1024)) + " GB";
		}
	}
}