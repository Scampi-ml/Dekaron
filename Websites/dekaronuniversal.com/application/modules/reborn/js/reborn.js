var Reborn = {
	doreborn: function(no, name, id)
	{
		UI.confirm("Are you sure you want to reborn <b>" + name + "</b>?", "Yes", function(){
			$.post(Config.URL + "reborn/submit", {character_no:no, csrf_token_name: Config.CSRF}, function(data)
			{
				if(data == 1)
				{
					UI.alert('Your character has been reborned.');
					$(id).attr("class", "nice_button").removeAttr( "onClick" ).html("Cant Reborn");
				}
				else
				{
					UI.alert(data);
				}
			});
		});
	}
}