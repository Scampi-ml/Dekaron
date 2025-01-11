<form onSubmit="Register.save(); return false" class="form-horizontal">
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Use Captcha</label>
        <div class="col-md-10"> 
            <select name="use_captcha" id="use_captcha" size="1" class="form-control">
                <option value="false" {if $use_captcha == 'false'}selected='selected'{/if}>False </option>
                <option value="true" {if $use_captcha == 'true'}selected='selected'{/if}>True (Recommended)</option>
            </select>
            <span class="help-block">This setting prevents spam accounts.</span>
        </div>
    </div>  
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Captcha Length</label>
        <div class="col-md-10">         
            <input type="text" name="captcha_length" class="form-control" id="captcha_length" value="{$captcha_length}"/>
            <span class="help-block"><i>The number of characters users need to enter</i></span>
        </div>
    </div> 
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Captcha Distortion Level</label>
        <div class="col-md-10">         
            <input type="text" name="captcha_distortionLevel" class="form-control" id="captcha_distortionLevel" value="{$captcha_distortionLevel}"/>
            <span class="help-block"><i>The number of lines in the Captcha. More = Less visibility</i></span>
        </div>
    </div> 
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Captcha Height</label>
        <div class="col-md-10">         
            <input type="text" name="captcha_height" class="form-control" id="captcha_height" value="{$captcha_height}"/>
            <span class="help-block"><i>The height of the Captcha in pixels</i></span>
        </div>
    </div> 
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Captcha Width</label>
        <div class="col-md-10">         
            <input type="text" name="captcha_width" class="form-control" id="captcha_width" value="{$captcha_width}"/>
            <span class="help-block"><i>The width of the Captcha in pixels. Enter "auto" or "xx" (pixels)</i></span>
        </div>
    </div> 
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Min Length Username</label>
        <div class="col-md-10">         
            <input type="text" name="min_length_username" class="form-control" id="min_length_username" value="{$min_length_username}"/>
            <span class="help-block"><i>The minimum characters for a username</i></span>
        </div>
    </div> 
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Max Length Username</label>
        <div class="col-md-10">         
            <input type="text" name="max_length_username" class="form-control" id="max_length_username" value="{$max_length_username}"/>
            <span class="help-block"><i>The maximum characters for a username</i></span>
        </div>
    </div> 
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Min Length Password</label>
        <div class="col-md-10">         
            <input type="text" name="min_length_password" class="form-control" id="min_length_password" value="{$min_length_password}"/>
            <span class="help-block"><i>The minimum characters for a password</i></span>
        </div>
    </div> 
    <div class="form-group form-actions">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save Settings</button>
        </div>
    </div>              
</form>

