<table class="table table-condensed table-bordered">
	<thead>
		<tr>
			<th>State</th>
			<th>Module Name</th>
			<th>Version</th>
			<th>Author</th>
			<th>Last Updated</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$modules item=module key=key}		
			<tr>
				<td class="text-center">	
					{if $module.enabled}
						{if in_array($module.module_name, $core_modules)}
							<a class="btn btn-sm btn-inverse disabled">Disable</a>
							<a class="btn btn-sm btn-inverse disabled">Uninstall</a>
						{else}
							<a onClick="Module.disableModule('{$module.module_name}','{$module.name}', this);" class="btn btn-sm btn-danger">Disable</a>
							<a onClick="Module.deleteModule('{$module.module_name}','{$module.name}', this);" class="btn btn-sm btn-danger">Uninstall</a>
						{/if}
					{else}
						{if isset($module.install) && $module.install == 'yes'}
							<a onClick="Module.enableModule('{$module.module_name}','{$module.name}','Install', this);" class="btn btn-sm btn-success">Install</a>
						{else}
							<a onClick="Module.enableModule('{$module.module_name}','{$module.name}','Enable', this);" class="btn btn-sm btn-success">Enable</a>
						{/if}
						<a onClick="Module.deleteModule('{$module.module_name}','{$module.name}', this);" class="btn btn-sm btn-danger">Uninstall</a>
					{/if}
				</td>
				<td><b>{ucfirst($module.name)}</b><br><i>{$module.description}</i></td>
				<td>{$module.version}</td>
				<td><a href="{$module.website}">{$module.author}</a></td>
				<td>{if $module.update == 0}Up to date{else}<a class="btn btn-sm btn-success">Update</a>{/if}</td>
			</tr>
		{/foreach}
	</tbody>
</table>	

