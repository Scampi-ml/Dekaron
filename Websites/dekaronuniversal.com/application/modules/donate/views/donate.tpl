<div id="donate">
	<div class="boxinfo">Please enter your character name and press "Check". <br>If your character name is found the "PAY WITH PAYPAL" button will be displayed.</div>
	<form action="https://www{if $donate_paypal.sandbox}.sandbox{/if}.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_xclick" />
		<input type="hidden" name="business" value="{$donate_paypal.email}" />
		<input type="hidden" name="item_name" value="{lang("donation_for", "donate")} {$server_name}" />
		<input type="hidden" name="quantity" value="1" />
		<input type="hidden" name="shipping" value="0" />
		<input type="hidden" name="currency_code" value="{$currency}" />
		<input type="hidden" name="return" value="{$url}donate/success" />
		<table class="nice_table" width="100%">
			<tr>
				<td>Character Name</td>
				<td><input type="text" name="custom" id="custom" value="" maxlength="200" /><a href="javascript:void(0)" onClick="Donate.checkUsername()" >Check</a></td>
			</tr>
			<tr>
				<td>Amount</td>
				<td>

				{foreach from=$donate_paypal.values item=value key=key}
					<label for="option_{$key}">
						<input type="radio" name="amount" value="{$key}" id="option_{$key}"/> <b>{$value} {lang("dp", "donate")}</b> {lang("for", "donate")} <b>{$currency_sign}{$key}</b>
					</label>
				{/foreach}					
					
					
				</td>
			</tr>
		</table>				
		<br>
		<div class="clear"></div>
		<input type='submit'  class="paypal_submit" value='{lang("pay_paypal", "donate")}' />
	</form>
</div>