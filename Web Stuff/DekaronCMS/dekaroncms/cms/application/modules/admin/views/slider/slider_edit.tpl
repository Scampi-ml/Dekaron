<div class="block block-themed">
	<div class="block-title">
		<h4>Edit slide</h4>
	</div>
	<div class="block-content">
		<form onSubmit="Slider.save(this, {$slide.id}); return false" id="submit_form" class="form-horizontal">
			<div class="form-group">
				<label for="image" class="control-label col-md-2">Image URL</label>
				<div class="col-md-10">
					<input type="text" class="form-control" name="image" id="image" placeholder=" slides/" value="{preg_replace('/{path}/', '', $slide.image)}"/>
				</div>
			</div>
			<div class="form-group">
				<label for="link" class="control-label col-md-2">Link (optional)</label>
				<div class="col-md-10">
					<input type="text" class="form-control"  name="link" id="link" placeholder="http://" value="{$slide.link}"/>
				</div>
			</div>
			<div class="form-group">
				<label for="text" class="control-label col-md-2">Image text (optional)</label>
				<div class="col-md-10">
					<input type="text" class="form-control"  name="text" id="text" value="{$slide.text}"/>
				</div>
			</div>								
			<div class="form-group form-actions">
				<div class="col-md-10 col-md-offset-2">
					<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Submit</button>
				</div>
			</div>	
		</form>				
	</div>
</div>