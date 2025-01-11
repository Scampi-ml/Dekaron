<form onSubmit="Donate_paypal.save(); return false" class="form-horizontal">
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Mode</label>
        <div class="col-md-10"> 
            <select name="paypal_mode" id="paypal_mode" size="1" class="form-control">
                <option value="sandbox" {if $paypal_mode == 'sandbox'}selected='selected'{/if}>Sandbox (for testing) </option>
                <option value="live" {if $paypal_mode == 'live'}selected='selected'{/if}>Live (production)</option>
            </select>
        </div>
    </div>  
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Client Secret</label>
        <div class="col-md-10">         
            <input type="text" name="paypal_clientSecret" class="form-control" id="paypal_clientSecret" value="{$paypal_clientSecret}"/>
        </div>
    </div> 
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Client Id</label>
        <div class="col-md-10">         
            <input type="text" name="paypal_clientId" class="form-control" id="paypal_clientId" value="{$paypal_clientId}"/>
        </div>
    </div> 

    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Paypal Currency</label>
        <div class="col-md-10">         
            <input type="text" name="paypal_currency" class="form-control" id="paypal_currency" value="{$paypal_currency}"/>
            <span class="help-block">Example: EUR, USD, GBP, ....</span>
        </div>
    </div> 

    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Connection TimeOut</label>
        <div class="col-md-10">         
            <input type="text" name="paypal_ConnectionTimeOut" class="form-control" id="paypal_ConnectionTimeOut" value="{$paypal_ConnectionTimeOut}"/>
        </div>
    </div> 
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Log Enabled</label>
        <div class="col-md-10"> 
            <select name="paypal_LogEnabled" id="paypal_LogEnabled" size="1" class="form-control">
                <option value="false" {if $paypal_LogEnabled == 'false'}selected='selected'{/if}>False </option>
                <option value="true" {if $paypal_LogEnabled == 'true'}selected='selected'{/if}>True </option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Log Level</label>
        <div class="col-md-10"> 
            <select name="paypal_LogLevel" id="paypal_LogLevel" size="1" class="form-control">
                <option value="FINE" {if $paypal_LogLevel == 'FINE'}selected='selected'{/if}>FINE </option>
                <option value="INFO" {if $paypal_LogLevel == 'INFO'}selected='selected'{/if}>INFO </option>
                <option value="WARN" {if $paypal_LogLevel == 'WARN'}selected='selected'{/if}>WARN </option>
                <option value="ERROR" {if $paypal_LogLevel == 'ERROR'}selected='selected'{/if}>ERROR </option>
            </select>
            <span class="help-block">Logging is most verbose in the 'FINE' level and decreases as you proceed towards ERROR.</span>
        </div>
    </div>
    <div class="form-group">
        <label for="slider_interval" class="control-label col-md-2">Validation Level</label>
        <div class="col-md-10"> 
            <select name="paypal_validationLevel" id="paypal_validationLevel" size="1" class="form-control">
                <option value="log" {if $paypal_validationLevel == 'log'}selected='selected'{/if}>log (logs the error message to logger only (default))</option>
                <option value="strict" {if $paypal_validationLevel == 'strict'}selected='selected'{/if}>strict (throws a php notice message)</option>
                <option value="disable" {if $paypal_validationLevel == 'disable'}selected='selected'{/if}>disable (disable the validation)</option>
            </select>
            <span class="help-block">If validation is set to strict, the PPModel would make sure that there are proper accessors (Getters and Setters) for each model objects.</span>
        </div>
    </div>
    <div class="form-group form-actions">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save Settings</button>
        </div>
    </div>              
</form>