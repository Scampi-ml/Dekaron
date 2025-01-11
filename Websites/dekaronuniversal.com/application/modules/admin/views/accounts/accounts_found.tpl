<form onSubmit="Accounts.save(this, {$external_details.id}); return false" id="submit_form" class="form-horizontal" >
    <div class="form-group">
        <label class="control-label col-md-2">Account</label>
        <div class="col-md-3">
            <p class="form-control-static">({$external_details.id}) <b>{$external_details.username}</b></p>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-2">Last log in</label>
        <div class="col-md-3">
            <p class="form-control-static"><b>{$external_details.last_login}</b> by <b>{$external_details.last_ip}</b></p>
        </div>
    </div>
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Nickname</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="nickname" name="nickname" value="{$internal_details.nickname}" {if !hasPermission("editAccounts")}disabled="disabled"{/if} />
        </div>
    </div>	
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Email</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="email" name="email" value="{$external_details.email}" {if !hasPermission("editAccounts")}disabled="disabled"{/if} />
        </div>
    </div>	

    <div class="form-group">
        <label class="control-label col-md-2">Website user group</label>
        <div class="col-md-3">
            <p class="form-control-static">Please assign groups at <a href="{$url}admin/aclmanager/groups">the group manager</a></p>
        </div>
    </div>
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">Change password</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="password" name="password" placeholder="Enter a new password" {if !hasPermission("editAccounts")}disabled="disabled"{/if} />
        </div>
    </div>
    <div class="form-group">
        <label for="general-text" class="control-label col-md-2">GM level</label>
        <div class="col-md-3">
            <input type="text" class="form-control" id="gm_level" name="gm_level" value="{$access_id.gmlevel}" {if !hasPermission("editAccounts")}disabled="disabled"{/if} />
        </div>
    </div>
	{if hasPermission("editPermissions")}
        <div class="alert alert-info">
        A user can be specifically allowed or denied to perform a certain action.
        By setting a user permission, the value you set overrides the group roles
        (example: the user group is allowed to submit comments, but you set the user
        specifically not to be allowed to - then the user won't be allowed to, despite
        being assigned to a group that is allowed to.)
        </div>    
        {foreach from=$modules key=name item=module}
            {if $module.manifest}
                <h4 class="sub-header">{ucfirst($module.name)}</h4>
                {if $module.manifest}
                    {foreach from=$module.manifest key=permissionName item=permission}
                        <div class="form-group">
                            <label for="{$name}-{$permissionName}" class="control-label col-md-2">{$permissionName}</label>
                            <div class="col-md-3">
                                <select size="1" class="form-control" name="{$name}-{$permissionName}" id="{$name}-{$permissionName}" {if !hasPermission("editAccounts")}disabled="disabled"{/if}>
                                    <option value="0" selected>Please select</option>
                                    <option value="1">Allow</option>
                                    <option value="0">Deny</option>
                                </select>
                                <span class="help-block">{$permission.description} (default: {($permission.default) ? "allow" : "deny"})</span>
                            </div>
                        </div>                                        
                    {/foreach}
                {/if}
            {/if}
        {/foreach}
	{/if}

	{if hasPermission("editAccounts")}
        <div class="form-group form-actions">
            <div class="col-md-10 col-md-offset-2">
                <button class="btn btn-success" type="submit" value="Save account"><i class="fa fa-check"></i> Submit</button>
            </div>
        </div>    
	{/if}
</form>