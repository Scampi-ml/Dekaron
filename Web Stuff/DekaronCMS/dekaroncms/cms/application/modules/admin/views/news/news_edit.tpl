<div class="block block-themed">
	<div class="block-title">
    	<h4>Edit Article</h4>
    </div>
    <div class="block-content">
        <form onSubmit="News.send({$article.id}); return false" class="form-horizontal" method="post" >          
			<div class="form-group">
                <label for="general-text" class="control-label col-md-2">Headline</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="headline" id="headline" value="{htmlspecialchars($article.headline)}">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-2">Content</label>
                <div class="col-md-10">
                	<textarea class="ckeditor" name="editor1" id="editor1">{$article.content}</textarea>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-md-10 col-md-offset-2">
                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save article</button>
                </div>
            </div>
        </form>
    </div>
</div>
