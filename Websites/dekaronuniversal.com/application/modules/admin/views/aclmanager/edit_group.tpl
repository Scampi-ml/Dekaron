<div class="block block-themed">
    <div class="block-title">
        <h4>Edit group</h4>
    </div>
    <div class="block-content">
    	<div class="row grid-boxes">
			<div class="col-md-7">
                <form onSubmit="Groups.save(this, {$group.id}); return false" id="submit_form" class="form-horizontal">
                    <div class="form-group">
                        <label for="general-text" class="control-label col-md-2">Group name</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="name" id="name" value="{$group.name}" />
                            
                        </div>
                    </div>	
                    <div class="form-group">
                        <label for="general-text" class="control-label col-md-2">Description</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="description" id="description" value="{$group.description}" />
                            <span class="help-block">(optional)</span>
                        </div>
                    </div>	
                    <div class="form-group">
                        <label for="general-text" class="control-label col-md-2">Group color</label>
                        <div class="col-md-3">
                            <input type="color" class="form-control"  name="color" id="color" value="{$group.color}" />
                            <span class="help-block">(optional)</span>
                        </div>
                    </div>
                    <h4 class="sub-header">Visibility permissions</h4>	
                    {if $links}
                        <h3>Menu links</h3>
                        <table width="100%" class="table table-condensed">
                            {foreach from=$links item=link}
                                    {if $link.permission}
                                        <tr>
                                            <td width="5%"><input type="checkbox" name="MENU_{$link.id}" id="MENU_{$link.id}" {if $link.has}checked="checked"{/if}></td>
                                            <td width="25%">{$link.side}</td>
                                            <td>{langColumn($link.name)}</td>
                                            <td>{$link.link}</td>
                                        </tr>
                                    {else}
                                        <tr style="opacity:0.6">
                                            <td width="5%"><input type="checkbox" disabled="disabled" checked="checked"></td>
                                            <td width="25%">{$link.side}</td>
                                            <td>{langColumn($link.name)}</td>
                                            <td>{$link.link}</td>
                                        </tr>
                                    {/if}		
                            {/foreach}
                        </table>
                    {/if}
                    {if $pages}
                        <h4 class="sub-header">Custom pages</h4>
                        <table width="100%" class="table table-condensed">
                            {foreach from=$pages item=page}
                                
                                    {if $page.permission}
                                        <tr>
                                            <td width="5%"><input type="checkbox" name="PAGE_{$page.id}" id="PAGE_{$page.id}" {if $page.has}checked="checked"{/if}></td>
                                            <td width="25%">{langColumn($page.name)}</td>
                                            <td >pages/{$page.identifier}</td>
                                        </tr>
                                    {else}
                                        <tr style="opacity:0.6">
                                            <td width="5%"><input type="checkbox" disabled="disabled" checked="checked"></td>
                                            <td width="25%">{langColumn($page.name)}</td>
                                            <td>pages/{$page.identifier}</td>
                                        </tr>
                                    {/if}		
                            {/foreach}
                        </table>
                    {/if}
                    {if $sideboxes}
                        <h3>Sideboxes</h3>
                        <table width="100%" class="table table-condensed">
                            {foreach from=$sideboxes item=sidebox}                                
                                {if $sidebox.permission}
                                    <tr>
                                        <td width="5%" style="text-align:center;"><input type="checkbox" name="SIDEBOX_{$sidebox.id}" id="SIDEBOX_{$sidebox.id}" {if $sidebox.has}checked="checked"{/if}></td>
                                        <td width="25%">{langColumn($sidebox.displayName)}</td>
                                        <td >{$sidebox.type}</td>
                                    </tr>
                                {else}
                                    <tr style="opacity:0.6">
                                        <td width="5%" ><input type="checkbox" disabled="disabled" checked="checked"></td>
                                        <td width="25%">{langColumn($sidebox.displayName)}</td>
                                        <td >{$sidebox.type}</td>
                                    </tr>
                                {/if}		
                            {/foreach}
                        </table>
                    {/if}

                    <h4 class="sub-header">Roles</h4>  
                    <div class="alert alert-info">
                        A role is a pre-defined set of permissions. The color indicates the role's danger-level. Please note that certain permissions may have a default value of 'allowed', such as actions that are meant to be performed by everyone by default.
                    </div>
                    <a href="javascript:void(0)" onClick="$('#roles input[type=checkbox]').each(function(){ this.checked = true; });" style="float:right;display:block;" class="btn btn-default">Select all</a>                                
                    <div id="roles">
                        {foreach from=$modules key=name item=module}
                            {if $module.db || $module.manifest}
                                <h3>{ucfirst($module.name)}</h3>
                                <table width="100%" class="table table-condensed">
                                    {if $module.db}
                                        {foreach from=$module.db item=role}
                                            <tr>
                                                <td width="5%"><input type="checkbox" name="{$name}-{$role.name}" id="{$name}-{$role.name}" {if $role.has}checked="checked"{/if}></td>
                                                <td width="25%">Custom role: {$role.name}</td>
                                                <td >{$role.description}</td>
                                            </tr>
                                        {/foreach}
                                    {/if}
                                    {if $module.manifest}
                                        {foreach from=$module.manifest key=roleName item=role}
                                            <tr>
                                                <td width="5%"><input type="checkbox" name="{$name}-{$roleName}" id="{$name}-{$roleName}" {if $role.has}checked="checked"{/if}></td>
                                                <td width="25%"><label style="{if isset($role.color)}color:{$role.color};{/if}">{$roleName}</label></td>
                                                <td >{$role.description}</td>
                                            </tr>
                                        {/foreach}
                                    {/if}
                                </table>
                            {/if}
                        {/foreach}
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-md-10 col-md-offset-2">
                            <button class="btn btn-success" type="submit" value="Save account"><i class="fa fa-check"></i> Submit</button>
                        </div>
                    </div>             
                </form> 
            </div>
			<div class="col-md-5">
                <h4 class="sub-header">Members</h4>	
                <div class="memberList">
                    {if $group.id == $guestId}
                        Visitors that are signed out will automatically be assigned to this group
                    {elseif $group.id == $playerId}
                        Visitors that are signed in will automatically be assigned to this group
                    {else}
                        {if $members}
                            {foreach from=$members item=member}
                                <a href="javascript:void(0)" onClick="Groups.removeAccount('{$member.username}', this, {$group.id} {if $member.username == $CI->user->getUsername()}, true{/if})">
                                    <img src="{$url}application/images/icons/delete.png" />
                                    {ucfirst($member.username)}
                                </a>
                            {/foreach}
                        {/if}
                        <a href="javascript:void(0)" onClick="Groups.addAccount(this, {$group.id})" class="add"><img src="{$url}application/images/icons/add.png" />Add</a>
                        <div class="clear"></div>
                    {/if}
                </div>             
            </div>            
		</div>                   
    </div>
</div>