{if isset($error)}
	<div class="boxerror">ERROR: {$error}</div>
{else}
	<center>
		<h2>{$success}</h2>
	</center>
{/if}