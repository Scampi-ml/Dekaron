<form onSubmit="Settings.saveApi(this); return false" class="form-horizontal">
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">API Show Debug</label>
		<div class="col-md-10">	
			<select name="api_debug" id="api_debug" size="1" class="form-control">
				<option value="false" {if $api_debug == 'false'}selected='selected'{/if}>False (Recommended)</option>
				<option value="true" {if $api_debug == 'true'}selected='selected'{/if}>True</option>
			</select>
			<span class="help-block">
				<div class="alert alert-danger">
					<i class="fa fa-bullhorn"></i>
					This is usefull if you have connection issues.
					<br>
					If you set this to <b>true</b>, the API will result the debug info and will exit after that. 
					<br>
					This is NOT recommended on live sites, it will show allot of sensitive information.
				</div>
			</span>
		</div>
	</div> 	
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">API Server</label>
		<div class="col-md-10">			
			<input type="text" name="api_server" class="form-control" id="api_server" value="{$api_server}"/>
			<span class="help-block"><i>Must start with "http://"</i></span>
		</div>
	</div> 
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">API HTTP Authentication</label>
		<div class="col-md-10">			
			<select name="api_http_auth" id="api_http_auth" size="1" class="form-control">
				<option value="" {if $api_http_auth == ''}selected{/if}>None (No login required)</option>
				<option value="basic" {if $api_http_auth == 'basic'}selected{/if}>Basic (Relatively secure login)</option>
				<option value="digest" {if $api_http_auth == 'digest'}selected{/if}>Digest (Secure login)</option>
			</select>	
			<span class="help-block"><i>Is login required and if so, which type of login? Recommended: None</i></span>
		</div>
	</div> 
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">API Http User</label>
		<div class="col-md-10">			
			<input type="text" name="api_http_user" class="form-control" id="api_http_user" value="{$api_http_user}"/>
			<span class="help-block"><i>Must be filled in if API HTTP Authentication is set to "Bacis" or "Digest"</i></span>
		</div>
	</div> 
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">API Http Password</label>
		<div class="col-md-10">			
			<input type="text" name="api_http_pass" class="form-control" id="api_http_pass" value="{$api_http_pass}"/>
			<span class="help-block"><i>Must be filled in if API HTTP Authentication is set to "Bacis" or "Digest"</i></span>
		</div>
	</div> 
	<h4 class="sub-header">Advanded Settings</h4>
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">API SSl Verify Peer Password</label>
		<div class="col-md-10">			
			<input type="text" name="api_ssl_verify_peer" class="form-control" id="api_ssl_verify_peer" value="{$api_ssl_verify_peer}"/>
		</div>
	</div> 
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">API Send Cookies</label>
		<div class="col-md-10">			
			<input type="text" name="api_send_cookies" class="form-control" id="api_send_cookies" value="{$api_send_cookies}"/>
		</div>
	</div> 
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">API name</label>
		<div class="col-md-10">			
			<input type="text" name="api_api_name" class="form-control" id="api_api_name" value="{$api_api_name}"/>
		</div>
	</div> 
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">API Key</label>
		<div class="col-md-10">			
			<input type="text" name="api_api_key" class="form-control" id="api_api_key" value="{$api_api_key}"/>
		</div>
	</div> 
	<div class="form-group">
		<label for="slider_interval" class="control-label col-md-2">API SSl CA Info</label>
		<div class="col-md-10">			
			<input type="text" name="api_ssl_cainfo" class="form-control" id="api_ssl_cainfo" value="{$api_ssl_cainfo}"/>
		</div>
	</div> 
	<div class="form-group form-actions">
		<div class="col-md-10 col-md-offset-2">
			<button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save Settings</button>
		</div>
	</div>				
</form>

