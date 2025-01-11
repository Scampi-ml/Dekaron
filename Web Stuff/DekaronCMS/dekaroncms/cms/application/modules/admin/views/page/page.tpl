<div class="clearfix">
    <a class="btn btn-sm btn-success" href="{$url}admin/page/create/"><i class="fa fa-pencil"></i> Create page</a>
</div>
<div class="block-selection">
	{if $pages}
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Page Link</th>
                <th>Page Name</th>
                <th></th>
            </tr>
        </thead>        
        <tbody>          
        {foreach from=$pages item=page}
        	<tr>
                <td><a href="{$url}page/{$page.identifier}/" target="_blank">/page/{$page.identifier}/</a></td>
                <td>{$page.name}</td>
                <td class="text-right">
                    <div class="btn-group">
                        	<a class="btn btn-sm btn-success"href="{$url}admin/page/edit/{$page.id}">Edit</a>
                        &nbsp;
                        	<a class="btn btn-sm btn-danger" href="javascript:void(0)" onClick="Pages.remove({$page.id})">Delete</a>
                    </div>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>        
	{/if}
</div>
