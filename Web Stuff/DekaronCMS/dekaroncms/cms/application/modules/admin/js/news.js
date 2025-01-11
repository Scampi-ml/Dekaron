window.CKEDITOR_BASEPATH = Config.URL + 'application/js/ckeditor/';
$.getScript(Config.URL + 'application/js/ckeditor/ckeditor.js', function(){
	CKEDITOR.config.toolbar = [
	   ['Styles','Format','Font','FontSize', 'Source'],
	   '/',
	   ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','-','Outdent','Indent','-'],
	   ['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	   ['Image','Table','-','Link','TextColor']
	] ;
});

var News = 
{
	remove: function(id, element)
	{
		UI.confirm("Do you really want to delete this article?", "Yes", function()
		{
			$(element).parents("tr").slideUp(300, function()
			{
				$(this).remove();
			});

			$.get(Config.URL + "admin/news/delete/" + id);
		});
	},
	send: function(id)
	{
		var data = {
			headline: $("#headline").val(),
			content: CKEDITOR.instances.editor1.getData(),
			csrf_token_name: Config.CSRF
		};

		$.post(Config.URL + "admin/news/send" + ((id) ? "/" + id : ""), data, function(response)
		{
			if(response == "yes")
			{
				Router.load(Config.URL + "admin/news");
			}
			else
			{
				UI.alert(response)
			}
		});
	}
}