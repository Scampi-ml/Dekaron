<section class="box big">
	<h2>Edit sidebox</h2>

	<form onSubmit="Sidebox.save(this, {$sidebox.id}); return false" id="submit_form">
		<label for="displayName">Headline</label>
		<input type="text" name="displayName" id="displayName" value="{htmlspecialchars($sidebox.displayName)}"/>

		<label for="type">Sidebox module</label>
		<select id="type" name="type" onChange="Sidebox.toggleCustom(this)">
			{foreach from=$sideboxModules item=module key=name}
				<option value="{$name}" {if $sidebox.type == preg_replace("/sidebox_/", "", $name)}selected{/if}>{$module.name}</option>
			{/foreach}
		</select>

		<label for="visibility">Visibility mode</label>
		<select name="visibility" id="visibility">
			<option value="everyone" {if !$sidebox.permission}selected{/if}>Visible to everyone</option>
			<option value="group" {if $sidebox.permission}selected{/if}>Controlled per group</option>
		</select>

	</form>

	<span id="custom_field" style="padding-top:0px;padding-bottom:0px;{if $sidebox.type != "custom"}display:none{/if}" >
		<label for="text">Content</label>
		{$Editor}
	</span>

	<form onSubmit="Sidebox.save(document.getElementById('submit_form'), {$sidebox.id}); return false">
		<input type="submit" value="Save sidebox" />
	</form>
</section>