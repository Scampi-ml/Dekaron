<form onSubmit="Settings.saveSmtp(); return false" class="form-horizontal">
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">SMTP Hostname</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="smtp_host" name="smtp_host" value="{$smtp_host}" />
            <span class="help-block"><i>SMTP Server</i></span>
        </div>
    </div>  
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">SMTP Username</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="smtp_user" name="smtp_user" value="{$smtp_user}" />
            <span class="help-block"><i>SMTP Account username</i></span>
        </div>
    </div> 
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">SMTP Password</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="smtp_pass" name="smtp_pass" value="{$smtp_pass}" />
            <span class="help-block"><i>SMTP Account password</i></span>
        </div>
    </div>   
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">SMTP Port</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="smtp_port" name="smtp_port" value="{$smtp_port}" />
            <span class="help-block"><i>Set the SMTP port. Default: 25</i></span>
        </div>
    </div> 
    <div class="form-group form-actions">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save Settings</button>
        </div>
    </div> 
</form>
<h4 class="sub-header">Email Tester</h4>
This tool will send an email using the normal DekaronCMS email routines. You can use this tool to test that your server is able to send emails correctly. 
<br>
<br>
<div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> Please save your settings before testing!</div>
<form onSubmit="Settings.testEmail(); return false" class="form-horizontal">
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">To</label>
        <div class="col-md-10">
            <input type="text" name="to" class="form-control" id="to" />
            <span class="help-block"><i>Use an email that you have access to so you can verify it was received.</i></span>
        </div>
    </div>  
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">From</label>
        <div class="col-md-10">
            <input type="text" name="from" class="form-control" id="from" value="{$smtp_user}" />
        </div>
    </div> 
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Subject</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="subject" name="subject" value="DekaronCMS Email Test" />
        </div>
    </div>   
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Message</label>
        <div class="col-md-10">
            <textarea rows="3" class="form-control" name="message" id="message">This is an DekaronCMS Email Test message. If you received this, it works.</textarea>            
        </div>
    </div> 
    <div class="form-group form-actions">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Send Email</button>
        </div>
    </div> 
</form>