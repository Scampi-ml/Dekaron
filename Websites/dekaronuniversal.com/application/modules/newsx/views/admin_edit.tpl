{TinyMCE()}
<section class="box big">
	<h2>Edit article</h2>

	<form onSubmit="News.send({$article.id}); return false">
		<label for="headline">Headline</label>
		<input type="hidden" id="headline" value="{htmlspecialchars($article.headline)}"/>
		
		<label for="news_content">
			Content
		</label>
	</form>
		<div style="padding:10px;">
			<textarea name="news_content" class="tinymce" id="news_content" cols="30" rows="10">{$article.content}</textarea>
		</div>
	<form onSubmit="News.send({$article.id}); return false">
		<input type="submit" value="Save article" />
	</form>
</section>
