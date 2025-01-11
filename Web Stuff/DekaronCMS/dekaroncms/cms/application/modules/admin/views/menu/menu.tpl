<script type="text/javascript">
	var customPages = JSON.parse('{json_encode($pages)}');
</script>
<div class="clearfix">
    <a class="btn btn-sm btn-success" href="{$url}admin/menu/create"><i class="fa fa-pencil"></i> Create link</a>
</div>
<div class="block-selection">
	{if $links}
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Position</th>
                <th>Location</th>
                <th>Name</th>
                <th>Link</th>
                <th></th>
            </tr>
        </thead>        
        <tbody>          
        {foreach from=$links item=link}
        	<tr>
                <td>
                    <div class="btn-group">
                        <a class="btn btn-sm btn-default" onClick="Menu.move('up', {$link.id}, this)" href="javascript:void(0)" data-original-title="Move Up"><i class="fa fa-caret-up"></i></a>
                        &nbsp;
                        <a class="btn btn-sm btn-default" onClick="Menu.move('down', {$link.id}, this)" href="javascript:void(0)" data-original-title="Move Down"><i class="fa fa-caret-down"></i></a>
                    </div>                    
                </td>
                <td>{$link.side}</td>
                <td>{$link.name}</td>
                <td><a href="{$link.link}" target="_blank">{$link.link}</a></td>
                <td class="text-right">
                    <div class="btn-group">
                        <a class="btn btn-sm btn-success" href="{$url}admin/menu/edit/{$link.id}"><i class="fa fa-pencil"></i> Edit</a>
                        &nbsp;
                        <a class="btn btn-sm btn-danger" onClick="Menu.remove({$link.id}, this)"><i class="fa fa-times"></i> Delete</a>
                    </div>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>        
	{/if}
</div>