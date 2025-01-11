<div class="clearfix">
    <a class="btn btn-sm btn-success" href="{$url}admin/slider/create"><i class="fa fa-pencil"></i> Create slider</a>
</div>
<div class="block-selection">
	{if $slides}
		<table class="table table-condensed" id="slider_list">
			<thead>
				<tr>
					<th>Position</th>
					<th>Image</th>
					<th>Link Text</th>
					<th>Link Url</th>
					<th></th>
				</tr>
			</thead>        
			<tbody> 
				{foreach from=$slides item=slide}
					<tr>
						<td width="10%">
							<a class="btn btn-sm btn-default" onClick="Slider.move('up', {$slide.id}, this)" href="javascript:void(0)" data-original-title="Move Up"><i class="fa fa-caret-up"></i></a>
							<a class="btn btn-sm btn-default" onClick="Slider.move('down', {$slide.id}, this)" href="javascript:void(0)" data-original-title="Move Down"><i class="fa fa-caret-down"></i></a>
						</td>
						<td width="25%"><b>{$slide.image}</b></td>
						<td width="30%">{$slide.text}</td>
						<td width="20%"><a href="{$slide.link}" target="_blank">{$slide.link_short}</a></td>
						<td class="text-right">
							<div class="btn-group">
								<a href="{$url}admin/slider/edit/{$slide.id}" class="btn btn-sm btn-success">Edit</a>
								&nbsp;
								<a href="javascript:void(0)" onClick="Slider.remove({$slide.id}, this)" data-tip="Delete" class="btn btn-sm btn-danger">Delete</a>
							</div>
						</td>
					</tr>				
				{/foreach}
			</tbody>
		</table> 
	{/if}   			
</div>