var Roles = {
	identifier: "roles",
	Links: {
		remove: "admin/aclmanager/roleDelete/",
		create: "admin/aclmanager/roleCreate/",
		save: "admin/aclmanager/roleSave/",
	},
	remove: function(id, element){
		var identifier = this.identifier,
			removeLink = this.Links.remove;

		UI.confirm("Do you really want to delete this role?", "Yes", function(){
			$(element).parents("li").slideUp(300, function(){
				$(this).remove();
			});

			$.get(Config.URL + removeLink + id);
		});
	},
	add: function(){
		var id = this.identifier;

		if($("#add_" + id).is(":visible")){
			$("#add_" + id).fadeOut(150, function(){
				$("#main_" + id).fadeIn(150);
			});
		}else{
			$("#main_" + id).fadeOut(150, function(){
				$("#add_" + id).fadeIn(150);
			});
		}
	},
	create: function(form){
		var values = {csrf_token_name: Config.CSRF};

		$(form).find("input, select").each(function(){
			if($(this).attr("type") != "submit" && $(this).attr("type") != "checkbox"){
				values[$(this).attr("name")] = $(this).val();
			}else if($(this).attr("type") == "checkbox"){
				values[$(this).attr("name")] = this.checked;
			}
		});

		if(this.fusionEditor != false){
			values[this.fusionEditor.replace("#", "")] = $(this.fusionEditor).html();
		}

		$.post(Config.URL + this.Links.create, values, function(data){
			console.log(data);
			eval(data);
		});
	},
	save: function(form, id){
		var values = {csrf_token_name: Config.CSRF};

		$(form).find("input, select").each(function(){
			if($(this).attr("type") != "submit" && $(this).attr("type") != "checkbox"){
				values[$(this).attr("name")] = $(this).val();
			}else if($(this).attr("type") == "checkbox"){
				values[$(this).attr("name")] = this.checked;
			}
		});

		if(this.fusionEditor != false){
			values[this.fusionEditor.replace("#", "")] = $(this.fusionEditor).html();
		}

		$.post(Config.URL + this.Links.save + id, values, function(data){
			console.log(data);
			eval(data);
		});
	}
}