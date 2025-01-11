{if $paypal_mode == 'sandbox'}
<div class="boxerror"><b>WARNING:</b> You are running in sandbox mode!<br>Please note that PayPal Sandbox is kinda slowly, let it connect!</div>
{/if}

<br>
<center>	
	<h2>Redirecting to PayPal.. Please wait</h2>
	<a href='{$pp_url}'>Only click here if it does not load.</a>	
</center>

<br>
<meta http-equiv="refresh" content="0; url={$pp_url}">