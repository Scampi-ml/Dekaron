<script type="text/javascript">
	var customPages = JSON.parse('{json_encode($pages)}');
</script>
<div class="block block-themed" id="main_link">
    <div class="block-title">
        <div class="block-options">
            {if hasPermission("addMenuLinks")}
                <a title="" class="btn btn-option enable-tooltip" href="javascript:void(0)" data-original-title="Create link" onClick="Menu.add()"><i class="fa fa-plus"></i></a>
            {/if}                
        </div>
        <h4>Menu links ({if !$links}0{else}{count($links)}{/if})</h4>
    </div>
    <div class="block-content">
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
                    {if hasPermission("editMenuLinks")}
                        <td>
                            <div class="btn-group">
                                 <a class="btn btn-sm btn-default" onClick="Menu.move('up', {$link.id}, this)" href="javascript:void(0)" data-original-title="Move Up"><i class="fa fa-caret-up"></i></a>
                                &nbsp;
                                {if hasPermission("deleteMenuLinks")}
                                    <a class="btn btn-sm btn-default" onClick="Menu.move('down', {$link.id}, this)" href="javascript:void(0)" data-original-title="Move Down"><i class="fa fa-caret-down"></i></a>
                                {/if}
                            </div>                    
                        </td>
                    {/if}
                    <td>{$link.side}</td>
                    <td>{langColumn($link.name)}</td>
                    <td><a href="{$link.link}" target="_blank">{$link.link_short}</a></td>
                    <td class="text-right">
                        <div class="btn-group">
                            {if hasPermission("editMenuLinks")}
                            	<a class="btn btn-sm btn-success" href="{$url}admin/menu/edit/{$link.id}"><i class="fa fa-pencil"></i> Edit</a>
                            {/if}
                            &nbsp;
                            {if hasPermission("deleteMenuLinks")}
                            	<a class="btn btn-sm btn-danger" onClick="Menu.remove({$link.id}, this)"><i class="fa fa-times"></i> Delete</a>
                            {/if}
                        </div>
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>        
		{/if}
    </div>
</div>


<section class="box big" id="add_link" style="display:none;">
	<h2><a href='javascript:void(0)' onClick="Menu.add()" data-tip="Return to menu links">Menu links</a> &rarr; New link</h2>

	<form onSubmit="Menu.create(this); return false" id="submit_form">
		<label for="name">Title</label>
		<input type="text" name="name" id="name" placeholder="My link" />

		<label for="type" data-tip="External links must begin with http://">URL (or <a href="javascript:void(0)" onClick="Menu.selectCustom()">select from custom pages</a>) <a>(?)</a></label>
		<input type="text" name="link" id="link" placeholder="http://"/>

		<label for="side">Menu location</label>
		<select name="side" id="side">
				<option value="top">Top</option>
				<option value="side">Side</option>
		</select>

		<label for="visibility">Visibility mode</label>
		<select name="visibility" id="visibility" onChange="if(this.value == 'group'){ $('#groups').fadeIn(300); } else { $('#groups').fadeOut(300); }">
			<option value="everyone" selected>Visible to everyone</option>
			<option value="group">Controlled per group</option>
		</select>

		<div id="groups" style="display:none;">
			Please manage the group visibility via <a href="{$url}admin/aclmanager/groups">the group manager</a> once you have created the link
		</div>

<label for="direct_link" data-tip="If you want to link to a non-DekaronCMS page on the same domain, you must select 'Yes' otherwise DekaronCMS will try to load it 'inside' the theme.">Internal direct link <a>(?)</a></label>
		<select name="direct_link" id="direct_link">
				<option value="0">No</option>
				<option value="1">Yes</option>
		</select>
	
		<input type="submit" value="Submit link" />
	</form>
</section>