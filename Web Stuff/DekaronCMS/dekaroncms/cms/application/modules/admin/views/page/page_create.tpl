<div class="block block-themed">
    <div class="block-title">
        <h4>Create page</h4>
    </div>
    <div class="block-content">
		<form onSubmit="Pages.send(); return false" class="form-horizontal">
			<div class="form-group">
				<label for="headline" class="control-label col-md-2">Headline</label>
				<div class="col-md-10">
					<input type="text" class="form-control"  name="headline" id="headline" />
				</div>
			</div>
			<div class="form-group">
				<label for="identifier" class="control-label col-md-2">Unique link identifier</label>
				<div class="col-md-10">
					<input type="text" class="form-control"  name="identifier" id="identifier"/>
					<span class="help-block">(as in mywebsite.com/page/<b>mypage</b>)</span>
				</div>
			</div>	
			<div class="form-group">
				<label for="visibility" class="control-label col-md-2">Visibility mode</label>
				<div class="col-md-10">
					<select name="visibility" id="visibility">
						<option value="everyone" selected >Visible to everyone</option>
						<option value="group">Controlled per group</option>
					</select>
				
				</div>
			</div>
			<div class="form-group">
				<label for="pages_content" class="control-label col-md-2">Page Content</label>
				<div class="col-md-10">
					<textarea name="editor1" class="ckeditor" id="editor1"></textarea>
				</div>
			</div>						
			<div class="form-group form-actions">
				<div class="col-md-10 col-md-offset-2">
					<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Create Page</button>
				</div>
			</div>
		</form>           
    </div>
</div>