<form onSubmit="Settings.saveWebsite(); return false" class="form-horizontal">
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Website title</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="title" name="title" placeholder="MyServer" value="{$title}" />
            <span class="help-block"><i>The title that is displayed on the top of your browser.</i></span>
        </div>
    </div>        
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Server name</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="server_name" name="server_name" placeholder="MyServer" value="{$server_name}" />
            <span class="help-block"><i>Will be used to define your server</i></span>
        </div>
    </div>         
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Search engine: Keywords</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="keywords" name="keywords" placeholder="dekaron,private server,pvp" value="{$keywords}" />
            <span class="help-block"><i>Separated by a comma ","</i></span>
        </div>
    </div> 
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Search engine: Description</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="description" name="description" placeholder="Best private server in the entire world!" value="{$description}" />
            <span class="help-block"><i>Define a description of your web page</i></span>
        </div>
    </div>   
    <div class="form-group">
        <label for="name" class="control-label col-md-2">News Limit</label>
        <div class="col-md-10">
            <select name="news_limit" id="news_limit" size="1" class="form-control">
                <option value="1" {if $news_limit == 1}selected='selected'{/if}>1</option>
                <option value="2" {if $news_limit == 2}selected='selected'{/if}>2</option>
                <option value="3" {if $news_limit == 3}selected='selected'{/if}>3</option>
                <option value="4" {if $news_limit == 4}selected='selected'{/if}>4</option>
                <option value="5" {if $news_limit == 5}selected='selected'{/if}>5 (Recommended)</option>
                <option value="6" {if $news_limit == 6}selected='selected'{/if}>6</option>
                <option value="7" {if $news_limit == 7}selected='selected'{/if}>7</option>
                <option value="8" {if $news_limit == 8}selected='selected'{/if}>8</option>
                <option value="9" {if $news_limit == 9}selected='selected'{/if}>9</option>
                <option value="10" {if $news_limit == 10}selected='selected'{/if}>10</option>
            </select>
            <span class="help-block"><i>The number of news articles on the homepage</i></span>
        </div>
    </div>  
    <div class="form-group">
        <label for="name" class="control-label col-md-2">Connection Type</label>
        <div class="col-md-10">
            <select name="connection_type" id="connection_type" size="1" class="form-control">
                <option value="local" {if $connection_type == 'local'}selected{/if}>SQL Server (Use your MsSQL connection)</option>
                <option value="api" {if $connection_type == 'api'}selected{/if}>API (Use the build-in API System)</option>
                <option value="none" {if $connection_type == 'none' }selected{/if}>None (Users will not be able to login)</option>
            </select>
            <span class="help-block">
                <div class="alert alert-danger">
                    <i class="fa fa-bullhorn"></i>
                    If you change the Connection Type, please change the corresponding settings
                    <br>
                    You can find them in the tabs (Above) in the settings menu
                </div>
            </span>                   
        </div>
    </div> 
    <div class="form-group form-actions">
        <div class="col-md-10 col-md-offset-2">
            <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save Settings</button>
        </div>
    </div>
</form>