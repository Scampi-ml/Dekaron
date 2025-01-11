<h4 class="page-header">Website</h4>
<form onSubmit="Settings.saveWebsiteSettings(); return false" class="form-horizontal">
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Website title</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="title" placeholder="MyServer" value="{$config.title}" />
        </div>
    </div>        
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Server name</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="server_name" placeholder="MyServer" value="{$config.server_name}" />
        </div>
    </div>         
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Search engine: keywords (separated by comma)</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="keywords" placeholder="dekaron,private server,pvp" value="{$config.keywords}" />
        </div>
    </div> 
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Search engine: description</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="description" placeholder="Best private server in the entire world!" value="{$config.description}" />
        </div>
    </div>            
    <div class="form-group form-actions">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Submit</button>
        </div>
    </div>
</form>