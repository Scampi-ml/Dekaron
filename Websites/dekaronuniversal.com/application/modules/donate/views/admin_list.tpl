{if $type == "paypal"}
	{foreach from=$results item=paypal_log}
		<li>
			<table width="100%" style="font-size:11px;">
				<tr>
					<td width="13%">{date("Y/m/d", $paypal_log.timestamp)}</td>
					<td width="13%">
						<a href="{$url}profile/{$paypal_log.user_id}" target="_blank">
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
{else}
{/if}