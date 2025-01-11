{foreach from=$downloads item=download}
	<h2><a href="{$download.download_link}">{$download.download_name}</a></h2>
{/foreach}