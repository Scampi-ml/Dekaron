<div class="block block-themed themed-default">
    <div class="block-title"><h4>Edit Link</h4></div>
    <div class="block-content full">
        <form onSubmit="Menu.save(this, {$link.id}); return false" id="submit_form" class="form-horizontal">
            <div class="form-group">
                <label for="name" class="control-label col-md-2">Title</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="name" id="name" placeholder="My link" value="{htmlspecialchars($link.name)}" />
                </div>
            </div>        
             <div class="form-group">
                <label for="name" class="control-label col-md-2">URL</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="link" id="link" placeholder="http://" value="{$link.link}" />
                    <span class="help-block">External links must begin with http://</span>
                </div>
            </div>         
            <div class="form-group">
                <label for="name" class="control-label col-md-2">Menu location</label>
                <div class="col-md-3">
                    <select size="1" class="form-control" name="side" id="side" >
                        <option value="top" {if $link.side == "top"}selected{/if}>Top</option>
                        <option value="side" {if $link.side == "side"}selected{/if}>Side</option>
                    </select>                
                </div>
            </div>           
            <div class="form-group">
                <label for="visibility" class="control-label col-md-2">Visibility mode</label>
                <div class="col-md-3">
                    <select size="1" class="form-control" name="visibility" id="visibility" onChange="if(this.value == 'group'){ $('#groups').fadeIn(300); } else { $('#groups').fadeOut(300); }" >
                        <option value="everyone" {if !$link.permission}selected{/if}>Visible to everyone</option>
                        <option value="group" {if $link.permission}selected{/if}>Controlled per group</option>
                    </select>                
                </div>
            </div>  
            <div {if !$link.permission}style="display:none"{/if} id="groups">
                <div class="form-group">
                    <label for="name" class="control-label col-md-2">&nbsp;</label>
                    <div class="col-md-3">
                        <span class="help-block">Please manage the group visibility via <a href="{$url}admin/aclmanager/groups">the group manager</a></span>
                    </div>
                </div>  
            </div>            
            <div class="form-group">
                <label for="visibility" class="control-label col-md-2">Internal direct link</label>
                <div class="col-md-3">
                    <select size="1" class="form-control" name="direct_link" id="direct_link" >
                        <option value="0" {if $link.direct_link == "0"}selected{/if}>No</option>
                        <option value="1" {if $link.direct_link == "1"}selected{/if}>Yes</option>
                    </select>   
                    <span class="help-block">If you want to link to a non-DekaronCMS page on the same domain, you must select 'Yes' otherwise DekaronCMS will try to load it 'inside' the theme.</span>             
                </div>
            </div>  
            <div class="form-group form-actions">
                <div class="col-md-10 col-md-offset-2">
                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Save link</button>
                </div>
            </div>
        </form>
    </div>
</div>