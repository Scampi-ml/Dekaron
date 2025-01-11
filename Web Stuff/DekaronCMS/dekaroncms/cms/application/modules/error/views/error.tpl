{if isset($is404) && $is404}
	<center style='margin:10px;font-weight:bold;'>The file or module you requested could not be found!</center>
{else}
	<center style='margin:10px;font-weight:bold;'>{$errorMessage}</center>
{/if}
