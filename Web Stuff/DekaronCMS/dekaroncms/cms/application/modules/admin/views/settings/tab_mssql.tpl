<form onSubmit="Settings.saveMssql(); return false" class="form-horizontal">
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">MSSQL Hostname</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="mssql_host" name="mssql_host" value="{$mssql_host}" />
            <span class="help-block"><i>MSSQL Server</i></span>
        </div>
    </div>  
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">MSSQL Username</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="mssql_username" name="mssql_username" value="{$mssql_username}" />
            <span class="help-block"><i>MSSQL Username</i></span>
        </div>
    </div> 
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">MSSQL Password</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="mssql_password" name="mssql_password" value="{$mssql_password}" />
            <span class="help-block"><i>MSSQL Password</i></span>
        </div>
    </div>
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">MSSQL Driver</label>
        <div class="col-md-10">
            <select name="mssql_driver" id="mssql_driver" size="1" class="form-control">
                <option value="sqlsrv" {if $mssql_driver == 'sqlsrv'}selected{/if}>SQLSRV (For SQL Servers 2008 or higher)</option>
                <option value="mssql" {if $mssql_driver == 'mssql'}selected{/if}>MSSQL (For SQL Servers 2000)</option>
            </select>
            <span class="help-block"><i>If you are unsure, please leave it at <b>SQLSRV</b></i></span>
        </div>
    </div>   
    <div class="form-group form-actions">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save Settings</button>
        </div>
    </div> 
</form>