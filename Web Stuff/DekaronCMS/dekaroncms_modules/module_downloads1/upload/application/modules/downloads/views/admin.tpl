<div class="clearfix">
    <a class="btn btn-sm btn-success" href="{$url}downloads/admin/create"><i class="fa fa-pencil"></i> Create Download</a>
</div>
<div class="block-selection">
	{if $downloads}
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Name</th>
                <th>Link</th>
                <th></th>
            </tr>
        </thead>        
        <tbody>          
        {foreach from=$downloads item=download}
        	<tr>
                <td>{$download.download_name}</td>
                <td><a href="{$download.download_link}" target="_blank">{$download.download_link}</a></td>
                <td class="text-right">
                    <div class="btn-group">
                        <a class="btn btn-sm btn-success" href="{$url}downloads/admin/edit/{$download.id}"><i class="fa fa-pencil"></i> Edit</a>
                        &nbsp;
                        <a class="btn btn-sm btn-danger" onClick="Downloads.remove({$download.id}, this)"><i class="fa fa-times"></i> Delete</a>
                    </div>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>        
	{/if}
</div>