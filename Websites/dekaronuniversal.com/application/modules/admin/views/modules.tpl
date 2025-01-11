<div class="row grid-boxes">
    <div class="col-md-6">
        <h4 class="page-header">Installed modules (<div style="display:inline;" id="enabled_count">{count($enabled_modules)}</div>)</h4>
		<ul id="enabled_modules">
			{foreach from=$enabled_modules item=module key=key}
				<li>
					
                    {if hasPermission("toggleModules")}
						{if $module.enabled}
                        	<a onClick="Module.disableModule('{$key}', this);" class="btn btn-sm btn-danger">Disable</a>
                        {else}
                        	<a onClick="Module.enableModule('{$key}', this);" class="btn btn-sm btn-success">Enable</a>
                        {/if}
					{/if}
					{if $module.has_configs && hasPermission("editModuleConfigs")}
                    <a href="{$url}admin/edit/{$key}" class="btn btn-sm btn-default">Edit configs</a>
                    {else}
                    <b style="margin-left:84px;">&nbsp;</b>
                    {/if}
					<b>{ucfirst($module.name)}</b>
				</li>
			{/foreach}
		</ul>
    </div>
    <div class="col-md-6">
        <h4 class="page-header">Disabled modules (<div style="display:inline;" id="disabled_count">{count($disabled_modules)}</div>)</h4>
		<ul id="disabled_modules">
			{foreach from=$disabled_modules item=module key=key}
				<li>
					{if hasPermission("toggleModules")}
						{if $module.enabled}
                        	<a onClick="Module.disableModule('{$key}', this);" class="btn btn-sm btn-danger">Disable</a>
                        {else}
                        	<a onClick="Module.enableModule('{$key}', this);" class="btn btn-sm btn-success">Enable</a>
                        {/if}
					{/if}
					{if $module.has_configs && hasPermission("editModuleConfigs")}
                    	<a href="{$url}admin/edit/{$key}" class="btn btn-sm btn-default">Edit configs</a>
                    {else}
                    	<b style="margin-left:84px;">&nbsp;</b>
                    {/if}
					<b>{ucfirst($module.name)}</b>
				</li>
			{/foreach}
		</ul>
    </div>
</div>