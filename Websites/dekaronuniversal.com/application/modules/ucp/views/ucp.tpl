<section id="ucp_top">
	<a href="{$url}ucp/avatar" id="ucp_avatar"><div>{lang("change_avatar", "ucp")}</div><img src="{$avatar}"/></a>
	<section id="ucp_info">
		<aside>
			<table width="280">
				<tr>
					<td width="5%"><img src="{$url}application/images/icons/user.png" /></td>
					<td width="35%">{lang("nickname", "ucp")}</td>
					<td width="60%"><a href="profile/{$id}" data-tip="View profile">{$username}</a></td>
				</tr>
				<tr>
					<td width="5%"><img src="{$url}application/images/icons/world.png" /></td>
					<td width="35%">Playtime</td>
					<td width="60%">{$playtime}hrs</td>
				</tr>
				<tr>
					<td width="5%"><img src="{$url}application/images/icons/coins.png" /></td>
					<td width="35%">Coins</td>
					<td width="60%">{$coins|number_format:0:",":"."}</td>
				</tr>
				<tr>
					<td width="5%"><img src="{$url}application/images/icons/award_star_bronze_1.png" /></td>
					<td width="35%">Rank</td>
					<td width="60%">{foreach from=$groups item=group} <span {if $group.color}style="color:{$group.color}"{/if}>{$group.name}</span>{/foreach}</td>
				</tr>
			</table>
		</aside>
		<aside>
			<table width="450">
				<tr>
					<td width="5%"><img src="{$url}application/images/icons/lightning.png" /></td>
					<td width="35%">{lang("voting_points", "ucp")}</td>
					<td width="60%">{$voting_points}</td>
				</tr>
				<tr>
					<td width="5%"><img src="{$url}application/images/icons/coins.png" /></td>
					<td width="35%">{lang("donation_points", "ucp")}</td>
					<td width="60%">{$donation_points}</td>
				</tr>
				<tr>
					<td width="5%"><img src="{$url}application/images/icons/shield.png" /></td>
					<td width="35%">{lang("account_status", "ucp")}</td>
					<td width="50%">{$account_status}</td>
				</tr>
				<tr>
					<td width="10%"><img src="{$url}application/images/icons/date.png" /></td>
					<td width="35%">{lang("member_since", "ucp")}</td>
					<td width="60%">{$member_since}</td>
				</tr>
			</table>
		</aside>
	</section>
	<div style="clear:both;"></div>
</section>
<div class="ucp_divider"></div>
<section id="ucp_buttons">
<br />
	{if hasPermission('view', "admin") && $config['admin']}
		<a href="{$url}{$config.admin}" style="background-image:url({$url}application/modules/ucp/images/admin_panel.jpg)"></a>
	{/if}
    
    {if $ucp_modules}
        {foreach from=$ucp_modules item=module_name}
            {foreach from=$module_name.ucp_module item=mod}
                <a href="{$url}{$mod}" style="background-image:url({$url}application/modules/{$mod}/images/{$mod}.png)"></a>
            {/foreach}
        {/foreach}
	{/if}       
	<div class="clear"></div>
</section>
{$characters}