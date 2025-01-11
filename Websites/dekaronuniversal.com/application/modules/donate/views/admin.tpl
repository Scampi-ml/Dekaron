<div class="statistics">
	<span>Monthly income ({$currency})</span>
	<div class="image">
		<img src="https://chart.googleapis.com/chart?chf=bg,s,FFFFFF&chxl=0:|{$first_date}|{$last_date}&chxp=0,12,87&chxr=1,0,{$top+20}&chxs=1,676767,11.5,0,lt,676767&chxt=x,y&chs=667x190&cht=lc&chco=095a9d&chds=0,{$top+20}&chd=t:{$monthly_income_stack}&chdlp=l&chls=2&chma=5,5,5,5" />
	</div>
</div>

{if $paypal_enabled}
	<section class="box big" id="donate_articles">
		<h2>
			<img src="{$url}application/themes/admin/images/icons/black16x16/ic_text_document.png"/>
			Last 10 PayPal donations
		</h2>

		<form style="margin-top:0px;" onSubmit="Donate.search('paypal'); return false">
			<input type="text" name="search_paypal" id="search_paypal" placeholder="Search by username, PayPal email or TXN ID" style="width:90%;margin-right:5px;"/>
			<input type="submit" value="Search" style="display:inline;padding:8px;" />
		</form>
	
		<ul id="donate_list_paypal">
			{if $paypal_logs}
				{foreach from=$paypal_logs item=paypal_log}
					<li>
						<table width="100%" style="font-size:11px;">
							
							<tr>
								<td width="13%">{date("Y/m/d", $paypal_log.timestamp)}</td>
								<td width="13%">
									<a href="{$url}profile/{$paypal_log.character_name}" target="_blank">
										{$paypal_log.nickname}
									</a>
								</td>
								
								<td width="13%" {if !$paypal_log.validated}style="text-decoration:line-through"{/if}>
									<b>
										{$paypal_log.payment_amount} {$paypal_log.payment_currency}
									</b>
								</td>

								{if $paypal_log.validated}
									<td width="15%" >{$paypal_log.payment_status}</td>
								{else}
									<td width="15%" data-tip="{$paypal_log.error}" style="color:red;cursor:pointer;">
										Error (?)
									</td>
								{/if}

								<td data-tip="Transaction ID: {$paypal_log.txn_id}" style="font-size:11px;">{$paypal_log.payer_email}</td>
							
								{if !$paypal_log.validated}<td><a class="nice_button" style="float:right;" href="javascript:void(0)" onClick="Donate.give({$paypal_log.id}, this)">Give DP</a></td>{/if}
							</tr>
						
						</table>
					</li>
				{/foreach}
			{/if}
		</ul>
	</section>
{/if}
