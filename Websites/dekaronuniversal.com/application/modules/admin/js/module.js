var Module = {
	enableModule: function(moduleId, element){
		UI.confirm("Are you sure you want to enable <b>" + moduleId + "</b>?", "Yes", function(){		
			$.post(Config.URL + 'admin/module/enable/' + moduleId, {csrf_token_name: Config.CSRF}, function(data){
				if(data == 'SUCCESS'){
					$(element).attr("onClick", "Module.disableModule('" + moduleId + "', this)").attr("class", "btn btn-sm btn-danger").html("Disable");
					var parent = $(element).parent();
					$("#enabled_modules").append(parent[0]);
					$("#disabled_count").html(parseInt($("#disabled_count").html()) - 1);
					$("#enabled_count").html(parseInt($("#enabled_count").html()) + 1);
				}
			});
		});
	},
	disableModule: function(moduleId, element){
		UI.confirm("Are you sure you want to disable <b>" + moduleId + "</b>?", "Yes", function(){
			$.post(Config.URL + 'admin/module/disable/' + moduleId, {csrf_token_name: Config.CSRF}, function(data){
				if(data == 'SUCCESS'){
					$(element).attr("onClick", "Module.enableModule('" + moduleId + "', this)").attr("class", "btn btn-sm btn-success").html("Enable");
					var parent = $(element).parent();
					$("#disabled_modules").append(parent[0]);
					$("#enabled_count").html(parseInt($("#enabled_count").html()) - 1);
					$("#disabled_count").html(parseInt($("#disabled_count").html()) + 1);
				}else{
					UI.alert(moduleId + " is a core module that can not be disabled!");
				}
			});
		});
	}
}

