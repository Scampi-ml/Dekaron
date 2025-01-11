$(".paypal_submit").hide();

var Donate =
{
	
	
	checkUsername: function()
	{
		var field_name = "#custom",
			field = $(field_name),
			value = field.val();

		// Length check
		if(value.length < 4 || value.length > 32)
		{
			alert("The character name is too small or too big");
		}

		// Alpha-numeric check
		else if(!/^[a-z0-9]+$/i.test(value))
		{
			alert("The character name may only be A-Z 0-9");
		}

		// Availability check
		else
		{
			// Perform an ajax call to check if username is available
			$.get(Config.URL + "donate/character_name_check/" + value, function(data)
			{
				if(data == "1")
				{
					$(".paypal_submit").show();
					alert("Success!\nYou may continue.");
				}
				else
				{
					alert("Character name was not found!\nPlease check the name and try again.");
				}
			});
		}
	}	
	
}