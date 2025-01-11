{form_open('donate_paypal/pay', 'class="page_form"')}
{if isset($validation_errors) && !empty($validation_errors)}<div class="boxerror">{$validation_errors}</div>{/if}
{if $items}
	<table class="nice_table" width="100%">
	    <tbody>	
			{foreach from=$items item=item}
		        <tr>
		            <td><input type="radio" name="item" value="{$item.id}"></td>
		            <td>Buy {$item.coins|number_format:0:",":"."} coins for {$item.price} {$currency}</td>
		        </tr>	   
			{/foreach}
	    </tbody>
	</table>
{/if}
<br><br>
<table style="width:80%">
	<tbody>
		<tr>
			<td><label for="register_username">Character Name</label></td>
			<td><input type="text" name="character_name"></td>
		</tr>
	</tbody>
</table>

<center style="margin-bottom:10px;margin-top:10px;">
	<input type="submit" value="Buy Coins" name="buy">
</center>
{form_close()}