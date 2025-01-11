{if $admin_username == 'admin' && $admin_password == 'admin'}
	<div class="alert alert-danger">
		<i class="fa fa-times-circle"></i> 
		The default login settings should be changed to prevent unwanted access to you admin panel!
	</div>
{/if}

<form onSubmit="Settings.saveLogin(this); return false" class="form-horizontal">		
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">Admin Nickname</label>
		<div class="col-md-10">			
			<input type="text" name="admin_nickname" class="form-control" id="admin_nickname" value="{$admin_nickname}"/>
			<span class="help-block"><i>This name will be used when you new news articles</i></span>
		</div>
	</div> 
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">Admin Username</label>
		<div class="col-md-10">			
			<input type="text" name="admin_username" class="form-control" id="admin_username" value="{$admin_username}"/>
			<span class="help-block"><i>Only use A-Z / 0-9 characters</i></span>
		</div>
	</div> 
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">Admin Password</label>
		<div class="col-md-10">			
			<input type="text" name="admin_password" class="form-control" id="admin_password" value="{$admin_password}"/>
			<span class="help-block"><i>Only use A-Z / 0-9 characters</i></span>
		</div>
	</div> 
	<div class="form-group form-actions">
		<div class="col-md-10 col-md-offset-2">
			<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save Settings</button>
		</div>
	</div>				
</form>