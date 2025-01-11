<div class="block block-themed">
	<div class="block-title">
    	<h4>Create</h4>
    </div>
    <div class="block-content">
        <form onSubmit="News.send(); return false" class="form-horizontal" method="post" >
			<div class="form-group">
                <label for="general-text" class="control-label col-md-2">Headline</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="headline" id="headline" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">Content</label>
                <div class="col-md-10">
                	<textarea class="ckeditor" name="editor1" id="editor1"></textarea>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-md-10 col-md-offset-2">
                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Create article</button>
                </div>
            </div>
        </form>
    </div>
</div>