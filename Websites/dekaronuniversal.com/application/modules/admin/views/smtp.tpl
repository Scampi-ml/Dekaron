<form onSubmit="Smtp.saveSmtpSettings(); return false" class="form-horizontal">
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">SMTP hostname</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="smtp_host" value="{$smtp.smtp_host}" />
        </div>
    </div>  
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">SMTP username</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="smtp_user" value="{$smtp.smtp_user}" />
        </div>
    </div> 
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">SMTP password</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="smtp_pass" value="{$smtp.smtp_pass}" />
        </div>
    </div>   
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">SMTP port</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="smtp_port" value="{$smtp.smtp_port}" />
        </div>
    </div> 
    <div class="form-group form-actions">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Submit</button>
        </div>
    </div>                                                                    
</form>