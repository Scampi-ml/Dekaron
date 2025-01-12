function UI()
{
	this.initialize = function()
	{
	}

	if(typeof time != "undefined")
	{
		if($("#slider").length > 0){
			UI.slider();
		}		
		
		this.slider = function(){
			var config = {
				autoplay: true,
				controls: false,
				captions: true,
				delay: Config.Slider.interval
			};
			if(Config.Slider.effect.length > 0){
				config.transitions = new Array(Config.Slider.effect);
			}
			window.myFlux = new flux.slider('#slider', config);
		}
	}

	this.alert = function(question, time)
	{		
		// Put question and button text
		$("#alert_message").html(question);

		// Show box
		$("#popup_bg").fadeTo(200, 0.5);
		$("#alert").fadeTo(200, 1);

		if(typeof time == "undefined")
		{
			$("#alert_message").css({marginBottom:"10px"});
			$(".popup_links").show();

			// Assign click event
			$("#alert_button").bind('click', function()
			{
				UI.hidePopup();	
			});
		}
		else
		{
			$("#alert_message").css({marginBottom:"0px"});
			$(".popup_links").hide();

			setTimeout(function()
			{
				UI.hidePopup();
			}, time);
		}

		// Assign hide-function to background
		$("#popup_bg").bind('click', function()
		{
			UI.hidePopup();
		});

		// Assign key events
		$(document).keypress(function(event)
		{
			// If "enter"
			if(event.which == 13)
			{
				UI.hidePopup();
			}
		});
	}

	this.confirm = function(question, button, callback, callback_cancel, width)
	{
		var normalWidth = $("#confirm").css("width");
		var normalMargin = $("#confirm").css("margin-left");

		if(width)
		{
			$("#confirm").css({width: width+"px"});
			$("#confirm").css({marginLeft: "-"+(width/2)+"px"});
		}

		$(".popup_links").show();
		
		// Put question and button text
		$("#confirm_question").html(question);
		$("#confirm_button").html(button);

		// Show box
		$("#popup_bg").fadeTo(200, 0.5);
		$("#confirm").fadeTo(200, 1);

		// Assign click event
		$("#confirm_button").bind('click', function()
		{
			$("#confirm").css({width:normalWidth});
			$("#confirm").css({marginLeft:normalMargin});
			callback();
			UI.hidePopup();	
		});

		// Assign hide-function to background
		$("#popup_bg").bind('click', function()
		{
			$("#confirm").css({width:normalWidth});
			$("#confirm").css({marginLeft:normalMargin});
			UI.hidePopup();
		});

		// Assign key events
		$(document).keypress(function(event)
		{
			// If "enter"
			if(event.which == 13)
			{
				$("#confirm").css({width:normalWidth});
				$("#confirm").css({marginLeft:normalMargin});
				callback();
				UI.hidePopup();
			}
		});
	}

	/**
	 * Hides the current popup box
	 */
	this.hidePopup = function()
	{
		// Hide box
		$("#popup_bg").hide();
		$("#confirm").hide();
		$("#alert").hide();
		$("#vote_reminder").hide();

		// Remove events
		$("#confirm_button").unbind('click');
		$("#alert_button").unbind('click');
		$(document).unbind('keypress');
	}

	/**
	 * Display the amount of remaining characters
	 * @param Object field
	 * @param Object indicator
	 */
	this.limitCharacters = function(field, indicator)
	{
		// Get the values
		var max = field.maxLength;
		var length = field.value.length;

		// Change the indicator
		document.getElementById(indicator).innerHTML = length + " / " + max;
	}
}
var UI = new UI();
