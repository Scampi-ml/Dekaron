window.CKEDITOR_BASEPATH = Config.URL + 'application/js/ckeditor/';
$.getScript(Config.URL + 'application/js/ckeditor/ckeditor.js', function(){
	CKEDITOR.config.toolbar = [
	   ['Styles','Format','Font','FontSize','Source'],
	   '/',
	   ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','-','Outdent','Indent','-'],
	   ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	   ['Image','Table','-','Link','TextColor']
	] ;
});

var Pages = {

	remove: function(id)
	{
		UI.confirm("Do you really want to delete this page?", "Yes", function()
		{
			var data = {
				csrf_token_name: Config.CSRF
			};

			$.post(Config.URL + "admin/page/delete" + ((id) ? "/" + id : ""), data, function(response)
			{
				if(response == "yes")
				{
					Router.load(Config.URL + "admin/page");
				}
				else
				{
					UI.alert(response);
				}
			});
		});
	},

	send: function(id)
	{
		var data = {
			name: $("#headline").val(),
			identifier: $("#identifier").val(),
			content: CKEDITOR.instances.editor1.getData(),
			visibility: $("#visibility").val(),
			csrf_token_name: Config.CSRF
		};

		$.post(Config.URL + "admin/page/send" + ((id) ? "/" + id : ""), data, function(response)
		{
			if(response == "yes")
			{
				Router.load(Config.URL + "admin/page");
			}
			else
			{
				UI.alert(response)
			}
		});
	}
}