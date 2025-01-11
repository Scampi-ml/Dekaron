{TinyMCE()}
<div class="block block-themed">
    <div class="block-title">
        <div class="block-options">
            {if hasPermission("canAdd")}
                <a data-toggle="block-collapse" class="btn btn-option enable-tooltip" href="javascript:void(0)" data-original-title="Create page"  onClick="Pages.show()"><i class="fa fa-plus"></i></a>
            {/if}                
        </div>
        <h4>Pages ({if !$pages}0{else}{count($pages)}{/if})</h4>
    </div>
    <div class="block-content">
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
                            {if hasPermission("canEdit")}
                            	<a class="btn btn-sm btn-success"href="{$url}page/admin/edit/{$page.id}">Edit</a>
                            {/if}
                            &nbsp;
                            {if hasPermission("canRemove")}
                            	<a class="btn btn-sm btn-danger" href="javascript:void(0)" onClick="Pages.remove({$page.id}, this)">Delete</a>
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

<div id="add_pages" style="display:none;">
	<section class="box big">
		<h2><a href='javascript:void(0)' onClick="Pages.show()" data-tip="Return to pages">Pages</a> &rarr; New page</h2>

		<form onSubmit="Pages.send(); return false">
			<label for="headline">Headline</label>
			<input type="text" id="headline" />
			
			<label for="identifier">Unique link identifier (as in mywebsite.com/page/<b>mypage</b>)</label>
			<input type="text" id="identifier" placeholder="mypage" />

			<label for="visibility">Visibility mode</label>
			<select name="visibility" id="visibility" onChange="if(this.value == 'group'){ $('#groups').fadeIn(300); } else { $('#groups').fadeOut(300); }">
				<option value="everyone" selected>Visible to everyone</option>
				<option value="group">Controlled per group</option>
			</select>

			<div id="groups" style="display:none;">
				Please manage the group visibility via <a href="{$url}admin/aclmanager/groups">the group manager</a> once you have created the page
			</div>

			<label for="pages_content">
				Content
			</label>
		</form>
			<div style="padding:10px;">
				<textarea name="pages_content" class="tinymce" id="pages_content" cols="30" rows="10"></textarea>
			</div>
		<form onSubmit="Pages.send(); return false">
			<input type="submit" value="Submit page" />
		</form>
	</section>
</div>

<script>
	require([Config.URL + "application/themes/admin/js/mli.js"], function()
	{
		new MultiLanguageInput($("#headline"));
	});
</script>