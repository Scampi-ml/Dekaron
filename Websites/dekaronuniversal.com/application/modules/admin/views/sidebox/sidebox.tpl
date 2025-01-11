<div class="block block-themed">
    <div class="block-title">
        <div class="block-options">
        	<a title="" data-toggle="modal" href="#modal-regular" class="btn btn-option enable-tooltip" href="javascript:void(0)" data-original-title="Create sidebox" onClick="Sidebox.add()"><i class="fa fa-plus"></i></a>
        </div>
        <h4>Sideboxes {if !$sideboxes}0{else}{count($sideboxes)}{/if}</h4>
    </div>
    <div class="block-content">
		{if $sideboxes}
        	<table width="100%" class="table table-condensed">
                {foreach from=$sideboxes item=sidebox}
                    <tr>
                        <td width="10%">
                            <a class="btn btn-sm btn-default" onClick="Sidebox.move('up', {$sidebox.id}, this)" href="javascript:void(0)" data-original-title="Move Up"><i class="fa fa-caret-up"></i></a>
                            <a class="btn btn-sm btn-default" onClick="Sidebox.move('down', {$sidebox.id}, this)" href="javascript:void(0)" data-original-title="Move Down"><i class="fa fa-caret-down"></i></a>
                        </td>
                        <td width="20%"><b>{langColumn($sidebox.displayName)}</b></td>
                        <td width="30%">{$sidebox.name}</td>
                        <td width="30%">
                            {if $sidebox.permission}
                                Controlled per group
                            {else}
                                Visible to everyone
                            {/if}
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-sm btn-success" href="{$url}admin/sidebox/edit/{$sidebox.id}"><i class="fa fa-pencil"></i> Edit</a>
                                <a class="btn btn-sm btn-danger" onClick="Sidebox.remove({$sidebox.id}, this)"><i class="fa fa-times"></i> Delete</a>
                            </div>                                
                        </td>
                    </tr>
                {/foreach}
            </table>
		{/if}
	</div>
</div>

<div class="modal fade" id="modal-regular" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Sideboxes</a> &rarr; New sidebox</h4>
            </div>
            <div class="modal-body">
                <p>
                    <form onSubmit="Sidebox.create(this); return false" id="submit_form">
                        <label for="displayName">Headline</label>
                        <input type="text" name="displayName" id="displayName" />
                
                        <label for="type">Sidebox module</label>
                        <select id="type" name="type" onChange="Sidebox.toggleCustom(this)">
                            {foreach from=$sideboxModules item=module key=name}
                                <option value="{$name}">{$module.name}</option>
                            {/foreach}
                        </select>
                
                        <label for="visibility">Visibility mode</label>
                        <select name="visibility" id="visibility" onChange="if(this.value == 'group'){ $('#groups').fadeIn(300); } else { $('#groups').fadeOut(300); }">
                            <option value="everyone" selected>Visible to everyone</option>
                            <option value="group">Controlled per group</option>
                        </select>
                
                        <div style="display:none" id="groups">
                            Please manage the group visibility via <a href="{$url}admin/aclmanager/groups">the group manager</a> once you have created the sidebox
                        </div>
                    </form>
                
                    <span id="custom_field" style="padding-top:0px;padding-bottom:0px;">
                        <label for="text">Content</label>
                        {$fusionEditor}
                    </span>
                
                    <form onSubmit="Sidebox.create(document.getElementById('submit_form')); return false">
                        <input type="submit" value="Submit sidebox" />
                    </form>                
                </p>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger">Close</button>
            </div>
        </div>
    </div>
</div>



