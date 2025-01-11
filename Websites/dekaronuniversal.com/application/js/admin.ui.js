function UI(){
	this.initialize = function(){
		// Is the image slider enabled?

	}

	
	this.alert = function(question, time){		
		$("#alert_message").html(question);
		$('#alert').modal({
			show: 'true'
		}); 		
		if(typeof time == "undefined"){
			$("#alert_message").css({marginBottom:"10px"});
			$(".popup_links").show();
			$("#alert_button").bind('click', function(){
				UI.hidePopup();	
			});
		}else{
			$("#alert_message").css({marginBottom:"0px"});
			$(".popup_links").hide();
			setTimeout(function(){
				UI.hidePopup();
			}, time);
		}
		$(document).keypress(function(event){
			if(event.which == 13){
				UI.hidePopup();
			}
		});
	}
	this.confirm = function(question, button, callback, callback_cancel, width)
	{
		var normalWidth = $("#confirm").css("width");
		var normalMargin = $("#confirm").css("margin-left");
		if(width){
			$("#confirm").css({width: width+"px"});
			$("#confirm").css({marginLeft: "-"+(width/2)+"px"});
		}
		$(".popup_links").show();
		$("#confirm_question").html(question);
		$("#confirm_button").html(button);
		$('#confirm').modal({
			show: 'true'
		}); 		
		$("#confirm_button").bind('click', function(){
			$("#confirm").css({width:normalWidth});
			$("#confirm").css({marginLeft:normalMargin});
			callback();
			UI.hidePopup();	
		});
		$("#popup_bg").bind('click', function(){
			$("#confirm").css({width:normalWidth});
			$("#confirm").css({marginLeft:normalMargin});
			UI.hidePopup();
		});
		$(document).keypress(function(event){
			if(event.which == 13){
				$("#confirm").css({width:normalWidth});
				$("#confirm").css({marginLeft:normalMargin});
				callback();
				UI.hidePopup();
			}
		});
	}
	this.hidePopup = function(){
		$('#confirm').modal('hide');
		$('#alert').modal('hide');
		$("#confirm_button").unbind('click');
		$("#alert_button").unbind('click');
		$(document).unbind('keypress');
	}
	this.limitCharacters = function(field, indicator){
		var max = field.maxLength;
		var length = field.value.length;
		document.getElementById(indicator).innerHTML = length + " / " + max;
	}
}
var UI = new UI();