var Accounts = {
	Links: {
		save: "admin/accounts/save/",
	},
	searchAccount: function() {
		var value = $("#search_accounts").val();
		$("#form_accounts_search").html('<center><span class="loader-01"></span><br /><br /></center>');
		$.post(Config.URL + "admin/accounts/search", {value: value, csrf_token_name: Config.CSRF}, function(data){
			$("#form_accounts_search").fadeOut(150, function(){
				$(this).html(data).fadeIn(500, function(){
					Tooltip.refresh();
				});
			});
		});
	},
	save: function(form, id){
		var values = {csrf_token_name: Config.CSRF};
		$(form).find("input, select").each(function(){
			if($(this).attr("type") != "submit"){
				if($(this).attr("type") == "checkbox"){
					values[$(this).attr("name")] = this.checked;
				}else{
					values[$(this).attr("name")] = $(this).val();
				}
			}
		});
		$.post(Config.URL + this.Links.save + id, values, function(data){
			console.log(data);
			eval(data);
		});
	}
}
