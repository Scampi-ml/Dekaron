function UI()
{
	this.initialize = function()
	{

	}

	this.alert = function(question, time)
	{		
		$("#alert_message").html(question);

		$("#popup_bg").fadeTo(200, 0.5);
		$("#alert").fadeTo(200, 1);

		if(typeof time == "undefined")
		{
			$("#alert_message").css({marginBottom:"10px"});
			$(".popup_links").show();
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
		
		$("#popup_bg").bind('click', function()
		{
			UI.hidePopup();
		});

		$(document).keypress(function(event)
		{
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
		$("#confirm_question").html(question);
		$("#confirm_button").html(button);
		$("#popup_bg").fadeTo(200, 0.5);
		$("#confirm").fadeTo(200, 1);

		$("#confirm_button").bind('click', function()
		{
			$("#confirm").css({width:normalWidth});
			$("#confirm").css({marginLeft:normalMargin});
			UI.hidePopup();	
		});

		$("#popup_bg").bind('click', function()
		{
			$("#confirm").css({width:normalWidth});
			$("#confirm").css({marginLeft:normalMargin});
			UI.hidePopup();
		});

		$(document).keypress(function(event)
		{
			if(event.which == 13)
			{
				$("#confirm").css({width:normalWidth});
				$("#confirm").css({marginLeft:normalMargin});
				UI.hidePopup();
			}
		});
	}

	this.hidePopup = function()
	{
		$("#popup_bg").hide();
		$("#confirm").hide();
		$("#alert").hide();
		$("#vote_reminder").hide();
		$("#confirm_button").unbind('click');
		$("#alert_button").unbind('click');
		$(document).unbind('keypress');
	}
}
var UI = new UI();
