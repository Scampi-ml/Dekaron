<div class="clearfix">
    <a class="btn btn-sm btn-success" href="{$url}donate_paypal/items/add"><i class="fa fa-pencil"></i> Add Item</a>
</div>
{if $items}
	<table class="table table-condensed">
	    <thead>
	        <tr>
	            <th>Price</th>
	            <th>Coins</th>
	            <th></th>
	        </tr>
	    </thead>
	    <tbody>
			{foreach from=$items item=item}
		        <tr id="{$item.id}">
		            <td>{$item.price}</td>
		            <td>{$item.coins}</td>
	                <td class="text-right">
	                    <div class="btn-group">
	                        <a class="btn btn-sm btn-success" href="{$url}donate_paypal/items/edit/{$item.id}"><i class="fa fa-pencil"></i> Edit</a>
	                        &nbsp;
	                        <a class="btn btn-sm btn-danger" onClick="Donate_paypal.remove({$item.id}, this)"><i class="fa fa-times"></i> Delete</a>
	                    </div>
	                </td>
		        </tr>
			{/foreach}
	    </tbody>
	</table>
{/if}