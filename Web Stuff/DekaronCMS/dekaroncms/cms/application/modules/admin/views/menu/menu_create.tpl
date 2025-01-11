<div class="block block-themed themed-default">
    <div class="block-title"><h4>Create Link</h4></div>
    <div class="block-content full">
        <form onSubmit="Menu.create(); return false" id="submit_form" class="form-horizontal">
            <div class="form-group">
                <label for="name" class="control-label col-md-2">Title</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="name" id="name" placeholder="My link" />
                </div>
            </div>        
             <div class="form-group">
                <label for="name" class="control-label col-md-2">URL</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="link" id="link" placeholder="http://" />
                    <span class="help-block">External links must begin with http://</span>
                </div>
            </div>         
            <div class="form-group">
                <label for="name" class="control-label col-md-2">Menu location</label>
                <div class="col-md-10">
                    <select size="1" class="form-control" name="side" id="side" >
                        <option value="top" selected>Top</option>
                        <option value="side" >Side</option>
                    </select>                
                </div>
            </div>           
            <div class="form-group">
                <label for="visibility" class="control-label col-md-2">Visibility mode</label>
                <div class="col-md-10">
                    <select size="1" class="form-control" name="visibility" id="visibility" >
                        <option value="everyone" selected >Visible to everyone</option>
                        <option value="group" >Controlled per group</option>
                    </select>                
                </div>
            </div>  
            <div class="form-group">
                <label for="visibility" class="control-label col-md-2">Internal direct link</label>
                <div class="col-md-10">
                    <select size="1" class="form-control" name="direct_link" id="direct_link" >
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>   
                    <span class="help-block">If you want to link to a non-DekaronCMS page on the same domain, you must select 'Yes' otherwise DekaronCMS will try to load it 'inside' the theme.</span>             
                </div>
            </div>  
            <div class="form-group form-actions">
                <div class="col-md-10 col-md-offset-2">
                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save menu</button>
                </div>
            </div>
        </form>
    </div>
</div>